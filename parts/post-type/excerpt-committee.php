<article class="excerpt-blockgrid">
    <a class="thumbnail" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
        <?php if (has_post_thumbnail()) { ?>
            <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), "featured-image")); ?>" alt="<?php the_title_attribute(); ?>">
        <?php } else { ?>
            <img src="<?php echo RECHALLENGE_URI; ?>/assets/images/placeholder.png" alt="<?php the_title_attribute(); ?>">
        <?php } ?>
    </a>
    <h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
</article>
