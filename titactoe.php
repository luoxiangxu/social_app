<?php require_once 'header.php'; 
ob_start();
?> 

<!DOCTYPE html>
<html>
<head>
	<title>TITACTOE</title>
	<script type="text/javascript" src="titactoe.js"></script>
</head>
<body>
	<header><h1>TITACTOE</h1></header>
	<p class="ttt_text">Player=>X , Bot=>O</p>
	<div class="titactoe_div">
		<button class="btn1" id="0" onclick="userTurn(this,0)"></button>
		<button class="btn1" id="1" onclick="userTurn(this,1)"></button>
		<button class="btn1" id="2" onclick="userTurn(this,2)"></button>
		<br>
		<button class="btn1" id="3" onclick="userTurn(this,3)"></button>
		<button class="btn1" id="4" onclick="userTurn(this,4)"></button>
		<button class="btn1" id="5" onclick="userTurn(this,5)"></button>
		<br>
		<button class="btn1" id="6" onclick="userTurn(this,6)"></button>
		<button class="btn1" id="7" onclick="userTurn(this,7)"></button>
		<button class="btn1" id="8" onclick="userTurn(this,8)"></button>
		<br>
		<input class="winner" type="text" id="winner" style="visibility: hidden;" disabled>
		<button class="new_btn" id="new_btn" style='visibility:hidden' onclick="document.location.reload(true)">New Game</button>
	</div>	
</body>
</html>

<?php 
	if(isset($_GET['winner'])){
		$winner=$_GET['winner'];
		$date_time=date("Y-m-d h:i:sa");
		$stmt=$conn->prepare("INSERT INTO titato_record(name,winner,date_time) VALUES(?,?,?)");
		$stmt->bind_param("sss",$_SESSION['player'],$winner,$date_time);
		$stmt->execute();
	}
	if(isset($_GET['choices'])){
		header("Content-Type: application/json; charset=UTF-8");
		$choices=json_decode($_GET['choices'], false);
		$stmt1=$conn->prepare("SELECT titato_recordID FROM titato_record ORDER BY titato_recordID DESC LIMIT 1");
		$stmt1->execute();
		$result=$stmt1->get_result();
		$row=$result->fetch_assoc();
		$titato_recordID=$row['titato_recordID'];
		$stmt2=$conn->prepare("INSERT INTO ttt_match_detail(choice1,choice2,choice3,choice4,choice5,choice6,choice7,choice8,choice9,titato_recordID) VALUES(?,?,?,?,?,?,?,?,?,?)");
		$stmt2->bind_param("sssssssssi",$choices->choices0,$choices->choices1,$choices->choices2,$choices->choices3,$choices->choices4,$choices->choices5,$choices->choices6,$choices->choices7,$choices->choices8,$titato_recordID);
		$stmt2->execute();
		ob_end_flush();
	}
	require_once 'footer.php';
?>


