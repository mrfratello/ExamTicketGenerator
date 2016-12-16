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

    function renderGroupName(name) {
        var groupEl = $('<div>');
        groupEl.addClass("group_item")
            .html(name);
        $('#groups .empty_block').hide();
        $('#groups').append(groupEl);

    }

    function checkOnExistQuestion() {
        var questionEls = $('.questions__item :visible', "#questions");
        if ( !questionEls.length ) {
            $('#create_tickets_form').removeClass('hidden');
            $('#questions').addClass("hidden");
        }
    }

    $("#create_group").on("click", function() {
        var groupName = "Группа " + numberGroup,
            group = {
                name: groupName,
                questions: []
            };
        var checkedQuestionEls = $('.questions__item :checked:visible', "#questions");
        if (checkedQuestionEls.length) {
            checkedQuestionEls.each(function() {
                var checkBox = $(this).parents('.questions__item'),
                    description = $('.description', checkBox).html();
                group.questions.push( description );
                checkBox.addClass("hidden");
            });
            numberGroup++;
            questionGroups.push(group);
            renderGroupName(groupName);
            checkOnExistQuestion();
        }
    });

    $("#create_tickets").on("click", function() {
        var form = $("#create_tickets_form");
        $("[name=grouped_questions]", form).val( JSON.stringify(questionGroups) );
        form.submit();
    });

})(jQuery);