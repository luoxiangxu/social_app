<?php
    require 'header.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Like Detail</title>
	<header><h1>PostID <?php echo $_GET['postID']; ?>'s Like Detail</h1></header>
</head>
<body>
<?php
    $postID=$_GET['postID'];
    $stmt=$conn->prepare("SELECT * FROM postlikedislike WHERE postID='$postID' AND dislike_date is null");
	$stmt->execute();
	$result=$stmt->get_result();
	if($result->num_rows > 0){
		echo "<div class='scroll'>";
				echo "<table>";
		            echo "<thead>";
		                echo "<tr>";
		                    echo "<th>Name</th>";
		                    echo "<th>Like_date</th>";
		                echo "</tr>";
		            echo "</thead>";
		            
		            echo "<tbody>";
		            while($row=$result->fetch_assoc()){
		                echo "<tr>";
		                    echo "<td>".$row['name']."</a></td>";
		                    echo "<td>".$row['like_date']."</td>";
		            }
		            echo "</tbody>";                            
		        echo "</table>";
		    echo "</div>";
	}else{
		echo "<p class='result'><em>No like yet!</em></p>";
	}
?>

</body>
</html>

<?php
    require 'footer.php'
?>