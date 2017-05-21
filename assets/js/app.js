;

Foundation.Orbit.defaults.navButtons = false;
jQuery(document).foundation();


jQuery(function ($) {

    // Don't follow links with data-open attribute
    $("a[data-open]").on('click tap', function (e) {
        e.preventDefault();
    })

    // Add class to body when menu open, for styling purposes
    $('[data-responsive-toggle]').on('toggled.zf.responsiveToggle', function (e, b, c) {
        var body = $("body");

        if (body.hasClass("menu-open")) {
            body.removeClass("menu-open");
        } else {
            body.addClass("menu-open");
        }

    });

    /* EVENTS */
    if ($.fullCalendar) {
        $('#calendar').fullCalendar({
            firstDay: 1,
            height: "auto",
            events: '/wp-json/w3cie-events/events',

            header: {
                left: 'title',
                center: '',
                right: 'month, basicWeek today prev, next'
            },

            eventRender: function (event, element) {
                if (false === event.allDay) {
                    $(element).find(".fc-content").append("<p class='fc-timestamp'>" + event.timestamp + "</p>");
                }
            }
        });
    }


    /* PORTAL */

    // Add readonly attribute to edit profile fields on load
    $("form.edit-profile-form :input:not(:submit):not(:hidden)").prop('readonly', true);

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

});
