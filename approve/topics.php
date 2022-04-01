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
        <title>Approve Topics</title>
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
            <h1>Pending Topics</h1>
            <div class="wrapper">
                <div class="content">
                    <?php
                    
                    $stmt = $con->prepare("SELECT * FROM topicApprove WHERE approved = 0");
                	$stmt->execute();
                    $result = $stmt->get_result();
                	while ($row = $result->fetch_assoc()) {
                		$topic = $row['topic'];
                		$name = $row['name'];
                		$link = $row['link'];
                		$tag = $row['link'];
                		$otherContact = $row['otherContact'];
                		echo "<div>";
                		echo "<strong>Topic: </strong>" . $topic . "<br>"; 
                		echo "<strong>Name: </strong>" . $name . "<br>";
                		echo "<strong>Link: </strong>" . $link . "<br>";
                		echo "<strong>Tag: </strong>" . $tag . "<br>";
                		echo "<strong>Contact:</strong>" . $otherContact . "<br>";
                		echo "<form method='POST' action='approveTopic.php'>
                		<input type='hidden' name='id' value='" . $id . "'>";
                		echo "<input type='submit' name='approveTopic' value='approve'>";
                		echo "</form>";
                	}
                	$stmt->close();
    }
	?>
	
	
                    </div>
                    
            </div>
        </div>
    </body>
</html>