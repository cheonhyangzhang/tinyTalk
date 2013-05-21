<?php
	session_start();
	include 'config.php';
	$dbcon = mysqli_connect($host, $username, $password, $database) or die('Could not connect: ' . mysqli_connect_error());
	$user = $_GET['user'];
	$type = $_GET['type'];
	$showtype = $_GET['showtype'];
	$page = $_GET['showpage'];

	$query = "SELECT name FROM Users WHERE username = '$user'";
	$result = mysqli_query($dbcon, $query)or die('Query failed: ' . mysqli_error($dbcon));
	$tuple = mysqli_fetch_row($result);
	$nickname= $tuple[0];

	$query = "SELECT COUNT(*) FROM Tweet WHERE fromUser = '$user'";
	$result = mysqli_query($dbcon, $query)or die('Query failed: ' . mysqli_error($dbcon));
	$tuple = mysqli_fetch_row($result);
	$tweetnum=$tuple[0];
	$query = "SELECT COUNT(*) FROM follow WHERE follower = '$user'";
	$result = mysqli_query($dbcon, $query)or die('Query failed: ' . mysqli_error($dbcon));
	$tuple = mysqli_fetch_row($result);
	$followingnum=$tuple[0];
	$query = "SELECT COUNT(*) FROM follow WHERE username = '$user'";
	$result = mysqli_query($dbcon, $query)or die('Query failed: ' . mysqli_error($dbcon));
	$tuple = mysqli_fetch_row($result);
	$followernum=$tuple[0];



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><title>Tinytalk</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<link href="css/overall.css" rel="stylesheet" type="text/css" />      
<link href="css/home.css" rel="stylesheet" type="text/css" />      
<link href="css/person.css" rel="stylesheet" type="text/css" />      
<body >  
	<div id="index" >
		<div id="mainPage" > 
			<div id="insidePage" > 
			 <div id="userinfortable">
                                <div id="nickname">
                                <?php
                                        echo $nickname;
                                ?>
                                </div>
                                <div id="numtable">
					<a href="person.php?type=<?php echo $type?>&showtype=1&showpage=1&user=<?php echo $user?>">
                                        <div id="tweet">
                                        <p class = numnum>
                                        <?php echo $tweetnum;?>
                                        </p>
                                        <p class = numtips>
                                        <BR>tinyTalks
                                        </p>
                                        </div></a>

                                        <a href="person.php?type=<?php echo $type?>&showtype=2&showpage=1&user=<?php echo $user?>">
                                        <div id="following">
                                        <p class = numnum>
                                        <?php echo $followingnum;?>
                                        </p>
                                        <p class = numtips>
                                        <BR>Following
                                        </p>
                                        </div></a>

                                        <a href="person.php?type=<?php echo $type?>&showtype=3&showpage=1&user=<?php echo $user?>">
                                        <div id="followers">
                                        <p class = numnum>
                                        <?php   echo $followernum; ?>
                                        </p>
                                        <p class = numtips>
                                        <BR>Followers
                                        </p>
                                        </div></a>
                                </div>
				<div id="followarea">
					<?php
						if ($type==1){
						}
						if ($type==2){
							$tmpUser=$_SESSION['username'];
							$query="SELECT * FROM follow WHERE username='$user' AND follower='$tmpUser'";
							$result = mysqli_query($dbcon, $query)or die('Query failed: ' . mysqli_error($dbcon));
							$tuple = mysqli_fetch_row($result);
							
							if ($tuple == NULL){
								print "<a href=\"follow.php?type=$type&showtype=$showtype&showpage=$page&user=$user\">";
								print "<Button class=\"button\">";
								print "Follow";
								print "</Button>";
								print "</a>";
							}
							else{
								print "<a href=\"unfollow.php?type=$type&showtype=$showtype&showpage=$page&user=$user\">";
								print "<Button class=\"button\">";
								print "Unfollow";
								print "</Button>";
								print "</a>";
							}
						}
					?>
				</div>
                        </div><!-- userinfortable-->
			<div id="tweettable">
                                <div id="tweettitle">
                                        <p id = "tweettitletext">
					<?php
						if ($showtype==1){
						 	echo "tinyTalks";
						}
						if ($showtype==2){
						 	echo "following";
						}
						if ($showtype==3){
						 	echo "followers";
						}
					?>	
					</p>
                                </div><!-- tweettitle-->
                                <div id="tweetmiddle">
					<?php
						if ($showtype ==1){
$query ="SELECT tweetid,Users.name AS name, Tweet.timeStamp AS timeStamp, Tweet.content AS content FROM Tweet, Users WHERE Users.username = Tweet.fromUser AND username='$user' ORDER BY timeStamp DESC";
$result = mysqli_query($dbcon, $query)
  or die('User not found: ' . mysqli_error());
}
						if ($showtype ==2){
$query ="SELECT U.name, U.username FROM Users U, follow F WHERE U.username = F.username AND F.follower='$user'";
$result = mysqli_query($dbcon, $query)
  or die('User not found: ' . mysqli_error());
}
						if ($showtype ==3){
$query ="SELECT U.name, U.username FROM Users U, follow F WHERE U.username = F.follower AND F.username='$user'";
$result = mysqli_query($dbcon, $query)
  or die('User not found: ' . mysqli_error());
}

					?>
					<?php
						if ($showtype ==1){
						$i=0;
						$pageminus=$page-1;
						$flag = 0;
						while ($tuple = mysqli_fetch_array($result)){
						if ($i<$page*8 && $i>=$pageminus*8 ){
						print "<a href = \"tweet.php?tweetid=";
						print $tuple['tweetid'];
						print "\">";
						print "<div class=\"tweetbox\">";
						print "<div class=\"tweetboxupper\">";
						print "<div class=\"tweetboxupperleft\">";
						print $tuple['name'];
						print "</div>";
						print "<div class=\"tweetboxupperright\">";
						print $tuple['timeStamp'];
						print "</div>";
						print "</div>";
						print "<div class=\"tweetboxlower\">";
						print $tuple['content'];
						print "</div>";
						print "</div>";
						print "</a>";
						}
						$i++;
						}
						$prepage = $page -1;
						$nextpage = $page +1;
						if ($prepage == 0){
							$prepage = 1;}
						if ($i < $page*9){
							$nextpage = $page;}
						}
						if ($showtype ==2 ||$showtype == 3){
						$i=0;
						$pageminus=$page-1;
						while ($tuple = mysqli_fetch_array($result)){
						if ($i<$page*9 && $i>=$pageminus*9 ){
						print "<a href = \"person.php?type=2&showtype=1&showpage=1&user=";
						print $tuple['username'];
						print "\">";
						print "<div class=\"tweetbox\">";
						print "<div class=\"tweetboxupper\">";
						print "<div class=\"tweetboxupperleft\">";
						print $tuple['name'];
						print "</div>";
						print "<div class=\"tweetboxupperright\">";
						print $tuple['username'];
						print "</div>";
						print "</div>";
						print "<div class=\"tweetboxlower\">";
						print "</div>";
						print "</div>";
						print "</a>";
						}
						$i++;
						}
						$prepage = $page -1;
						$nextpage = $page +1;
						if ($prepage == 0){
							$prepage = 1;}
						if ($i ==0){
							$nextpage = $page-1;}
						}
					?>

					
                                </div><!-- tweetmiddle-->
                                <div id="tweettile" >
					<p id="previous">
					<a href="person.php?type=<?php echo $type?>&showtype=<?php echo $showtype?>&showpage=<?php echo $prepage?>&user=<?php echo $user?>">
