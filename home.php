<?php
/**
 * Template for news overview (association -> news)
 */
get_header();
?>

    <!-- Main -->
    <main class="shrink">

        <?php
        get_template_part("parts/navigation/breadcrumb");
        ?>

        <div class="row news-overview">
            <?php
            if (have_posts()) {
                ?>
                <div class="row">
                    <?php
                    while (have_posts()) {

                        // Render first post
                        the_post();
                        ?>

                        <div class="column column-block">
                            <?php get_template_part('parts/post-type/excerpt', 'post'); ?>
                        </div>

                        <?php
                    }
                    ?>

                </div>

                <?php
            } else {
                ?>

                <div class="column">
                    <h3>No content available</h3>
                    <p>There are currently no (recent) news items.</p>
                </div>

                <?php
            }
            ?>
        </div>

        <div class="row column">
            <p><a class="button small" href="<?=get_year_link('')?>">Browse news archives &rsaquo;</a></p>
        </div>

    </main>

<?php
get_footer();
