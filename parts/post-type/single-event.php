<?php
// Get post meta
$meta = get_post_custom(get_the_ID());
$location = ! isset($meta['_event_location']) ? 'Unknown' : $meta['_event_location'][0];
$start_ts = ! isset($meta['_event_start_date']) || empty($meta['_event_start_date'][0]) ? -1 : strtotime($meta['_event_start_date'][0]);
$end_ts = ! isset($meta['_event_end_date']) ? -1 : strtotime($meta['_event_end_date'][0]);
$cost_str = ! isset($meta['_event_cost']) ? -1 : $meta['_event_cost'][0];

// Date
$formatted_date = format_event_date($start_ts, $end_ts);

// Cost
$formatted_cost = format_event_cost($cost_str);

// Categories
$category_list = get_the_term_list(get_the_ID(), 'event_category', '', ', ', '');
?>


<div class="row post-content">

    <article class="column medium-7 large-8">

        <?php
        the_title('<h1>', '</h1>');
        the_content();
        ?>

        <footer>
            <?php get_template_part("parts/misc/share"); ?>
        </footer>

        <p class="events-backlink"><a class="button small" href="<?=site_url('/activities/');?>">&lsaquo; Back to calendar</a></p>

    </article>

    <aside class="column medium-5 large-4">

        <div class="wisv-panel">

            <header class="wisv-panel-heading">
                <h1 class="small">Details</h1>
            </header>

            <div class="wisv-panel-content">

                <?php if ($formatted_date[0]) { ?>
                    <ul class="fa-ul company-details">
                        <li><i class="fa-li fa ch-clock-o"></i><?=esc_attr($formatted_date[0])?></li>
                        <?php if (! empty($formatted_date[1])) { ?>
                            <li>till <?=esc_attr($formatted_date[1])?></li>
                        <?php } ?>
                    </ul>
                <?php } ?>

                <?php if ($location) { ?>
                    <ul class="fa-ul company-details">
                        <li><i class="fa-li fa ch-map-marker"></i><?=esc_attr($location)?></li>
                    </ul>
                <?php } ?>

                <ul class="fa-ul company-details">
                    <li><i class="fa-li fa ch-eur"></i><?=$formatted_cost?></li>
                </ul>

                <?php if ($category_list) { ?>
                    <ul class="fa-ul company-details">
                        <li><i class="fa-li fa ch-tag"></i><?=$category_list?></li>
                    </ul>
                <?php } ?>

            </div>

        </div>

        <?php
        if (has_post_thumbnail()) {
            ?>
            <div class="wisv-panel">
                <a href="<?=esc_url(get_the_post_thumbnail_url())?>">
                    <?php the_post_thumbnail('medium', [
                        'alt' => esc_attr(get_the_title()),
                    ]); ?>
                </a>
            </div>
            <?php
        }
        ?>
    </aside>

</div>

