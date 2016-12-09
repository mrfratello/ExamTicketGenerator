(function($){
    if (questions) {
        if (questions.length) {
            
        } else {
            var errorMessage = $("<div/>");
            errorMessage.addClass("text-danger")
                .html("Не удалось выделить из файла список вопросов");
            $("#questions").append(errorMessage);
        }
    }
})(jQuery);