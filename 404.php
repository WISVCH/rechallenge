<?php
get_header();
?>

    <!-- Main -->
    <section>

        <?php
        get_template_part("parts/navigation/breadcrumb");
        ?>

        <div class="row column">
            <h1>Page not found</h1>
            <p>The requested page could not be found.</p>
            <?php get_search_form(); ?>
        </div>

    </section>

<?php
get_footer();