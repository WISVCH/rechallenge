<article class="news-featured">


    <header>
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
            <?php the_post_thumbnail("featured-image"); ?>
            <h1 class="small"><?php the_title(); ?></h1>
        </a>

        <p class="byline">
            <?php

            $term = false;

            // Get primary category
            if (class_exists('WPSEO_Primary_Term')) {
                $primary_term = new WPSEO_Primary_Term('category', get_the_id());
                $primary_term = $primary_term->get_primary_term();
                $term = get_term($primary_term);
                $term = is_wp_error($term) ? false : $term->name;
            }

            if ($term === false) {
                $category = get_the_category();
                if (count($category) > 0) {
                    $term = reset($category)->name;
                }
            }
            ?>
            <time pubdate="pubdate"><?php the_time("F jS, Y"); ?></time>
            <?php
            if ($term) {
                echo ' | '.esc_html($term);
            }
            ?>
        </p>
    </header>

    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
        <?php the_excerpt(); ?>
    </a>
</article>