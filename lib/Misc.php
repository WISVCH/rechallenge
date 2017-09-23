<?php

namespace ReCHallenge;

/**
 * Alter queries for ReCHallenge templates.
 *
 * @package ReCHallenge
 */
class Misc
{
    /**
     * Hook into WordPress.
     */
    static function register_hooks()
    {
        add_filter('get_the_archive_title', [__CLASS__, 'archive_titles']);

        add_filter('term_link', [__CLASS__, 'term_links'], 10, 3);
    }

    /**
     * Retrieve the archive title based on the queried object.
     *
     * @since 4.1.0
     *
     * @return string Archive title.
     */
    static function archive_titles($title)
    {
        if (is_category()) {
            /* translators: Category archive title. 1: Category name */
            $title = single_cat_title('', false);
        } elseif (is_tag()) {
            /* translators: Tag archive title. 1: Tag name */
            $title = single_tag_title('', false);
        } elseif (is_author()) {
            /* translators: Author archive title. 1: Author name */
            $title = '<span class="vcard">'.get_the_author().'</span>';
        } elseif (is_year()) {
            /* translators: Yearly archive title. 1: Year */
            $title = get_the_date(_x('Y', 'yearly archives date format')).' archives';
        } elseif (is_month()) {
            /* translators: Monthly archive title. 1: Month name and year */
            $title = get_the_date(_x('F Y', 'monthly archives date format')).' archives';
        } elseif (is_day()) {
            /* translators: Daily archive title. 1: Date */
            $title = get_the_date(_x('F j, Y', 'daily archives date format')).' archive';
        } elseif (is_post_type_archive()) {
            /* translators: Post type archive title. 1: Post type name */
            $title = post_type_archive_title('', false);
        } elseif (is_tax()) {
            $tax = get_taxonomy(get_queried_object()->taxonomy);
            /* translators: Taxonomy term archive title. 1: Taxonomy singular name, 2: Current taxonomy term */
            $title = sprintf(__('%1$s: %2$s'), $tax->labels->singular_name, single_term_title('', false));
        } else {
            $title = 'News';
        }

        return $title;
    }

    static function term_links($termlink, $term, $taxonomy)
    {

        switch ($taxonomy) {
            case 'job_type':
            case 'company_offerings':
                $termlink = get_post_type_archive_link($taxonomy === 'job_type' ? 'job_opening' : 'company');

                return add_query_arg('filter_type', $term->slug, $termlink);
            case 'job_study':
            case 'company_study':

                $termlink = get_post_type_archive_link($taxonomy === 'job_study' ? 'job_opening' : 'company');

                return add_query_arg('filter_study', $term->slug, $termlink);
            default:
                return $termlink;
        }
    }
}
