<?php

namespace ReCHallenge;

/**
 * Custom redirections.
 *
 * @package ReCHallenge
 */
class Redirect
{
    /**
     * Hook into WordPress.
     */
    static function register_hooks()
    {

        // Redirect parents
        add_action('pre_get_posts', [__CLASS__, 'redirect_parents']);
    }

    /**
     * Redirect parent pages to first child.
     */
    static function redirect_parents(\WP_Query $query)
    {

        if ($query->is_main_query()) {

            $obj = $query->get_queried_object();

            // If top level page
            if (isset($obj->post_parent) && $obj->post_parent === 0) {

                global $wpdb;

                // Check for children, direct DB query for performance reasons
                $q = $wpdb->prepare('
                    SELECT ID FROM '.$wpdb->posts.'
                    WHERE
                        post_status = "publish" &&
                        post_type = "page" &&
                        post_parent = %d
                    ORDER BY
                        menu_order, post_title
                    LIMIT 1', $obj->ID);

                $first_child = $wpdb->get_var($q);

                if (! empty($first_child)) {

                    // Redirect to first child (if any)
                    wp_redirect(get_permalink($first_child));
                    exit;
                }
            }
        }
    }
}
