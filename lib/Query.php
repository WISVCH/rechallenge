<?php

namespace ReCHallenge;

/**
 * Alter queries for ReCHallenge templates.
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

        // Add menus
        add_action('pre_get_posts', [__CLASS__, "exclude_education_updates"]);
    }

    /**
     * Do not display education mailings in the news archives.
     */
    static function exclude_education_updates($query)
    {

        if ($query->is_main_query() && (is_home() || is_archive('post'))) {

            // @TODO remove hardcoded category ID
            $query->set('category__not_in', 22);

        }
    }
}
