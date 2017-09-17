<?php
get_header();
?>

    <!-- Main -->
    <main>

        <?php
        get_template_part("parts/navigation/breadcrumb");
        ?>

        <div class="row column">

            <?php
            if (have_posts()) {

                while (have_posts()) {
                    the_post();

                    get_template_part('parts/post-type/single-post');
                }
            } else {
                get_template_part('parts/post-type/empty', 'post');
            }
            ?>

        </div>

    </main>

<?php
get_footer();
