<?php
$meta = get_post_custom(get_the_ID());
$board_year = ! isset($meta['_board_year'][0]) ? '' : $meta['_board_year'][0];
?>
<div class="row board-wrapper">

    <div class="large-5 column">
        <?php
        the_post_thumbnail('full');
        ?>
    </div>

    <div class="large-7 column">
        <?php
        the_title('<h1>', '</h1>');

        if (! empty($board_year)) {
            ?>
            <p class="byline"><?=esc_html($board_year);?></p>
            <?php
        }

        the_content();
        ?>
    </div>

</div>
