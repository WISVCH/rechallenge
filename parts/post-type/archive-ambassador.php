<div class="row small-up-1 medium-up-2 large-up-4">
    <?php
    while (have_posts()) {
        the_post(); ?>

        <div class="column column-block">
            <?php get_template_part('parts/post-type/excerpt', $post_type); ?>
        </div>

    <?php } ?>
</div>
