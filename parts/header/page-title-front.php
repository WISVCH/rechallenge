<?php
// Get slides
$slides = new WP_Query([
    'post_type' => 'slide',
    'posts_per_page' => 5,
    'orderby' => 'menu_order',
    'order' => 'ASC',
]);

if ($slides->have_posts()) { ?>

    <!-- Page title / slider -->
    <div class="page-title slider">
        <section class="orbit" role="region" data-orbit>

            <ul class="orbit-container">
                <?php
                $count = 0;

                while ($slides->have_posts()) {
                    $slides->the_post();

                    // Get slide bg
                    $css = has_post_thumbnail() ? ' style="background-image:url('.esc_url(get_the_post_thumbnail_url(null, 'cover')).')"' : '';
                    ?>
                    <li class="<?=$count === 0 ? 'is-active ' : ''?>orbit-slide"<?=$css?>>
                        <div class="orbit-caption"><div class="align-middle"><?php the_content(); ?></div></div>
                    </li>
                    <?php
                    $count++;
                }

                wp_reset_postdata();
                ?>
            </ul>

            <?php
            if ($count > 1) {
                echo '<nav class="orbit-bullets">';
                for ($x = 0; $x < $count; $x++) {
                    echo '<button '.(($x === 0) ? 'class="is-active" ' : '').' data-slide="'.$x.'" aria-label="Navigate to slide '.($x + 1).'"></button>';
                }
                echo '</nav>';
            }
            ?>

        </section>
    </div>

<?php }
