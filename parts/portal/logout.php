<?php

if (is_user_logged_in()) {
    ?>

    <h1>Logout</h1>
    <p><a href="<?php echo wp_logout_url(site_url('/')); ?>">Click here</a> to log out.</p>

    <?php
} else {

    ?>

    <h1>Log Out</h1>
    <p>You have been successfully logged out. <a href="<?php echo esc_url(site_url('/')); ?>">Click here</a> to go back to the front page.</p>

    <?php
}
