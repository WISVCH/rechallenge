<?php

namespace ReCHallenge;

/**
 * Custom redirections.
 *
 * @package ReCHallenge
 */
class Query
{
    /**
     * Hook into WordPress.
     */
    static function register_hooks()
    {

        // Redirect parents
        add_action('pre_get_posts', [__CLASS__, 'redirect_parents']);

        // Filter career section
        add_action('pre_get_posts', [__CLASS__, 'filter_career']);

        // Disable taxonomy archives
        // TODO: temporary fix until event categories are properly implemented in the calendar.
        add_action('pre_get_posts', [__CLASS__, 'kill_taxonomy_archives']);
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
                        post_status = "publish" AND
                        post_type = "page" AND
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

    static function filter_career($query)
    {

        if (! is_admin() && $query->is_main_query()) {

            $filter_study = ! empty($_GET['filter_study']) ? sanitize_title($_GET['filter_study']) : false;
            $filter_type = ! empty($_GET['filter_type']) ? sanitize_title($_GET['filter_type']) : false;

            $tax_query = [];

            if ($query->is_post_type_archive('company')) {

                if ($filter_study) {

                    $tax_query[] = [
                        'taxonomy' => 'company_study',
                        'field' => 'slug',
                        'terms' => $filter_study,
                    ];
                }

                if ($filter_type) {
                    $tax_query[] = [
                        'taxonomy' => 'company_offerings',
                        'field' => 'slug',
                        'terms' => $filter_type,
                    ];
                }
            } elseif ($query->is_post_type_archive('job_opening')) {
                if ($filter_study) {

                    $tax_query[] = [
                        'taxonomy' => 'job_study',
                        'field' => 'slug',
                        'terms' => $filter_study,
                    ];
                }

                if ($filter_type) {
                    $tax_query[] = [
                        'taxonomy' => 'job_type',
                        'field' => 'slug',
                        'terms' => $filter_type,
                    ];
                }
            }

            if (count($tax_query) > 0) {
                $query->set('tax_query', $tax_query);
            }
        }
    }

    /**
     * Completely disable term archives for taxonomy.
     *
     * @param  string $taxonomy WordPress taxnomy name
     * @link https://wordpress.stackexchange.com/q/140351
     */
    static function kill_taxonomy_archives($query)
    {

        if (is_admin()) {
            return;
        }

        if (is_tax(['event_category'])) {
            $query->set_404();
            status_header(404);
        }
    }
}
