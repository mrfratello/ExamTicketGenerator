<?php
    session_start();
?>
<?php
    include_once "header.php";
?>
<h1>Генератор экзаменационных билетов</h1>
<form method="POST" action="parse_exam.php" enctype="multipart/form-data">
    <div class="form-group">
        <label for="examFile">Загрузите файл с вопросами</label>
        <input type="file" id="examFile" name="examFile">
        <p class="help-block">Желательно, чтобы файл был в формате <em>markdown</em></p>
    </div>
    <?php
        if (!empty($_SESSION["error_upload"])) {
    ?>
        <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <?php echo $_SESSION["error_upload"]; ?>
        </div>
    <?php
            unset($_SESSION["error_upload"]);
        }
    ?>
     <button class="btn btn-primary" type="submit">Загрузить</button>
</form>
<?php
    include_once "footer.php";
?>
