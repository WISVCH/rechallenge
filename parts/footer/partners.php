<?php
$partners = new WP_Query([
    'post_type' => 'company',
    'orderby' => 'rand',
    'posts_per_page' => 10,
    'meta_key' => '_company_partnerlink',
    'meta_compare' => 'EXISTS',
]);

if ($partners->have_posts()) { ?>

    <!-- Partners -->
    <div class="row column">
        <h1 class="small">Our partners</h1>
        <div class="row partners small-up-2 medium-up-4 large-up-5">
            <?php
            while ($partners->have_posts()) {
                $partners->the_post(); ?>

                <div class="column">
                    <?php
                    $link_type = get_post_meta(get_the_ID(), "_link_to", true);
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
                    ?>
                    <a href="<?php echo esc_url($link_url); ?>" title="<?php the_title_attribute(); ?>" class="partner">
                        <?php
                        if (has_post_thumbnail()) {
                            ?>
                            <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title_attribute(); ?>">
                        <?php } else { ?>
                            <span class="fallback-title"><?php the_title(); ?></span>
                            <?php
                        }

                        $excerpt = get_the_excerpt();
                        if (! empty($excerpt)) {
                            ?>
                            <span class="partner-excerpt">
                                <?=$excerpt?><br>
                                <span class="button alt" href="<?php echo esc_url($link_url); ?>"><?php echo $link_text; ?></span>
                            </span>
                        <?php } ?>
                    </a>
                </div>

            <?php } ?>
        </div>
    </div>

    <?php
}
