<?php
get_header();
?>
	<!-- Main -->
	<section>
		<?php
		get_template_part("parts/navigation/breadcrumb");

		if (have_posts() && false !== ($archive_post_type = get_post_type())) {
			get_template_part('parts/post-type/archive', get_post_type());
		} else {
			get_template_part('parts/post-type/archive', 'empty');
		}
		?>
	</section>

<?php
get_footer();