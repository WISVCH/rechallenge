<?php
$meta = get_post_custom(get_the_ID());
$company_id = !isset($meta['_company_id'][0]) ? '' : $meta['_company_id'][0];
$location = !isset($meta['_company_location'][0]) ? '' : $meta['_company_location'][0];
?>
<article class="row">
	<div class="small-12 medium-3 column">
		<?php
		if (has_post_thumbnail($company_id)) {
			?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<?php echo get_the_post_thumbnail($company_id, "featured-image", array(
					'class' => 'thumbnail'
				)); ?>
			</a>
			<?php
		}
		?>
	</div>
	<div class="small-12 medium-9 column">
		<header>
			<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
		</header>
		<p class="byline">
			<span><a href="<?php echo get_permalink($company_id); ?>"><?php echo get_the_title($company_id); ?></a></span>
			<?php if (!empty($location)) { ?>
				<span><?php echo esc_html($location); ?></span>
			<?php } ?>
			<span>Placed <?php echo human_time_diff(get_the_time('U')); ?> ago</span>
		</p>
		<?php the_excerpt(); ?>
	</div>
</article>
