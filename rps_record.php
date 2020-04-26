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
		<h1><?php echo $_SESSION['player']; ?>'s Rock Paper Scissor Record</h1>
	</header>
	
</body>
</html>

<?php
$player=$_SESSION['player'];
	$stmt=$conn->prepare("SELECT * FROM prs_record WHERE name='$player'");
	$stmt->execute();
	$result=$stmt->get_result();
	if($result->num_rows > 0){
    echo "<div class='scroll'>";
		echo "<table>";
            echo "<thead>";
                echo "<tr>";
                    echo "<th>recordID</>";
                    echo "<th>Player</th>";
                    echo "<th>player win</th>";
                    echo "<th>bot win</th>";
                    echo "<th>draw</th>";
                    echo "<th>date time</th>";
                    echo "<th>detail</th>";
                echo "</tr>";
            echo "</thead>";
            
            echo "<tbody>";
            while($row=$result->fetch_assoc()){
                echo "<tr>";
                    echo "<td>" . $row['prs_recordID'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['player_win'] . "</td>";
                    echo "<td>" . $row['bot_win'] . "</td>";
                    echo "<td>" . $row['draw'] . "</td>";
                    echo "<td>" . $row['date_time'] . "</td>";
                    echo "<td><a href=rps_matchDetail.php?id=" . $row['prs_recordID'] .">match detail</a></td>";
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