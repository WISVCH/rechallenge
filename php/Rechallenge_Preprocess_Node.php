<?php

use Drupal\Core\Url;

class Rechallenge_Preprocess_Node {

	/**
	 * Add is_front TWIG variable to all templates.
	 * @param $variables preprocess_node variables
	 */
	public static function addIsFront(&$variables) {

		// Add is_front to all pages.
		try {
			$variables['is_front'] = \Drupal::service('path.matcher')->isFrontPage();
		} catch (Exception $e) {
			// If the database is not yet available, set the default value.
			$variables['is_front'] = false;
		}

	}

	/**
	 * Add content type specific TWIG variables.
	 * @param $variables preprocess_node variables
	 */
	public static function addContentTypeVars(&$variables) {

		switch ($variables['node']->getType()) {

			case "banner":

				// Create banner target
				$banner_node = $variables['node'];

				$banner_target_raw = $banner_node->get('field_banner_target')->getValue();
				if (!empty($banner_target_raw[0])) {
					$banner_target = $banner_target_raw[0];

					$variables['banner_target'] = Url::fromUri($banner_target['uri']);

				}


				break;

		}

	}

}