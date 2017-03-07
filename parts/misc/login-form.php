<?php
if (!is_user_logged_in()) {
	?>

	<section class="tiny reveal" id="login-form" data-reveal data-animation-in="fade-in" data-animation-out="fade-out">

		<h1 class="text-center">Login</h1>

		<?php
		wp_login_form(array(
			'redirect' => admin_url(),
			'form_id' => 'wisv-login-form',
			'label_username' => "Username",
			'label_password' => "Password",
			'label_remember' => "Remember me?",
			'label_log_in' => "Login",
			'remember' => true
		));
		?>
	</section>


	<?php
}