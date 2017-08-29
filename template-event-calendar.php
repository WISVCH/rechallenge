<?php
/* Template Name: Event Calendar */
get_header();

get_template_part("parts/navigation/breadcrumb");
?>

    <main class="full">

        <div class="row column column-block">
            <div id="calendar" class="wisv-calendar"></div>
        </div>

        <div class="row column">
            <?php the_content(); ?>
        </div>

    </main>

<?php
get_footer();
