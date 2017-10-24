<!-- Calendar -->
<section class="wisv-panel">
    <header class="wisv-panel-heading">
        <h1 class="small">Career Events</h1>
    </header>

    <div class="wisv-panel-content">

        <?php
        $events = new WP_Query([
            'post_type' => 'event',
            'posts_per_page' => 2,
            'meta_query' => [
                'event_selection' => [
                    'key' => '_event_end_date',
                    'type' => 'DATETIME',
                    'value' => date('Y-m-d H:i'),
                    'compare' => '>=',
                ],
                'event_order' => [
                    'key' => '_event_start_date',
                    'type' => 'DATETIME',
                ],
            ],
            'tax_query' => [
                [
                    'taxonomy' => 'event_category',
                    'field' => 'slug',
                    'terms' => 'career',
                ],
            ],
            'orderby' => 'event_order',
            'order' => 'ASC',
        ]);

        if ($events->have_posts()) { ?>

            <ul>
                <?php
                while ($events->have_posts()) {
                    $events->the_post(); ?>
                    <li class="row event"><?php get_template_part('parts/post-type/excerpt', 'event'); ?></li>
                    <?php
                }
                wp_reset_postdata();
                ?>
            </ul>

        <?php } else { ?>

            <p>There are no career events planned in the near future.</p>

        <?php } ?>

    </div>
</section>
