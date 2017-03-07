<!-- Partners -->
<div class="row column">

	<?php
	$partners = new WP_Query(array(
		'post_type' => 'company',
		'orderby' => 'rand',
		'posts_per_page' => 10,
	));

	if ($partners->have_posts()) {
		?>

		<h1 class="small">Our partners</h1>

		<div class="row partners small-up-2 medium-up-4 large-up-5">
			<?php
			while ($partners->have_posts()) {
				$partners->the_post();
				?>

				<div class="column">
					<?php
					$link_type = get_post_meta(get_the_ID(), "_link_to", true);
					switch ($link_type) {
						case "post":
							$link_text = 'View profile <i class="fa ch-arrow-right"></i>';
							$link_url = get_the_permalink();
							break;
						default:
							$link_text = 'Visit website <i class="fa ch-arrow-right"></i>';
							$link_url = get_post_meta(get_the_ID(), "_company_website", true); // escape later
							break;
					}
					?>

					<a href="<?php echo esc_url($link_url); ?>" title="<?php the_title_attribute(); ?>" class="partner">
						<?php
						if (has_post_thumbnail()) {
							?>
							<img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title_attribute(); ?>"/>
							<?php
						} else {
							the_title();
						}
						?>
					</a>
					<span class="partner-excerpt">
						<span class="positioner">
							<?php echo get_the_excerpt(); ?>
							<a class="button alt" href="<?php echo esc_url($link_url); ?>"><?php echo $link_text; ?></a>
						</span>
					</span>
				</div>

				<?php

			}
			?>
		</div>

		<?php
	}
	?>

</div>