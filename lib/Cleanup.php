<?php

namespace ReCHallenge;

/**
 * Clean up and speed up WordPress by removing or unloading unnecessary parts.
 *
 * @package ReCHallenge
 */
class Cleanup
{
    /**
     * Hook into WordPress.
     */
    static function register_hooks()
    {

        // Disable Emojicons.
        add_action('init', [__CLASS__, 'disable_emojicons']);

        // Remove WP Generator Meta Tag
        remove_action('wp_head', 'wp_generator');
        add_filter('the_generator', [__CLASS__, 'remove_generator_meta']);

        // Remove WLWriter Meta Tag
        remove_action('wp_head', 'wlwmanifest_link');

        // Remove Shortlink Meta Tag
        remove_action('wp_head', 'wp_shortlink_wp_head');

        // Remove EditURI Meta Tag
        remove_action('wp_head', 'rsd_link');

        // Disable oEmbed
        remove_action('rest_api_init', 'wp_oembed_register_route');
        remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
        remove_action('wp_head', 'wp_oembed_add_discovery_links');
        remove_action('wp_head', 'wp_oembed_add_host_js');

        // Remove version number in query args
        if (! is_admin()) {
            add_filter('script_loader_src', [__CLASS__, 'remove_version_query_arg'], 15, 1);
            add_filter('style_loader_src', [__CLASS__, 'remove_version_query_arg'], 15, 1);
            add_filter('script_loader_src', [__CLASS__, 'remove_version_query_arg_amp'], 15, 1);
            add_filter('style_loader_src', [__CLASS__, 'remove_version_query_arg_amp'], 15, 1);
        }
        
        // Disable some endpoints for unauthenticated users
        add_filter('rest_endpoints', [__CLASS__, 'disable_default_endpoints']);
    }

    /**
     * Disables Emojicons.
     *
     * @see http://wordpress.stackexchange.com/questions/185577/disable-emojicons-introduced-with-wp-4-2
     */
    static function disable_emojicons()
    {

        remove_action('admin_print_styles', 'print_emoji_styles');
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('admin_print_scripts', 'print_emoji_detection_script');
        remove_action('wp_print_styles', 'print_emoji_styles');
        remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
        remove_filter('the_content_feed', 'wp_staticize_emoji');
        remove_filter('comment_text_rss', 'wp_staticize_emoji');
        add_filter('emoji_svg_url', '__return_false');
        add_filter('tiny_mce_plugins', [__CLASS__, 'disable_emojicons_tinymce']);
    }

    /**
     * Disable Emojicons in the TinyMCE editor.
     *
     * @param $plugins TinyMCE plugins.
     * @return array Filtered TinyMCE plugins.
     */
    static function disable_emojicons_tinymce($plugins)
    {
        if (is_array($plugins)) {
            return array_diff($plugins, ['wpemoji']);
        } else {
            return [];
        }
    }

    /**
     * Remove WP generator (with version number)
     *
     * @return string Empty string.
     */
    static function remove_generator_meta()
    {
        return "";
    }

    /**
     * Remove WP version number from query arguments.
     *
     * @TODO speed up this function using strpos.
     * @param $src Asset to load
     * @return mixed Asset URL without query argument
     */
    static function remove_version_query_arg($src)
    {
        $rqs = explode('?ver', $src);

        return $rqs[0];
    }

    /**
     * Remove WP version number from query arguments, after ampersand.
     *
     * @param $src Asset to load
     * @return mixed Asset URL without query argument
     */
    static function remove_version_query_arg_amp($src)
    {
        $rqs = explode('&ver', $src);

        return $rqs[0];
    }

    /**
     * Disable some endpoints for unauthenticated users
     *
     * @param $endpoints
     * @return mixed
     */
    function disable_default_endpoints( $endpoints ) {
        $endpoints_to_remove = array(
            '/oembed/1.0',
            '/wp/v2',
            '/wp/v2/media',
            '/wp/v2/types',
            '/wp/v2/statuses',
            '/wp/v2/taxonomies',
            '/wp/v2/tags',
            '/wp/v2/users',
            '/wp/v2/comments',
            '/wp/v2/settings',
            '/wp/v2/themes',
            '/wp/v2/blocks',
            '/wp/v2/oembed',
            '/wp/v2/posts',
            '/wp/v2/pages',
            '/wp/v2/block-renderer',
            '/wp/v2/search',
            '/wp/v2/categories'
        );

        if (!is_user_logged_in() ) {
            foreach ($endpoints_to_remove as $rem_endpoint) {
                // $base_endpoint = "/wp/v2/{$rem_endpoint}";
                foreach ($endpoints as $maybe_endpoint => $object) {
                    if (stripos( $maybe_endpoint, $rem_endpoint ) !== false) {
                        unset( $endpoints[ $maybe_endpoint ] );
                    }
                }
            }
        }
        return $endpoints;
    }
}
