<?php
	session_start();
	include 'config.php';
	$tweettopicid=$_GET['tweettopicid'];
	$dbcon = mysqli_connect($host, $username, $password, $database) or die('Could not connect: ' . mysqli_connect_error());
	$user = $_SESSION['username'];
	if ($user == NULL ){
		header("Location: login.php?type=normal");
	}
	$page = $_GET['page'];
	$query = "SELECT name FROM Users WHERE username = '$user'";
	$result = mysqli_query($dbcon, $query)or die('Query failed: ' . mysqli_error($dbcon)); $tuple = mysqli_fetch_row($result);
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

	$query = "SELECT content FROM Topic WHERE topicid = '$tweettopicid'";
	$result = mysqli_query($dbcon, $query)or die('Query failed: ' . mysqli_error($dbcon));
	$tuple = mysqli_fetch_row($result);
	$topiccontent = $tuple[0];


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><title>Tinytalk</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<link href="css/overall.css" rel="stylesheet" type="text/css" />      
<link href="css/home.css" rel="stylesheet" type="text/css" />      
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
					<a href="person.php?type=1&showtype=1&showpage=1&user=<?php echo $user?>">
                                        <div id="tweet">
                                        <p class = numnum>
                                        <?php echo $tweetnum;?>
                                        </p>
                                        <p class = numtips>
                                        <BR>tinyTalks
                                        </p>
                                        </div></a>

					<a href="person.php?type=1&showtype=2&showpage=1&user=<?php echo $user?>">
                                        <div id="following">
                                        <p class = numnum>
                                        <?php echo $followingnum;?>
                                        </p>
                                        <p class = numtips>
                                        <BR>Following
                                        </p>
                                        </div></a>

					<a href="person.php?type=1&showtype=3&showpage=1&user=<?php echo $user?>">
                                        <div id="followers">
                                        <p class = numnum>
                                        <?php   echo $followernum; ?>
                                        </p>
                                        <p class = numtips>
                                        <BR>Followers
                                        </p>
                                        </div></a>
                                </div>
                        </div><!-- userinfortable-->
			 <div id="senttweettable">
				<form method=get action="sendtweet.php">
<textarea name="tweetcontent" autocomplete="off" class="textfield" cols = 30 rows=4 placeholder="Send talk..." required = "required"></textarea>

			<input type="text" autocomplete = "off" class = "textfield" placeholder="topic" name="topic">
<div id="sendbutton" >
			<Button class="button" >Send</Button></div>
</form>
			</div><!-- send tweet table-->
			<div id="tweettable">
                                <div id="tweettitle">
                                        <p id = "tweettitletext">Topic: <?php echo $topiccontent?></p>
                                </div><!-- tweettitle-->
                                <div id="tweetmiddle">
					<?php
$query ="SELECT T.tweetid, U.name AS name, T.timeStamp AS timeStamp, T.content AS content FROM hasTopic H, Tweet T, Users U WHERE H.topicid = '$tweettopicid' AND T.tweetid = H.tweetid AND U.username = T.fromUser ORDER BY timeStamp DESC";
$result = mysqli_query($dbcon, $query)
  or die('User not found: ' . mysqli_error());

					?>
					<?php
						$i=0;
						$pageminus=$page-1;
						while ($tuple = mysqli_fetch_array($result)){
						if ($i<$page*8 && $i>=$pageminus*8 ){
						print "<a href = \"tweet.php?tweetid=";
						print $tuple['tweetid'];
						print "&page=1\">";
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
						if ($i< ($nextpage-1)*8){
							$nextpage = $page;}
					?>

					
                                </div><!-- tweetmiddle-->
                                <div id="tweettile" >
					<p id="previous"><a href="topic.php?type=1&page=1" >Back to Topic</a>&nbsp<a href="tweettopic.php?tweettopicid=<?php echo $tweettopicid?>&page=<?php echo $prepage?>">Previous</a>&nbsp<a href="tweettopic.php?tweettopicid=<?php echo $tweettopicid?>&page=<?php echo $nextpage?>"> 	Next</a></p>
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
                                                <li id = "topicdown">
						<a class ="lefttip" href="topic.php?type=1&page=1">topic
						</a>
						</li>
                                                <li id = "people">
						<a class ="lefttip" href="person.php?type=1&showtype=1&showpage=1&user=<?php echo $user?>">Me
						</a>
						</li>
                                        </ul>
                        	</div>
				<div id="search">
					<form method=get action="search.php?">
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
