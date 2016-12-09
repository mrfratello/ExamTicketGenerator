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
    <div id="questions" class="questions"></div>

    <script type="text/javascript">
        var questions = <?php echo json_encode($question_list); ?>
    </script>
<?php
    include_once "footer.php";
?>