Previous</a>&nbsp
					<a href="person.php?type=<?php echo $type?>&showtype=<?php echo $showtype?>&showpage=<?php echo $nextpage?>&user=<?php echo $user?>">
				 	Next</a></p>
                                </div><!-- tweettile-->

                        </div><!-- tweettable-->



         	<address id="copyrights">&copy; Cheonhyang 2012</address>
                <div id="head">
                        <div id="insidehead">
                                <div id="lefttop">
                                        <ul>
                                                <li id = "home">
						<a class ="lefttip" href="home.php?showpage=1">home
						</a>
						</li>
                                                <li id = "topic">
						<a class ="lefttip" href="topic.php?type=1&page=1">topic
						</a>
						</li>
                                                <li id = "peopledown">
						<a class ="lefttip" href="person.php?type=1&showtype=1&showpage=1&user=<?php echo $_SESSION['username']?>"><?php echo $_SESSION['nickname']?>
						</a>
						</li>
                                        </ul>
                        	</div>
				<div id="search">
					<form method=get action="search.php?type=1">
						<input type="text" placeholder="Search" name="searchcontent" class ='textfield' >
						<div id="searchbuttonarea">
						<Button type="submit" id="searchbutton"></Button>
						</div>
					</form>
                        	</div>
                                <div id="settings">
                                        <ul>
                                                <li id = "settingsbtn"><a href="#"></a>
                                                <ul>
                                                        <li><a href="help.php">HELP</a></li>
                                                        <li><a href="index.php?type=destroy">LOGOUT</a></li>
                                                </ul>
                                                </li>
                                        </ul>
                        	</div>
                        </div>
                </div><!-- head -->

			</div><!-- homeinsidePage -->
		</div> <!-- mainpage -->
	</div> <!-- index -->
</body>
</html>
