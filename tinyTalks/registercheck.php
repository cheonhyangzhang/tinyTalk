<?php
include 'config.php';

$dbcon = mysqli_connect($host, $username, $password, $database) or die('Could not connect: ' . mysqli_connect_error());
$ruser = $_REQUEST['registerusername'];
$rpwd = $_REQUEST['registerpassword'];
$rname = $_REQUEST['registernickname'];
$query = "SELECT *FROM Users WHERE username = '$ruser' ";
$result = mysqli_query($dbcon, $query)
or die('Query failed: ' . mysqli_error($dbcon));
$tuple = mysqli_fetch_array($result);
if ($tuple == NULL){
	$query = "INSERT INTO Users VALUES('$ruser','$rname','$rpwd',NOW())";
	$result = mysqli_query($dbcon, $query);
	header("Location:login.php?type=registered");
}
else{
	header("Location:login.php?type=used");
}
// Free result
mysqli_free_result($result);
// Closing connection
mysqli_close($dbcon);
?>

