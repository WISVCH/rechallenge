<div class="row column">
    <?php
    the_title('<h1>', '</h1>');

    if (has_post_thumbnail()) {
        ?>

        <a href="<?=esc_url(get_the_post_thumbnail_url())?>" class="thumbnail float-right">
            <?php the_post_thumbnail('featured-image'); ?>
        </a>

        <?php
    }

    the_content();
    ?>
</div>
