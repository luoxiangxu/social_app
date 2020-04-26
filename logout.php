<?php
	ob_start();
	require 'connection/connection.php';
	session_destroy();
	header('location:login.php');
	ob_end_flush();
?>