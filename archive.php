<?php
get_header();

if (is_tax()) {
    // Reliably get post type from taxonomy object (get_post_type() is not set on empty archives)
    global $wp_taxonomies;
    $post_type = (isset($wp_taxonomies[$tax])) ? reset($wp_taxonomies[$tax]->object_type) : get_post_type();
} else {
    $post_type = $wp_query->query['post_type'] ?? (is_a(($o = get_queried_object()), 'WP_Post_Type') ? $o->name : '');
}
?>
    <!-- Main -->
    <main <?php echo in_array($post_type, ['', 'post', 'company', 'job_opening']) ? 'class="shrink"' : ''; ?>>
        <?php
        get_template_part("parts/navigation/breadcrumb");

        get_template_part('parts/post-type/archive', $post_type);
        ?>
    </main>

<?php
get_footer();
