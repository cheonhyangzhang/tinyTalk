<?php
include 'config.php';
session_start();
$dbcon = mysqli_connect($host, $username, $password, $database) or die('Could not connect: ' . mysqli_connect_error());
$user = $_SESSION['username'];
$tweetid = $_SESSION['tweetid'];
$replycontent=$_GET['replycontent'];
$query = "INSERT INTO Reply VALUES ('',$tweetid,'$replycontent',0,'$user','$user',0,NOW())";
$result = mysqli_query($dbcon, $query)
or die('Query failed: ' . mysqli_error($dbcon));
header("Location: tweet.php?tweetid=$tweetid&page=1");
// Free result
mysqli_free_result($result);
// Closing connection
mysqli_close($dbcon);
?>

