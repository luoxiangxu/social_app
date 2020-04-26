<?php
	ob_start();
	require 'header.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>New Post</title>
	<header><h1>New Post</h1></header>
	<p class="post_mention">(Post will automatically delete after 3 days!)</p>
</head>
<body>
	<form action="new_post.php" method="post" enctype="multipart/form-data">
		<div class="new_post_div">
			<input type="text" class="post_header_input" name="header" placeholder="header" required="true"><br>
			<textarea name="content" rows="10" cols="50" class="content" placeholder="content" required="true"></textarea><br>
			image:<input type="file" name="image" required ><br>
			<input type="checkbox" name="public"> Post as public
		</div>
		<div style="text-align:center;">
			<button class="new_post" name="post">Post</button>
		</div>
	</form>
</body>
</html>
<?php
	if(isset($_POST['post'])){

		if ($_FILES["image"]["size"] < 3000000) {
			if(isset($_POST['public'])){
				$public='true';
			}else{
				$public='false';
			}
			$header=$_POST['header'];
			$content=$_POST['content'];
			$number=rand();
			$saveTo="assets/post_images/".$number.".png";
			$date_time=date("Y-m-d h:i:sa");
			$stmt1=$conn->prepare("INSERT INTO post(title,content,image,date_time,post_name,public) VALUES(?,?,?,?,?,?)");
			$stmt1->bind_param("ssssss",$header,$content,$saveTo,$date_time,$_SESSION['player'],$public);
			if($stmt1->execute()){
				move_uploaded_file($_FILES['image']['tmp_name'], $saveTo);
				header("Location:your_post.php?message=Post success!");
				ob_end_flush();
			}
		}else{
			header("Location:your_post.php?message=Sorry, your image size must be lower than 3MB.");
			ob_end_flush();
		}
	}
	require 'footer.php';
	
?>