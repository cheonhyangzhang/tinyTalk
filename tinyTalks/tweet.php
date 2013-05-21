<?php
	session_start();
	include 'config.php';
	$dbcon = mysqli_connect($host, $username, $password, $database) or die('Could not connect: ' . mysqli_connect_error());
	$user = $_SESSION['username'];
	$tweetid = $_GET['tweetid'];
	$_SESSION['tweetid']=$tweetid;
	$page= $_GET['page'];
	if ($page == NULL){
		$page=1;
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><title>Tinytalk</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<link href="css/overall.css" rel="stylesheet" type="text/css" />      
<link href="css/tweet.css" rel="stylesheet" type="text/css" />      
<body >  
	<div id="index" >
		<div id="mainPage" > 
			<div id="insidePage" > 
			<div id="tweettable">
                                <div id="tweetpagetweet">
					<?php
					$query = "SELECT content, name, timeStamp FROM Users, Tweet WHERE username=fromUser AND tweetid='$tweetid'";
					$result = mysqli_query($dbcon, $query)or die('Query failed: ' . mysqli_error($dbcon));
						$tuple = mysqli_fetch_array($result);
						print "<div class=\"tweetpagebox\">";
						print "<div class=\"tweetpageboxlower\">";
						print "<div class=\"tweetpageboxlowerleft\">";
						print $tuple['name'];
						print "</div>";
						print "<div class=\"tweetpageboxlowerright\">";
						print $tuple['timeStamp'];
						print "</div>";
						print "</div>";
						print "<div class=\"tweetpageboxupper\">";
						print $tuple['content'];
						print "</div>";
						print "</div>";
					
					?>
				<div id="reply">
					<form method=get action="reply.php?">
<textarea name="replycontent" class="textfield" cols = 40 rows=3 placeholder="Reply to tweet..." required = "required"></textarea>
						<div id="searchbuttonarea">
						<Button type="submit" class="button">Reply</Button>
						</div>
					</form>
                        	</div>
							
                                </div><!-- tweetpagetweet-->
                                <div id="tweetmiddle">
					<?php
	$query = "SELECT name, content, timeStamp, replyType, fromUser, toUser FROM Reply, Users WHERE tweetid='$tweetid' AND username = fromUser";
	$result = mysqli_query($dbcon, $query)or die('Query failed: ' . mysqli_error($dbcon));
						$pageminus=$page-1;
						$i=0;
						while ($tuple = mysqli_fetch_array($result)){
						if ($i<$page*7 && $i>=$pageminus*7 ){
						print "<div class=\"replybox\">";
						print "<div class=\"replyboxupper\">";
						print "<div class=\"replyboxupperleft\">";
						print $tuple['name'];
						if ($tuple['replyType']==0){
						}
						else{
							print " to ";
							print $tuple['toUser'];
						}
						print "</div>";
						print "<div class=\"replyboxupperright\">";
						print $tuple['timeStamp'];
						print "</div>";
						print "</div>";
						print "<div class=\"replyboxlower\">";
						print $tuple['content'];
						print "</div>";
						print "</div>";
						}
						$i++;
						}
						
						$prepage = $page -1;
						$nextpage = $page +1;
						if ($prepage == 0){
							$prepage = 1;}
						if ($i< ($nextpage-1)*7){
							$nextpage = $page;}
					?>

					
                                </div><!-- tweetmiddle-->
                                <div id="tweettile" >
					<p id="previous">
						<a href="tweet.php?tweetid=<?php echo $tweetid?>&page=<?php echo $prepage?>">
						Previous</a>&nbsp
						<a href="tweet.php?tweetid=<?php echo $tweetid?>&page=<?php echo $nextpage?>">
						 	Next</a>
					</p>
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
                                                <li id = "people">
						<a class ="lefttip" href="person.php?type=1&showtype=1&showpage=1&user=<?php echo $user?>">Me
						</a>
						</li>
                                        </ul>
                        	</div>
				<div id="search">
					<form method=get action="search.php">
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
