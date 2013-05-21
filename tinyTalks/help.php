<?php
	session_start();
	include 'config.php';
	$dbcon = mysqli_connect($host, $username, $password, $database) or die('Could not connect: ' . mysqli_connect_error());
	$user = $_SESSION['username'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><title>Tinytalk</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<link href="css/overall.css" rel="stylesheet" type="text/css" />      
<link href="css/help.css" rel="stylesheet" type="text/css" />      
<body >  
	<div id="index" >
		<div id="mainPage" > 
			<div id="insidePage" > 
			<div id="tweettable">
                                <div id="tweetmiddle">
					<p>You can use the back menu on the right top to get back where you are. </p>
					<p>Users infor to test: </p>
					<p>more meaningful infor</p>
					<p>jangcenhiang@163.com 101506</p>
					<p>doraxxy@gmail.com 101506</p>
					<p>User with more infor but has no meaning</p>
					<p>aaa@gmail.com 051220</p>
					
                                </div><!-- tweetmiddle-->
                        </div><!-- tweettable-->



         	<address id="copyrights">&copy; Cheonhyang 2012</address>
                <div id="head">
                        <div id="insidehead">
				<div id="logo">
							<?php
								print "<a href=\"";
								if ($user==NULL){
									print "index.php\">";
								}
								else{
									print "home.php?showpage=1\">";
								}
							?>
					<div id = "logoBtn"></div></a></div>
                                <div id="settings">
                                        <ul>
                                                <li id = "settingsbtn"><a href="#"></a>
                                                <ul>
							<?php
								print "<li><a href=\"";
								if ($user==NULL){
									print "index.php\">BACK</a></li>";
								}
								else{
									print "home.php?showpage=1\">BACK</a></li>";
								}
							?>
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
