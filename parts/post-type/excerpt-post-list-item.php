<?php
$thumb_url = has_post_thumbnail() ? get_the_post_thumbnail_url(null, 'thumbnail') : RECHALLENGE_URI.'/assets/images/placeholder.png';
?>
<li>
    <article class="icon-row">

        <div class="icon-cell">
            <a class="thumbnail" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" style="background-image:url(<?=esc_url($thumb_url)?>)"></a>
        </div>

        <div class="text-cell">
            <h2 class="small"><a href=" <?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <p class="byline">
                <time pubdate="pubdate"><?php the_time("F jS, Y"); ?></time>
            </p>
        </div>
    </article>
</li>
