<article class="row column post-content">
    <?php
    $thumb = get_the_post_thumbnail_url(get_the_ID(), "medium");
    $meta = get_post_custom(get_the_ID());
    $ambassador_function = ! isset($meta['ambassador_function'][0]) ? '' : $meta['ambassador_function'][0];
  
    if (! empty($thumb)) {
        ?>
        <a href="<?=esc_url(get_the_post_thumbnail_url(null, 'large'))?>" class="thumbnail nopad prop">
            <?php include(locate_template('parts/misc/thumbnail-proportional.php')); ?>
        </a>
        <?php
    }

    the_title('<h1>', '</h1>');

    if (!empty($ambassador_function)) { ?>
            <p class="byline"><?=esc_html($ambassador_function);?></p>
    <?php };
  
    the_content();
    ?>
</article>
