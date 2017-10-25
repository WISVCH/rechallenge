<?php

namespace ReCHallenge;

/**
 * Admin theme settings.
 *
 * @package ReCHallenge
 */
class Settings
{
    private static $_settings;

    static function register_hooks()
    {
        add_action('admin_menu', [__CLASS__, 'add_admin_menu']);
        add_action('admin_init', [__CLASS__, 'settings_init']);

    }

    private static function _load_settings()
    {
        static::$_settings = get_option('rechallenge_settings');
    }

    static function get_setting($key)
    {
        if (empty(static::$_settings)) {
            static::_load_settings();
        }

        return array_key_exists($key, static::$_settings) ? static::$_settings[$key] : false;
    }

    static function add_admin_menu()
    {
        add_theme_page('Theme Settings', 'Theme Settings', 'manage_options', 'rechallenge', [__CLASS__, 'render_page']);
    }

    static function settings_init()
    {
        register_setting('rechallenge', 'rechallenge_settings');
        add_settings_section('rechallenge', null, null, 'rechallenge');

        // Google Analytics ID (analytics_id)
        add_settings_field('analytics_id', 'Google Analytics ID', [__CLASS__, 'render_analytics_id',], 'rechallenge', 'rechallenge');

        // CHoice API URL (choice_url)
        add_settings_field('choice_url', 'CHoice API URL', [__CLASS__, 'render_choice_url',], 'rechallenge', 'rechallenge');
    }

    static function render_page()
    { ?>
        <form action="options.php" method="post">

            <h2>ReCHallenge Theme Settings</h2>

            <?php
            settings_fields('rechallenge');
            do_settings_sections('rechallenge');
            submit_button();
            ?>

        </form>
    <?php }

    static function render_analytics_id()
    {
        $analytics_id = static::get_setting('analytics_id') ?? "";
        ?>
        <input type="text" name="rechallenge_settings[analytics_id]" value="<?=esc_attr($analytics_id)?>" class="regular-text">
        <?php
    }

    static function render_choice_url()
    {
        $choice_url = static::get_setting('choice_url') ?? "";
        ?>
        <input type="text" name="rechallenge_settings[choice_url]" value="<?=esc_attr($choice_url)?>" class="regular-text" placeholder="https://">
        <?php
    }
}
