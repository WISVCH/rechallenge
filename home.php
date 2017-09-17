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
        get_template_part("parts/post-type/archive", "post");
        ?>

    </main>

<?php
get_footer();
