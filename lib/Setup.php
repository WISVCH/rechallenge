<?php

namespace ReCHallenge;

/**
 * Setup theme.
 *
 * @package ReCHallenge
 */
class Setup
{
    /**
     * Hook into WordPress.
     */
    static function register_hooks()
    {

        // Declare theme support
        add_action('after_setup_theme', [__CLASS__, "theme_support"]);

        // Add image sizes
        add_action('after_setup_theme', [__CLASS__, "image_sizes"]);

        // Remove unnecessary image sizes
        add_filter('intermediate_image_sizes', [__CLASS__, "disable_default_sizes"]);

        // Increase Twitter cache
        add_filter('latest_tweets_cache_seconds', [__CLASS__, "twitter_cache"]);

        // Change excerpt length
        add_filter('excerpt_length', [__CLASS__, 'excerpt_length'], 100);
    }

    /**
     * Declare support for WordPress functions.
     */
    static function theme_support()
    {

        // Post Thumbnails
        add_theme_support('post-thumbnails');

        // HTML5 support
        add_theme_support('html5', ['search-form', 'gallery', 'caption']);

        // Title tag
        add_theme_support('title-tag');

        // Breadcrumbs
        add_theme_support('yoast-seo-breadcrumbs');
    }

    static function image_sizes()
    {

        // Page cover
        add_image_size("cover", 1920, 500, true);

        // Featured image (news)
        add_image_size("featured-image", 800, 350, true);
    }

    static function disable_default_sizes($sizes)
    {
        return array_filter($sizes, function ($val) {
            return 'medium_large' !== $val && 'large' !== $val;
        });
    }

    static function twitter_cache()
    {
        return 3600;
    }

    static function excerpt_length($length)
    {
        return 50;
    }
}
