<?php require_once 'header.php';?>
<!DOCTYPE html>
<html>
<head>
	<title>Match Detail</title>
</head>
<body>
	<header>
		<h1>Match detail for recordID No.<?php echo $_GET['id'];?></h1>
	</header>
</body>
</html>
<?php 
	if(isset($_GET['id'])){
		$id=$_GET['id'];
		$stmt=$conn->prepare("SELECT * FROM prs_match_detail WHERE prs_recordID='$id'");
		$stmt->execute();
		$result=$stmt->get_result();
		if($result->num_rows > 0){
		echo"<div class='scroll'>";
			echo "<table>";
           		echo "<thead>";
                	echo "<tr>";
                		echo "<th>recordID</th>";
 						echo "<th>round</th>";
                    	echo "<th>player move</th>";
                    	echo "<th>bot move</th>";
                    	echo "<th>winner</th>";
                	echo "</tr>";
            	echo "</thead>";
            
            	echo "<tbody>";
            	while($row=$result->fetch_assoc()){
                	echo "<tr>";
                	    echo "<td>" . $row['prs_recordID'] . "</td>";
                	    echo "<td>" . $row['round'] . "</td>";
                	    echo "<td>" . $row['user_move'] . "</td>";
                	    echo "<td>" . $row['bot_move'] . "</td>";
                	    echo "<td>" . $row['winner'] . "</td>";
            	}
            	echo "</tbody>";                            
        	echo "</table>";
        echo"</div>";
		}else{
			echo "<p class='result'><em>No records were found.</em></p>";
		}
	}
	require_once 'footer.php';
?>