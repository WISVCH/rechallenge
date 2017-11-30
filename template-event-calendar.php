<?php
/* Template Name: Event Calendar */
get_header();

get_template_part("parts/navigation/breadcrumb");
?>

    <main class="full">

        <div class="row column column-block">
            <div id="calendar" class="wisv-calendar"></div>

            <?php
            // Get all event categories
            $categories = get_terms([
                'taxonomy' => 'event_category',
                'hide_empty' => false,
            ]);

            if (! empty($categories) && count($categories) > 0) {
                ?>
                <div class="dropdown-pane" id="event-filter-dropdown" data-auto-focus="true" data-close-on-click="true">
                    <fieldset class="large-6 cell">
                        <?php
                        foreach ($categories as $c) {
                            $slug = esc_attr($c->slug); ?>
                            <input type="checkbox" name="cat-<?=$slug?>" data-slug="<?=$slug?>" value="<?=esc_attr($c->name)?>" id="cat-<?=$slug?>" checked><label
                                    for="cat-<?=$slug?>"><?=esc_html($c->name)?></label><br>
                        <?php } ?>
                    </fieldset>
                </div>
            <?php } ?>
        </div>

        <div class="row column">
            <?php the_content(); ?>
        </div>

    </main>

<?php
get_footer();
