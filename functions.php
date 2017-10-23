<?php

namespace ReCHallenge;

define("RECHALLENGE_URI", get_stylesheet_directory_uri());

// Load required classes
require_once("lib/Assets.php");
require_once("lib/Ajax.php");
require_once("lib/Branding.php");
require_once("lib/Cleanup.php");
require_once("lib/Foundation.php");
require_once("lib/Menu.php");
require_once("lib/Misc.php");
require_once("lib/Query.php");
require_once("lib/SEO.php");
require_once("lib/Setup.php");
require_once("lib/Sidebars.php");

// Clean up WordPress
Cleanup::register_hooks();

// Register redirections
Query::register_hooks();

// Handle AJAX requests
Ajax::register_hooks();

// Setup theme
Setup::register_hooks();

// Register menus
Menu::register_hooks();

// Register sidebars / widget areas
Sidebars::register_hooks();

// Load Foundation 6 compatibility adjustments
Foundation::register_hooks();

// Load scripts and scripts
Assets::register_hooks();

// Load Yoast SEO modifications
SEO::register_hooks();

// Miscellaneous modifications
Misc::register_hooks();

// Load W3Cie branding
Branding::register_hooks();

// Helper functions
require_once("lib/functions.php");
