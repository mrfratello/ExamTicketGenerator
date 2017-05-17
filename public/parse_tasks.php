<?php
    session_start();
    if ( isset($_FILES['examFile']) && isset($_FILES['examFile']['tmp_name']) ) {
        $data = file_get_contents($_FILES['examFile']['tmp_name']);
    } else {
        $_SESSION["error_upload"] = "Файл не был загружен";
        header("Location: /");
    }

    require '../vendor/autoload.php';

    include_once "header.php";

    $Parsedown = new Parsedown();
    $tasks = explode("---", $data);
    $tasks = array_map("trim", $tasks);

    foreach($tasks as $task) {
?>

    <div class="ticket">
        <div class="ticket__body">
            <?php echo $Parsedown->text($task); ?>
        </div>
    </div>

<?php
    }

    include_once "footer.php";
?>