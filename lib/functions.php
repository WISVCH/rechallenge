<?php

/**
 * Encodes e-mail address. Rudimentary spam protection.
 *
 * @param $e Input email
 * @return string Encoded output email
 */
function encode_email($e)
{
    $output = '';
    for ($i = 0; $i < strlen($e); $i++) {
        $output .= '&#'.ord($e[$i]).';';
    }

    return $output;
}

/**
 * @TODO Might not be necessary when using Yoast SEO.
 * @return string Page title.
 */
function rechallenge_get_title()
{

    if (is_home()) {
        $title = get_the_title(get_option("page_for_posts"));
    } elseif (is_singular('post')) {
        $title = "News";
    } elseif (is_post_type_archive("board") || is_singular('board')) {
        $title = "Current and previous boards";
    } elseif (is_post_type_archive("committee") || is_singular('committee')) {
        $title = "Committees";
    } elseif (is_post_type_archive("company") || is_singular('company')) {
        $title = "Companies";
    } elseif (is_post_type_archive("honorary_member") || is_singular('honorary_member')) {
        $title = "Honorary Members";
    } elseif (is_post_type_archive("job_opening") || is_singular('job_opening')) {
        $title = "Job Openings";
    } elseif (is_post_type_archive("event") || is_singular('event')) {
        $title = "Activities";
    } elseif (is_archive()) {
        $title = get_the_archive_title();
    } elseif (is_404()) {
        $title = "404 &ndash; Page not found";
    } else {
        $title = get_the_title(get_the_ID());
    }

    return $title;
}

function rechallenge_get_cover_image()
{

    // News
    if (is_singular('post') || is_home()) {
        $cover_image = get_the_post_thumbnail_url(get_option('page_for_posts'), 'cover');
    } else {
        $cover_image = get_the_post_thumbnail_url(rechallenge_get_aux_page_id(), 'cover');
    }

    return $cover_image ?? '';
}

/**
 * Returns the ID of the page associated with a custom post type archive. (if a post type archive page)
 *
 * @return int|false Auxiliary page ID.
 */
function rechallenge_get_aux_page_id()
{

    // Custom post type archives
    if (is_post_type_archive("board") || is_singular('board')) {
        $id = get_page_by_path("association/boards");
    } elseif (is_post_type_archive("committee") || is_singular('committee')) {
        $id = get_page_by_path("association/committees");
    } elseif (is_post_type_archive("company") || is_singular('company')) {
        $id = get_page_by_path("career/companies");
    } elseif (is_post_type_archive("honorary_member") || is_singular('honorary_member')) {
        $id = get_page_by_path("association/honorary-members");
    } elseif (is_post_type_archive("job_opening") || is_singular('job_opening')) {
        $id = get_page_by_path("career/job-openings");
    } elseif (is_post_type_archive("event") || is_singular('event')) {
        $id = get_page_by_path("activities");
    } elseif (is_home() || is_archive()) {
        $id = get_post(get_option("page_for_posts"));
    }

    if (isset($id) && is_a($id, "WP_Post")) {
        return $id->ID;
    }

    return get_the_ID();
}

/**
 * Format two event timestamps.
 *
 * @param $start_ts
 * @param $end_ts
 * @return array Formatted start date at index 0, formatted end date (if any) at index 1.
 */
function format_event_date($start_ts, $end_ts)
{

    // Check the start date
    if ($start_ts < 0) {
        return ['Unknown'];
    }

    // Prepare DateTime object
    $start = new DateTime();
    $start->setTimestamp($start_ts);

    // Check the end date
    if ($end_ts < 0) {
        $date_str = [$start->format('F j, Y, G:i')];
    } else { // Both start and end date set
        $end = new DateTime();
        $end->setTimestamp($end_ts);

        // Calculate date difference
        $diff = $start->diff($end);

        // Same day
        if ($diff->d === 0) {
            $date_str = [
                $start->format('F j, Y, G:i').' &ndash; '.$end->format("G:i"),
            ];
        } else { // Different day
            $date_str = [
                $start->format('F j, Y, G:i'),
                $end->format('F j, Y, G:i'),
            ];
        }
    }

    return $date_str;
}

/**
 * Money format event cost.
 *
 * @param $cost_str Raw price string from database.
 * @return string Formatted price string.
 */
function format_event_cost($cost_str)
{

    // Check if cost is set, numeric and not negative
    if (! isset($cost_str) || ! is_numeric($cost_str) || $cost_str < 0) {
        $formatted_cost = 'Unknown';
    } else {

        // Check if price is free
        if ($cost_str > 0) {
            $formatted_cost = number_format($cost_str, 2, ',', '.');

            // Substitute the leading zeroes for a dash
            if (substr($formatted_cost, -3) === ',00') {
                $formatted_cost = substr($formatted_cost, 0, -3).",&minus;";
            }
        } else {
            $formatted_cost = '0,&minus;';
        }
    }

    return $formatted_cost;
}

/**
 * Display tab-like bar to select taxonomy terms.
 *
 * @param $term_array get_terms() array.
 * @param $filter GET-variable name of filter.
 */
function rechallenge_faceted_term_selection($term_array, $filter, $label = null)
{
    $filter_check = empty($_GET[$filter]) ? null : sanitize_title($_GET[$filter]);

    if (! is_wp_error($term_array)) { ?>
        <ul class="tabs faceted-selection">
            <?php if ($label) { ?>
                <li class="tabs-title tabs-label"><span><?=esc_html($label)?></span></li>
            <?php } ?>
            <li class="tabs-title"><a<?=$filter_check === null ? ' aria-selected="true"' : ''?> href="<?=esc_attr(remove_query_arg($filter))?>">All</a></li>
            <?php
            foreach ($term_array as $term) {
                $active_class = $term->slug === $filter_check ? ' aria-selected="true"' : ''; ?>
                <li class="tabs-title"><a<?=$active_class?> href="<?=esc_attr(add_query_arg($filter, $term->slug))?>"><?=esc_html($term->name);?></a></li>
            <?php } ?>
        </ul>
    <?php }
}

