<div class="row column column-block">
    <h1>Job Openings</h1>
    <p>Kick start your career with W.I.S.V. 'Christiaan Huygens'.</p>

    <?php
    // Get studies
    $studies = get_terms([
        'taxonomy' => 'job_study',
        'hide_empty' => false,
        'parent' => 0,
    ]);

    // Get types
    $offerings = get_terms([
        'taxonomy' => 'job_type',
        'hide_empty' => false,
        'parent' => 0,
    ]);

    rechallenge_faceted_term_selection($offerings, 'filter_type', 'Job Type');
    rechallenge_faceted_term_selection($studies, 'filter_study', 'Study');
    ?>
</div>

<div class="row">
    <?php
    if (have_posts()) {
        while (have_posts()) {
            the_post(); ?>
            <div class="column column-block separator-block">
                <?php get_template_part('parts/post-type/excerpt', 'job_opening'); ?>
            </div>
        <?php }
    } else { ?>
        <div class="column">
            <h3>Oh no!</h3>
            <p>There are no job openings available for the current selection.</p>
            <p><a href="<?=remove_query_arg(['filter_study', 'filter_type'])?>" class="button primary tiny">Clear filters <i class="ch-arrow-right"></i></a></p>
        </div>
    <?php } ?>
</div>
