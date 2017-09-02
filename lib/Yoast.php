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
        } elseif (is_singular(['board', 'committee', 'honorary_member']) || is_post_type_archive(['board', 'committee', 'honorary_member'])) {
            $breadcrumb[] = [
                'url' => get_permalink(get_page_by_path('association')),
                'text' => 'Association',
            ];

            array_splice($links, 1, -2, $breadcrumb);
        } elseif (is_singular(['company', 'job_opening']) || is_post_type_archive(['company', 'job_opening'])) {
            $breadcrumb[] = [
                'url' => get_permalink(get_page_by_path('career')),
                'text' => 'Career',
            ];

            array_splice($links, 1, -2, $breadcrumb);
        }

        // Add company name to breadcrumbs for job openings
        if (is_singular('job_opening')) {

            // Check if company ID set
            $company_id = get_post_meta(get_the_ID(), '_company_id', true);

            // Check if company exists
            if (empty($company_id) || get_post_status($company_id) === false) {

                $company_name[] = [
                    'text' => 'Unknown Company',
                ];
            } else {

                $company_name[] = [
                    'id' => $company_id,
                ];
            }

            array_splice($links, -1, -1, $company_name);
        }

        return $links;
    }
}
