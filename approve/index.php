<!DOCTYPE html>
<html>
    <?php
    session_start();

    if (!isset($_SESSION["username"])) {
        header("Location: ../login/");
        exit();
    } else {
        include '../config.php';
    ?>
    <head>
        <meta charset="UTF-8">
        <title>Approve Entries</title>
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

    <?php include '../navigate.php' ?>

        <div class="container">
            <div class="wrapper">
            <h1>Pending Entries</h1>
            <p>View the entry to approve it.</p>
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
                echo '<div>';
                echo '<span class="title"><strong><a href="../view.php?approveView=' . $id . '">' . $title . '</a> </strong></span>';
                echo '- <span class="date">' . $formattedDate . '</span><br>';
                echo '<span class="author"><strong>Submitted by:</strong> ' . $name . '</div>';
            }
        $stmt->close();
        }
            ?>
            </div>
        </div>
    </body>
</html>