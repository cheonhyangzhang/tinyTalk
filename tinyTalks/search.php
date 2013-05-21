<?php
	session_start();
	include 'config.php';
	$dbcon = mysqli_connect($host, $username, $password, $database) or die('Could not connect: ' . mysqli_connect_error());
	$user = $_SESSION['username'];
	$searchcontent=$_GET['searchcontent'];
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
<link href="css/home.css" rel="stylesheet" type="text/css" />      
<link href="css/search.css" rel="stylesheet" type="text/css" />      
<body >  
	<div id="index" >
		<div id="mainPage" > 
			<div id="insidePage" > 
			<div id="tweettable">
                                <div id="tweettitle">
                                        <p id = "tweettitletext">Search Result for "<?php echo $searchcontent?>"</p>
                                </div><!-- tweettitle-->
                                <div id="tweetmiddle">
					<?php
	$query = "SELECT name, username FROM Users WHERE username LIKE '%$searchcontent%' OR name LIKE '%$searchcontent%'";
	$result = mysqli_query($dbcon, $query)or die('Query failed: ' . mysqli_error($dbcon));
						$pageminus=$page-1;
						$i=0;
						while ($tuple = mysqli_fetch_array($result)){
						if ($i<$page*9 && $i>=$pageminus*9 ){
						print "<a href = \"";
						print "person.php?type=2&showtype=1&showpage=1&user=";
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
						
	$query = "SELECT name, content,tweetid,timeStamp FROM Tweet, Users WHERE Tweet.fromUser = Users.username AND content LIKE '%$searchcontent%'";
	$result = mysqli_query($dbcon, $query)or die('Query failed: ' . mysqli_error($dbcon));
						
						while ($tuple = mysqli_fetch_array($result)){
						if ($i<$page*9 && $i>=$pageminus*9 ){
						print "<a href = \"tweet.php?tweetid=";
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
						if ($i< ($nextpage-1)*9){
							$nextpage = $page;}
					?>

					
                                </div><!-- tweetmiddle-->
                                <div id="tweettile" >
					<p id="previous">
						<a href="search.php?searchcontent=<?php echo $searchcontent?>&page=<?php echo $prepage?>">
						Previous</a>&nbsp
						<a href="search.php?searchcontent=<?php echo $searchcontent?>&page=<?php echo $nextpage?>">
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
						<a class ="lefttip" href="#">topic
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
