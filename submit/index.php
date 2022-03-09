<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.10.0/tinymce.min.js"></script>
</head>
<?php
session_start();

    if (!isset($_SESSION["username"])) {
        header("Location: ../login/");
        exit();
    } else {
        include '../config.php';
?>
<body>
    <? include '../navigate.php' ?>
    <div class="container">
        <div class="wrapper">
        <h1>Submit a Post</h1>
        <p>It is highly recommended to write your entry in your own text editor and then copy it here when ready to post. This editor does not save drafts!</p>
            <form id="submitEntry" method="POST" action="../submit.php">
            <label>Title</label> <input type="text" name="titleInput" id="titleInput"><br>
            <label></label><textarea name="entryInput" id="entryInput"></textarea><br>
            <label>Name/Alias</label><input type="text" name="nameInput" id="nameInput"><br>
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
    selector: "textarea",
    plugins: 'link',
    setup: function (editor) {
        editor.on('change', function () {
            tinymce.triggerSave();
        });
    }
});

    </script>
</html>