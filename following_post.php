<?php
ob_start();
	require 'header.php';
	require_once 'connection/post.php';
	if(!empty($_GET['message'])) {
		$message = $_GET['message'];
		echo "<script type='text/javascript'>alert('$message');</script>";
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Post</title>
	<header><h1><?php echo $_SESSION['player'] ?>'s Following Post</h1></header>
</head>
<body>
	<div class="post_scroll">
		<?php
			$player=$_SESSION['player'];
			$stmt=$conn->prepare("SELECT name FROM user_relation WHERE follower_name='$player'");
			$stmt->execute();
			$result=$stmt->get_result();
			if($result->num_rows > 0){
				while($row=$result->fetch_assoc()){
					$following=$row['name'];
					$stmt2=$conn->prepare("SELECT * FROM post WHERE post_name='$following' ORDER BY date_time DESC");
					$stmt2->execute();
					$result2=$stmt2->get_result();
					$stmt3=$conn->prepare("SELECT follower_name FROM user_relation WHERE name='$following'");
					$stmt3->execute();
					$follower_result = $stmt3->get_result();
					while($following_row = $result2->fetch_assoc()){
						echo "<div class='post'>";
							echo "<div class='post_detail'>";
								echo "<div class='post_content'>";
									echo "<p class='post_header'>Post header : ".$following_row['title']."</p>";
									echo "<textarea rows='10' cols='55' disabled>".$following_row['content'].";</textarea>";
									echo "<p>date:".$following_row['date_time']."---Poster: ".$following_row['post_name']." ( ".$follower_result->num_rows." Follower)</p>";	
								echo "</div>";
								echo "<div class='post_image'>";
									echo "<img class='post_images' src='".$following_row['image']."'></img>";
								echo "</div>";					
							echo "</div>";	
							echo "<div class='comment'>";
								$postID=$following_row['postID'];
								$form_action='following_post';
								comment_section($postID,$form_action);
							echo "</div>";
						echo "</div>";
					}
				}	
			}else{
				echo "Currently no post";
			}
		?>
	</div>

</body>

</html>
<?php
	if(isset($_POST['post_comment'])){
		$comment=$_POST['comment'];
		$postID=$_POST['post_comment'];
		comment($comment,$postID);
	}
	if(isset($_POST['like'])){
		$postID = $_POST['like'];
		$location = 'following_post';
		like($postID,$location);
	}
			
	if(isset($_POST['dislike'])){
		$postID = $_POST['dislike'];
		$location = 'following_post';
		dislike($postID,$location);
	}
	require 'footer.php';
?>