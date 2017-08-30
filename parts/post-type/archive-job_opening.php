<div class="row column">
    <h1>Job Openings</h1>
    <p>Kick start or continue your career with W.I.S.V. 'Christiaan Huygens'.</p>
</div>

<div class="row">
    <?php
    if (have_posts()) {

        while (have_posts()) {
            the_post();
            ?>

            <div class="column column-block separator-block">
                <?php get_template_part('parts/post-type/excerpt', 'job-opening'); ?>
            </div>

            <?php
        }
    } else {
        ?>
        <p>There are currently no job openings available to display.</p>
        <?php
    }
    ?>

</div>
