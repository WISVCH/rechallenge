<?php
$meta = get_post_custom(get_the_ID());
$board_year = ! isset($meta['_board_year'][0]) ? '' : $meta['_board_year'][0];
$with_photo = has_post_thumbnail() ? 'has-photo' : false;
?>
<div class="row roster-page <?=$with_photo ?? ''?>">

    <?php if ($with_photo) { ?>

        <div class="column column-block">
            <?php
            the_title('<h1>', '</h1>');

            if (! empty($board_year)) { ?>
                <p class="byline"><?=esc_html($board_year);?></p>
            <?php } ?>
        </div>

        <div class="large-5 column">
            <a href="<?=esc_url(get_the_post_thumbnail_url())?>">
                <?php the_post_thumbnail('featured-image'); ?>
            </a>
        </div>

        <div class="large-7 column">
            <?php the_content(); ?>
        </div>

    <?php } else { ?>

        <div class="column">
            <?php
            the_title('<h1>', '</h1>');
            the_content();
            ?>
        </div>

    <?php } ?>

</div>
