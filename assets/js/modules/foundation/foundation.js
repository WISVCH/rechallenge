var FoundationOverrides;

(function ($) {

    FoundationOverrides = {

        init: function () {
            FoundationOverrides.initFoundation();
            FoundationOverrides.binds();
        },

        initFoundation: function () {

            // Initialize Foundation
            Foundation.Orbit.defaults.navButtons = false;

            $(document).foundation();

        },

        binds: function () {

            // Don't follow links with data-open attribute
            $("a[data-open]").on('click tap', function (e) {
                e.preventDefault();
            });

            // Add class to body when menu open, for styling purposes
            $('[data-responsive-toggle]').on('toggled.zf.responsiveToggle', function () {
                var body = $("body"), button = $('.wisv-menu-icon');

                if (body.hasClass("menu-open")) {
                    body.removeClass("menu-open");
                    button.removeClass('is-active');
                } else {
                    body.addClass("menu-open");
                    button.addClass('is-active');
                }

            });
        }

    }

})(jQuery);
