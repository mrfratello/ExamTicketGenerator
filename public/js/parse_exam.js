var questionTemplate = "<div class=\"questions__item checkbox\">" +
    "<label>" +
        "<input type=\"checkbox\" value=\"{{index}}\"> " +
        "<span class=\"description\">{{description}}</span>" +
    "</label>" +
"</div>";
var questionGroups = [],
    numberGroup = 1;

(function($){
    if (questions) {
        if (questions.length) {
            renderQuestions(questions);
            $("#control_panel").removeClass("hidden");
        } else {
            var errorMessage = $("<div/>");
            errorMessage.addClass("text-danger")
                .html("Не удалось выделить из файла список вопросов");
            $("#questions").append(errorMessage);
        }
    }

    function renderQuestions(list) {
        for (var i = 0; i < list.length; i++) {
            var questionEl = questionTemplate.replace("{{index}}", i)
                .replace("{{description}}", list[i]);
            $('#questions').append(questionEl);
        }
    }

    $("#create_group").on("click", function() {
        var group = {
            name: "Группа " + numberGroup,
            questions: []
        };
        var checkedQuestionEls = $('.questions__item :checked:visible', "#questions");
        checkedQuestionEls.each(function() {
            var checkBox = $(this).parents('.questions__item'),
                description = $('.description', checkBox).html();
            group.questions.push( description );
            checkBox.addClass("hidden");
        });
        numberGroup++;
        questionGroups.push(group);
        // TODO вставить группу в блок управления
    });
})(jQuery);