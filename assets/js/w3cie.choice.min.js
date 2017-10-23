jQuery(function ($) {

    /* CHOICE */
    var choiceUrl = "https://choice.w3cie.k8s.chnet/api/v1/";

    var blueprintItem = "<li class='accordion-item' data-accordion-item><a href='#' class='accordion-title clearfix'>{% courseName %}</a><div class='accordion-content'" +
        " data-tab-content style='display: none;'><h4>Exams/Summaries</h4><table cellspacing='0'><thead><tr><th width='150px'>Course Code</th><th>Exam</th><th" +
        " width='150px'>Answers</th><th width='50px'></th></tr></thead><tbody>{% content %}</tbody></table></li>";
    var blueprintItemNoResult = "<li class='accordion-item' data-accordion-item><a href='#' class='accordion-title" +
        " clearfix'>No course found that match your search criteria!</li>";

    var blueprintRow = "<tr><td>{% courseCode %}</td><td>{% name %}</td><td><span class='ch-{% answers %}'></span></td><td><a target='_blank' href='" + choiceUrl + "document/exam/{% documentId %}' class='button tiny'><span class='ch-file-o'></span></a></td></tr>";
    var blueprintRowNoResult = "<tr><td colspan='4'>No exams available yet!</td></tr>";

    $("#searchQuery").on('keyup', function () {
        searchCourses();
    });

    $("#searchStudy, #searchProgram").on('change', function () {
        searchCourses();
    });

    function choiceInit() {
        $.ajax({
            url: choiceUrl + "course/active",
            async: false,
            dataType: "json",
            success: function (data) {
                $("#choice-accordion").html("").removeData('zfPlugin');

                handleGetCourses(data);
            }
        });

        $(document).foundation();
    }

    function searchCourses() {
        $("#choice-accordion").html("").removeData('zfPlugin');

        $.ajax({
            url: choiceUrl + "course/active/search",
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
        if (data.content.length > 0) {
            $.each(data.content, function (i, course) {
                var courseName = course.code + " " + course.name;
                var courseHtml = blueprintItem.split("{% courseName %}").join(courseName);

                var rows = getCourseExams(course);
                courseHtml = courseHtml.split("{% content %}").join(rows);

                $("#choice-accordion").append(courseHtml);
            });
        } else {
            $("#choice-accordion").append(blueprintItemNoResult);
        }
    }

    function getCourseExams(course) {
        var rows = "";

        $.ajax({
            url: choiceUrl + "exam/course/" + course.code + "/including",
            async: false,
            dataType: "json",
            success: function (data) {
                rows = handleGetCourseExamResponse(data);
            }
        });

        return rows;
    }

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
                row = row.split("{% documentId %}").join(exam.id);
                row = row.split("{% answers %}").join(exam.includingAnswers ? 'check' : 'ban');

                rows += row
            });
        } else {
            rows = blueprintRowNoResult;
        }
        return rows;
    }

    choiceInit();

});
