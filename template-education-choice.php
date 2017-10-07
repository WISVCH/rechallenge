<?php
/* Template Name: CHoice */
get_header();

get_template_part("parts/navigation/breadcrumb");
?>

    <main>

        <div class="row column column-block">
            <?php the_content(); ?>
        </div>

        <div class="row">
            <div class="column">
                <div class="row collapse">
                    <div class="choice-search clearfix">
                        <div class="small-6 column">
                            <label>Study
                                <select id="searchStudy">
                                    <option value="">-- Select a study --</option>
                                    <option value="AM">Applied Mathematics</option>
                                    <option value="CS">Computer Science</option>
                                </select>
                            </label>
                        </div>
                        <div class="small-6 column">
                            <form>
                                <label>Study program
                                    <select id="searchProgram">
                                        <option value="">-- Select a study program --</option>
                                        <option value="FIRST_YEAR">First year</option>
                                        <option value="SECOND_YEAR">Second year</option>
                                        <option value="THIRD_YEAR">Third year</option>
                                        <option value="MASTER">Master</option>
                                    </select>
                                </label>
                            </form>
                        </div>

                        <div class="small-12 column">
                            <label> Search
                                <input type="text" placeholder="Start typing to search for a course..." id="searchQuery">
                            </label>
                        </div>
                    </div>
                </div>

                <ul id="choice-accordion" class="accordion choice-accordion" data-accordion data-multi-expand="true"
                    data-allow-all-closed="true">
                    <li class="accordion-item" data-accordion-item><a href="#" class="accordion-title clearfix">Loading courses.....</a></li>
                </ul>
            </div>
        </div>


    </main>

<?php
get_footer();
