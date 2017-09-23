<?php

// Get current taxonomy
$queried_object = get_queried_object();
$tax = $queried_object->taxonomy;

// Reliably get post type from taxonomy object (get_post_type() is not set on empty archives)
global $wp_taxonomies;
$pt_name = (isset($wp_taxonomies[$tax])) ? reset($wp_taxonomies[$tax]->object_type) : get_post_type();

// Get post type name
$pt_object = get_post_type_object($pt_name);

// Get all terms in taxonomy
$terms = get_terms([
    'taxonomy' => $tax,
    'hide_empty' => false,
    'parent' => 0,
]);

$label = $pt_object->label ?? '';
?>
<div class="row column">
    <h1><?=! empty($pt_object->label) ? esc_html($pt_object->label) : '';?></h1>

    <?php
    if (! is_wp_error($terms)) {
        ?>
        <ul class="tabs" data-tabs id="example-tabs">
            <?php
            foreach ($terms as $term) {
                $active_class = $term->term_id === $queried_object->term_id ? ' aria-selected="true"' : '';
                ?>
                <li class="tabs-title"><a<?=$active_class?> href="<?=esc_attr(get_term_link($term, $tax))?>"><?=esc_html($term->name);?></a></li>
                <?php
            }
            ?>
        </ul>
        <?php
    }
    ?>
</div>

<div class="row">
    <?php

    if (have_posts()) {

        while (have_posts()) {
            the_post();
            ?>

            <div class="column column-block separator-block">
                <?php get_template_part('parts/post-type/excerpt', $pt_name); ?>
            </div>

            <?php
        }
    } else {
        ?>
        <div class="column column-block separator-block">
            There are currently no <?=esc_html(strtolower($label))?> available in this category.
        </div>
        <?php
    }
    ?>
</div>
