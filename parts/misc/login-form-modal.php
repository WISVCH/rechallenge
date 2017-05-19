<?php
if (! is_user_logged_in()) {
    ?>

    <section class="tiny reveal" id="login-form" data-reveal data-animation-in="fade-in" data-animation-out="fade-out">

        <h1 class="text-center">Login</h1>

        <?php

        if (class_exists("OpenID_Connect_Generic_Login_Form")) {

            ?>

            <p class="text-center">Login with your CH account or TU Delft NetID.</p>

            <?php echo do_shortcode("[openid_connect_generic_login_button]"); ?>

            <p class="text-center">
                <small>Having trouble logging in? <a href="<?php echo wp_login_url(site_url('portal')); ?>">Click here</a></small>
            </p>

            <?php
        } else {

            // Default WP login form
            wp_login_form([
                'redirect' => site_url('portal'),
                'form_id' => 'wisv-login-form',
                'label_username' => "Username",
                'label_password' => "Password",
                'label_remember' => "Remember me?",
                'label_log_in' => "Login",
                'remember' => true,
            ]);
        }
        ?>
    </section>


    <?php
}