<!DOCTYPE html>
<html>

    <head>
        <title>Submit Entry</title>
        <meta charset="UTF-8">
           <?php
    session_start();

    if (!isset($_SESSION["username"])) {
        header("Location: ../login/");
        exit();
    } else {
        include '../config.php';
    ?>
    <?php 
        $stylePath = "/assets/css/";
        // SELECT
                $stmt = $con->prepare("SELECT * FROM stylesheets");
                $stmt->execute();
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()) {
                echo "<link rel='stylesheet' href='" . $stylePath . $row['fileName'] . "' data-theme='" . $row['title'] . "'>";
                }
                $stmt->close();
        ?>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.10.0/tinymce.min.js"></script>
    </head>
<body>
    <? include '../navigate.php' ?>
    <div class="container">
        <div class="wrapper">
        <h1>Submit a Post</h1>
        <p>Use the editor below to construct your entry.</p>
        <p>All entries must be approved by moderation before going live.</p>
            <form id="submitEntry" method="POST" action="../submit.php">
            <label>Title</label> <input type="text" name="titleInput" id="titleInput"><br>
            <label></label><textarea name="entryInput" id="entryInput"></textarea><br>
            <label>Name/Alias</label><input type="text" name="nameInput" id="nameInput"><br>
            <label>Short Bio (will begin with "YourName is...")</label><textarea name="bioInput" id="bioInput"></textarea>
            <label>Email</label><input type="email" name="emailInput" id="emailInput"><br>
            <label>Link to your site</label><input type="url" name="linkInput" id="linkInput"><br>
            <br><br>

            <input type="text" id="honeypot" name="honeypot">
            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
</body>
<?php } ?>
<script>
tinymce.init({
    selector: "textarea#entryInput",
    plugins: 'link image media paste preview spellchecker autosave lists code',
    autosave_ask_before_unload: true,
    autosave_interval: '10s',
    autosave_restore_when_empty: true,
    toolbar: 'undo redo aligncenter alignjustify alignleft alignnone alignright numlist bullist indent outdent blockquote bold italic underline code styleselect fontselect fontsizeselect forecolor backcolor  removeformat strikethrough spellchecker media wordcount restoredraft preview',
    setup: function (editor) {
        editor.on('change', function () {
            tinymce.triggerSave();
        });
    }
});

    </script>
</html>