<?php
/* Template Name: Education Updates */
get_header();
?>

    <!-- Main -->
    <main class="shrink news-overview">

        <?php
        get_template_part("parts/navigation/breadcrumb");
        ?>

        <div class="row column">
            <?php
            the_content();
            ?>
        </div>

        <?php
        $edu = new WP_Query([
            'post_type' => 'post',
            'category_name' => 'education-updates',
            'paged' => (get_query_var('paged')) ? get_query_var('paged') : 1,

        ]);

        if ($edu->have_posts()) {
            ?>

            <div class="row">

                <?php
                while ($edu->have_posts()) {
                    $edu->the_post(); ?>
                    <div class="column column-block separator-block news-block">
                        <?php get_template_part('parts/post-type/excerpt', 'post-large'); ?>
                    </div>
                <?php } ?>

            </div>

            <?php if ($edu->max_num_pages > 1) { ?>
                <div class="row column">
                    <div class="next-prev-links">
                        <p><?php
                            echo get_previous_posts_link();
                            echo get_next_posts_link(null, $edu->max_num_pages);
                            ?></p>
                    </div>
                </div>
                <?php
            }

            wp_reset_postdata();
        } else { ?>

            <div class="row">
                <div class="column">
                    <h3>No education updates available</h3>
                    <p>There are no education updates to display.</p>
                </div>
            </div>

        <?php } ?>

    </main>

<?php
get_footer();
