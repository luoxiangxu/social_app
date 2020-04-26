<?php

	function comment_section($p1,$form_action){
		require "connection.php";
		$postID = $p1;
		$stmt2=$conn->prepare("SELECT * FROM comment_detail WHERE postID='$postID'");
		$stmt2->execute();
		$comment_result=$stmt2->get_result();
		echo "<link rel='stylesheet' type='text/css' href='assets/css/style.css'>";
		echo "<div class='comments_scroll'>";
			if($comment_result->num_rows > 0){
				while($comment_row=$comment_result->fetch_assoc()){
					echo "<div class='comments'>";
						echo "<p>".$comment_row['comment_name']." said :".$comment_row['content']."</p>";
						echo "<p>commented date :".$comment_row['date_time']."</p>";
					echo "</div>";
				}
			}else{
				echo "<p>No Comment yet.</p>";
			}
		echo "</div>";
		echo "<div class='your_comment'>";
			echo "<form action='".$form_action.".php' method='post'>";
					echo "<input name='comment' placeholder='write comment here' class='write_comment'>";
					echo "<button name='post_comment' class='post_comment' value='".$postID."'>Post Comment</button>";
			echo "</form>";
			echo "<form action='".$form_action.".php' method='post'>";
				$user = $_SESSION['player'];
				$stmt4=$conn->prepare("SELECT * FROM postlikedislike WHERE name='$user' AND postID='$postID'");
				$stmt4->execute();
				$result4 = $stmt4->get_result();
				$row4 = $result4->fetch_assoc();
				if($row4['like_date'] != null){
					echo "<button name='like' class='like_on' value='".$postID."'>Like</button>";
				}else{
					echo "<button name='like' class='like_off' value='".$postID."'>Like</button>";
				}
				if($row4['dislike_date'] != null){
					echo "<button name='dislike' class='like_on' value='".$postID."'>Dislike</button>";
				}else{
					echo "<button name='dislike' class='like_off' value='".$postID."'>Dislike</button>";
				}
			echo "</form>";		
			$stmt5=$conn->prepare("SELECT * FROM postlikedislike WHERE postID='$postID' AND dislike_date is null");
			$stmt5->execute();
			$like_result=$stmt5->get_result();
			echo "<a href=like_post.php?postID=".$postID." class='like'> ".$like_result->num_rows." people like this post</a>";
			echo "   |   ";
			$stmt6=$conn->prepare("SELECT * FROM postlikedislike WHERE postID='$postID' AND like_date is null");
			$stmt6->execute();
			$dislike_result=$stmt6->get_result();
			echo "<a href=dislike_post.php?postID=".$postID." class='like'> ".$dislike_result->num_rows." people dislike this post</a>";
		echo "</div>";
	}

	function comment($p1,$p2){
		require "connection.php";
		$comment=$p1;
		$postID=$p2;
		$date_time=date("Y-m-d h:i:sa");
		$stmt=$conn->prepare("INSERT INTO comment_detail(content,date_time,comment_name,postID) VALUES(?,?,?,?)");
		$stmt->bind_param("sssi",$comment,$date_time,$_SESSION['player'],$postID);
		$stmt->execute();
		header("Refresh:0");
		ob_end_flush();
	}

	
	function like($p1,$p2){
		require "connection.php";
		$user = $_SESSION['player'];
		$postID = $_POST['like'];
		$stmt = $conn->prepare("SELECT * FROM postlikedislike WHERE name='$user' AND postID='$postID'");
		$stmt->execute();
		$result = $stmt->get_result();
		$row = $result->fetch_assoc();
		if($result->num_rows == 0){
			$date_time=date("Y-m-d h:i:sa");
			$stmt=$conn->prepare("INSERT INTO postlikedislike(like_date,name,postID) VALUES(?,?,?)");
			$stmt->bind_param("ssi",$date_time,$user,$postID);
			$stmt->execute();
			header("Location:".$p2.".php?message=You like this post!");
			ob_end_flush();
		}else if($row['dislike_date'] != null){
			$date_time=date("Y-m-d h:i:sa");
			$stmt=$conn->prepare("UPDATE postlikedislike SET like_date='$date_time',dislike_date=null WHERE name='$user' AND postID='$postID'");
			$stmt->execute();
			header("Location:".$p2.".php?message=You like this post!");
			ob_end_flush();
		}else if($row['like_date'] != null){
			$date_time=date("Y-m-d h:i:sa");
			$stmt=$conn->prepare("DELETE FROM postlikedislike WHERE name='$user' AND postID='$postID'");
			$stmt->execute();
			header("Location:".$p2.".php?message=Remove like from this post!");
			ob_end_flush();
		}
	}


	function dislike($p1,$p2){
		require "connection.php";
		$user = $_SESSION['player'];
		$postID = $p1;
		$stmt = $conn->prepare("SELECT * FROM postlikedislike WHERE name='$user' AND postID='$postID'");
		$stmt->execute();
		$result = $stmt->get_result();
		$row = $result->fetch_assoc();
		if($result->num_rows == 0){
			$date_time=date("Y-m-d h:i:sa");
			$stmt=$conn->prepare("INSERT INTO postlikedislike(dislike_date,name,postID) VALUES(?,?,?)");
			$stmt->bind_param("ssi",$date_time,$user,$postID);
			$stmt->execute();
			header("Location:".$p2.".php?message=You dislike this post!");
			ob_end_flush();
		}else if($row['like_date'] != null){
			$date_time=date("Y-m-d h:i:sa");
			$stmt=$conn->prepare("UPDATE postlikedislike SET dislike_date='$date_time',like_date=null WHERE name='$user' AND postID='$postID'");
			$stmt->execute();
			header("Location:".$p2.".php?message=You dislike this post!");
			ob_end_flush();
		}else if($row['dislike_date'] != null){
			$date_time=date("Y-m-d h:i:sa");
			$stmt=$conn->prepare("DELETE FROM postlikedislike WHERE name='$user' AND postID='$postID'");
			$stmt->execute();
			header("Location:".$p2.".php?message=Remove dislike from this post!");
			ob_end_flush();
		}
	}
?>