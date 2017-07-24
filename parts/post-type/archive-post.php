<div class="row small-up-2 medium-up-3 large-up-4">
    <?php
    $post_type = get_post_type();
    if ($post_type !== false) {

        // Get large excerpt for posts
        if ($post_type === 'post') {
            $post_type = 'post-large';
        }

        while (have_posts()) {
            the_post();
            ?>
            <div class="column column-block">
                <a href="<?php the_permalink(); ?>"
                   style="display:block;height:200px;padding-top:1px; background:url(<?=get_the_post_thumbnail_url(get_the_ID(), 'featured-image');?>) center no-repeat;background-size:cover;">
                    <div style="background:rgba(0,0,0,.5);margin-top:149px;line-height:50px;color:#fff;padding-left:1rem;">
                        <?php the_title(); ?>
                    </div>
                </a>
            </div>
            <?php
        }
    }
    ?>
</div>
