<?php
namespace ReCHallenge;

// Load required classes
require_once("lib/Branding.php");
require_once("lib/Cleanup.php");
require_once("lib/Foundation.php");
require_once("lib/Menu.php");
require_once("lib/Redirect.php");
require_once("lib/Scripts.php");
require_once("lib/Setup.php");
require_once("lib/Sidebars.php");
require_once("lib/Styles.php");

// Clean up WordPress
Cleanup::register_hooks();

// Setup theme
Setup::register_hooks();

// Register redirections
Redirect::register_hooks();

// Register menus
Menu::register_hooks();

// Register sidebars / widget areas
Sidebars::register_hooks();

// Load Foundation 6 compatibility adjustments
Foundation::register_hooks();

// Load styles
Styles::register_hooks();

// Load scripts
Scripts::register_hooks();

// Load W3Cie branding
Branding::register_hooks();


// Helper functions
require_once("lib/functions.php");