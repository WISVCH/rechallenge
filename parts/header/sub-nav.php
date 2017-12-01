<!-- Sub Nav -->
<nav class="sub-nav">

    <ul class="horizontal menu">
        <?php
        foreach ($children as $subpage) {

            global $post;

            if (// Post ID matches subpage (nav item) ID
                (isset($post) && $post->ID === $subpage->ID) ||

                // Auxilliary ID matches page
                rechallenge_get_aux_page_id() === $subpage->ID) {
                $active = true;
            } else {
                $active = false;
            }
            ?>
            <li><a href="<?=get_page_link($subpage)?>"<?php echo $active ? ' class="is-active"' : ''; ?>><?=esc_html($subpage->post_title)?></a></li>
            <?php
        }
        ?>
    </ul>

</nav>
