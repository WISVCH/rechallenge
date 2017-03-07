<?php
namespace ReCHallenge;


/**
 * Make sure all WordPress branding is replaced by CH / W3Cie branding.
 * @package ReCHallenge
 */
class Branding {

	/**
	 * Hook into WordPress.
	 */
	static function register_hooks() {

		// Alter login screen
		add_action('login_enqueue_scripts', array(__CLASS__, 'login_logo'));
		add_filter('login_headerurl', array(__CLASS__, 'login_logo_url'));
		add_filter('login_headertitle', array(__CLASS__, 'login_logo_title'));

		// Change admin footer
		add_filter('admin_footer_text', array(__CLASS__, 'admin_footer'));

	}

	/**
	 * Add CH logo to login screen.
	 */
	static function login_logo() {
		?>
		<style type="text/css">
			#login h1 a {
				background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/assets/images/ch-logo@2x.png);
				width: 100%;
				height: 90px;
				background-size: contain;
			}
		</style>
		<?php
	}

	/**
	 * Change login logo URL.
	 */
	static function login_logo_url() {
		return home_url();
	}

	/**
	 * Change login logo title.
	 */
	static function login_logo_title() {
		return get_bloginfo("name");
	}

	/**
	 * WordPress admin footer.
	 */
	static function admin_footer() {
		echo '<span id="footer-thankyou"><a href="https://wordpress.org/">WordPress</a> with a touch of W3Cie.</span>';
	}


}