<?php
$loginurl = is_user_logged_in() && class_exists(WISVCH\Portal\Init::class) ? WISVCH\Portal\Init::getUrl() : site_url('portal');
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#058cce">
    <link rel="icon" href="<?php echo RECHALLENGE_URI; ?>/assets/images/favicon.png">

    <?php wp_head(); ?>

</head>
<body <?php body_class(is_front_page() ? 'front-page' : ''); ?>>

<div class="page-container">

    <!-- Page header -->
    <header class="page-header">

        <!-- Title Bar -->
        <div class="title-bar hide-for-large" data-responsive-toggle="nav-menu" data-hide-for="large">
            <div class="row collapse">
                <div class="small-6 medium-5 bg-left column">
                    <a class="logo-small hide-for-large" href="<?php echo esc_url(site_url('/')); ?>">
                        <img src="<?php echo RECHALLENGE_URI; ?>/assets/images/ch-logo.png" alt="<?php echo esc_attr(get_bloginfo('sitename')); ?>" class="logo-small">
                    </a>
                </div>
                <div class="small-6 medium-7 bg-right column">
                    <div class="float-right">
                        <?php
                        // @TODO: make link to portal dynamic. see: lib/Menu.php
                        if (is_user_logged_in()) {
                            echo '<a class="login-button button alert account-button" href="'.site_url('portal').'">Account</a>';
                        } else {
                            echo '<a class="login-button button alert" href="'.site_url('portal').'" data-open="login-form">Login</a>';
                        }
                        ?>
                        <button class="wisv-menu-icon hamburger hamburger--collapse" type="button" data-toggle>
                            <span class="hamburger-box"><span class="hamburger-inner"></span></span>
                        </button>
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
                                    <a href="<?php echo esc_url(site_url('/')); ?>">
                                        <img src="<?php echo RECHALLENGE_URI; ?>/assets/images/ch-logo.png" width="300" height="110"
                                             alt="W.I.S.V. 'Christiaan Huygens'">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="top-bar-right">
                            <?php
                            wp_nav_menu([
                                "container" => "",
                                "container_class" => "",
                                "items_wrap" => '<ul class="vertical large-horizontal menu">%3$s</ul>',
                                "menu_class" => "",
                                "menu_id" => "",
                                "depth" => 1,
                                "fallback_cb" => false,
                                "theme_location" => "main-nav",
                            ]);
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

            // Prepare data for page title and subpage menu.
            if (is_home() || is_singular('post')) { // News archive

                $page = get_post(get_option("page_for_posts"));

                // Get subpages
                $children = get_pages([
                    'child_of' => $page->post_parent,
                    'sort_column' => 'menu_order,post_title',
                ]);
            } elseif (is_page()) { // Regular page

                // Get subpages
                $children = get_pages([
                    'child_of' => $post->post_parent !== 0 ? $post->post_parent : $post->ID,
                    'sort_column' => 'menu_order,post_title',
                ]);
            } elseif (is_archive() || is_post_type_archive() || is_singular(['board', 'committee', 'company', 'honorary_member', 'job_opening'])) { // Custom post types

                // Get aux page ID
                $id = rechallenge_get_aux_page_id();
                $post_parent = wp_get_post_parent_id($id);

                // Get subpages
                $children = get_pages([
                    'child_of' => $post_parent !== 0 ? $post_parent : $id,
                    'sort_column' => 'menu_order,post_title',
                ]);
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
