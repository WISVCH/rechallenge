<article class="news-featured">
    <a href="<?php the_permalink(); ?>">

        <header>
            <?php
            if (has_post_thumbnail()) {
                the_post_thumbnail("featured-image");
            }
            ?>
            <h1 class="small"><?php the_title(); ?></h1>
            <p class="byline">
                <time pubdate="pubdate"><?php the_date("F jS, Y"); ?></time>
            </p>
        </header>

        <?php the_excerpt(); ?>
    </a>
</article>