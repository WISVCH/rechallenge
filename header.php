<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/favicon.png">

	<?php wp_head(); ?>

</head>
<body <?php body_class(is_front_page() ? 'front-page' : ''); ?>>

<!-- Page header -->
<header class="page-header">

	<!-- Title Bar -->
	<div class="title-bar hide-for-large" data-responsive-toggle="nav-menu" data-hide-for="large">
		<div class="row collapse">
			<div class="small-6 medium-5 bg-left column">
				<a class="logo-small show-for-medium-down" href="<?php echo esc_url(home_url('/')); ?>">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/ch-logo-small@2x.png" alt="W.I.S.V. 'Christiaan Huygens'" class="logo-small">
				</a>
			</div>
			<div class="small-6 medium-7 bg-right column">
				<div class="float-right">
					<a class="login-button button alert" href="#">Login</a>
					<button class="wisv-menu-icon" type="button" data-toggle></button>
				</div>
			</div>

		</div>
	</div>

	<!-- Top Bar -->
	<div class="wisv-header left">

		<div class="wisv-header right">
			<div class="center row">

				<nav class="top-bar" id="nav-menu">
					<div class="top-bar-left show-for-large">
						<div class="logo-wrapper">
							<div class="logo">
								<a href="<?php echo esc_url(home_url('/')); ?>">
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/ch-logo@2x.png" width="300" height="110" alt="W.I.S.V. 'Christiaan Huygens'">
								</a>
							</div>
						</div>
					</div>
					<div class="top-bar-right">
						<?php
						wp_nav_menu(array(
							"container" => "",
							"container_class" => "",
							"items_wrap" => '<ul class="dropdown vertical large-horizontal menu" data-dropdown-menu>%3$s</ul>',
							"menu_class" => "",
							"menu_id" => "",
							"depth" => 1,
							"fallback_cb" => false,
							"theme_location" => "main-nav",
						));
						?>
					</div>
				</nav>

			</div>
		</div>

	</div>


	<?php

	// Load page title template part. Many corner cases (unfortunately), concerning the page children.

	if (is_front_page()) {

		get_template_part("parts/header/page-title", "front");

	} else {

		global $post;

		if (is_home()) { // News archive

			$page = get_post(get_option("page_for_posts"));

			// Get subpages
			$children = get_pages(array(
				'child_of' => $page->post_parent
			));

		} elseif (is_page()) { // Regular page

			// Get subpages
			$children = get_pages(array(
				'child_of' => $post->post_parent !== 0 ? $post->post_parent : $post->ID
			));


		} elseif (is_post_type_archive()) { // Custom post type archive

			// Get aux page ID
			$id = rechallenge_get_aux_page_id();
			$post_parent = wp_get_post_parent_id($id);

			// Get subpages
			$children = get_pages(array(
				'child_of' => $post_parent !== 0 ? $post_parent : $id
			));

		}

		// Load page title template
		include(locate_template('parts/header/page-title.php'));

		// Load sub navigation if has subpages
		if (count($children) > 0) {
			include(locate_template('parts/header/sub-nav.php'));
		}

	}
	?>


</header>