<?php
namespace ReCHallenge;

/**
 * Loads theme scripts.
 * @package ReCHallenge
 */
class Scripts {

	/**
	 * Hook into WordPress.
	 */
	static function register_hooks() {

		add_action('wp_enqueue_scripts', array(__CLASS__, 'load_scripts'));

	}

	/**
	 * Enqueue scripts.
	 */
	static function load_scripts() {

		// Register scripts
		wp_register_script('what-input', get_stylesheet_directory_uri() . '/assets/components/what-input/dist/what-input.js', array(), null, true);
		wp_register_script('foundation', get_stylesheet_directory_uri() . '/assets/components/foundation-sites/dist/js/foundation.js', array('jquery', 'what-input'), null, true);
		wp_register_script('rechallenge', get_stylesheet_directory_uri() . '/assets/js/app.js', array('jquery', 'foundation'), null, true);

		// Load combined and compressed theme JS and dependencies
		wp_enqueue_script('rechallenge');

	}

}
