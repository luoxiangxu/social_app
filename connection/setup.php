<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname="game";
$conn1 = new mysqli($servername, $username, $password);

//create database
$sql = "CREATE DATABASE game";
if ($conn1->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn1->error;
}

$player = "CREATE TABLE player (
name VARCHAR(50) PRIMARY KEY, 
password VARCHAR(16) NOT NULL
)";

$post = "CREATE TABLE post (
postID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(50),
content VARCHAR(200),
image VARCHAR(200),
date_time VARCHAR(50),
post_name VARCHAR(50),
public VARCHAR(50),
FOREIGN KEY (post_name) REFERENCES player(name) 
)";

$comment_detail = "CREATE TABLE comment_detail (
commentID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
content VARCHAR(200),
date_time VARCHAR(50),
comment_name VARCHAR(50),
postID INT(6) UNSIGNED,
FOREIGN KEY (comment_name) REFERENCES player(name),
FOREIGN KEY (postID) REFERENCES post(postID)
)";

$prs_record = "CREATE TABLE prs_record (
prs_recordID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
player_win INT(6) NULL,
bot_win INT(6) NULL,
draw INT(6) NULL,
date_time VARCHAR(50),
name VARCHAR(50),
FOREIGN KEY (name) REFERENCES player(name)
)";

$prs_match_detail = "CREATE TABLE prs_match_detail(
prs_match_detailID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
round INT(6),
user_move VARCHAR(50),
bot_move VARCHAR(50),
winner VARCHAR(50),
prs_recordID INT(6) UNSIGNED,
FOREIGN KEY (prs_recordID) REFERENCES prs_record(prs_recordID)
)";

$titato_record="CREATE TABLE titato_record (
titato_recordID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
winner VARCHAR(50),
date_time VARCHAR(50),
name VARCHAR(50),
FOREIGN KEY (name) REFERENCES player(name)
)";

$ttt_match_detail = "CREATE TABLE ttt_match_detail(
ttt_match_detailID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
choice1 VARCHAR(50),
choice2 VARCHAR(50),
choice3 VARCHAR(50),
choice4 VARCHAR(50),
choice5 VARCHAR(50),
choice6 VARCHAR(50),
choice7 VARCHAR(50),
choice8 VARCHAR(50),
choice9 VARCHAR(50),
titato_recordID INT(6) UNSIGNED,
FOREIGN KEY (titato_recordID) REFERENCES titato_record(titato_recordID)
)";

$user_relation = "CREATE TABLE user_relation(
user_relationID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
follow_date VARCHAR(50),
name VARCHAR(50),
follower_name VARCHAR(50),
FOREIGN KEY (name) REFERENCES player(name)
)";

$postlikedislike = "CREATE TABLE postlikedislike(
postlikedislikeID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
like_date VARCHAR(50),
dislike_date VARCHAR(50),
player_name VARCHAR(50),
postID INT(6) UNSIGNED,
FOREIGN KEY (name) REFERENCES player(name),
FOREIGN KEY (postID) REFERENCES post(postID)
)";

$conn2 = new mysqli($servername, $username, $password,$dbname);
if ($conn2->query($player) === TRUE) {
    echo "Tables".$player." create successfully";
} else {
    echo "Error creating table: " . $conn2->error;
}
if ($conn2->query($post) === TRUE) {
    echo "Tables".$post." create successfully";
} else {
    echo "Error creating table: " . $conn2->error;
}
if ($conn2->query($comment_detail) === TRUE) {
    echo "Tables".$comment_detail." create successfully";
} else {
    echo "Error creating table: " . $conn2->error;
}
if ($conn2->query($prs_record) === TRUE) {
    echo "Tables".$prs_record." create successfully";
} else {
    echo "Error creating table: " . $conn2->error;
}
if ($conn2->query($prs_match_detail) === TRUE) {
    echo "Tables".$prs_match_detail." create successfully";
} else {
    echo "Error creating table: " . $conn2->error;
}
if ($conn2->query($titato_record) === TRUE) {
    echo "Tables".$titato_record." create successfully";
} else {
    echo "Error creating table: " . $conn2->error;
}
if ($conn2->query($ttt_match_detail) === TRUE) {
    echo "Tables".$ttt_match_detail." create successfully";
} else {
    echo "Error creating table: " . $conn2->error;
}
if ($conn2->query($user_relation) === TRUE) {
    echo "Tables".$user_relation." create successfully";
} else {
    echo "Error creating table: " . $conn2->error;
}
if ($conn2->query($postlikedislike) === TRUE) {
    echo "Tables".$postlikedislike." create successfully";
} else {
    echo "Error creating table: " . $conn2->error;
}

?>