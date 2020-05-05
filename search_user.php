<?php
	require 'header.php';
	if(!empty($_GET['message'])) {
		$message = $_GET['message'];
		echo "<script type='text/javascript'>alert('$message');</script>";
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Search User</title>
</head>
<body>
	<header><h1>Search User By Name</h1></header>
	<form action='search_user.php' method="post">
		<div class='search_user'>
			<input class="winner" type="text" name="user">
			<button class="new_btn" type="submit" name='search'>Search</button>
		</div>
	</form>
</body>
</html>

<?php
	if(isset($_POST['search'])){
		$user=$_POST['user'];
		$stmt=$conn->prepare("SELECT * FROM player WHERE name='$user'");
		$stmt->execute();
		$result=$stmt->get_result();
		if($result->num_rows > 0){
			$_SESSION['target_user'] = $user;
			echo "<div class='scroll'>";
				echo "<table>";
		            echo "<thead>";
		                echo "<tr>";
		                    echo "<th>username</>";
		                    echo "<th>following</th>";
		                    echo "<th>follower</th>";
		                echo "</tr>";
		            echo "</thead>";
		            
		            echo "<tbody>";
		            while($row=$result->fetch_assoc()){
		                echo "<tr>";
		                    echo "<td><a href=user_profile.php>" . $row['name'] . "</td>";
		                    $stmt1=$conn->prepare("SELECT * FROM user_relation WHERE follower_name='$user'");
		                    $stmt1->execute();
		                    $following_result=$stmt1->get_result();
		                    echo "<td><a href=following_detail.php?name=" . $user . "> " . $following_result->num_rows . "</a></td>";
		                    $stmt2=$conn->prepare("SELECT * FROM user_relation WHERE name='$user'");
							$stmt2->execute();
							$follower_result=$stmt2->get_result();
		                   	echo "<td><a href=follower_detail.php?name=" . $user . ">".$follower_result->num_rows."</td>";
		            }
		            echo "</tbody>";                            
		        echo "</table>";
		    echo "</div>";
		    
		}else{
			echo "<p class='result'><em>No such user.</em></p>";
		}
	}

	require 'footer.php';
?>