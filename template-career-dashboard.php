<?php
/* Template Name: Career Dashboard */
get_header();

get_template_part("parts/navigation/breadcrumb");
?>

    <div class="row column">
        <?php
        the_title('<h1>', '</h1>');
        the_content();
        ?>
    </div>

    <!-- Calendar / News -->
    <div class="section-even calendar-news">

    <div class="row" data-equalizer data-equalize-on="large" id="equalize-columns">
        <div class="column medium-5 large-4">

            <!-- Calendar -->
            <section class="wisv-panel" data-equalizer-watch>
                <header class="wisv-panel-heading">
                    <h1 class="small">Career Events</h1>
                </header>

                <div class="wisv-panel-content">
                    <ul>
                        <?php
                        for ($x = 0; $x < 4; $x++) {
                            ?>
                            <li class="row event">
                                <?php get_template_part('parts/post-type/excerpt', 'event'); ?>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>

            </section>

        </div>
        <div class="column medium-7 large-8">

            <section class="wisv-panel" data-equalizer-watch>
                <div class="wisv-panel-heading">
                    <h1 class="small">Latest Job Openings
                        <small><a href="<?php echo get_post_type_archive_link('job_opening') ?>">View more <i class="fa ch-arrow-right"></i></a></small>
                    </h1>
                </div>
                <div class="wisv-panel-content">
                    <?php
                    // Get most recent job openings
                    $job_openings = new WP_Query([
                        'post_type' => 'job_opening',
                        'posts_per_page' => 3,
                        'orderby' => 'date',
                        'order' => 'DESC',
                    ]);

                    // Render job openings
                    iF ($job_openings->have_posts()) {
                        while ($job_openings->have_posts()) {
                            $job_openings->the_post();
                            get_template_part('parts/post-type/excerpt', 'job-opening');
                        }
                        wp_reset_postdata();
                    } else {
                        ?>
                        <div class="column">
                            <h3>No content available</h3>
                            <p class="">There are currently no (recent) job openings available.</p>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </section>

        </div>
    </div>

<?php
get_footer();
