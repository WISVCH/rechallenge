<?php $thumb = get_the_post_thumbnail_url(get_the_ID(), "featured-image"); ?>
<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
    <?php
    include(locate_template('parts/misc/thumbnail-proportional.php'));
    the_title('<h2>', '</h2>');
  
    the_excerpt();
    ?>
</a>