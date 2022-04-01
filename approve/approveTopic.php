<?php

include "../config.php";

if (isset($_POST['approveTopic'])) {
    $id = $_POST['id'];

    $stmt = $con->prepare("UPDATE topicApprove SET approved = 1");
  	$stmt->execute();
  	$result = $stmt->get_result();
  	$stmt->close();
  	header('location: topics.php');
}