var Portal;

(function ($) {

    Portal = {

        init: function () {

            Portal.settings = {
                edit_form: $("form.edit-profile-form")
            };

            Portal.initPortalEditForm();
        },

        initPortalEditForm: function () {

            if (Portal.settings.edit_form.length > 0) {
                Portal.settings.edit_form.find(":input:not(:submit):not(:hidden)").prop('readonly', true);

                Portal.editFormBinds();
            }
        },

        editFormBinds: function () {

            Portal.settings.edit_form.on('focus', 'input[readonly]', function () {

                // Remove readonly attribute
                $(this).prop('readonly', false);

                // Store original value
                $(this).data("val-original", $(this).val());


            }).on('blur', ':input:not(:submit)', function () {

                // Reset readonly status if nothing has changed
                if ($(this).val() == $(this).data('val-original')) {
                    $(this).prop('readonly', true);
                }

            }).on('submit', function () {

                // Replace readonly with disabled, so only changed inputs are submitted
                $(this).find('input[readonly]').prop('readonly', false).prop('disabled', true);

            });

        }

    }

})(jQuery);
