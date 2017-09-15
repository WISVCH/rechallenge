<?php
/* Check if Profile class exists.
 * Since this template is loaded via the WISVCH plug-in, this should always be the case,
 * but everything crashes if this class is not available, so check anyway.
 */
if (! class_exists("WISVCH\\Portal\\Shortcodes\\Profile")) {
    return;
}

use WISVCH\Portal\Shortcodes\Profile;

?>

<div class="row collapse">
    <div class="small-12 column">

        <?php
        // @TODO linken werkt niet, je logt dan gewoon in met een (ander) CH account. Is misschien ook niet zo erg.

        // Check if CH connected
        if ($ch_member === false) { ?>

            <h2>Link Profile</h2>
            <p>Your account has not been linked to a CH Connect profile (yet). Please link your account using the following button:</p>

            <div class="openid-button-left">
                <?php echo do_shortcode("[openid_connect_generic_login_button]"); ?>
            </div>

        <?php } else { ?>

            <h2>Edit Profile</h2>
            <p>This is your personal information as currently known by the study association. Please update where necessary.</p>

            <form action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" method="post" class="edit-profile-form">

                <?php wp_nonce_field('wisvch_portal_edit-profile'); ?>

                <!-- Full Name -->
                <div class="row">
                    <div class="small-12 medium-3 columns">
                        <label for="user_name" class="middle">Full Name</label>
                    </div>
                    <div class="small-12 medium-9 columns">
                        <input required type="text" id="user_name" name="user_name" value="<?php Profile::ch('name', $ch_connect); ?>" placeholder="Full Name">
                    </div>
                </div>

                <!-- Given Name -->
                <div class="row">
                    <div class="small-12 medium-3 columns">
                        <label for="user_given_name" class="middle">Given name</label>
                    </div>
                    <div class="small-12 medium-9 columns">
                        <input required type="text" name="user_given_name" id="user_given_name" value="<?php Profile::ch('given_name', $ch_connect); ?>"
                               placeholder="Given Name">
                    </div>
                </div>

                <!-- Gender -->
                <div class="row">
                    <div class="small-12 medium-3 columns">
                        <label for="male">Gender</label>
                    </div>
                    <div class="small-12 medium-9 columns">
                        <label for="male" class="inline"><input type="radio" name="user_gender" id="male" value="male" disabled
                                <?php checked(Profile::ch('gender', $ch_connect, false), 'male'); ?>> Male</label>
                        <label for="female" class="inline"><input type="radio" name="user_gender" id="female" value="female" disabled
                                <?php checked(Profile::ch('gender', $ch_connect, false), 'female'); ?>> Female</label>
                    </div>
                </div>

                <!-- Birthdate -->
                <div class="row">
                    <div class="small-12 medium-3 columns">
                        <label for="user_birthdate" class="middle">Birthdate</label>
                    </div>
                    <div class="small-12 medium-9 columns">
                        <input required type="text" name="user_birthdate" id="user_birthdate"
                               value="<?php echo date_i18n("d - m - Y", strtotime(Profile::ch('birthdate', $ch_connect, false))); ?>" placeholder="DD - MM - YYYY">
                    </div>
                </div>

                <!-- Email Address -->
                <div class="row">
                    <div class="small-12 medium-3 columns">
                        <label for="user_email" class="middle">Email Address</label>
                    </div>
                    <div class="small-12 medium-9 columns">
                        <input required type="text" name="user_email" id="user_email" value="<?php Profile::ch('email', $ch_connect); ?>" placeholder="Email Address">
                    </div>
                </div>

                <!-- Phone Number -->
                <div class="row">
                    <div class="small-12 medium-3 columns">
                        <label for="user_phone" class="middle">Phone Number</label>
                    </div>
                    <div class="small-12 medium-9 columns">
                        <input required type="text" name="user_phone" id="user_phone" value="<?php Profile::ch('phone_number', $ch_connect); ?>"
                               placeholder="Phone Number">
                    </div>
                </div>

                <!-- Address -->
                <div class="row">
                    <div class="small-12 medium-3 columns">
                        <label for="user_street_address" class="middle">Address</label>
                    </div>
                    <div class="small-12 medium-9 columns">
                        <input required type="text" name="user_street_address" id="user_street_address"
                               value="<?php Profile::ch(['address', 'street_address'], $ch_connect); ?>" placeholder="Street Name + Number">
                    </div>
                </div>

                <!-- ZIP, City -->
                <div class="row">
                    <div class="small-12 medium-3 columns show-for-medium">
                        &nbsp;
                    </div>
                    <div class="small-12 medium-9 columns">
                        <div class="row">
                            <div class="small-5 medium-3 columns">
                                <input required type="text" name="user_zip" id="user_zip" value="<?php Profile::ch(['address', 'postal_code'], $ch_connect); ?>"
                                       placeholder="Postal Code">
                            </div>
                            <div class="small-5 medium-7 columns">
                                <input required type="text" name="user_city" id="user_city" value="<?php Profile::ch(['address', 'locality'], $ch_connect); ?>"
                                       placeholder="City">
                            </div>
                            <div class="small-2 medium-2 columns">
                                <input required type="text" name="user_country" id="user_country" maxlength="2" value="<?php Profile::ch(['address', 'country'], $ch_connect); ?>"
                                       placeholder="Country">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Student Number, NetID -->
                <div class="row">
                    <div class="small-12 medium-3 columns">
                        <label for="user_studentno" class="middle">Student details</label>
                    </div>
                    <div class="small-12 medium-9 columns">
                        <div class="row">
                            <div class="small-6 columns">
                                <input required type="text" name="user_studentno" id="user_studentno" value="<?php Profile::ch('student_number', $ch_connect); ?>"
                                       placeholder="Student Number">
                            </div>
                            <div class="small-6 columns">
                                <input required type="text" name="user_netid" id="user_netid" value="<?php Profile::ch('netid', $ch_connect); ?>"
                                       placeholder="NetID">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="small-12 medium-2 columns show-for-medium">
                        &nbsp;
                    </div>
                    <div class="small-12 medium-9 columns">
                        <input type="submit" class="button small" name="user_editprofile_submit" value="Submit changes">
                    </div>
                </div>


            </form>

        <?php } ?>

    </div>
    <?php include('sidebar.php'); ?>

</div>
