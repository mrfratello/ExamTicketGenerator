<?php
    session_start();
    if ( isset($_FILES['examFile']) ) {
        $data = file_get_contents($_FILES['examFile']['tmp_name']);
    } else {
        header("Location: /");
    }

    require '../vendor/autoload.php';

    include_once "header.php";
?>
    <h1>Разделение вопросов на группы</h1>
    <?php
        $Parsedown = new Parsedown();
        $string_list = explode("\n", $data);
        $pattern = '/^\d+\./';
        $question_list = array();
        foreach($string_list as $string) {
            if ( preg_match($pattern, $string, $matches)) {
                array_push($question_list, $Parsedown->text(str_replace($matches[0], "", $string)));
            }
        }
    ?>

    <div class="row">
        <div id="questions" class="questions col-md-8"></div>
        <div id="control_panel" class="col-md-4 hidden">
            <h3>Группы вопросов</h3>
            <div id="groups">
                <em>Пока не создано ни одной группы</em>
            </div>
            <div class="row">
                <div id="create_group" class="btn btn-primary col-md-offset-1 col-md-4">Создать группу</div>
                <div id="clear_groups" class="btn btn-default col-md-offset-2 col-md-4">Начать заново</div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        var questions = <?php echo json_encode($question_list); ?>
    </script>
<?php
    include_once "footer.php";
?>