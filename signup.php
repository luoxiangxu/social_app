<?php
	require_once 'header.php'
?>

<!DOCTYPE html>
<html>
<head>
	<title>Singup</title>
</head>
<body>
	<header>
		<h1>Please Sing Up </h1>
	</header>
	<div >
		<form action="signup.php" method="post">
			<p>name</p><input type="text" name="name" placeholder="name" required><br>
			<p>password</p><input type="password" name="password" placeholder="password" required><br>
			<button type="submit" name="signup" class="btn">Sing up</button>
			<span></span>
		</form>
	</div>
</body>
</html>

<?php
	if(isset($_POST['signup'])){
		$name=$_POST['name'];
		$password=$_POST['password'];

		$stmt1=mysqli_query($conn,"SELECT * FROM player WHERE name='$name'");

		if($stmt1->num_rows == 0){
			$stmt2=$conn->prepare("INSERT INTO player(name,password) VALUES (?,?)");
			$stmt2->bind_param("ss",$name,$password);
			$stmt2->execute();
			echo "<script type='text/javascript'>alert('player sign up success!');window.location.href='login.php';</script>";
		}else{
			echo "<script type='text/javascript'>alert('player name already exist!')</script>";
		}

		
	}

	require_once 'footer.php'
?>