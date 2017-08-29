<div class="row collapse">

    <div class="small-12 column">
        <h2><?php echo esc_html($greeting).', '.esc_html(! empty($meta['first_name'][0]) ? $meta['first_name'][0] : $user->display_name); ?></h2>

        <?php
        if (! empty($meta['last_login'])) {
            ?>
            <p>Your last login was at <?php echo get_date_from_gmt($meta['last_login'][0], 'l, F jS Y, H:i'); ?>.</p>
            <?php
        }

        global $post;

        // Get subpages (actions)
        $actions = get_pages([
            'child_of' => $post->post_parent,
            'sort_column' => 'menu_order,post_title',
            'exclude' => $post->ID,
        ]);

        if (count($actions) > 0) {
            ?>
            <h3>Get started:</h3>
            <ul>
                <?php
                foreach ($actions as $action) {
                    ?>
                    <li><a href="<?php echo get_permalink($action->ID); ?>"><?php echo esc_html(get_the_title($action)); ?></a></li>
                    <?php
                }
                ?>
            </ul>

            <?php
        }
        ?>

    </div>

    <?php
    include('sidebar.php');
    ?>

</div>
