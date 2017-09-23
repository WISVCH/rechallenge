<div class="row column column-block">
    <h1>Companies</h1>
    <p>Find your new employer with W.I.S.V. 'Christiaan Huygens'.</p>

    <?php
    // Get studies
    $studies = get_terms([
        'taxonomy' => 'company_study',
        'hide_empty' => false,
        'parent' => 0,
    ]);

    // Get offerings
    $offerings = get_terms([
        'taxonomy' => 'company_offerings',
        'hide_empty' => false,
        'parent' => 0,
    ]);

    rechallenge_faceted_term_selection($offerings, 'filter_type', 'Offerings');
    rechallenge_faceted_term_selection($studies, 'filter_study', 'Study');
    ?>
</div>

<div class="row">
    <?php
    if (have_posts()) {
        while (have_posts()) {
            the_post(); ?>
            <div class="column column-block separator-block">
                <?php get_template_part('parts/post-type/excerpt', 'company'); ?>
            </div>
        <?php }
    } else { ?>
        <div class="column">
            <h3>Oh no!</h3>
            <p>There are no companies available for the current selection.</p>
            <p><a href="<?=remove_query_arg(['filter_study', 'filter_type'])?>" class="button primary tiny">Clear filters <i class="ch-arrow-right"></i></a></p>
        </div>
    <?php } ?>
</div>
