<div class="column">
    <?php
    global $post;

    $meta = get_post_custom(get_the_ID());
    $link_url = empty($meta["_company_website"][0]) ? false : $meta["_company_website"][0];
    $link_type = $meta["_link_to"][0] ?? false;

    // Switch link type to post when 1) no link type is set or 2) the URL is not set
    if (! $link_type || ($link_type == 'url' && empty($link_url))) {
        $link_type = "post";
    }

    switch ($link_type) {
        default:
        case "post":
            $link_text = 'View profile <i class="fa ch-arrow-right"></i>';
            $link_url = get_permalink();
            break;
        case "url":
            $link_text = 'Visit website <i class="fa ch-arrow-right"></i>';
            $link_url = get_post_meta(get_the_ID(), "_company_website", true);
            break;
    }

    $thumb = get_the_post_thumbnail_url(null, 'medium');
    $style = $thumb ? ' style="background-image:url('.esc_url($thumb).')"' : '';
    $class = 'class="'.($thumb ? 'img hidetext' : 'img').'"';
    ?>
    <a href="<?=esc_url($link_url)?>" title="<?php the_title_attribute(); ?>" class="partner">
        <span <?=$class.$style?>><?php the_title(); ?></span>
        <?php
        
        if(empty($post->post_excerpt)) {
        
            // @see wp_trim_excerpt()
            $excerpt_content = str_replace(']]>', ']]&gt;', apply_filters('the_content', $post->post_content));

            // Generate our own, shorter excerpt
            $excerpt = wp_trim_words($excerpt_content, 35, apply_filters('excerpt_more', ' '.'[&hellip;]'));
        } else {
            
            // Use the regular excerpt if available
            $excerpt = get_the_excerpt();
        }
        
        if (! empty($excerpt)) { ?>
            <span class="partner-excerpt"><?=$excerpt?><br><span class="button alt"><?=$link_text?></span></span>
        <?php } ?>
    </a>
</div>
