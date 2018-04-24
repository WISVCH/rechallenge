var Events;

(function ($) {

    Events = {

        init: function () {

            Events.settings = {
                calendar: $('#calendar')
            };

            if ($.fullCalendar) {
                Events.initCalendar();
                Events.binds();
            }
        },

        binds: function () {

            Events.settings.calendar.on('click tap', '.fc-button', function () {
                $(this).blur();
            });

            // Update events on filter change
            $('#event-filter-dropdown').find('input:checkbox').on('change', function () {
                Events.updateCurrentEventFilter();
                Events.settings.calendar.fullCalendar('rerenderEvents');
            });

            // Change view on media query change
            $(window).on('changed.zf.mediaquery', function () {
                if (Foundation.MediaQuery.atLeast('large')) {
                    Events.settings.calendar.fullCalendar('changeView', 'month');
                } else {
                    Events.settings.calendar.fullCalendar('changeView', 'listMonth');
                }
            });
        },

        initCalendar: function () {

            // Load large calendar
            Events.settings.calendar.fullCalendar({
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

                viewRender: Events.customViewRender,
                eventRender: Events.customEventRender,
                eventAfterRender: Events.customEventAfterRender

            });

        },

        updateCurrentEventFilter: function () {
            var currentFilter = [];
            $("#event-filter-dropdown input:checkbox:checked").each(function () {
                currentFilter.push($(this).data('slug'));
            });
            Events.settings.calendar.data('currentFilter', currentFilter);
        },

        customViewRender: function () {
            if (typeof $('.fc-filterButton-button').attr('data-toggle') == 'undefined') {
                $('.fc-filterButton-button').attr('data-toggle', 'event-filter-dropdown');
                new Foundation.Dropdown($("#event-filter-dropdown"));
            }

            Events.updateCurrentEventFilter();
        },

        customEventRender: function (event) {

            // Filter events
            if (event.categories) {
                var currentFilter = Events.settings.calendar.data('currentFilter');
                if ($(event.categories).filter(currentFilter).length <= 0) {
                    return false;
                }
            }

        },

        customEventAfterRender: function (event, $el) {

            // Lower opacity of events in next month
            if (event.start.isAfter(Events.settings.calendar.fullCalendar('getView').intervalEnd)) {
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

    }

})(jQuery);
