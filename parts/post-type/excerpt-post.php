<article class="news-featured">
    <a href="<?php the_permalink(); ?>">
        <h2><?php the_title(); ?></h2>
        <p class="byline">
            <time pubdate="pubdate"><?php the_date("F jS, Y"); ?></time>
        </p>

        <?php the_excerpt(); ?>
    </a>
</article>