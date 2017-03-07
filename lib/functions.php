<?php

/**
 * Encodes e-mail address. Rudimentary spam protection.
 * @param $e Input email
 * @return string Encoded output email
 */
function encode_email($e) {
	$output = '';
	for ($i = 0; $i < strlen($e); $i++) {
		$output .= '&#' . ord($e[$i]) . ';';
	}
	return $output;
}

function rechallenge_get_title() {

	if (is_home()) {
		$title = get_the_title(get_option("page_for_posts"));
	} elseif (is_post_type_archive("board")) {
		$title = "Current and previous boards";
	} elseif (is_post_type_archive("committee")) {
		$title = "Committees";
	} elseif (is_post_type_archive("company")) {
		$title = "Companies";
	} elseif (is_post_type_archive("honorary_member")) {
		$title = "Honorary Members";
	} elseif (is_post_type_archive("job_opening")) {
		$title = "Job Openings";
	} else {
		$title = get_the_title(get_the_ID());
	}

	return $title;
}

/**
 * Returns the ID of the page associated with a custom post type archive. (if a post type archive page)
 * @return int|false Auxilliary page ID.
 */
function rechallenge_get_aux_page_id() {

	// Custom post type archives
	if (is_post_type_archive("board")) {
		$id = get_page_by_path("association/boards");
	} elseif (is_post_type_archive("committee")) {
		$id = get_page_by_path("association/committees");
	} elseif (is_post_type_archive("company")) {
		$id = get_page_by_path("career/companies");
	} elseif (is_post_type_archive("honorary_member")) {
		$id = get_page_by_path("association/honorary-members/");
	} elseif (is_post_type_archive("job_opening")) {
		$id = get_page_by_path("career/job-openings");
	}

	// Singular custom post type
	if (is_singular(array(
		"board", "committee", "company", "honorary-member", "job-opening"
	))) {

		switch (get_post_type()) {
			case "board":
				$id = get_page_by_path("association/boards");
				break;
			case "company":
				$id = get_page_by_path("career/companies");
				break;
		}

	}

	if (isset($id) && is_a($id, "WP_Post")) {
		return $id->ID;
	}
	return get_the_ID();

}