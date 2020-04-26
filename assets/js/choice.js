var CHoice;

(function ($) {

    CHoice = {

        init: function (settings) {

            CHoice.url = window.choice_url;

            CHoice.settings = {
                blueprintItem: "<li class='accordion-item' data-accordion-item><a href='#' class='accordion-title clearfix'>{% courseName %}</a><div class='accordion-content'" +
                    " data-tab-content style='display: none;'><h4>Exams/Summaries</h4><table cellspacing='0'><thead><tr><th width='150px'>Course Code</th><th>Exam</th><th" +
                    " width='150px'>Answers</th><th width='50px'></th></tr></thead><tbody>{% content %}</tbody></table></li>",
                blueprintItemNoResult: "<li class='accordion-item' data-accordion-item><a href='#' class='accordion-title" +
                    " clearfix'>No courses found that match your search criteria.</li>",
                blueprintRow: "<tr><td>{% courseCode %}</td><td>{% name %}</td><td><span class='ch-{% answers %}'></span></td><td>" +
                    "<a target='_blank' href='" + CHoice.url + "document/exam/{% documentId %}' class='button tiny'><span class='ch-file-o'></span></a></td></tr>",
                blueprintRowNoResult: "<tr><td colspan='4'>No exams available yet.</td></tr>"
            };

            // Initialize CHoice
            CHoice.initChoice();

            // Add DOM binds
            CHoice.binds();
        },

        binds: function () {

            $("#searchQuery").on('keyup', CHoice._debounce(CHoice.searchCourses, 250));
            $("#searchStudy, #searchProgram").on('change', CHoice._debounce(CHoice.searchCourses, 250));

        },

        initChoice: function () {

            $.ajax({
                url: CHoice.url + "course/active",
                async: false,
                dataType: "json",
                success: function (data) {
                    CHoice.handleGetCourses(data);
                }
            });

        },

        searchCourses: function () {

            $.ajax({
                url: CHoice.url + "course/active/search",
                data: {
                    study: $("#searchStudy").val(),
                    program: $("#searchProgram").val(),
                    query: $("#searchQuery").val()
                },
                async: false,
                dataType: "json",
                success: function (data) {
                    CHoice.handleGetCourses(data);
                }
            });

        },

        handleGetCourses: function (data) {

            $("#choice-accordion").empty();

            if (data.content.length > 0) {

                $.each(data.content, function (i, course) {

                    var courseName = course.code + " " + course.name,
                        courseHtml = CHoice.settings.blueprintItem.split("{% courseName %}").join(courseName),
                        rows = CHoice.handleGetCourseExamResponse(course.exam);

                    courseHtml = courseHtml.split("{% content %}").join(rows);

                    $("#choice-accordion").append(courseHtml);
                });

            } else {
                $("#choice-accordion").append(CHoice.settings.blueprintItemNoResult);
            }

            Foundation.reInit($('#choice-accordion'));
        },

        handleGetCourseExamResponse: function (data) {
            var rows = "";
            const months = [January, February, March, April, May, June, Juli, August, September, October, November, December]

            if (data.length > 0) {
                $.each(data, function (i, exam) {
                    var row = CHoice.settings.blueprintRow.split("{% courseCode %}").join(exam.course.code);
                    exam.date = LocalDate.parse(exam.date)

                    var month = months[(parseInt(exam.date.split('-')[1]) - 1)]

                    var name = exam.name + " " + month + " " + exam.date.split('-')[0] + ", " + exam.date.split('-')[2];
                    row = row.split("{% name %}").join(name);
                    row = row.split("{% documentId %}").join(exam.id);
                    row = row.split("{% answers %}").join(exam.includingAnswers ? 'check' : 'ban');

                    rows += row
                });
            } else {
                rows = CHoice.settings.blueprintRowNoResult;
            }

            return rows;
        },

        // Source: https://davidwalsh.name/javascript-debounce-function
        _debounce: function (func, wait, immediate) {
            var timeout;
            return function () {
                var context = this, args = arguments;
                var later = function () {
                    timeout = null;
                    if (!immediate) func.apply(context, args);
                };
                var callNow = immediate && !timeout;
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
                if (callNow) func.apply(context, args);
            };
        }

    }

})(jQuery);
