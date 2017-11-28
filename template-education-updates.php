<?php
/* Template Name: Education Updates */
get_header();
?>

    <!-- Main -->
    <main class="shrink">

        <?php
        get_template_part("parts/navigation/breadcrumb");

        // Display page content
        the_post();
        get_template_part('parts/post-type/single');

        // Load education updates
        $updates = new WP_Query([
            'category_name' => 'education-updates',
            'posts_per_page' => 3,
        ]);

        if ($updates->have_posts()) { ?>

            <div class="row">

                <?php
                while ($updates->have_posts()) {
                    $updates->the_post();
                    ?>

                    <div class="column column-block separator-block news-block">
                        <?php get_template_part('parts/post-type/excerpt', 'post'); ?>
                    </div>

                    <?php
                }
                wp_reset_postdata();
                ?>

            </div>

            <div class="row">
                <p class="next-prev-links"><a class="button small" href="<?=get_term_link('education-updates', 'category')?>">
                        More education updates <i class="fa ch-arrow-right"></i>
                    </a></p>
            </div>

            <?php
        } else {
            ?>

            <div class="row column column-block">
                <h3>Check back soon!</h3>
                <p>There are no education updates available at the moment.</p>
            </div>

        <?php } ?>

        </div>
    </main>

<?php
get_footer();
