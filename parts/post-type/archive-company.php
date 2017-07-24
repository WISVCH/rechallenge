<div class="row column">
    <h2>Companies</h2>

    <?php
    if (have_posts()) {

        while (have_posts()) {
            the_post();
            get_template_part('parts/post-type/excerpt', 'company');
        }
    } else {
        ?>
        <p>There are currently no companies available to display.</p>
        <?php
    }
    ?>

</div>
