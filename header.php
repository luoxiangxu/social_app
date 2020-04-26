<?php 
	require_once 'connection/connection.php'; 
?>
<link rel="stylesheet" type="text/css" href="assets/css/style.css">
<body>
	<img src="assets/images/chat.png" width="200" height="100" style="border-radius:20px;margin:10px">
	<?php
		if(isset($_SESSION['player'])){
			echo"<a href='search_user.php' style='color:blue;font-size: 20px;position: absolute;right: 200px;'>Search User</a>";
			echo"<a href='following_detail.php?name=" . $_SESSION['player'] . "' style='color:blue;font-size: 20px;position: absolute;right: 100px;'>Following</a>";
			echo "<a href='follower_detail.php?name=" . $_SESSION['player'] . "' style='color:blue;font-size: 20px;position: absolute;right: 10px;'>Follower</a>";
		}
		echo "<ul>";
		  	if(isset($_SESSION['player'])){
		  		echo"<li><a class='active' href='home.php'>Home</a></li>";
				echo"<li><a href='public_post.php'>Public Post</a></li>";
				echo"<li><a href='following_post.php'>Following Post</a></li>";
		  		echo"<li><a href='your_post.php'>Your Post</a></li>";
		  		echo"<li><a href='rps_record.php'>RPS Record</a></li>";
		  		echo"<li><a href='ttt_record.php'>TTT Recrod</a></li>";
		  		echo "<li><a href='profile.php'>Profile</a></li>" ;
		  		echo"<li><a href='logout.php'>logout</a></li>";
		  	}else{
		  		echo"<li><a href='index.php'>About</a></li>";
		  		echo"<li><a href='login.php'>Login</a></li>";
		  	}
	?>

	  
    </ul>
</body>