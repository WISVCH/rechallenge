<?php

namespace ReCHallenge;

/**
 * Loads theme stylesheets.
 *
 * @package ReCHallenge
 */
class Styles
{
    /**
     * Hook into WordPress.
     */
    static function register_hooks()
    {

        add_action('wp_enqueue_scripts', [__CLASS__, 'load_stylesheets']);
        add_action('admin_init', [__CLASS__, 'editor_style']);
    }

    /**
     * Enqueue stylesheets.
     */
    static function load_stylesheets()
    {

        // Custom fonts
        wp_register_style('custom-fonts', "https://fonts.googleapis.com/css?family=Lato:400,700|Noto+Sans:700");

        // Core CSS
        wp_register_style('rechallenge', get_stylesheet_directory_uri()."/assets/css/app.css", ["custom-fonts"]);

        // Let's go!
        wp_enqueue_style('rechallenge');
    }

    /**
     * Add reCHallenge to editor.
     */
    static function editor_style()
    {
        add_editor_style(get_stylesheet_directory_uri()."/assets/css/editor.css");
    }
}
