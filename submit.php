<?php 

include 'config.php';

// handles edits
if (isset($_POST['cat'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $url = $_POST['url'];
    $descr = $_POST['descr'];
    $cat = $_POST['cat'];

    
 	$stmt = $con->prepare("UPDATE websites SET title = ?, url = ?, descr = ?, category = ? WHERE id = ?");
     $stmt->bind_param("sssss", $title, $url, $descr, $cat, $id);
     $stmt->execute();
     $result = $stmt->get_result();
     $stmt->close();
}

// handles deletions
if (isset($_POST['del'])) {
    $id = $_POST['id'];
    $stmt = $con->prepare("DELETE FROM websites WHERE id = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $stmt->close();
}

// handles submissions
if (isset($_POST['submit'])) {
    
    $honeypot = $_POST['honeypot'];
        if(!empty($honeypot)){
            return; //you may add code here to echo an error etc.
        }else{
            $title = trim($_POST['titleInput']);
            $entry = trim($_POST['entryInput']);
            $name = $_POST['nameInput'];
            $email = $_POST['emailInput'];
            $link = $_POST['linkInput'];
            $bio = $_POST['bioInput'];
            $dateposted = date("Y-m-d");
            $timeposted = date('Y-m-d H:i:s');

            // Check fields are empty or not
            if ($entry == ''){
            $error_message = "You can't submit a blank entry.";
            echo $error_message;
            }

            echo $title, $entry, $name, $email, $link, $dateposted, $timeposted;

            $stmt = $con->prepare("INSERT INTO blogs(owner_name, owner_email, owner_link, owner_bio, dateposted, timeposted, title, entry) VALUES (?,?,?,?,?,?,?,?)");
            $stmt->bind_param("ssssssss", $name, $email, $link, $bio, $dateposted, $timeposted, $title, $entry);
            $stmt->execute();
            $stmt->close();
            header("Location: index.php");
           
        }
}

// handled edit submission
if (isset($_POST['submitEdit'])) {
    $id = trim($_POST['id']);
    $title = trim($_POST['titleInput']);
    $entry = trim($_POST['entryInput']);
    $name = $_POST['nameInput'];
    $email = $_POST['emailInput'];
    $link = $_POST['linkInput'];
    $bio = $_POST['bioInput'];;  
    echo $id,$title,$entry,$name,$email,$link,$bio,$content; 
    $stmt = $con->prepare("UPDATE blogs SET owner_name=?, owner_email=?, owner_link=?, owner_bio=?, title=?, entry=? WHERE id = ?");
            $stmt->bind_param("sssssss", $name, $email, $link, $bio, $title, $entry, $id);
    
            $stmt->execute();
            $stmt->close();
    header("Location: index.php");         

}
