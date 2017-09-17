<!-- Banner Bar -->
<section class="section-even banner-bar">

    <div class="row">
        <?php dynamic_sidebar('banner-bar'); ?>
        <div class="small-12 large-4 column wisv-buttons">
            <div class="row">
                <?php
                wp_nav_menu([
                    "container" => "",
                    "container_class" => "",
                    "items_wrap" => '%3$s',
                    "menu_class" => "",
                    "menu_id" => "",
                    "depth" => 1,
                    "fallback_cb" => false,
                    "theme_location" => "banner-bar",
                ]);
                ?>
            </div>
        </div>
    </div>

</section>
