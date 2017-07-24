<div class="row column">
    <h2>Job Openings</h2>

    <?php
    if (have_posts()) {

        while (have_posts()) {
            the_post();
            get_template_part('parts/post-type/excerpt', 'job-opening');
        }
    } else {
        ?>
        <p>There are currently no job openings available to display.</p>
        <?php
    }
    ?>

</div>
