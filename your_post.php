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
	<header><h1><?php echo $_SESSION['player'] ?>'s Post</h1></header>
</head>
<body>
	<div class="post_scroll">
	
		<?php
			$player=$_SESSION['player'];
			$stmt=$conn->prepare("SELECT * FROM post WHERE post_name='$player' ORDER BY date_time DESC");
			$stmt->execute();
			$result=$stmt->get_result();
			if($result->num_rows > 0){
				while($row=$result->fetch_assoc()){
					$postID=$row['postID'];
					echo "<div class='post'>";
						echo "<div class='post_detail'>";
							echo "<div class='post_content'>";
								echo "<p class='post_header'>Post header : ".$row['title']."</p>";
								echo "<textarea rows='10' cols='55' disabled>".$row['content'].";</textarea>";
								echo "<p>uploaded date:".$row['date_time']."----------public:".$row['public']."</p>";	
							echo "</div>";
							echo "<div class='post_image'>";
								echo "<img class='post_images' src='".$row['image']."'></img>";
							echo "</div>";					
						echo "</div>";	
						echo "<div class='comment'>";
							$form_action='your_post';
							comment_section($postID,$form_action);
						echo "</div>";
					echo "</div>";
				}	
			}else{
				echo "Currently no post";
			}
		?>

	</div>
	<div style="text-align:center;">
		<button class="new_post" onclick="document.location.href='new_post.php';">New Post</button>
	<div>
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
		$location = 'your_post';
		like($postID,$location);
	}
			
	if(isset($_POST['dislike'])){
		$postID = $_POST['dislike'];
		$location = 'your_post';
		dislike($postID,$location);
	}
	require 'footer.php';
?>