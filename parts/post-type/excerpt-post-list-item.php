<li>
	<article class="icon-row">

		<div class="icon-cell">
			<a href="<?php the_permalink(); ?>">
				<?php
				$thumb_url = has_post_thumbnail() ? get_the_post_thumbnail_url() : RECHALLENGE_URI . '/assets/images/placeholder.png';
				?>
				<img class="thumbnail" src="<?php echo $thumb_url; ?>" alt="">
			</a>
		</div>

		<div class="text-cell">
			<h2 class="small"><a href=" <?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<p class="byline">
				<time pubdate="pubdate"><?php the_date("F jS, Y"); ?></time>
			</p>
		</div>
	</article>
</li>