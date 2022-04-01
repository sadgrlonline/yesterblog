<?php

include "../config.php";

if (isset($_POST['submitTopic'])) {
    
    $honeypot = $_POST['honeypot'];
  $honeypot = $_POST['honeypot'];

    $name = $_POST['name'];
    $topic = $_POST['topic'];
    $link = $_POST['link'];
    $tag = $_POST['tag'];
    $otherContact = $_POST['otherContact'];
    
    //echo $name, $topic, $link, $tag, $otherContact;
    
      if(!empty($honeypot)){
    return;
  }else{
    
    $stmt = $con->prepare("INSERT INTO topicApprove(topic, name, link, tag, otherContact) VALUES (?,?,?,?,?)");
    $stmt->bind_param("sssss", $name, $topic, $link, $tag, $otherContact);
    $stmt->execute();
    $stmt->close();
    header('location: /index.php');
  }
    
}