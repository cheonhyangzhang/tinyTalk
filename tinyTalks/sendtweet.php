<?php
include 'config.php';
session_start();
$dbcon = mysqli_connect($host, $username, $password, $database) or die('Could not connect: ' . mysqli_connect_error());
$tweet = $_REQUEST['tweetcontent'];
$topic = $_REQUEST['topic'];
$user = $_SESSION['username'];

$query = "INSERT INTO Tweet VALUES ('','$user','$tweet',NOW())";
$result = mysqli_query($dbcon, $query)
or die('Query failed: ' . mysqli_error($dbcon));
$query = "SELECT MAX(tweetid) FROM Tweet ";
$result = mysqli_query($dbcon, $query);
$tuple = mysqli_fetch_row($result);
$tweetid=$tuple[0];
if ($topic == NULL){
}
else{
	$query = "SELECT * FROM Topic WHERE content='$topic'";
	$result = mysqli_query($dbcon, $query);
	$tuple = mysqli_fetch_row($result);
	if ($tuple[0]==NULL){
		$query = "INSERT INTO Topic VALUES ('','$topic')";
		mysqli_query($dbcon, $query);
		$query = "SELECT MAX(topicid) FROM Topic ";
		$result = mysqli_query($dbcon, $query);
		$tuple = mysqli_fetch_row($result);
		$topicid=$tuple[0];
	}
	else{
		$topicid=$tuple[0];
	}
	$query = "INSERT INTO hasTopic VALUES ($tweetid,$topicid)";
	mysqli_query($dbcon, $query);
	
}
header("Location: home.php?showpage=1");
mysqli_free_result($result);
mysqli_close($dbcon);
?>

