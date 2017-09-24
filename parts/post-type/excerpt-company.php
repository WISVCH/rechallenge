<?php
$thumb = get_the_post_thumbnail_url(get_the_ID(), "medium");
$thumb_sizing = 'contain';
?>
<article class="row excerpt-company">

    <div class="small-3 column">
        <a class="thumbnail prop" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
            <?php include(locate_template('parts/misc/thumbnail-proportional.php')); ?>
        </a>
    </div>

    <div class="small-9 column">
        <header>
            <h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
        </header>

        <aside class="byline">
            <?php

            // Get job opening studies
            $terms_study = get_the_terms(get_the_ID(), 'company_study');

            if ($terms_study && ! is_wp_error($terms_study)) {

                $job_studies = [];

                foreach ($terms_study as $term) {
                    $job_studies[] = '<a href="'.esc_url(get_term_link($term)).'">'.esc_html($term->name).'</a>';
                }

                if (! empty($job_studies)) {
                    ?><span><?=join(", ", $job_studies)?></span><?php
                }
            }

            if (! empty($location)) { ?><span><?php echo esc_html($location); ?></span><?php } ?>
        </aside>

        <?php the_excerpt(); ?>

        <footer class="byline">
            <?php

            // Get job opening types
            $terms_type = get_the_terms(get_the_ID(), 'company_offerings');

            if ($terms_type && ! is_wp_error($terms_type)) {

                $job_types = [];

                foreach ($terms_type as $term) {
                    $job_types[] = '<a href="'.esc_url(get_term_link($term)).'">'.esc_html($term->name).'</a>';
                }

                if (! empty($job_types)) {
                    ?><span><?=join(", ", $job_types)?></span><?php
                }
            }

            ?>
        </footer>
    </div>

</article>
