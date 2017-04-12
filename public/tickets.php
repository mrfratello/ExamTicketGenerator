<?php

    function getClearArray($count) {
        $list = array();
        for ($i = 0; $i < $count; $i++) {
            $list[] = null;
        }
        return $list;
    }

    function getTickets($groups, $questions_per_ticket = 2) 
    {
        $tickets = array();
        $j = 0;
        while( count($groups) ) {
            // формируем массив соответствия номера вопроса в билете номеру группы вопросов
            $group_number = getClearArray($questions_per_ticket);
            for ($i = 0; $i < $questions_per_ticket; $i++) {
                do {
                    $number = mt_rand(0, count($groups) - 1);
                } while ( (array_search($number, $group_number, true) !== false) && (count($groups) >= $questions_per_ticket) );
                $group_number[$i] = $number;
            }
            // выбираем вопросы из нужной группы
            $ticket = array();
            for ($i = 0; $i < $questions_per_ticket; $i++) {
                $tasks = $groups[$group_number[$i]]["questions"];
                $task_number = mt_rand(0, count($tasks) - 1);
                array_push($ticket, array(
                        'number' => $i + 1,
                        'text' => $tasks[$task_number]
                    ));
                array_splice($groups[$group_number[$i]]["questions"], $task_number, 1);
            }
            array_push($tickets, $ticket);
            
            for ($i = 0; $i < count($groups); $i++) {
                if ( !count($groups[$i]["questions"]) ) {
                    array_splice($groups, $i, 1);
                    $i--;
                }
            }
            error_log("Count groups " . count($groups));
        }
        shuffle($tickets);
        return $tickets;
    }

    if (isset($_POST['grouped_questions'])) {
        include_once "header.php";
        $grouped_questions = json_decode($_POST['grouped_questions'], true);

        $ticket_list = getTickets( $grouped_questions );

        for ($i = 1; $i <= count($ticket_list); $i++) {
?>
    <div class="ticket">
        <div class="ticket__header text-center">
            Билет №<?php echo $i; ?>
        </div>
        <div class="ticket__body">
            <ol class="questions">
<?php
            foreach ($ticket_list[$i-1] as $question) {
?>
                <li>
                    <?php echo $question["text"]; ?>
                </li>
<?php
            }
?>
            </ol>
        </div>
    </div>

<?php
        }

        include_once "footer.php";
    } else {
        header("Location: /");
    }
?>
