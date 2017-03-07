<!-- Banner Bar -->
<section class="section-even banner-bar">

	<div class="row">
		<div class="small-12 large-8 column">
			<a class="banner-container" href="#"><img class="" width="770" height="170" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/test/ifot-banner.jpg"></a>
		</div>
		<div class="small-12 large-4 column wisv-buttons">
			<div class="row">
				<?php
				wp_nav_menu(array(
					"container" => "",
					"container_class" => "",
					"items_wrap" => '%3$s',
					"menu_class" => "",
					"menu_id" => "",
					"depth" => 1,
					"fallback_cb" => false,
					"theme_location" => "banner-bar"
				));
				?>
			</div>
		</div>
	</div>

</section>