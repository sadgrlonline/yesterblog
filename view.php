

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="style.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.10.0/tinymce.min.js"></script>
      
    </head>
    <body>
        <?php 
        session_start();
        include 'navigate.php' 
        ?>
        <div class="container">
            <div class="wrapper">


            <?php
            include "config.php";

            date_default_timezone_set("US/Eastern");
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
                    echo '<div class="blog">';


                    //echo "Approval";
                    echo '<div class="title"><h2>' . $title . '</h2></div>';
                    echo '<div class="date">Posted on ' . $formattedDate . ' at ' . $formattedTime . '</div>';
                    echo '<div class="author">by <a href="' . $link . '">' . $name . '</a></div>';
                    echo '<div class="post">' . $entry . '</div>';
                    echo '<div class="footer"></div>';
                    echo '</div>';


                }

                if (isset($_GET['approve'])) {
                    
                    $id = $_GET['approve'];
                    $stmt = $con->prepare("UPDATE blogs SET approved = 1 WHERE id = ?");
                    $stmt->bind_param("s", $id);
                    $stmt->execute();
                    $stmt->close();
                    header("Location: approve/");
                    } 

            ?>

            <div class="commentsArea">
                <div class="leaveComment">
                <strong>Leave a comment:</strong><br><br>
                <div class="form">
                <form method='post' action=''>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <div class="form-group">
                        
                        <div class="form-group">
                            <label for="nickname">Nickname</label><br>
                            <input type="text" class="form-control" name="nickname" id="nickname" required="required" maxlength="20">
                        </div><br>
                        <div class="form-group">
                        <label for="email">Email</label><br>
                        <input type="email" class="form-control" name="email" id="email" maxlength="30"><br>
                        <sup>This field will not be posted publicly.</sup>
                        </div><br>
                        <div class="form-group">
                            <label for="comment">Comment</label><br>
                            <textarea class="form-control" name="comment" id="comment" required="required" maxlength="10000"></textarea>
                        </div>
                        <button class="btn" type="submit" name="postComment">Post</button>
                    </div>
                    </div>

                </form>
            </div>
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
                <strong>Comments</strong><br><br>
    
                <?php
                // read comments
                //$id = $_GET['entry'];
                $stmt = $con->prepare("SELECT * FROM comments WHERE blogid = ?  ORDER BY blogid ");
                $stmt->bind_param("s", $id);
                $stmt->execute();
                $result = $stmt->get_result();
                    while ($row = $result->fetch_assoc()) {
                $CommentDate=$row["dateposted"];
                $Nickname=$row["nickname"];
                $Email=$row["email"];
                $Comment=$row["comment"];
                $formattedCommentDate = date("m/d/y", strtotime($CommentDate));
                $formattedCommentTime = date("g:iA", strtotime($CommentDate));
                $match = $stmt->num_rows();
                ?>
                <div class="comment">
                    <div class="nickname"><strong>From</strong> <?php echo $Nickname; ?></div><br>
                    <div class="commentDate">on <?php echo $formattedCommentDate ?> at <?php echo $formattedCommentTime ?></div><br>
                    <div class="message"><strong></strong> <?php echo $Comment; ?></div><br><hr>
                </div>
        <?php } ?>
    </div>
    <?php
    ?>

    

</div>
    </div>
