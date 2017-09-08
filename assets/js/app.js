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

    /* CHOICE */

    var blueprintItem = "<li class='accordion-item' data-accordion-item><a href='#' class='accordion-title clearfix'>{% courseName %}</a><div class='accordion-content' data-tab-content style='display: none;'><h4>Exams</h4><table><thead><tr><th width='150px'>Course Code</th><th>Exam</th><th width='150px'>Answers</th><th width='50px'></th></tr></thead><tbody>{% content %}</tbody></table></div></li>";

    var blueprintRow = "<tr><td>{% courseCode %}</td><td>{% name %}</td><td><span class='ch-{% answers %}'></span></td><td><a target='_blank' href='http://localhost:8080/choice/api/v1/document/{% documentId %}' class='button tiny'><span class='ch-file-o'></span></a></td></tr>";
    var blueprintRowNoResult = "<tr><td colspan='4'>No exams available yet!</td></tr>";

    $("#searchQuery").on('keyup', function () {
        searchCourses();
    });

    $("#searchStudy, #searchProgram").on('change', function () {
        searchCourses();
    });

    function searchCourses() {
        $("#choice-accordion").html("").removeData('zfPlugin');

        $.ajax({
            url: "http://localhost:8080/choice/api/v1/course/active/search",
            data: {
                study: $("#searchStudy").val(),
                program: $("#searchProgram").val(),
                query: $("#searchQuery").val()
            },
            async: false,
            dataType: "json",
            success: function (data) {
                handleGetCourses(data);
            }
        });

        $(document).foundation();
    }


    function handleGetCourses(data) {
        $.each(data.content, function (i, course) {
            var courseName = course.code + " " + course.name;
            var courseHtml = blueprintItem.split("{% courseName %}").join(courseName);

            var rows = getCourseExams(course);
            courseHtml = courseHtml.split("{% content %}").join(rows);

            $("#choice-accordion").append(courseHtml);
        });
    }

    $.ajax({
        url: "http://localhost:8080/choice/api/v1/course/active",
        async: false,
        dataType: "json",
        success: function (data) {
            handleGetCourses(data);
        }
    });

    function handleGetCourseExamResponse(data) {
        var rows = "";
        if (data.content.length > 0) {
            $.each(data.content, function (i, exam) {
                var row = blueprintRow.split("{% courseCode %}").join(exam.course.code);

                var month = exam.date.month.toLowerCase().replace(/\b[a-z]/g, function (letter) {
                    return letter.toUpperCase();
                });

                var name = exam.name + " " + month + " " + exam.date.dayOfMonth + ", " + exam.date.year;
                row = row.split("{% name %}").join(name);
                row = row.split("{% documentId %}").join(exam.document.id);
                row = row.split("{% answers %}").join(exam.includingAnswers ? 'check' : 'ban');

                rows += row
            });
        } else {
            rows = blueprintRowNoResult;
        }
        return rows;
    }

    function getCourseExams(course) {
        var rows = "";
        $.ajax({
            url: "http://localhost:8080/choice/api/v1/exam/course/" + course.code + "/including",
            async: false,
            dataType: "json",
            success: function (data) {
                rows = handleGetCourseExamResponse(data);
            }
        });
        return rows;
    }
});
