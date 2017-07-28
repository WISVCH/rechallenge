<?php
get_header();
?>

    <!-- Main -->
    <main <?php echo ! is_singular('event') && !is_singular('company') && !is_singular('job_opening') ? 'class="shrink"' : ''; ?>>

        <?php
        get_template_part("parts/navigation/breadcrumb");
        ?>

        <div class="row column">
            <?php
            while (have_posts()) {
                the_post();

                get_template_part('parts/post-type/single', get_post_type());
            }
            ?>
        </div>

    </main>

<?php
get_footer();