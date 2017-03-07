<?php
namespace ReCHallenge;


require_once("Walkers/Menu.php");
require_once("Walkers/BannerBar.php");

/**
 * Foundation 6 compatibility class.
 * @package ReCHallenge
 */
class Foundation {

	/**
	 * Hook into WordPress.
	 */
	static function register_hooks() {

		// Replace default Menu Walker
		add_filter('wp_nav_menu_args', array(__CLASS__, 'replace_walker'));

		// Add active class to menu
		add_filter('nav_menu_link_attributes', array(__CLASS__, 'active_nav_class'), 20, 2);

	}

	/**
	 * Add active class to active menu item.
	 * @param $atts Link attributes.
	 * @param $item Menu item.
	 * @return array Updates link attributes.
	 */
	static function active_nav_class($atts, $item) {

		if ($item->current === true || $item->current_item_ancestor === true) {
			$atts['class'] = 'active';
		}

		return $atts;
	}

	/**
	 * Switch out default nav walker class with Foundation-compatible version.
	 * @param $args wp_nav_menu() defaults
	 */
	static function replace_walker($args) {

		switch ($args['theme_location']) {
			case 'banner-bar':
				$args['walker'] = new Walkers\BannerBar();
				break;
			default:
				$args['walker'] = new Walkers\Menu();
				break;
		}

		return $args;
	}


}