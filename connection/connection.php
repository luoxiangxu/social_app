<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname="game";

//check session status, prevent from session start twice
if (!isset($_SESSION))
  {
    session_start();
  }

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt1=$conn->prepare("SELECT * FROM post WHERE date_time < DATE_ADD(NOW(),INTERVAL -72 HOUR)");
$stmt1->execute();
$result = $stmt1->get_result();

if($result->num_rows > 0){
  while($row = $result->fetch_assoc()){
    $postID = $row['postID'];
    $stmt2 = $conn->prepare("DELETE FROM postlikedislike WHERE postID='$postID'");
    $stmt2->execute();
    $stmt3 = $conn->prepare("DELETE FROM comment_detail WHERE postID='$postID'");
    $stmt3->execute();
    $stmt4 = $conn->prepare("DELETE FROM post WHERE postID='$postID'");
    $stmt4->execute();
    $image = $row['image'];
    unlink($image);
  }
}

?>