<article class="news-featured">
	<header>
		<?php
		if (has_post_thumbnail()) {
			?>
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail("featured-image"); ?>
			</a>
			<?php
		}
		?>

		<h1 class="small"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
		<p class="byline">
			<time pubdate="pubdate"><?php the_date("F jS, Y"); ?></time>
		</p>
	</header>
	<?php the_excerpt(); ?>
</article>