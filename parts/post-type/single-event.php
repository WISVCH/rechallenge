<?php
// Get post meta
$meta = get_post_custom(get_the_ID());
$location = ! isset($meta['_event_location']) ? 'Unknown' : $meta['_event_location'][0];
$start_ts = ! isset($meta['_event_start_date']) || empty($meta['_event_start_date'][0]) ? -1 : strtotime($meta['_event_start_date'][0]);
$end_ts = ! isset($meta['_event_end_date']) ? -1 : strtotime($meta['_event_end_date'][0]);
$cost_str = ! isset($meta['_event_cost']) ? -1 : $meta['_event_cost'][0];
$events_key = ! isset($meta['_ch_events_key']) ? - 1 : $meta['_ch_events_key'][0];

// Date
$formatted_date = format_event_date($start_ts, $end_ts);

// Products
$product_ids = ! isset($meta['_event_product_post_array']) ? [] : unserialize($meta['_event_product_post_array'][0]);

// Categories
// TODO: restore when event categories are implemented
// $category_list = get_the_term_list(get_the_ID(), 'event_category', '', ', ', '');
$categories = get_the_terms(get_the_ID(), 'event_category');
$category_list = is_array($categories) ? implode(', ', wp_list_pluck($categories, 'name')) : false;
?>


<div class="row post-content">

    <aside class="column column-block medium-5 large-4 medium-push-7 large-push-8">

        <div class="wisv-panel">

            <header class="wisv-panel-heading">
                <h1 class="small">Details</h1>
            </header>

            <div class="wisv-panel-content">

                <?php if ($formatted_date[0]) { ?>
                    <ul class="fa-ul company-details">
                        <li><i class="fa-li fa ch-clock-o"></i><?=esc_attr($formatted_date[0])?></li>
                        <?php if (! empty($formatted_date[1])) { ?>
                            <li>to <?=esc_attr($formatted_date[1])?></li>
                        <?php } ?>
                    </ul>
                <?php } ?>

                <?php if ($location) { ?>
                    <ul class="fa-ul company-details">
                        <li><i class="fa-li fa ch-map-marker"></i><?= esc_attr($location) ?></li>
                    </ul>
                <?php } ?>

                <ul class="fa-ul company-details">
                    <?php
                    for ($i = 0; $i < count($product_ids); $i++) {
                        $product = get_post($product_ids[$i]);
                        $product_meta = get_post_custom($product_ids[$i]);
                        ?>
                        <li><?= ($i === 0) ? '<i class="fa-li fa ch-money"></i>' : '' ?>
                            &euro; <?= format_event_cost($product_meta['_product_cost'][0]) ?> <?= (count($product_ids) != 1) ? $product->post_title : '' ?>
                        </li>
                        <?php
                    }
                    ?>
                </ul>


                <?php if ($category_list) { ?>
                    <ul class="fa-ul company-details">
                        <li><i class="fa-li fa ch-tag"></i><?= $category_list ?></li>
                    </ul>
                <?php } ?>

            </div>

        </div>

        <?php
        if (has_post_thumbnail()) {
            ?>
            <div class="wisv-panel show-for-medium">
                <a href="<?= esc_url(get_the_post_thumbnail_url(null, 'large')) ?>">
                    <?php the_post_thumbnail('medium', [
                        'alt' => esc_attr(get_the_title()),
                    ]); ?>
                </a>
            </div>
            <?php
        }
        ?>
    </aside>

    <article class="column medium-7 large-8 medium-pull-5 large-pull-4">
        <p class="events-backlink">
            <a class="button alt" href="<?= site_url( '/activities/' ); ?>"><i class="fa ch-arrow-left"></i> Back to calendar</a>
        </p>


		<?php
		the_title( '<h1>', '</h1>' );
		the_content();

		if ( count( $product_ids ) > 0 ) {
		    $max_cost = PHP_INT_MIN;

			for ( $i = 0; $i < count( $product_ids ); $i ++ ) {
				$product_cost = get_post_custom($product_ids[ $i ])['_product_cost'][0];

				if ($product_cost > $max_cost) {
				    $max_cost = $product_cost;
                }
			}

			?>
            <a class="button small" href="<?= site_url( '/events/' . $events_key ); ?>">
                <?= ($max_cost > 0) ? 'Get your ticket now' : 'Register now' ?>
            </a>
			<?php
		}
		?>


        <footer>
			<?php get_template_part( "parts/misc/share" ); ?>
        </footer>
    </article>

</div>

