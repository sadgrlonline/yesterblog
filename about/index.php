<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../style.css">
      
    </head>
    <body>
    <?php
    session_start();
    include '../navigate.php';
    include '../config.php';
    ?>
        <div class="container">
            <div class="flex">
            <div class="wrapper">
                <h1>About Yesterblog</h1>
                   <p>This is a collaborative blog about the past, present and future of the internet.</p>
                   <p>The <a href="https://yesterweb.org/" target="_blank">Yesterweb</a> is a community of people who feel like the modern internet is going in the wrong direction.</p>
                   <p>If you'd like to contribute an article to the blog, please submit your topic here for approval. </p>
            <h3>Contributors</h3>

            
            <?php
            
            // this section is generated automatically by unique author names
            $stmt = $con->prepare("SELECT DISTINCT owner_name, owner_link FROM blogs WHERE approved = 1 ORDER BY id DESC");
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $name = $row["owner_name"];
                $link = $row["owner_link"];
                if(!empty($link)) {
                echo "<li><a href='" . $link . "'>" . $name . "</a></li>";
                } else {
                echo "<li>" . $name . "</li>";
                }

            }
            $stmt->close();

            ?>

</div>
<div class="sidebar"><?php include "../sidebar.php"; ?></div></div>