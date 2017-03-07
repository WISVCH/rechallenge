<?php
get_header();
?>

	<!-- Main -->
	<section>

		<?php
		get_template_part("parts/navigation/breadcrumb");
		?>

		<div class="row column">
			<?php
			while (have_posts()) {
				the_post();

				get_template_part('parts/post-type/single', get_post_type());
			}
			?>
		</div>

	</section>

<?php
get_footer();