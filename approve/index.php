<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <title>Approve</title>
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

    <?php include '../navigate.php' ?>

        <div class="container">
            <div class="wrapper">
                <div class="content">
            <h1>Approve Entries</h1>
            <?php

            date_default_timezone_set("US/Eastern");

            $sql = "SELECT COUNT(*) FROM blogs WHERE approved = 0";
            $qry = mysqli_query($con, $sql);
            $entryCount = mysqli_fetch_assoc($qry)['COUNT(*)'];

            if (!$entryCount > 0) {
                echo "<center><p>There are no new entries to approve.</p></center>";
            }

            $stmt = $con->prepare("SELECT * FROM blogs WHERE approved = 0 ORDER BY id DESC");
            $stmt->execute();
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()) {
                $id = $row['id'];
                $name = $row['owner_name'];
                $link = $row['owner_link'];
                $dateposted = $row['dateposted'];
                $title = $row['title'];
                $entry = $row['entry'];
                $formattedDate = date("l, F j, Y", strtotime($dateposted));
                echo '<div class="blog">';
                echo '<span class="title"><a href="../view.php?approveView=' . $id . '">' . $title . ' </a></span>';
                echo '- <span class="date">' . $formattedDate . '</span></div>';
            }
        $stmt->close();
        }
            ?>
            </div>
        </div>
    </body>
</html>