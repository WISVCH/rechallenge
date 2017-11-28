<?php
$meta = get_post_custom(get_the_ID());
$board_year = ! isset($meta['_board_year'][0]) ? '' : $meta['_board_year'][0];

$prev = get_adjacent_post(false, '', true);
$next = get_adjacent_post(false, '', false);
?>

<article class="roster-page post-content">

    <header class="row collapse" data-equalizer>

        <nav class="small-2 column adjacent-link" data-equalizer-watch>
            <?php if (! empty($next)) { ?>
                <a class="button tiny" href="<?=get_permalink($next)?>"><i class="fa ch-arrow-left"></i></a>
            <?php } ?>
        </nav>

        <div class="small-8 column column-block text-center" data-equalizer-watch>
            <?php
            the_title('<h1>', '</h1>');

            if (! empty($board_year)) { ?>
                <p class="byline"><?=esc_html($board_year);?></p>
            <?php } ?>
        </div>

        <nav class="small-2 column adjacent-link text-right" data-equalizer-watch>
            <?php if (! empty($prev)) { ?>
                <a class="button tiny" href="<?=get_permalink($prev)?>"><i class="fa ch-arrow-right"></i></a>
            <?php } ?>
        </nav>

    </header>

    <div class="row">

        <div class="large-5 column">
            <a href="<?=esc_url(get_the_post_thumbnail_url(null, 'large'))?>">
                <?php the_post_thumbnail('medium', [
                    'alt' => esc_attr(get_the_title()),
                ]); ?>
            </a>
        </div>

        <div class="large-7 column">
            <?php the_content(); ?>
        </div>

    </div>
</article>
