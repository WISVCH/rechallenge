<div class="row column">
    <h1><?php the_archive_title(); ?></h1>
</div>

<div class="row">
    <?php
    if (have_posts()) {

        while (have_posts()) {

            // Render first post
            the_post();
            ?>

            <div class="column column-block separator-block news-block">
                <?php get_template_part('parts/post-type/excerpt', 'post'); ?>
            </div>

            <?php
        }
    } else {
        ?>

        <div class="column">
            <h2>No content available</h2>
            <p>There are currently no (recent) news items.</p>
        </div>

        <?php
    }
    ?>
</div>

<div class="row column column-block">
    <p class="next-prev-links"><?php echo get_posts_nav_link([
            'sep' => '',
        ]); ?></p>
</div>

<?php
if (is_home()) {
    ?>
    <div class="row column">
        <p class=""><a class="button small" href="<?=get_year_link('')?>">Browse news archive &rsaquo;</a></p>
    </div>
    <?php
}
