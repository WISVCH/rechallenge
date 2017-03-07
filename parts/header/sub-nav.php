<!-- Sub Nav -->
<nav class="sub-nav">

	<ul class="horizontal menu">
		<?php
		foreach ($children as $subpage) {

			global $post;

			if (
				// Post ID matches subpage (nav item) ID
				(isset($post) && $post->ID === $subpage->ID) ||

				// Custom post type archive
				(is_post_type_archive() && rechallenge_get_aux_page_id() === $subpage->ID) ||

				// News archive or news item
				((is_home() || is_singular("post")) && $subpage->ID == get_option("page_for_posts"))
			) {
				$active = true;
			} else {
				$active = false;
			}

			?>
			<li><a href="<?php echo get_page_link($subpage); ?>"<?php echo $active ? ' class="active"' : ''; ?>><?php echo esc_html($subpage->post_title); ?></a></li>
			<?php
		}
		?>
	</ul>

</nav>
