<?php

namespace ReCHallenge;

/**
 * Loads theme scripts.
 *
 * @package ReCHallenge
 */
class Scripts
{
    /**
     * Hook into WordPress.
     */
    static function register_hooks()
    {

        add_action('wp_enqueue_scripts', [__CLASS__, 'load_scripts']);
    }

    /**
     * Enqueue scripts.
     */
    static function load_scripts()
    {

        $stylesheet_uri = get_stylesheet_directory_uri();

        // Register scripts
        wp_register_script('rechallenge', $stylesheet_uri.'/assets/js/scripts.min.js', ['jquery'], null, true);

        // Calendar scripts
        wp_register_script('events-calendar', $stylesheet_uri.'/assets/js/calendar.min.js', ['jquery'], null, true);

        // Load scripts
        wp_enqueue_script('rechallenge');

        if (is_page_template('template-event-calendar.php')) {
            wp_enqueue_script('events-calendar');
        }
    }
}
