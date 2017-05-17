jQuery(function($) {
    $('#typeTickets').change(function() {
        var typeTickets = $(this).val(),
            form = $(this).parents('form'),
            actionValue = "parse_exam.php";
        if ( typeTickets == "exam_ticket" ) {
            actionValue = "parse_exam.php";
        } else if ( typeTickets == "exam_tasks" ) {
            actionValue = "parse_tasks.php";
        }
        form.attr('action', actionValue);
    });
});