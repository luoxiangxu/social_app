<?php
	require_once 'header.php';
	$userChoice='';
?>

<!DOCTYPE html>
<html>
<head>
	<title>rock paper scissors</title>
	<script type="text/javascript" src="rps.js"></script>
</head>
	<header>
		<h1>Rock Paper Scissors</h1>
	</header>
	<div class="score-board">
		<div class="round_text">Round :</div>
		<div class="round" id="round">1</div>
		<div class="player">user</div>
		<div class="bot">bot</div>
		<span id="user_score">0</span>:
		<span id="bot_score">0</span>
		<div class="draw_text">draw :</div>
		<div class="draw" id="draw">0</div>
	</div>
	<div class="images">
			<div class="pictures">
				<button onclick="paper()"><img src="assets/images/paper.jpg"></button>
			</div>
			<div class="pictures">
				<button onclick="rock()"><img src="assets/images/rock.jpg"></button>
			</div>
			<div class="pictures">
				<button onclick="scissor()"><img src="assets/images/scissor.jpg"></button>
			</div>
	</div>
	<div style="text-align:center;">
		<span id="result" style="font-size:25px;font-weight: bold;"></span>
	<div>
</body>
</html>

<?php
	if(isset($_GET['data1'])){
		header("Content-Type: application/json; charset=UTF-8");
		$data1=json_decode($_GET['data1'], false);
		$date_time=date("Y-m-d h:i:sa");
		$stmt1=$conn->prepare("INSERT INTO prs_record(name,player_win,bot_win,draw,date_time) VALUES (?,?,?,?,?)");
		$stmt1->bind_param("siiis",$_SESSION['player'],$data1->userScore,$data1->botScore,$data1->draw,$date_time);
		$stmt1->execute();
	}

	if(isset($_GET['data2'])){
		header("Content-Type: application/json; charset=UTF-8");
		$data2=json_decode($_GET['data2'], false);
		$stmt1=$conn->prepare("INSERT INTO prs_match_detail(round,user_move,bot_move,winner,prs_recordID) VALUES (?,?,?,?,?)");
		$stmt2=$conn->prepare("SELECT prs_recordID FROM prs_record ORDER BY prs_recordID DESC LIMIT 1");
		$stmt2->execute();
		$result=$stmt2->get_result();
		$row=$result->fetch_assoc();
		$prs_recordID=$row['prs_recordID'];
		$stmt1->bind_param("isssi",$data2->round,$data2->userChoice,$data2->botChoice,$data2->winner,$prs_recordID);
		$stmt1->execute();
	}

	if(isset($_GET['data3'])){
		header("Content-Type: application/json; charset=UTF-8");
		$data3=json_decode($_GET['data3'], false);
		$stmt1=$conn->prepare("SELECT prs_recordID FROM prs_record ORDER BY prs_recordID DESC LIMIT 1");
		$stmt1->execute();
		$result=$stmt1->get_result();
		$row=$result->fetch_assoc();
		$prs_recordID=$row['prs_recordID'];
		$player_win=$data3->userScore;
		$bot_win=$data3->botScore;
		$draw=$data3->draw;
		$stmt2=mysqli_query($conn,"UPDATE prs_record SET player_win='$player_win',bot_win='$bot_win',draw='$draw' WHERE prs_recordID='$prs_recordID'");
	}

	require_once 'footer.php';
?>