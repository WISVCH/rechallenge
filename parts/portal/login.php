<?php

use WISVCH\Portal\Portal;

// Display content based on user login status
if (is_user_logged_in()) {

    ?>
    <aside class="callout" data-closable>
        <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
            <span aria-hidden="true">&times;</span>
        </button>
        <h5>Error</h5>
        <p>You are already logged in. Would you like to <a href="<?php echo wp_logout_url(site_url('/')); ?>">log out</a> instead?</p>

    </aside>

    <h1>Log In</h1>
    <p><a href="<?php echo esc_url(Portal::getUrl()); ?>">Click here</a> to go to your account page.</p>

    <?php
} else {

    ?>

    <h1>Log In</h1>
    <?php
    wp_login_form([
        'redirect' => site_url('portal'),
        'form_id' => 'wisv-login-form',
        'label_username' => "Username",
        'label_password' => "Password",
        'label_remember' => "Remember me?",
        'label_log_in' => "Login",
        'remember' => true,
    ]);
    ?>

    <?php
}
