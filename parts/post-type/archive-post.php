<?php
/**
 * Template for post archives (daily / monthly / yearly)
 */
?>
<div class="row">

    <?php
    the_archive_title('<h1>', '</h1>');
    ?>

    <?php
    if (have_posts()) {
        ?>

        <table>
            <thead>
            <tr>
                <th>Date</th>
                <th>Title</th>
            </tr>
            </thead>

            <?php
            while (have_posts()) {
                the_post(); ?>


                <tr>
                    <td><?php the_time('F jS, Y'); ?></td>
                    <td><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></td>
                </tr>


                <?php
            }
            ?>

        </table>

        <?php
    } else {
        ?>

        <div class="column">
            <h3>No content available</h3>
            <p>There are currently no (recent) news items.</p>
        </div>

        <?php
    }
    ?>
</div>
