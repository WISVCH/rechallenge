<?php
$meta = get_post_custom(get_the_ID());

$location = ! isset($meta['_event_location']) ? 'Unknown' : $meta['_event_location'][0];
$start = ! isset($meta['_event_start_date']) || empty($meta['_event_start_date'][0]) ? 'Unknown' : date("F j, Y, G:i", strtotime($meta['_event_start_date'][0]));
$end = ! isset($meta['_event_end_date']) ? 'Unknown' : date("F j, Y, G:i", strtotime($meta['_event_end_date'][0]));

// Cost
if (! isset($meta['_event_cost']) || ! is_numeric($meta['_event_cost'][0])) {
    $cost = '<em>Unknown</em>';
} else {
    $cost = $meta['_event_cost'][0] > 0 ? number_format_i18n($meta['_event_cost'][0], 2) : 'Free!';
    if (substr($cost, -3) === '.00') {
        $cost = substr($cost, 0, -3).",&minus;";
    }
}

$category_list = get_the_term_list(get_the_ID(), 'event-category', '', ', ', '');
?>

<article>

    <div class="row">

        <div class="column medium-7 large-8">

            <?php
            the_title('<h1>', '</h1>');
            the_content();
            ?>

            <p class="events-backlink"><a class="button small" href="<?=site_url('/activities/overview/');?>">&lsaquo; Back to calendar</a></p>

        </div>

        <aside class="column medium-5 large-4">

            <div class="wisv-panel">

                <header class="wisv-panel-heading">
                    <h1 class="small">Details</h1>
                </header>

                <div class="wisv-panel-content">

                    <?php if ($start) { ?>
                        <ul class="fa-ul company-details">
                            <li><i class="fa-li fa ch-clock-o"></i><?=esc_attr($start)?></li>
                            <?php if ($end) { ?>
                                <li><?=esc_attr($end)?></li>
                            <?php } ?>
                        </ul>
                    <?php } ?>

                    <?php if ($location) { ?>
                        <ul class="fa-ul company-details">
                            <li><i class="fa-li fa ch-map-marker"></i><?=esc_attr($location)?></li>
                        </ul>
                    <?php } ?>

                    <ul class="fa-ul company-details">
                        <li><i class="fa-li fa ch-eur"></i><?=$cost?></li>
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
                    <?php
                    the_post_thumbnail();
                    ?>
                </div>
                <?php
            }
            ?>
        </aside>

    </div>

</article>