<?php

use Drupal\Core\Link;

class Rechallenge_Preprocess_Menu_Local_Task {

	/**
	 * Fix local tasks menu links.
	 * @param $variables preprocess_menu_local_task variables
	 */
	public static function fixLocalTasksMenu(&$variables) {

		$link = $variables['element']['#link'];
		$url = $link['url'];
		$options = $url->getOptions();
		$url->setOptions($options + $link['localized_options']);
		$variables['item'] = Link::fromTextAndUrl($link['title'], $url);

	}

}