<?php $with_photo = has_post_thumbnail() ? 'has-photo' : false; ?>
<article class="row roster-page post-content <?=$with_photo ?? ''?>">

    <?php if ($with_photo) { ?>

        <div class="large-5 column">
            <a href="<?=esc_url(get_the_post_thumbnail_url(null, 'large'))?>">
                <?php the_post_thumbnail('medium', [
                    'alt' => esc_attr(get_the_title()),
                ]); ?>
            </a>
        </div>

        <div class="large-7 column">
            <?php the_title('<h1>', '</h1>'); ?>
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

</article>
