<div class="row column">
    <h1>Companies</h1>
    <p>Find your new employer with W.I.S.V. 'Christiaan Huygens'.</p>
</div>

<div class="row">
    <?php
    if (have_posts()) {

        while (have_posts()) {
            the_post();
            ?>

            <div class="column column-block separator-block">
                <?php get_template_part('parts/post-type/excerpt', 'company'); ?>
            </div>

            <?php
        }
    } else {
        ?>
        <p>There are currently no companies available to display.</p>
        <?php
    }
    ?>

</div>
