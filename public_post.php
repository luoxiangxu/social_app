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
	<title>Public post</title>
	<header><h1>Public post (Only post in 10 lastest posts!)</h1></header>
</head>
<body>
	<div class="post_scroll">
		<?php
			$stmt1=$conn->prepare("SELECT * FROM post WHERE public='true' ORDER BY date_time DESC LIMIT 10");
			$stmt1->execute();
			$result=$stmt1->get_result();
			if($result->num_rows > 0){
				while($row=$result->fetch_assoc()){
					$postID=$row['postID'];
					$post_name = $row['post_name'];
					$stmt2=$conn->prepare("SELECT follower_name FROM user_relation WHERE name='$post_name'");
					$stmt2->execute();
					$follower_result=$stmt2->get_result();
					echo "<div class='post'>";
						echo "<div class='post_detail'>";
							echo "<div class='post_content'>";
								echo "<p class='post_header'>Post header : ".$row['title']."</p>";
								echo "<textarea rows='10' cols='55' disabled>".$row['content'].";</textarea>";
								echo "<p>date: ".$row['date_time']."---Poster: ".$row['post_name']." ( ".$follower_result->num_rows." follower)</p>";	
							echo "</div>";
							echo "<div class='post_image'>";
								echo "<img class='post_images' src='".$row['image']."'></img>";
							echo "</div>";					
						echo "</div>";	
						echo "<div class='comment'>";
							$form_action = 'public_post';
							comment_section($postID,$form_action);	
						echo "</div>";
					echo "</div>";
				}
			}else{
				echo "Currently no post";
			}
		?>
	</div>
</body>
</html>

<?php
	require 'footer.php';
	if(isset($_POST['post_comment'])){
		$comment=$_POST['comment'];
		$postID=$_POST['post_comment'];
		comment($comment,$postID);
	}
	if(isset($_POST['like'])){
		$postID = $_POST['like'];
		$location = 'public_post';
		like($postID,$location);
	}
			
	if(isset($_POST['dislike'])){
		$postID = $_POST['dislike'];
		$location = 'public_post';
		dislike($postID,$location);
	}
?>