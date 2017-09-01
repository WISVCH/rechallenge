<?php
/* Template Name: Education Updates */
get_header();

get_template_part("parts/navigation/breadcrumb");
?>

    <!-- Main -->
    <main class="shrink">

        <div class="row column">
            <?php
            the_content();
            ?>
        </div>

        <div class="row">
            <?php
            $edup = new WP_Query([
               'category_name' => 'education-updates'
            ]);

            if ($edup->have_posts()) {

                while ($edup->have_posts()) {

                    // Render first post
                    $edup->the_post();
                    ?>

                    <div class="column column-block separator-block news-block">
                        <?php get_template_part('parts/post-type/excerpt', 'post-large'); ?>
                    </div>

                    <?php
                }

                wp_reset_postdata();
            } else {
                ?>

                <div class="column">
                    <h2>No education updates available</h2>
                    <p>There are no education updates to display.</p>
                </div>

                <?php
            }
            ?>
        </div>

    </main>

<?php
get_footer();
