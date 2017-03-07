<?php
namespace ReCHallenge;


/**
 * Clean up and speed up WordPress by removing or unloading unnecessary parts.
 * @package ReCHallenge
 */
class Cleanup {

	/**
	 * Hook into WordPress.
	 */
	static function register_hooks() {

		// Disable Emojicons.
		add_action('init', array(__CLASS__, 'disable_emojicons'));

		// Remove WP Generator Meta Tag
		remove_action('wp_head', 'wp_generator');
		add_filter('the_generator', array(__CLASS__, 'remove_generator_meta'));

		// Remove WLWriter Meta Tag
		remove_action('wp_head', 'wlwmanifest_link');

		// Remove Shortlink Meta Tag
		remove_action('wp_head', 'wp_shortlink_wp_head');

	}

	/**
	 * Disables Emojicons.
	 * @see http://wordpress.stackexchange.com/questions/185577/disable-emojicons-introduced-with-wp-4-2
	 */
	static function disable_emojicons() {

		remove_action('admin_print_styles', 'print_emoji_styles');
		remove_action('wp_head', 'print_emoji_detection_script', 7);
		remove_action('admin_print_scripts', 'print_emoji_detection_script');
		remove_action('wp_print_styles', 'print_emoji_styles');
		remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
		remove_filter('the_content_feed', 'wp_staticize_emoji');
		remove_filter('comment_text_rss', 'wp_staticize_emoji');
		add_filter('emoji_svg_url', '__return_false');
		add_filter('tiny_mce_plugins', array(__CLASS__, 'disable_emojicons_tinymce'));

	}

	/**
	 * Disable Emojicons in the TinyMCE editor.
	 * @param $plugins TinyMCE plugins.
	 * @return array Filtered TinyMCE plugins.
	 */
	static function disable_emojicons_tinymce($plugins) {
		if (is_array($plugins)) {
			return array_diff($plugins, array('wpemoji'));
		} else {
			return array();
		}
	}

	/**
	 * Remove WP generator (with version number)
	 * @return string Empty string.
	 */
	static function remove_generator_meta() {
		return "";
	}

}