<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="style.css">
      
    </head>
    <body>
    <?php 
    session_start();
    include 'navigate.php' 
    ?>
        <div class="container">
            <div class="wrapper">
                <div class="content">

                <h1>Yesterblog</h1>
                <?php
                        include "config.php";

                        date_default_timezone_set("US/Eastern");

                        $stmt = $con->prepare("SELECT * FROM blogs ORDER BY id DESC");
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
                            echo '<div class="entry">';
                            echo '<span class="title"><a href="view.php?entry=' . $id . '">' . $title . ' </a></span>';
                            echo '- <span class="date">' . $formattedDate . '</span></div>';
                        }
                        $stmt->close();
                        ?>
                    </div>
            </div>
        </div>