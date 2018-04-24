<?php
/* Template Name: CHoice */
get_header();

get_template_part( "parts/navigation/breadcrumb" );

$choice_url = \ReCHallenge\Settings::get_setting( 'choice_url' );

if ( ! empty( $choice_url ) ) {
	?>
    <script>
        window.choice_url = <?=wp_json_encode( $choice_url )?>;
    </script>
	<?php
}
?>

    <main>

        <div class="row column column-block">
			<?php the_content(); ?>
        </div>

        <div class="row">
            <div id="choiceLogin" class="column">
                <div class="openid-button-left">
                    <div class="openid-connect-login-button" style="margin: 1em 0; text-align: center;">
                        <a class="button button-large" href="<?= $choice_url ?>api/v1/login">Login with CH Connect</a>
                    </div>
                </div>
            </div>
            <div class="column" id="choiceContainer">
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
                                <input type="text" placeholder="Start typing to search for a course..."
                                       id="searchQuery">
                            </label>
                        </div>
                    </div>
                </div>

                <ul id="choice-accordion" class="accordion choice-accordion" data-accordion
                    data-allow-all-closed="true">
                    <li class="accordion-item"><a href="#" class="accordion-title clearfix">Loading courses...</a>
                    </li>
                </ul>
            </div>
        </div>


    </main>

<?php
get_footer();
