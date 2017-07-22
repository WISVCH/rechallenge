;jQuery(function ($) {

    // Init Foundation JS
    Foundation.Orbit.defaults.navButtons = false;
    $(document).foundation();

    // Don't follow links with data-open attribute
    $("a[data-open]").on('click tap', function (e) {
        e.preventDefault();
    });

    // Add class to body when menu open, for styling purposes
    $('[data-responsive-toggle]').on('toggled.zf.responsiveToggle', function (e, b, c) {
        var body = $("body"), button = $('.wisv-menu-icon');

        if (body.hasClass("menu-open")) {
            body.removeClass("menu-open");
            button.removeClass('is-active');
        } else {
            body.addClass("menu-open");
            button.addClass('is-active');
        }

    });

    /* IMAGE GALLERIES */
    $('.inline-gallery').each(function () {
        $(this).magnificPopup({
            delegate: 'a.gallery-image',
            type: 'image',
            gallery: {
                enabled: true
            }
        });
    });

    /* EVENTS */
    if ($.fullCalendar) {

        // Load large calendar
        var cal = $('#calendar').fullCalendar({
            firstDay: 1,
            height: "auto",

            defaultView: Foundation.MediaQuery.atLeast('large') ? 'month' : 'listMonth',

            header: {
                left: 'title',
                center: '',
                right: 'today prev, next'
            },

            events: {
                url: '/wp-json/wp/v2/events/fullcalendar'
            },

            timeFormat: 'H:mm',
            displayEventEnd: true,

            handleWindowResize: false,

            // Fix multi-day event start and end times
            eventAfterRender: function (event, $el) {
                if (!event.start.isSame(event.end, 'day')) {
                    $el.find('.fc-time').html(event.start.format("H:mm"));
                }
            }
        }).on('click tap', '.fc-button', function (e) {
            // Lose focus..
            $(this).blur();
        });

        // Change view on media query change
        $(window).on('changed.zf.mediaquery', function () {
            if (Foundation.MediaQuery.atLeast('large')) {
                cal.fullCalendar('changeView', 'month');
            } else {
                cal.fullCalendar('changeView', 'listMonth');
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
