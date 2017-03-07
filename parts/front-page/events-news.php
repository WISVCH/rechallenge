<!-- Calendar / News -->
<div class="section-even calendar-news">

	<div class="row" data-equalizer data-equalize-on="large" id="equalize-columns">
		<div class="column medium-5 large-4">

			<!-- Calendar -->
			<section class="wisv-panel" data-equalizer-watch>
				<header class="wisv-panel-heading">
					<h1 class="small">Calendar
						<small><a href="#">Overview <i class="fa ch-arrow-right"></i></a></small>
					</h1>
				</header>

				<div class="wisv-panel-content">
					<ul>
						<?php
						for ($x = 0; $x < 4; $x++) {
							?>
							<li class="row event">
								<?php get_template_part('parts/post-type/excerpt', 'event'); ?>
							</li>
							<?php
						}
						?>
					</ul>
				</div>

			</section>

		</div>
		<div class="column medium-7 large-8">

			<!-- News -->
			<section class="wisv-panel" data-equalizer-watch>
				<div class="wisv-panel-heading">
					<h1 class="small">News
						<small><a href="<?php echo get_permalink(get_option('page_for_posts')) ?>">More <i class="fa ch-arrow-right"></i></a></small>
					</h1>
				</div>
				<div class="wisv-panel-content">
					<div class="row">

						<?php
						$news = new WP_Query(array(
							'post_type' => 'post',
							'posts_per_page' => 5,
							'orderby' => 'date',
							'order' => 'DESC'
						));

						if ($news->have_posts()) {

							$news->the_post();
							?>

							<div class="medium-12 large-7 column">
								<?php echo get_template_part("parts/post-type/excerpt", "post-large"); ?>
							</div>

							<?php
							// If more than one post
							if ($news->have_posts()) {
								?>
								<ul class="medium-12 large-5 column news">
									<?php
									while ($news->have_posts()) {
										$news->the_post();
										echo get_template_part("parts/post-type/excerpt", "post-list-item");
									}
									?>
								</ul>
								<?php
							}

							wp_reset_postdata();

						} else {
							?>

							<div class="column">
								<h3>No content available</h3>
								<p class="">There are currently no (recent) news items.</p>
							</div>

							<?php
						}
						?>

					</div>
				</div>
			</section>

		</div>
	</div>

</div>