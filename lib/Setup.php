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
        add_image_size("featured-image", 800, 300, false);

        // Banner
        add_image_size("banner", 837, 170, true);
    }
}