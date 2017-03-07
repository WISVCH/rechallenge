<?php
$url = rawurlencode(get_permalink());
$title = rawurlencode(get_the_title(get_the_ID()));
$excerpt = rawurlencode(get_the_excerpt(get_the_ID()));
?>
<ul class="share">
	<li class="text">Share:</li>
	<li><a target="_blank" class="fb" href="https://facebook.com/sharer/sharer.php?u=<?php echo $url; ?>" title="Facebook"><i class="fa ch-facebook" aria-hidden="true"></i></a></li>
	<li><a target="_blank" class="li" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $url; ?>&amp;title=<?php echo $title; ?>&amp;summary=<?php echo $excerpt; ?>&amp;source=url" title="LinkedIn"><i class="fa ch-linkedin" aria-hidden="true"></i></a></li>
	<li><a target="_blank" class="tw" href="https://twitter.com/intent/tweet/?text=<?php echo $title; ?>&amp;url=<?php echo $url; ?>" title="Twitter"><i class="fa ch-twitter" aria-hidden="true"></i></a></li>
	<li><a target="_blank" class="wa" href="whatsapp://send?text=<?php echo $excerpt; ?>%20<?php echo $url; ?>" title="Whatsapp"><i class="fa ch-whatsapp" aria-hidden="true"></i></a></li>
</ul>