<?php
/* Check if Profile class exists.
 * Since this template is loaded via the WISVCH plug-in, this should always be the case,
 * but everything crashes if this class is not available, so check anyway.
 */
if (!class_exists("WISVCH\\Portal\\Shortcodes\\Profile")) {
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

            <h2>Edit Profile <a class="float-right button small secondary" href="<?= site_url('/password') ?>">Change password</a></h2>
            <p>This is your personal information as currently known by the study association. Please update where necessary.</p>

            <form action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" method="post" class="edit-profile-form">

                <?php wp_nonce_field('wisvch_portal_edit-profile'); ?>

                <div class="row">
                    <div class="small-12 columns">
                        <h3>Personal Information</h3>
                    </div>
                </div>
                <!-- Full Name -->
                <div class="row">
                    <div class="small-12 medium-3 columns">
                        <label for="user_fullname" class="middle">Full Name</label>
                    </div>
                    <div class="small-12 medium-9 columns">
                        <input type="text" id="user_fullname" name="user_fullname" value="<?php Profile::ch('formatted_name', $ch_dienst2); ?>" placeholder="Full Name" disabled>
                    </div>
                </div>

                <!-- Gender -->
                <div class="row">
                    <div class="small-12 medium-3 columns">
                        <label for="male">Gender</label>
                    </div>
                    <div class="small-12 medium-9 columns">
                        <label for="male" class="inline"><input type="radio" name="user_gender" id="male" value="male" disabled <?php checked(Profile::ch('gender', $ch_dienst2, false), 'M'); ?>> Male</label>
                        <label for="female" class="inline"><input type="radio" name="user_gender" id="female" value="female" disabled <?php checked(Profile::ch('gender', $ch_dienst2, false), 'F'); ?>> Female</label>
                        <label for="female" class="inline"><input type="radio" name="user_gender" id="other" value="other" disabled <?php checked(Profile::ch('gender', $ch_dienst2, false), 'O'); ?>> Other</label>
                        <small>If you wish to communicate a gender change please contact the secretary.</small>
                    </div>
                </div>

                <!-- Pronouns -->
                <div class="row">
                    <div class="small-12 medium-3 columns">
                        <label for="user_pronouns" class="middle">Pronouns</label>
                    </div>
                    <div class="small-12 medium-9 columns">
                        <input required type="text" name="user_pronouns" id="user_pronouns" value="<?php Profile::ch('pronouns', $ch_dienst2); ?>" placeholder="Pronouns">
                    </div>
                </div>

                <!-- Birthdate -->
                <div class="row">
                    <div class="small-12 medium-3 columns">
                        <label for="user_birthdate" class="middle">Birthdate</label>
                    </div>
                    <div class="small-12 medium-9 columns">
                        <input type="text" name="user_birthdate" id="user_birthdate" value="<?php echo date_i18n("d - m - Y", strtotime(Profile::ch('birthdate', $ch_dienst2, false))); ?>" placeholder="DD - MM - YYYY" disabled>
                    </div>
                </div>

                <!-- Email Address -->
                <div class="row">
                    <div class="small-12 medium-3 columns">
                        <label for="user_email" class="middle">Email Address</label>
                    </div>
                    <div class="small-12 medium-9 columns">
                        <input required type="text" name="user_email" id="user_email" value="<?php Profile::ch('email', $ch_dienst2); ?>" placeholder="Email Address">
                    </div>
                </div>

                <!-- Phone Number -->
                <div class="row">
                    <div class="small-12 medium-3 columns">
                        <label for="user_phone_mobile" class="middle">Phone Number</label>
                    </div>
                    <div class="small-12 medium-9 columns">
                        <input required type="text" name="user_phone_mobile" id="user_phone_mobile" value="<?php Profile::ch('phone_mobile', $ch_dienst2); ?>" placeholder="Phone Number">
                    </div>
                </div>

                <!-- Address -->
                <div class="row">
                    <div class="small-12 medium-3 columns">
                        <label for="user_street_name" class="middle">Address</label>
                    </div>
                    <div class="small-12 medium-9 columns">
                        <div class="row">
                            <div class="small-12 medium-8 columns">
                                <input required type="text" name="user_street_name" id="user_street_name" value="<?php Profile::ch('street_name', $ch_dienst2); ?>" placeholder="Street">
                            </div>
                            <div class="small-12 medium-4 columns">
                                <input required type="text" name="user_house_number" id="user_house_number" value="<?php Profile::ch('house_number', $ch_dienst2); ?>" placeholder="House Number">
                            </div>
                        </div>
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
                                <input required type="text" name="user_postcode" id="user_postcode" value="<?php Profile::ch('postcode', $ch_dienst2); ?>" placeholder="Postal Code">
                            </div>
                            <div class="small-5 medium-7 columns">
                                <input required type="text" name="user_city" id="user_city" value="<?php Profile::ch('city', $ch_dienst2); ?>" placeholder="City">
                            </div>
                            <div class="small-2 medium-2 columns">
                                <input required type="text" name="user_country" id="user_country" maxlength="2" value="<?php Profile::ch('country', $ch_dienst2); ?>" placeholder="Country">
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
                        </div>
                        <div class="row">
                            <div class="small-12 medium-6 columns">
                                <input type="text" name="user_study" id="user_study" value="<?php Profile::ch(['student', 'study'], $ch_dienst2); ?>" placeholder="Study" disabled>
                            </div>
                            <div class="small-6 medium-3 columns">
                                <input type="text" name="user_studentno" id="user_studentno" value="<?php Profile::ch(['student', 'student_number'], $ch_dienst2); ?>" placeholder="Student Number" disabled>
                            </div>
                            <div class="small-6 medium-3 columns">
                                <input type="text" name="user_netid" id="user_netid" value="<?php Profile::ch('netid', $ch_dienst2); ?>" placeholder="NetID" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="small-12 columns">
                        <h3>E-mail and Post subscriptions</h3>
                        <p>Choose which e-mail announcements and post you want to receive from us.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="small-12 columns">
                        <label for="user_machazine">
                            <input type="checkbox" name="user_machazine" id="user_machazine" value="1" <?= Profile::ch('machazine', $ch_dienst2, false) ? 'checked' : '' ?>>
                            MaCHazine (Printed magazine, sent to your home address)
                        </label>
                    </div>
                    <!-- mail announcements -->
                    <div class="small-12 columns">
                        <label for="user_mail_announcements">
                            <input type="checkbox" name="user_mail_announcements" id="user_mail_announcements" value="1" <?= Profile::ch('mail_announcements', $ch_dienst2, false) ? 'checked' : '' ?>>
                            General Announcements (E-mail)
                        </label>
                    </div>
                    <!-- mail company -->
                    <div class="small-12 columns">
                        <label for="user_mail_company">
                            <input type="checkbox" name="user_mail_company" id="user_mail_company" value="1" <?= Profile::ch('mail_company', $ch_dienst2, false) ? 'checked' : '' ?>>
                            Company Mailings (E-mail)
                        </label>
                    </div>
                    <!-- mail education -->
                    <div class="small-12 columns">
                        <label for="user_mail_education">
                            <input type="checkbox" name="user_mail_education" id="user_mail_education" value="1" <?= Profile::ch('mail_education', $ch_dienst2, false) ? 'checked' : '' ?>>
                            Education Mailings (E-mail)
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="small-12 medium-3 columns show-for-medium">
                        &nbsp;
                    </div>
                    <div class="small-12 medium-7 columns">
                        <input type="submit" class="button small" name="user_editprofile_submit" value="Submit changes">
                    </div>
                </div>
            </form>

        <?php } ?>

    </div>
    <?php include('sidebar.php'); ?>

</div>