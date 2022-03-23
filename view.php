<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.10.0/tinymce.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    </head>

    <body>
        <?php 
        session_start();
        include 'navigate.php' 
        ?>

        <main class="container">
                <div class="wrapper">

                    <?php
                    include "config.php";
                    date_default_timezone_set("US/Eastern");

                    // shows approve button (might need to change how this works)
                    if (isset($_GET['approveView'])) {
                        $id = $_GET['approveView'];
                        echo '<a id="approve" href="/yesterblog/view.php?approve=' . $id . '">Approve this Entry</a>';
                    } else if (isset($_GET['entry']))  {
                        $id = $_GET['entry'];
                    }


                    $stmt = $con->prepare("SELECT * FROM blogs WHERE id = ?");
                    $stmt->bind_param("s", $id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    
                    
                    while ($row = $result->fetch_assoc()) {
                        $id = $row['id'];
                        $name = $row['owner_name'];
                        $link = $row['owner_link'];
                        $bio = $row['owner_bio'];
                        $dateposted = $row['dateposted'];
                        $timeposted = $row['timeposted'];
                        $title = $row['title'];
                        $entry = $row['entry'];
                        $formattedDate = date("l, F j, Y", strtotime($dateposted));
                        $formattedTime = date("g:iA", strtotime($timeposted));
                    
                        $qry = $con->prepare("SELECT * FROM comments WHERE blogid=?");
                        $qry->bind_param("s", $id);
                        $qry->execute();
                        $qry->store_result();
                        $match = $qry->num_rows();
                        $randomNum = rand(5, 15);
                        echo '<article class="blog">';
                        if (isset($_SESSION['username']) && $_SESSION['username'] == true) {
                            echo '<div class="flex">';
                            echo '<a class="editEntry" href="view.php?edit=' . $id . '">Edit</a>';
                            echo '<a class="deleteEntry" href="view.php?delete=' . $id . '">Delete</a>';
                            echo '</div>';
                            //echo "Welcome to the member's area, " . $_SESSION['username'] . "!";
                        }
                        echo '<header class="title"><h2>' . $title . '</h2></header>';
                        echo '<div class="date">Posted on ' . $formattedDate . ' at ' . $formattedTime . '</div>';
                        echo '<div class="author">by <a href="' . $link . '">' . $name . '</a></div>';
                        echo '<div class="post">' . $entry . '</div>';
                        echo '<section class="bioArea"><div><header><h3 class="about">About the Author</h3></header><p>' . $name . ' is ' . $bio . '</p>';
                        if ($link !== '') {
                        echo '<p class="link">You can find ' . $name . ' <a href="' . $link . ' target="_blank">here</a>.</p>';
                        }
                        echo '</section>';
                                                                    // shows approve button (might need to change how this works)
                    if (isset($_GET['approveView'])) {
                        $id = $_GET['approveView'];
                        echo '<a id="approve" href="/yesterblog/view.php?approve=' . $id . '">Approve this Entry</a>';
                    } else if (isset($_GET['entry']))  {
                        $id = $_GET['entry'];
                    }
                        
                        echo '</div>';
                        
                        echo '<div>';

                        echo '</div>';
                        echo '</article>';
                        
                        
                        echo '</div>';

                        echo '</div>';
                        echo '</div>';
                        echo '<div class="footer"></div>';
                        


                    }

                    // APPROVAL LOGIC
                    if (isset($_GET['approve'])) {
                        if (isset($_SESSION['username']) && $_SESSION['username'] == true) {
                            $id = $_GET['approve'];
                            $stmt = $con->prepare("UPDATE blogs SET approved = 1 WHERE id = ?");
                            $stmt->bind_param("s", $id);
                            $stmt->execute();
                            $stmt->close();
                            header("Location: approve/");
                        }
                    }

                    // EDIT POST LOGIC - this turns everything 'editable'
                    if (isset($_GET['edit'])) {
                        $stmt->close();
                        $id = $_GET['edit'];
                        $stmt = $con->prepare("SELECT * FROM blogs WHERE id = ?");
                        $stmt->bind_param("s", $id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                    
                    
                        while ($row = $result->fetch_assoc()) {
                            $id = $row['id'];
                            $name = $row['owner_name'];
                            $email = $row['owner_email'];
                            $link = $row['owner_link'];
                            $bio = $row['owner_bio'];
                            $dateposted = $row['dateposted'];
                            $timeposted = $row['timeposted'];
                            $title = $row['title'];
                            $entry = $row['entry'];

                            $formattedDate = date("l, F j, Y", strtotime($dateposted));
                            $formattedTime = date("g:iA", strtotime($timeposted));
                            echo '<form id="submitEntry" method="POST" action="submit.php">';
                            echo '<label>Title</label> <input type="text" name="titleInput" id="titleInput" value="' . $title . '"><br>';
                            echo '<label></label><textarea name="entryInput" id="entryInput">' . $entry . '</textarea><br>';
                            echo '<label>Name/Alias</label><input type="text" name="nameInput" id="nameInput" value="' . $name . '"><br>';
                            echo '<label>Short Bio</label><textarea name="bioInput" id="bioInput">' . $bio . '</textarea>';
                            echo '<label>Email</label><input type="email" name="emailInput" id="emailInput" value="' . $email . '"><br>';
                            echo '<label>Link to your site</label><input type="url" name="linkInput" id="linkInput" value="' . $link .  '"><br>';
                            echo '<input type="hidden" name="id" value="' . $id .'">';
                            echo '<input type="submit" name="submitEdit" value="Submit Edit">';

                        }
                    }

                    // DELETE LOGIC
                    if (isset($_GET['delete'])) {
                        // check if logged in
                        if (!isset($_SESSION["username"])) {
                            header('location: error.php');
                        }
                        $id = $_GET["delete"];
                        $stmt = $con->prepare("DELETE FROM blogs WHERE id = ?");
                        $stmt->bind_param("s", $id);
                        $stmt->execute();
                        $stmt->close();
                        header('location: index.php');
                    }
                ?>

                <?php
                    // this conditionally hides all of the comment stuff for editing posts
                    if (!isset($_GET['edit'])) {
                ?>
                <div class="commentsArea">
                    <div class="leaveComment">
                    <details><summary><strong>Leave a comment</strong></summary><br><br>
                    <div class="form">
                    <form method='post' action=''>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <label for="nickname">Nickname</label><br>
                                <input type="text" class="form-control" name="nickname" id="nickname" required>
                            <br>
                            <label for="email">Email</label><br>
                            <input type="email" class="form-control" name="email" id="email"><br>
                            <sup>This field will not be posted publicly.</sup>
                            <br>
                                <label for="comment">Comment</label><br>
                                <textarea class="form-control" name="comment" id="comment" required="required" maxlength="10000"></textarea><br>
                          
                            <button class="btn" type="submit" name="postComment">Post</button>
                        
                     

                    </form>
                    </details>
                <br><br>

                <?php
                    // post comments
                    if (isset($_POST['postComment'])){
                        $nickname = trim($_POST['nickname']);
                        $email = trim($_POST['email']);
                        $comment = trim($_POST['comment']);
                        $dateposted = date("Y-m-d H:i:s");
                        $id = $_GET['entry'];

                        // Check fields are empty or not
                        if ($comment == ''){
                        $error_message = "You can't submit a blank comment.";
                        echo $error_message;
                        }

                        // Insert records
                        $insertSQL = "INSERT INTO comments(blogid, nickname, email, dateposted, comment) values(?,?,?,?,?)";
                        $stmt = $con->prepare($insertSQL);
                        $stmt->bind_param("sssss",$id, $nickname, $email, $dateposted, $comment);
                        $stmt->execute();
                        $stmt->close();
                        echo "<script>history.pushState({}, '', '')</script>";
                    }
                ?>

            <div class="comments">
                <details><summary>
                    
    
                <?php
                
                // read comments
                //$id = $_GET['entry'];
                $stmt = $con->prepare("SELECT * FROM comments WHERE blogid = ?  ORDER BY blogid ");
                $stmt->bind_param("s", $id);
                $stmt->execute();
                $result = $stmt->get_result();
                $number = mysqli_num_rows($result);
                
                if ($number !==0) {
                    echo "<strong>View comments (" . $number . ")</strong></summary>";
                    
                    while ($row = $result->fetch_assoc()) {
                $CommentDate=$row["dateposted"];
                $Nickname=$row["nickname"];
                $Email=$row["email"];
                $Comment=$row["comment"];
                $formattedCommentDate = date("m/d/y", strtotime($CommentDate));
                $formattedCommentTime = date("g:iA", strtotime($CommentDate));
                //$match = $stmt->num_rows();
                
                
                
                ?>
                <div class="comment">
                    <div class="nickname">
                        <strong>From</strong> <?php echo $Nickname; ?>
                        <span class="commentDate">
                            <strong>on</strong> <?php echo $formattedCommentDate ?> at <?php echo $formattedCommentTime ?>
                        </span>
                    </div>
                    <div class="message">
                        <br>
                       <?php echo $Comment; ?>

                    </div>
                    <?php 
                    if (isset($_SESSION['username']) && $_SESSION['username'] == true) {
                        echo "<br>";
                        echo "<a href='view.php?deleteComment=" . $id . "'>delete</a>";
                        // need to write the delete logic for this
                    }
                    ?>
                    <br>
                    </div>
                    
                    <?php
                    } 
                    echo "</details>";

} else {
    echo "<strong>View Comments</strong></summary>";
    echo "<em>There are no comments.</em>";
                    }
                }
                    ?>
    </div>
    <?php
    ?>

    

</div>
    </div>
                </div>
    <?php include 'random.php'; ?>
                </div>

                </main>
                <style>
                    .flex {
                        display:block;
                    }
                    .wrapper {
                        max-width:900px;
                    }
                    </style>
<script>
tinymce.init({
    selector: "textarea#entryInput",
    plugins: 'link',
    setup: function (editor) {
        editor.on('change', function () {
            tinymce.triggerSave();
        });
    }
});

$('.deleteEntry').on("click", function(e) {

    e.preventDefault();
    console.log('hi');
    if(confirm("Are you sure you want to delete this post?")) {
        window.location = $(this).attr('href');

    }
});

    </script>