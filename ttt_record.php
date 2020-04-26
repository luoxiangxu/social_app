<?php
	require_once 'header.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Record</title>
</head>
<body>
	<header>
		<h1><?php echo $_SESSION['player']; ?>'s TITACTOE Record</h1>
	</header>
	
</body>
</html>

<?php
$player=$_SESSION['player'];
	$stmt=$conn->prepare("SELECT * FROM titato_record WHERE name='$player'");
	$stmt->execute();
	$result=$stmt->get_result();
	if($result->num_rows > 0){
    echo "<div class='scroll'>";
		echo "<table>";
            echo "<thead>";
                echo "<tr>";
                    echo "<th>recordID</>";
                    echo "<th>Player</th>";
                    echo "<th>winner</th>";
                    echo "<th>date time</th>";
                    echo "<th>detail</th>";
                echo "</tr>";
            echo "</thead>";
            
            echo "<tbody>";
            while($row=$result->fetch_assoc()){
                echo "<tr>";
                    echo "<td>" . $row['titato_recordID'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['winner'] . "</td>";
                    echo "<td>" . $row['date_time'] . "</td>";
                    echo "<td><a href=ttt_matchDetail.php?id=" . $row['titato_recordID'] .">match detail</a></td>";
            }
            echo "</tbody>";                            
        echo "</table>";
    echo "</div>";
	}
	else{
        echo "<p class='result'><em>No records were found.</em></p>";
    }

	require_once 'footer.php';
?> 