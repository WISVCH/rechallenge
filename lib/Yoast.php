<?php

namespace ReCHallenge;

/**
 * Modifies Yoast SEO behavior.
 *
 * @package ReCHallenge
 */
class Yoast
{
    /**
     * Hook into WordPress.
     */
    static function register_hooks()
    {

        add_action('wpseo_breadcrumb_links', [__CLASS__, 'alter_breadcrumbs']);
    }

    /**
     * Modify breadcrumbs.
     *
     * @param links
     * @return mixed
     */
    static function alter_breadcrumbs($links)
    {

        // Add activities page in Event breadcrumb (N.B. hardcoded)
        if (is_singular('event')) {
            $breadcrumb[] = [
                'url' => get_permalink(get_page_by_path('activities')),
                'text' => 'Activities',
            ];

            array_splice($links, 1, -2, $breadcrumb);
        }

        return $links;
    }
}
