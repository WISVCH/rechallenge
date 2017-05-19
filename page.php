<?php
get_header();
?>

    <!-- Main -->
    <section>

        <?php
        get_template_part("parts/navigation/breadcrumb");

        the_post();

        get_template_part('parts/post-type/single-page');
        ?>
    </section>

<?php
get_footer();
