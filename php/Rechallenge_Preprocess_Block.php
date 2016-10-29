<?php

class Rechallenge_Preprocess_Block {

	/**
	 * Add slider_count TWIG variable to frontpage slider block.
	 * @param $variables preprocess_block variables
	 */
	public static function addResultCountFrontpageSlider(&$variables) {

		if ($variables['elements']["#id"] === "views_block__frontpage_slider_block") {
			$view = $variables['elements']['content']['#view'];

			$page_total = isset($view->result) ? count($view->result) : 0;

			$variables["slider_count"] = $page_total;

		}

	}

}