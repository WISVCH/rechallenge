Foundation.Orbit.defaults.navButtons = false;


// @TODO: only use Foundation plug-ins actually in use
jQuery(document).foundation();


jQuery(function ($) {

    $("a[data-open]").on('click tap', function (e) {
        e.preventDefault();
    })


    // Add readonly attribute to profile fields on load
    $("form.edit-profile-form :input:not(:submit)").prop('readonly', true);

    // Add listeners
    $("form.edit-profile-form").on('focus', 'input[readonly]', function () {

        // Remove readonly attribute
        $(this).prop('readonly', false);

        // Store original value
        $(this).data("val-original", $(this).val());


    }).on('blur', ':input:not(:submit)', function () {

        // Reset readonly status if nothing has changed
        if ($(this).val() == $(this).data('val-original')) {
            $(this).prop('readonly', true);
        }

    }).on('submit', function (e) {

        // Replace readonly with disabled, so only changed inputs are submitted
        $(this).find('input[readonly]').prop('readonly', false).prop('disabled', true);

    });

})