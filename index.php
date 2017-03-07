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
			/*

			<aside class="callout" data-closable>
				<button class="close-button" aria-label="Dismiss alert" type="button" data-close>
					<span aria-hidden="true">&times;</span>
				</button>
				<h5>Welcome!</h5>
				<p>This design is a work in progress.</p>

			</aside>
			*/ ?>

			<?php
			if (have_posts()) {

				while (have_posts()) {
					the_post();

					get_template_part('parts/post-type/single-post', get_post_format());
				}

			} else {
				get_template_part('parts/post-type/empty', 'post');
			}
			?>

		</div>

	</section>

<?php
get_footer();