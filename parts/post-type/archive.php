<div class="row small-up-2 medium-up-3 large-up-4">
    <?php
    $post_type = get_post_type();

    // Get large excerpt for posts
    if ($post_type === 'post') {
        $post_type = 'post-large';
    }

    while (have_posts()) {
        the_post();
        ?>

        <div class="column column-block">
            <?php get_template_part('parts/post-type/excerpt', $post_type); ?>
        </div>

        <?php
    }
    ?>
</div>
