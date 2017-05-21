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
    } elseif (is_post_type_archive("board")) {
        $title = "Current and previous boards";
    } elseif (is_post_type_archive("committee")) {
        $title = "Committees";
    } elseif (is_post_type_archive("company")) {
        $title = "Companies";
    } elseif (is_post_type_archive("honorary_member")) {
        $title = "Honorary Members";
    } elseif (is_post_type_archive("job_opening")) {
        $title = "Job Openings";
    } elseif (is_post_type_archive("event")) {
        $title = "Events";
    } elseif (is_404()) {
        $title = "404 &ndash; Page not found";
    } else {
        $title = get_the_title(get_the_ID());
    }

    return $title;
}

function rechallenge_get_cover_image()
{
    if (is_singular("event")) {
        // @TODO: check if Yoast SEO enabled
        $cat = new WPSEO_Primary_Term('event-category', get_the_ID());
        $cat = $cat->get_primary_term();

        $terms = get_the_terms(get_the_ID(), 'event-category');

        if ($terms !== false) {

            foreach ($terms as $item) {
                if ($item->term_id === $cat) {
                    $cover_image = $item->description;
                }
            }
        }
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
    if (is_post_type_archive("board")) {
        $id = get_page_by_path("association/boards");
    } elseif (is_post_type_archive("committee")) {
        $id = get_page_by_path("association/committees");
    } elseif (is_post_type_archive("company")) {
        $id = get_page_by_path("career/companies");
    } elseif (is_post_type_archive("honorary_member")) {
        $id = get_page_by_path("association/honorary-members/");
    } elseif (is_post_type_archive("job_opening")) {
        $id = get_page_by_path("career/job-openings");
    } elseif (is_post_type_archive("event")) {
        $id = get_page_by_path("activities/overview");
    }

    // Singular custom post type
    if (is_singular([
        "board",
        "committee",
        "company",
        "honorary-member",
        "job-opening",
        "event",
    ])) {

        switch (get_post_type()) {
            case "board":
                $id = get_page_by_path("association/boards");
                break;
            case "company":
                $id = get_page_by_path("career/companies");
                break;
        }
    }

    if (isset($id) && is_a($id, "WP_Post")) {
        return $id->ID;
    }

    return get_the_ID();
}
