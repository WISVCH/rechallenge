<?php 
$thumb = get_the_post_thumbnail_url(get_the_ID(), "medium"); 
$meta = get_post_custom(get_the_ID());
$ambassador_function = ! isset($meta['ambassador_function'][0]) ? '' : $meta['ambassador_function'][0];
?>
<article class="excerpt-blockgrid excerpt-ambassador">
    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
        <div class="thumbnail nopad prop">
            <?php include(locate_template('parts/misc/thumbnail-proportional.php')); ?>
        </div>
        <?php 
      the_title('<h2>', '</h2>');
      
          if (!empty($ambassador_function)) { ?>
            <p class="byline"><?=esc_html($ambassador_function);?></p>
      
        <?php } ?>
    </a>
</article>
