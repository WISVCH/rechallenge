<?php
// Prep
$job_type_raw = get_terms([
    'taxonomy' => 'job_type',
    'hide_empty' => false,
    'parent' => 0,
]);

$job_type = [];
foreach ($job_type_raw as $item) {
    $job_type[$item->slug] = $item->name;
}

$job_study_raw = get_terms([
    'taxonomy' => 'job_study',
    'hide_empty' => false,
    'parent' => 0,
]);

$job_study = [];
foreach ($job_study_raw as $item) {
    $job_study[$item->slug] = $item->name;
}

$company_type_raw = get_terms([
    'taxonomy' => 'company_offerings',
    'hide_empty' => false,
    'parent' => 0,
]);

$company_type = [];
foreach ($company_type_raw as $item) {
    $company_type[$item->slug] = $item->name;
}

$company_study_raw = get_terms([
    'taxonomy' => 'company_study',
    'hide_empty' => false,
    'parent' => 0,
]);

$company_study = [];
foreach ($company_study_raw as $item) {
    $company_study[$item->slug] = $item->name;
}

// Merge
$types = array_unique(array_merge($job_type, $company_type));
$studies = array_unique(array_merge($job_study, $company_study));
?>

<!-- Selector -->
<section class="wisv-panel">

    <div class="wisv-panel-content">

        <form id="careerSelector">

            <label for="cs_type">I'm looking for a
                <select id="cs_type" name="filter_type">
                    <option value="">- All -</option>
                    <?php foreach ($types as $t_id => $type) { ?>
                        <option value="<?=esc_attr($t_id)?>"><?=esc_html($type)?></option>
                    <?php } ?>
                </select>
            </label>

            <label for="cs_study">Study
                <select id="cs_study" name="filter_study">
                    <option value="">- All -</option>
                    <?php foreach ($studies as $s_id => $study) { ?>
                        <option value="<?=esc_attr($s_id)?>"><?=esc_html($study)?></option>
                    <?php } ?>
                </select>
            </label>

            <div class="expanded small button-group">
                <button formaction="/career/companies" type="submit" class="button alert" id="findCompanies">Find companies</button>
                <button formaction="/career/job-openings" type="submit" class="button alert" id="findJobOpenings">Find job openings</button>
            </div>

        </form>

    </div>
</section>
