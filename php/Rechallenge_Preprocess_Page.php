<?php

class Rechallenge_Preprocess_Page {

	/**
	 * Merge account menu with main menu.
	 * @param $variables preprocess_page variables
	 */
	public static function mergeMainMenu(&$variables) {

		$menus = array("main", "account");

		$combined_tree = array();
		$menu_tree = \Drupal::menuTree();
		$parameters = $menu_tree->getCurrentRouteMenuTreeParameters(trim($menus[0]));

		$parameters->setMinDepth(1);
		$parameters->setMaxDepth(1);

		$manipulators = array(
			// Show links to nodes that are accessible for the current user.
			array('callable' => 'menu.default_tree_manipulators:checkNodeAccess'),
			// Only show links that are accessible for the current user.
			array('callable' => 'menu.default_tree_manipulators:checkAccess'),
			// Use the default sorting of menu links.
			array('callable' => 'menu.default_tree_manipulators:generateIndexAndSort'),
		);
		// Force the entire tree to be build by setting expandParents to an
		// empty array.
		$parameters->expandedParents = array();
		// Iterate over the menus and merge them together.
		foreach ($menus as $menu_name) {
			$tree_items = $menu_tree->load(trim($menu_name), $parameters);

			// Check if iterating over User Account menu
			if ($menu_name === "account" && !\Drupal::currentUser()->isAnonymous()) {
				foreach (array_keys($tree_items) as $name) {

					if ($name === "user.logout") {

						// Remove logout link
						unset($tree_items[$name]);

					}

					// TODO: change label for "My Account" page
				}
			}

			$tree_manipulated = $menu_tree->transform($tree_items, $manipulators);
			$combined_tree = array_merge($combined_tree, $tree_manipulated);
		}

		$menu = $menu_tree->build($combined_tree);

		$variables['page']['main_navigation'] = array(
			'#markup' => \Drupal::service("renderer")->renderRoot($menu),
		);
	}

	/**
	 * Generate menu if current node has underlying nodes.
	 * @param $variables preprocess_page variables
	 */
	public static function generateSubpagesMenu(&$variables) {

		// ** Generate menu with subpages ** //

		$current_nid = \Drupal::routeMatch()->getRawParameter('node');

		$menu_tree = \Drupal::menuTree();
		$parameters = $menu_tree->getCurrentRouteMenuTreeParameters("main");

		$parameters->setMinDepth(2);
		$parameters->setMaxDepth(2);
		$parameters->addExpandedParents(array($current_nid));

		$manipulators = array(
			// Show links to nodes that are accessible for the current user.
			array('callable' => 'menu.default_tree_manipulators:checkNodeAccess'),
			// Only show links that are accessible for the current user.
			array('callable' => 'menu.default_tree_manipulators:checkAccess'),
			// Use the default sorting of menu links.
			array('callable' => 'menu.default_tree_manipulators:generateIndexAndSort'),
		);

		$tree_items = $menu_tree->load("main", $parameters);
		$tree = $menu_tree->transform($tree_items, $manipulators);

		$menu = $menu_tree->build($tree);
		$menu["#menu_name"] = "subpage";
		$menu["#theme"] = "menu__secondary";

		$variables['has_subpages'] = count($tree) > 0;
		$variables['page']['subpage_navigation'] = array(
			'#markup' => \Drupal::service("renderer")->renderRoot($menu),
		);

	}

}