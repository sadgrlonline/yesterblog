<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <title>Dashboard</title>
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
        <?php include "../navigate.php" ?>
        <div class="container">
            <div class="wrapper">
            <h1>Dashboard</h1>
            
            <?php
                $sql = "SELECT COUNT(*) FROM blogs";
                $qry = mysqli_query($con, $sql);
                $entryCount = mysqli_fetch_assoc($qry)['COUNT(*)'];
                $sql2 = "SELECT COUNT(*) FROM blogs WHERE approved = 0";
                $qry2 = mysqli_query($con, $sql2);
                $pendingCount = mysqli_fetch_assoc($qry2)['COUNT(*)'];
            ?>
                <div class="content">
                    <p>There are <?php echo $entryCount; ?> entries.</p>
                    <p>There are <?php echo $pendingCount; } ?> entries pending.</p>
                </div>
            </div>
        </div>
    </body>
</html>