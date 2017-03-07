<?php
namespace ReCHallenge;

/**
 * Loads theme stylesheets.
 * @package ReCHallenge
 */
class Styles {

	/**
	 * Hook into WordPress.
	 */
	static function register_hooks() {

		add_action('wp_enqueue_scripts', array(__CLASS__, 'load_stylesheets'));

	}

	/**
	 * Enqueue stylesheets.
	 */
	static function load_stylesheets() {

		// Primary stylesheet
		wp_enqueue_style('rechallenge', get_stylesheet_directory_uri() . "/assets/css/app.css");

	}

}
