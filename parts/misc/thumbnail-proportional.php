<?php
$class = isset($thumb_sizing) && $thumb_sizing === 'contain' ? $thumb_sizing : '';
if ($thumb) { ?>
    <div class="thumb-image <?=$class?>" style="background-image:url(<?=esc_url($thumb)?>)"></div>
<?php } else { ?>
    <div class="thumb-image contain" style="background-image:url(<?=RECHALLENGE_URI.'/assets/images/placeholder.png'?>)"></div>
<?php } ?>