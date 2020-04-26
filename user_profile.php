<?php 
ob_start();
    require_once 'header.php'; 
    $src="assets/user_profile/".$_SESSION['target_user'].".png";
    if(!file_exists($src)){
        $src="assets/user_profile/default.png";
    }
    
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <header><h1><?php echo $_SESSION['target_user']; ?>'s profile</h1></header>
</head>
<body>
	<div class="profile">
        <img src=<?php echo $src; ?> width="300px" height="200px" style="border-radius:10px;"><br>
        <p>UserName: <?php echo $_SESSION['target_user'];?></p><br>
        <?php
            if($_SESSION['target_user'] != $_SESSION['player']){
		    	$stmt=$conn->prepare("SELECT * FROM user_relation WHERE name=? AND follower_name=?");
		    	$stmt->bind_param("ss",$_SESSION['target_user'],$_SESSION['player']);
		    	$stmt->execute();
		    	$result=$stmt->get_result();
		    	if($result->num_rows > 0){
		    		echo "<form action='user_profile.php' method='post'>";
		    			echo "<button name='unfollow' class='follow'>unfollow</button>";
		    		echo "</form>";
		    	}else{
			    	echo "<form action='user_profile.php' method='post'>";
			    		echo "<button name='follow' class='follow'>follow</button>";
			    	echo "</form>";
		    	}
		    }
            
            if(isset($_POST['follow'])){
                $date_time=date("Y-m-d h:i:sa");
                $stmt=$conn->prepare("INSERT INTO user_relation(follow_date,name,follower_name) VALUES(?,?,?)");
                $stmt->bind_param("sss",$date_time,$_SESSION['target_user'],$_SESSION['player']);
                $stmt->execute();
                unset($_SESSION['target_user']);
                header("Location:search_user.php?message=User Followed!");
                ob_end_flush();
            }
        
            if(isset($_POST['unfollow'])){
                $date_time=date("Y-m-d h:i:sa");
                $stmt=$conn->prepare("DELETE FROM user_relation WHERE name=? AND follower_name=?");
                $stmt->bind_param("ss",$_SESSION['target_user'],$_SESSION['player']);
                $stmt->execute();
                unset($_SESSION['target_user']);
                header("Location:search_user.php?message=User Unfollowed!"); 
                ob_end_flush();
            }
        ?>
	</div>
</body>
</html>

<?php require_once 'footer.php'; ?>