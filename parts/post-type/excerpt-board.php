<?php
$meta = get_post_custom(get_the_ID());
$board_year = ! isset($meta['_board_year'][0]) ? '' : $meta['_board_year'][0];
?>
<article class="excerpt-board">
    <?php
    if (has_post_thumbnail()) {
        ?>
        <a class="thumbnail" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
            <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), "featured-image")); ?>" alt="<?php the_title_attribute(); ?>">
        </a>
        <?php
    }
    ?>

    <h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

    <?php
    if (! empty($board_year)) {
        ?>
        <p class="byline"><?=esc_html($board_year);?></p>
        <?php
    }
    ?>
</article>