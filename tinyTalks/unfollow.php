<?php
	session_start();
	include 'config.php';
	$dbcon = mysqli_connect($host, $username, $password, $database) or die('Could not connect: ' . mysqli_connect_error());
	$user = $_GET['user'];
	$type = $_GET['type'];
	$showtype = $_GET['showtype'];
	$page = $_GET['showpage'];
	

	$tmpUser = $_SESSION['username'];
	$query = "DELETE FROM follow WHERE username = '$user' AND follower='$tmpUser'";
	$result = mysqli_query($dbcon, $query)or die('Query failed: ' . mysqli_error($dbcon));
	
	header("Location: person.php?type=$type&showtype=$showtype&showpage=$page&user=$user");
?>
