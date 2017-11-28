<?php
$eventID = get_the_ID();

$meta = get_post_custom($eventID);
$taxonomy = get_post_taxonomies($eventID);

$start = strtotime($meta['_event_start_date'][0]);
$end = strtotime($meta['_event_end_date'][0]);
?>
<article class="column icon-row">

    <div class="icon-cell event-date-wrapper">
        <a href="<?php the_permalink(); ?>" class="event-date">
            <?php
            if ($start !== false) {
                echo date("l", $start).'<span>'.date("j", $start).'</span>'.date("F", $start);
            } else {
                echo '&nbsp;<span>??</span>&nbsp;';
            }
            ?>
        </a>
    </div>

    <div class="text-cell event-desc">
        <header>
            <h1 class="event-desc-header"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
        </header>

        <?php
        $categories = get_the_terms($eventID, 'event_category');
        $has_categories = is_array($categories);

        // Only display byline if category and/or start time is available
        if ($has_categories || $start !== false) { ?>

            <footer class="byline">
                <?php if ($has_categories) { ?>
                    <span class="event-location">
                    <?php
                    // TODO: restore when event categories are implemented
                    /* <a href="<?php echo get_term_link($item->term_id); ?>"><?php echo $item->name; ?></a> */
                    echo implode(', ', wp_list_pluck($categories, 'name'));
                    ?>
                </span>
                    <?php
                }

                if ($start !== false) {
                    ?>
                    <span class="event-time">
                    <?php echo date("G:i", $start)." - ".date("G:i", $end); ?>
                </span>
                <?php } ?>

            </footer>

        <?php } ?>

        <?php echo isset($meta['_event_short_description']) ? wpautop($meta['_event_short_description'][0]) : ''; ?>

    </div>

</article>
