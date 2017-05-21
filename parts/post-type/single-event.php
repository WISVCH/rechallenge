<?php
$meta = get_post_custom(get_the_ID());

$location = ! isset($meta['_event_location']) ? 'Unknown' : $meta['_event_location'][0];
$start = ! isset($meta['_event_start_date']) || empty($meta['_event_start_date'][0]) ? 'Unknown' : date("F j, Y, G:i", strtotime($meta['_event_start_date'][0]));
$end = ! isset($meta['_event_end_date']) ? 'Unknown' : date("F j, Y, G:i", strtotime($meta['_event_end_date'][0]));

// Cost
if (! isset($meta['_event_cost'])) {
    $cost = 'Free';
} elseif (! is_numeric($meta['_event_cost'][0])) {
    $cost = '<i>Unknown</i>';
} else {
    $cost = $meta['_event_cost'][0] > 0 ? "&euro; ".number_format_i18n($meta['_event_cost'][0], 2) : 'Free';
}

?>

<article>

    <div class="row">

        <div class="column medium-7 large-8">

            <?php
            the_title('<h1>', '</h1>');
            ?>

            <table class="wisv-event-table unstriped stack">
                <tbody>
                <tr>
                    <th>Starting time</th>
                    <td><?=$start?></td>
                </tr>
                <tr>
                    <th>Ending time</th>
                    <td><?=$end?></td>
                </tr>
                <tr>
                    <th>Cost</th>
                    <td><?=$cost?></td>
                </tr>
                <tr>
                    <th>Location</th>
                    <td><?=$location?></td>
                </tr>
                <?php
                $categories = get_the_terms(get_the_ID(), 'event-category');
                if ($categories !== false) {
                    ?>
                    <tr>
                        <th>Categories</th>
                        <td>
                            <?php foreach (get_the_terms(get_the_ID(), 'event-category') as $item) { ?>
                                <a href="<?php echo get_term_link($item->term_id); ?>"><?php echo $item->name; ?></a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>


            <?php
            the_content();
            ?>


        </div>

        <div class="column medium-5 large-4">
            <?php
            if (has_post_thumbnail()) {
                the_post_thumbnail();
            }
            ?>
        </div>

    </div>

</article>