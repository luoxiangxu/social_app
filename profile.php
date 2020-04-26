<?php
	ob_start();
	require_once 'header.php';
	$src="assets/user_profile/".$_SESSION['player'].".png";
	if(!file_exists($src)){
		$src="assets/user_profile/default.png";
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
</head>
<body>
	<div class="profile">
		<form action="profile.php" method="post" enctype="multipart/form-data">
		<img src=<?php echo $src; ?> width="300px" height="200px" style="border-radius:10px;"><br>
		<p>UserName: <?php echo $_SESSION['player'];?></p><br>
		<input type="file" name="img" ><br>
		<input type="submit" name="upload" value="upload image">
		</form>
	</div>
</body>
</html>

<?php

    if(isset($_POST['upload'])){
    	$saveTo = "assets/user_profile/". $_SESSION['player'] . ".png";
    	move_uploaded_file($_FILES['img']['tmp_name'], $saveTo);
		header("Refresh:0");
		ob_end_flush();
    }
    require_once 'footer.php';
?>	