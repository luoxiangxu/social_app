<?php
	require 'header.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Follower Detail</title>
	<header><h1><?php echo $_GET['name']; ?>'s Follower Detail</h1></header>
</head>
<body>

</body>
</html>

<?php
	$name=$_GET['name'];
    $stmt=$conn->prepare("SELECT * FROM user_relation WHERE name=?");
    $stmt->bind_param("s",$name);
	$stmt->execute();
	$result=$stmt->get_result();
	if($result->num_rows > 0){
		echo "<div class='scroll'>";
				echo "<table>";
		            echo "<thead>";
		                echo "<tr>";
		                    echo "<th>follower</th>";
		                    echo "<th>followed_date</th>";
		                echo "</tr>";
		            echo "</thead>";
		            
		            echo "<tbody>";
		            while($row=$result->fetch_assoc()){
		                echo "<tr>";
		                    echo "<td>".$row['follower_name']."</a></td>";
		                    echo "<td>".$row['follow_date']."</td>";
		            }
		            echo "</tbody>";                            
		        echo "</table>";
		    echo "</div>";
	}else{
		echo "<p class='result'><em>No follower found!</em></p>";
	}
	require 'footer.php';
?>