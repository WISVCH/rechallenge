<?php

namespace ReCHallenge;

/**
 * Make sure all WordPress branding is replaced by CH / W3Cie branding.
 *
 * @package ReCHallenge
 */
class Branding
{
    /**
     * Hook into WordPress.
     */
    static function register_hooks()
    {

        // Alter login screen
        add_action('login_enqueue_scripts', [__CLASS__, 'login_logo']);
        add_filter('login_headerurl', [__CLASS__, 'login_logo_url']);
        add_filter('login_headertitle', [__CLASS__, 'login_logo_title']);

        // Change admin footer
        add_filter('admin_footer_text', [__CLASS__, 'admin_footer']);
    }

    /**
     * Add CH logo to login screen.
     */
    static function login_logo()
    {
        ?>
        <style type="text/css">
            #login {
                padding: 5% 0 0 !important;
            }

            #login h1 a {
                background-image: url(<?=RECHALLENGE_URI?>/assets/images/shield.png);
                width: 100%;
                height: 150px;
                background-size: contain;
            }
        </style>
        <?php
    }

    /**
     * Change login logo URL.
     */
    static function login_logo_url()
    {
        return home_url();
    }

    /**
     * Change login logo title.
     */
    static function login_logo_title()
    {
        return get_bloginfo("name");
    }

    /**
     * WordPress admin footer.
     */
    static function admin_footer()
    {
        echo '<span id="footer-thankyou"><a href="https://wordpress.org/">WordPress</a> with a touch of W3Cie.</span>';
    }
}
