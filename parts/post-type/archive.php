<div class="row small-up-2 medium-up-3 large-up-5">
	<?php
	$post_type = get_post_type();
	if ($post_type !== false) {

		while (have_posts()) {
			the_post();
			?>
			<article class="column">
				<?php get_template_part('parts/post-type/excerpt', $post_type); ?>
			</article>
			<?php
		}

	}
	?>
</div>