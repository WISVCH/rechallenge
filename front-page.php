<?php
get_header();
?>

	<!-- Intro text -->
	<section class="section-odd intro-text">
		<div class="row column text-center">
			<?php the_content(); ?>
		</div>
	</section>

<?php
// Events / News
get_template_part("parts/front-page/events-news");

// Banner Bar
get_template_part("parts/front-page/banner-bar");

// Photo Album
get_template_part("parts/front-page/photo-album");

// Footer
get_footer();