<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        
        <?php 
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

        <script src="scripts/loadStylesheet.js"></script>
        <script src="scripts/script.js"></script>
    </head>
        <body>
            <?php
            session_start();
            include 'navigate.php' 
            ?>

            <main class="container">
                <h1>Yesterweb Blog</h1>
                        <p>A collaborative blog about the past, present and future of the internet. </p>
                        <p>You can subscribe via RSS <a href="feed.php">here</a>.</p>
                    <div class="flex">
                        <div class="wrapper">

                            <?php
                            

                            date_default_timezone_set("US/Eastern");


                            $stmt = $con->prepare("SELECT * FROM blogs WHERE approved = 1 ORDER BY id DESC");
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
                               
                                echo '<article class="blog">';
                                echo '<header class="title"><h2><a href="view.php?entry=' . $id . '">' . $title . '</a></h2></header>';
                                echo '<div class="whoWhen">Posted on <span class="date">' . $formattedDate . '</span>';
                                echo '<span class="author"> by <a href="' . $link . '">' . $name . '</a></span></div>';
                                echo '<div class="post">' . $entry . '</div>';
                                $sql = "SELECT COUNT(*) FROM comments WHERE blogid = " . $id;
                                $qry = mysqli_query($con, $sql);
                                $totalCount = mysqli_fetch_assoc($qry)['COUNT(*)'];
                                echo '<section class="links">';
                                if ($totalCount == 1) {
                                    echo '<a href="view.php?entry=' . $id . '" id="View"" id="addComment">' . $totalCount . ' Comment</a><a href="view.php?entry=' . $id . '" id="View">View Entry</a>';
                                } else if ($totalCount == 0) {
                                    echo '<a href="view.php?entry=' . $id . '" id="View"" id="addComment">Add Comment</a><a href="view.php?entry=' . $id . '" id="View">View Entry</a>';
                                } else {
                                    echo '<a href="view.php?entry=' . $id . '" id="View"" id="addComment">' . $totalCount . ' Comments</a><a href="view.php?entry=' . $id . '" id="View">View Entry</a></section>';
                                }
                                echo '</section></article>';
                            }

                            $stmt->close();

                            ?>
                        </div>
                        <aside class="sidebar">
                            <? include "sidebar.php" ?>
                        </aside>
                    </div>
                        </main>
        </body>
    </html>

