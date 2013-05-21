<?php
include 'config.php';

$dbcon = mysqli_connect($host, $username, $password, $database) or die('Could not connect: ' . mysqli_connect_error());
$user = $_REQUEST['loginusername'];
$pwd = $_REQUEST['loginpassword'];
$ruser = $_REQUEST['registerusername'];
$rpwd = $_REQUEST['registerpassword'];
$rname = $_REQUEST['registernickname'];
$query = "SELECT *FROM Users WHERE username = '$user' AND password = '$pwd'";
$result = mysqli_query($dbcon, $query)
or die('Query failed: ' . mysqli_error($dbcon));
$tuple = mysqli_fetch_array($result);
if ($tuple == NULL){
header("Location: login.php");
}
else{
session_start();
$_SESSION['username']=$user;
$query = "SELECT name FROM Users WHERE username = '$user'";
$result = mysqli_query($dbcon, $query)
or die('Query failed: ' . mysqli_error($dbcon));
$tuple = mysqli_fetch_array($result);
$_SESSION['nickname']=$tuple[0];
header("Location: home.php?showpage=1");
}
// Free result
mysqli_free_result($result);
// Closing connection
mysqli_close($dbcon);
?>

