<?php
$meta = get_post_custom(get_the_ID());
$board_year = ! isset($meta['_board_year'][0]) ? '' : $meta['_board_year'][0];
$thumb = get_the_post_thumbnail_url(get_the_ID(), "featured-image");
?>
<article class="excerpt-blockgrid">
    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
        <?php if ($thumb) { ?>
            <div class="thumbnail" style="background-image:url(<?=esc_url($thumb)?>)"></div>
        <?php } else { ?>
            <div class="thumbnail placeholder" style="background-image:url(<?=RECHALLENGE_URI.'/assets/images/placeholder.png'?>)"></div>
        <?php }
        the_title('<h2>', '</h2>');

        if (! empty($board_year)) { ?>
            <p class="byline"><?=esc_html($board_year);?></p>
        <?php } ?>
    </a>
</article>
