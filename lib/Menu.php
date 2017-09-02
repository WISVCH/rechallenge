<?php

namespace ReCHallenge;

/**
 * Register theme menu locations.
 *
 * @package ReCHallenge
 */
class Menu
{
    /**
     * Hook into WordPress.
     */
    static function register_hooks()
    {

        // Add menus
        add_action('after_setup_theme', [__CLASS__, "register_menus"]);

        // Add login/account link to primary menu
        add_filter('wp_nav_menu_items', [__CLASS__, 'add_login_link'], 10, 2);

        // Fix active menu items
        add_filter('nav_menu_link_attributes', [__CLASS__, 'fix_active_menu_items'], 10, 2);
    }

    /**
     * Register theme locations.
     */
    static function register_menus()
    {

        // Main Navigation
        register_nav_menu('main-nav', 'Main Naviation');

        // Banner Bar (buttons)
        register_nav_menu('banner-bar', 'Buttons in banner bar');
    }

    /**
     * Adds a login button to the primary menu if user is logged out, or a view account button when logged in.
     *
     * @param $items Menu items
     * @param $args Menu settings
     * @return string Menu items, with appended button
     */
    static function add_login_link($items, $args)
    {

        if ($args->theme_location == 'main-nav') {

            // @TODO: make link to portal dynamic
            if (is_user_logged_in()) {
                $items .= '<li><a class="login-button button alert account-button" href="'.site_url('portal').'">Account</a></li>';
            } else {
                $items .= '<li><a class="login-button button alert" href="'.site_url('portal').'" data-open="login-form">Login</a></li>';
            }
        }

        return $items;
    }

    /**
     * Add active menu item class when WordPress doesn't.
     *
     * @param $atts Link attributes.
     * @param $item Menu item object.
     * @return mixed Modified link attributes.
     */
    static function fix_active_menu_items($atts, $item)
    {

        // @TODO find a better way to recognize parent pages
        $page_ids = [
            'association' => '18',
            'career' => '24',
        ];

        $cpt = [
            'association' => [
                'board',
                'committee',
                'honorary_member',
            ],
            'career' => [
                'company',
                'job_opening',
            ],
        ];

        $association_clause = $item->object_id === $page_ids['association'] && (is_post_type_archive($cpt['association']) || is_singular($cpt['association']));
        $career_clause = $item->object_id === $page_ids['career'] && (is_post_type_archive($cpt['career']) || is_singular($cpt['career']));

        if ($association_clause || $career_clause) {
            $atts['class'] = empty($atts['class']) ? 'active' : $atts['class'].' active';
        }

        return $atts;
    }
}
