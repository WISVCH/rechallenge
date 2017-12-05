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
            // Round to the nearest multiple of 5 (minimum of 5)
            $max_partners = max(5, round($partners->found_posts / 5) * 5);

            while ($partners->have_posts() && $partners->current_post + 1 < $max_partners) {
                $partners->the_post();
                get_template_part('parts/footer/partnerlink');
            } ?>
        </div>
    </div>

<?php }
