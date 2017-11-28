<?php

namespace ReCHallenge;

/**
 * Loads theme scripts.
 *
 * @package ReCHallenge
 */
class Assets
{
    /**
     * Hook into WordPress.
     */
    static function register_hooks()
    {

        add_action('wp_enqueue_scripts', [__CLASS__, 'load_scripts']);
        add_action('wp_enqueue_scripts', [__CLASS__, 'load_stylesheets']);
        add_action('admin_init', [__CLASS__, 'editor_style']);
    }

    /**
     * Enqueue scripts.
     */
    static function load_scripts()
    {

        $stylesheet_uri = get_stylesheet_directory_uri();

        // Load latest jQuery in footer
        wp_deregister_script('jquery');
        wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js', [], '3.2.1', true);

        // Register theme scripts
        wp_register_script('rechallenge', $stylesheet_uri.'/assets/js/scripts.min.js', ['jquery'], null, true);
        wp_register_script('events-calendar', $stylesheet_uri.'/assets/js/calendar.min.js', ['jquery'], null, true);
        wp_register_script('w3cie-choice', $stylesheet_uri.'/assets/js/w3cie.choice.min.js', ['jquery', 'rechallenge'], null, true);

        // Load scripts
        wp_enqueue_script('rechallenge');

        if (is_page_template('template-event-calendar.php')) {
            wp_enqueue_script('events-calendar');
        }

        if (is_page_template('template-education-choice.php')) {
            wp_enqueue_script('w3cie-choice');
        }
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
