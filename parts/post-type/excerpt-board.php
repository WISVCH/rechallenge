<?php
$meta = get_post_custom(get_the_ID());
$board_year = ! isset($meta['_board_year'][0]) ? '' : $meta['_board_year'][0];
$thumb = get_the_post_thumbnail_url(get_the_ID(), "medium");
?>
<article class="excerpt-blockgrid">
    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
        <div class="thumbnail nopad prop">
            <?php include(locate_template('parts/misc/thumbnail-proportional.php')); ?>
        </div>

        <?php
        the_title('<h2>', '</h2>');

        if (! empty($board_year)) { ?>
            <p class="byline"><?=esc_html($board_year);?></p>
        <?php } ?>
    </a>
</article>
