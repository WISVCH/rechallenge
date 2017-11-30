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
            },
            image: {
                titleSrc: function (item) {
                    var p = item.el.parent();
                    if (p.is('figure')) {
                        var cap = p.find('figcaption').text();
                    } else {
                        var cap = item.el.find('img').attr('alt');
                    }
                    return cap ? cap : '';
                }
            },
            callbacks: {
                beforeOpen: function () {
                    this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
                    this.st.mainClass = 'mfp-zoom-in';
                },
                change: function () {
                    var t = this.content.find('.mfp-title');
                    if (t) {
                        if (t.text() == "") {
                            t.addClass('nobg');
                        } else {
                            t.removeClass('nobg');
                        }
                    }
                }
            }
        });
    });

    $('.post-content').find('a[href$=".png"], a[href$=".jpg"], a[href$=".jpeg"], a[href$=".gif"]').each(function () {

        $(this).magnificPopup({
            type: 'image',
            image: {
                titleSrc: function (item) {
                    var p = item.el.parent();
                    return p.is('figure') ? p.find('figcaption').text() : item.el.find('img').attr('alt');
                }
            },
            callbacks: {
                beforeOpen: function () {
                    this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
                    this.st.mainClass = 'mfp-zoom-in';
                },
                change: function () {
                    var t = this.content.find('.mfp-title');
                    if (t) {
                        if (t.text() == "") {
                            t.addClass('nobg');
                        } else {
                            t.removeClass('nobg');
                        }
                    }
                }
            }
        });
    });


    /* EVENTS */

    var updateCurrentEventFilter = function (cal) {
        var currentFilter = [];
        $("#event-filter-dropdown input:checkbox:checked").each(function () {
            currentFilter.push($(this).data('slug'));
        });
        cal.data('currentFilter', currentFilter);
    };

    if ($.fullCalendar) {

        // Load large calendar
        var cal = $('#calendar').fullCalendar({
            firstDay: 1,
            height: "auto",

            defaultView: Foundation.MediaQuery.atLeast('large') ? 'month' : 'listMonth',

            customButtons: {
                filterButton: {
                    text: "Filter",
                }
            },

            header: {
                left: 'title',
                center: '',
                right: 'filterButton today prev, next'
            },

            events: {
                url: '/wp-json/wp/v2/events/fullcalendar'
            },

            timeFormat: 'H:mm',
            displayEventEnd: true,

            handleWindowResize: false,

            viewRender: function () {
                if (typeof $('.fc-filterButton-button').attr('data-toggle') == 'undefined') {
                    $('.fc-filterButton-button').attr('data-toggle', 'event-filter-dropdown');
                    new Foundation.Dropdown($("#event-filter-dropdown"));
                }

                updateCurrentEventFilter($('#calendar'));
            },

            eventRender: function (event) {

                // Filter events
                if (event.categories) {

                    var currentFilter = $('#calendar').data('currentFilter');
                    if ($(event.categories).filter(currentFilter).length <= 0) {
                        return false;
                    }
                }

            },

            eventAfterRender: function (event, $el) {

                // Lower opacity of events in next month
                if (event.start.isAfter(cal.fullCalendar('getView').intervalEnd)) {
                    $el.addClass('next-month');
                }

                // Add category colors
                if (event.primary_category) {
                    $el.addClass("cat-" + event.primary_category);
                } else if (event.categories) {
                    $el.addClass("cat-" + event.categories[0]);
                }

                // Fix multi-day event start and end times
                if (!event.start.isSame(event.end, 'day')) {
                    $el.find('.fc-time').html(event.start.format("H:mm"));
                }
            }

        }).on('click tap', '.fc-button', function () {
            // Lose focus..
            $(this).blur();
        });

        updateCurrentEventFilter(cal);

        // Change view on media query change
        $(window).on('changed.zf.mediaquery', function () {
            if (Foundation.MediaQuery.atLeast('large')) {
                cal.fullCalendar('changeView', 'month');
            } else {
                cal.fullCalendar('changeView', 'listMonth');
            }
        });

        // Update events on filter change
        $('#event-filter-dropdown input:checkbox').on('change', function () {
            updateCurrentEventFilter(cal);
            cal.fullCalendar('rerenderEvents');
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
