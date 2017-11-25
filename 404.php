<?php
get_header();
?>

    <!-- Main -->
    <main>

        <?php get_template_part("parts/navigation/breadcrumb"); ?>

        <div class="row column">
            <h1>Page not found</h1>
            <p>We're sorry, there is no page at the requested address.</p>
            <p><a class="button small alert" href="<?=home_url("/")?>"><i class="ch-arrow-left"></i> Back to the front page</a></p>
            <?php get_search_form(); ?>
        </div>

    </main>

<?php
get_footer();
