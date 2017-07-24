<?php
get_header();
?>

    <!-- Main -->
    <main>
        <?php
        get_template_part("parts/navigation/breadcrumb");
        get_template_part('parts/post-type/archive', 'post');
        ?>
    </main>

<?php
get_footer();
