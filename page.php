<?php
get_header();
?>

    <!-- Main -->
    <main class="shrink">

        <?php
        get_template_part("parts/navigation/breadcrumb");

        the_post();

        get_template_part('parts/post-type/single-page');
        ?>
    </main>

<?php
get_footer();
