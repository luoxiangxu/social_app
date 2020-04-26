<?php 
    require_once 'header.php';
    if(isset($_GET['id'])){
        $titato_recordID=$_GET['id'];
        $stmt1=$conn->prepare("SELECT * FROM ttt_match_detail WHERE titato_recordID='$titato_recordID'");
        $stmt1->execute();
        $result1=$stmt1->get_result();
        $row1=$result1->fetch_assoc();

        if(empty($row1['choice1'])){$row1['choice1']="null";}
        if(empty($row1['choice2'])){$row1['choice2']="null";}
        if(empty($row1['choice3'])){$row1['choice3']="null";}
        if(empty($row1['choice4'])){$row1['choice4']="null";}
        if(empty($row1['choice5'])){$row1['choice5']="null";}
        if(empty($row1['choice6'])){$row1['choice6']="null";}
        if(empty($row1['choice7'])){$row1['choice7']="null";}
        if(empty($row1['choice8'])){$row1['choice8']="null";}
        if(empty($row1['choice9'])){$row1['choice9']="null";}


        $stmt2=$conn->prepare("SELECT * FROM titato_record WHERE titato_recordID='$titato_recordID'");
        $stmt2->execute();
        $result2=$stmt2->get_result();
        $row2=$result2->fetch_assoc();
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>TITACTOE</title>
</head>
<body>
    <header><h1>TITACTOE Record For ID <?php echo $_GET['id']; ?></h1></header>
    <p class="ttt_text">Player=>X , Bot=>O</p>
    <div class="titactoe_div">
        <button class="btn1" disabled="true"><?php echo"<p class='titactoe2'>".$row1['choice1']."</p>";?></button>
        <button class="btn1" disabled="true"><?php echo"<p class='titactoe2'>".$row1['choice2']."</p>";?></button>
        <button class="btn1" disabled="true"><?php echo"<p class='titactoe2'>".$row1['choice3']."</p>";?></button>
        <br>
        <button class="btn1" disabled="true"><?php echo"<p class='titactoe2'>".$row1['choice4']."</p>";?></button>
        <button class="btn1" disabled="true"><?php echo"<p class='titactoe2'>".$row1['choice5']."</p>";?></button>
        <button class="btn1" disabled="true"><?php echo"<p class='titactoe2'>".$row1['choice6']."</p>";?></button>
        <br>
        <button class="btn1" disabled="true"><?php echo"<p class='titactoe2'>".$row1['choice7']."</p>";?></button>
        <button class="btn1" disabled="true"><?php echo"<p class='titactoe2'>".$row1['choice8']."</p>";?></button>
        <button class="btn1" disabled="true"><?php echo"<p class='titactoe2'>".$row1['choice9']."</p>";?></button>
        <br>
        <input class="winner" type="text" value="   Winner => <?php echo $row2['winner']; ?>" disabled>
    </div>  
</body>
</html> 

<?php
    require_once 'footer.php';
?>

