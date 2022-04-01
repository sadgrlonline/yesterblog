<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <?php 
         session_start();
        include "../config.php";
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
        <?php include "../navigate.php"; ?>
        <div class="container">
            <h1>Submit a Topic</h1>
            
            <p>All submitted entries <strong>must</strong> be related to the internet and digital spaces online (past, present or future). </p>
            <p>If you're interested in contributing to the blog, your topic must be approved first. You can submit your topic idea here, and the mods will review it and get back to you.</p>
            
            
            <form method="POST" action="submitTopic.php">
                <input type="hidden" name="honeypot">
            <label>Your name</label> <input type="text" name="name">
            <label>Give a brief description of what you'd like to write about</label> <textarea name="topic"></textarea>
            <label>Please give us a link to your website or social media </label> <input type="url" name="link">
            <label>If you're in the YW Discord, please provide your Discord tag</label> <input type="text" name="tag">
            <label>If you're not in the YW Discord, please provide a way to reach you about your approval</label> <input type="text" name="otherContact"><br><br>
            
            <input type="submit" name="submitTopic" value="Submit">
            
        </form>
        
        </div>
        
    </body>
    
</html>