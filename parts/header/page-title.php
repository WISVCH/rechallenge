<?php
// If template called without $children variable, empty array fallback
if (! isset($children)) {
    $children = [];
}

// Add dotted border if no sub-nav
$dotted_border = count($children) === 0 ? ' dotted-border' : '';

// Get cover image
$cover_image = rechallenge_get_cover_image();
$cover_image_html = $cover_image !== false ? ' style="background-image:url('.esc_url($cover_image).')"' : '';

// Get title
$title = rechallenge_get_title();
?>

<!-- Page title -->
<div class="page-title<?php echo $dotted_border; ?>"<?php echo $cover_image_html; ?>>
    <?php
    // Collapse if no cover image but has sub menu
    if (count($children) === 0 || $cover_image !== false) {
        ?>
        <div class="row">
            <div class="column">
                <h1><?php echo esc_html($title); ?></h1>
            </div>
        </div>
        <?php
    }
    ?>
</div>
