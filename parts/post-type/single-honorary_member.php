<article class="row column post-content">
    <?php
    the_title('<h1>', '</h1>');

    if (has_post_thumbnail()) {
        ?>

        <a href="<?=esc_url(get_the_post_thumbnail_url(null, 'large'))?>" class="thumbnail float-right">
            <?php the_post_thumbnail('featured-image'); ?>
        </a>

        <?php
    }

    the_content();
    ?>
</article>
