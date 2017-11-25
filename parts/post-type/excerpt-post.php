<?php
$thumb = get_the_post_thumbnail_url(get_the_ID(), "medium");
?>
<article class="row excerpt-post">

    <div class="small-12 medium-3 column">
        <a class="thumbnail prop nopad" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
            <?php include(locate_template('parts/misc/thumbnail-proportional.php')); ?>
        </a>
    </div>

    <div class="small-12 medium-9 column">
        <header>
            <h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
        </header>

        <?php the_excerpt(); ?>

        <p class="byline">
            Posted <time pubdate="pubdate"><?php the_date('F jS, Y H:i'); ?></time>
        </p>
    </div>

</article>
