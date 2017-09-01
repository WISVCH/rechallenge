<div class="row small-up-2 medium-up-4 large-up-6">
    <?php
    while (have_posts()) {
        the_post(); ?>

        <div class="column column-block">
            <?php get_template_part('parts/post-type/excerpt', $post_type); ?>
        </div>

    <?php } ?>
</div>
