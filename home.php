<?php
get_header();
?>

    <!-- Main -->
    <section>
        <?php
        get_template_part("parts/navigation/breadcrumb");
        get_template_part('parts/post-type/archive', 'post');
        ?>
    </section>

<?php
get_footer();
