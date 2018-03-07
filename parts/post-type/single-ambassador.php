<article class="row column post-content">
    <?php
    $thumb = get_the_post_thumbnail_url(get_the_ID(), "medium");
    if (! empty($thumb)) {
        ?>
        <a href="<?=esc_url(get_the_post_thumbnail_url(null, 'large'))?>" class="thumbnail nopad prop">
            <?php include(locate_template('parts/misc/thumbnail-proportional.php')); ?>
        </a>
        <?php
    }

    the_title('<h1>', '</h1>');

    the_content();
    ?>
</article>
