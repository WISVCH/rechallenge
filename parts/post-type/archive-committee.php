<div class="row small-up-2 medium-up-3 large-up-4">
    <?php
    $page = get_posts([
        'name'      => 'committees',
        'post_type' => 'page'
    ]);

    if ( $page )
    {
        echo $page[0]->post_content;
    }


    while (have_posts()) {
        the_post(); ?>
        <div class="column column-block">
            <?php get_template_part('parts/post-type/excerpt', 'committee'); ?>
        </div>
    <?php } ?>
</div>
