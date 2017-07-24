<article>

    <?php
    the_title("<h1>", "</h1>");
    ?>
    <p class="byline">
        <time pubdate="pubdate"><?php the_date('F jS, Y H:i'); ?></time>
    </p>

    <?php
    the_content();
    ?>

    <footer>
        <?php get_template_part("parts/misc/share"); ?>
    </footer>

</article>