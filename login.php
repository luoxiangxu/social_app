<?php
	require_once 'header.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>
	<header>
		<h1>Please Login</h1>
	</header>
	<div>
		<form action="login.php" method="post" class="login">
			<p >name</p><input type="text" name="name" placeholder="name"><br>
			<p >password</p><input class="gg" type="password" name="password" placeholder="password"><br>
			<button class="btn" type="submit" name="login">Login</button>
			<br>
			<a href="signup.php">if you didnt have a account click here</a>
		</form>
		
	</div>
</body>
</html>

<?php
	if(isset($_POST['login'])){
		$name=$_POST['name'];
		$password=$_POST['password'];

		$result=mysqli_query($conn,"SELECT * FROM player WHERE name='$name' && password='$password'");

		if($result->num_rows == 0){
			echo "<script type='text/javascript'>alert('player name or password wrong!')</script>";
		}else{
			$_SESSION['player']=$name;
			$_SESSION['rps_player_score']=0;
			$_SESSION['rps_bot_score']=0;
			$_SESSION['draw']=0;
			$_SESSION['round']=1;
			echo "<script type='text/javascript'>window.location.href='home.php';</script>";
		}
	}

	require_once 'footer.php';
?>