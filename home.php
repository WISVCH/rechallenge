<?php
/**
 * Template for news overview (association -> news)
 */
get_header();
?>

    <!-- Main -->
    <main class="shrink news-overview">

        <?php
        get_template_part("parts/navigation/breadcrumb");
        ?>

        <div class="row column">
            <h1>News</h1>
            <p>All the latest about W.I.S.V. 'Christiaan Huygens'.</p>
        </div>

        <div class="row">
            <?php
            if (have_posts()) {

                while (have_posts()) {

                    // Render first post
                    the_post();
                    ?>

                    <div class="column column-block separator-block news-block">
                        <?php get_template_part('parts/post-type/excerpt', 'post-large'); ?>
                    </div>

                    <?php
                }
            } else {
                ?>

                <div class="column">
                    <h2>No content available</h2>
                    <p>There are currently no (recent) news items.</p>
                </div>

                <?php
            }
            ?>
        </div>

        <div class="row column">
            <div class="next-prev-links">
                <p><?php echo get_posts_nav_link([
                        'sep' => '',
                    ]); ?></p>
            </div>

            <p><a class="button small" href="<?=get_year_link('')?>">Browse full news archives &rsaquo;</a></p>
        </div>

    </main>

<?php
get_footer();
