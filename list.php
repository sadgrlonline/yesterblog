<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>List View</title>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <?php 
            session_start();
     include "config.php";
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
      
    </head>
    <body>
    <?php 
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