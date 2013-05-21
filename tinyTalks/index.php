<?php
	session_start();
	$indextype = $_GET['type'];
	if ($indextype == destroy){
		session_destroy();
		echo destoryed;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><title>Tinytalk</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<link href="css/overall.css" rel="stylesheet" type="text/css" />      
<body >  
	<div id="index" >
		<div id="head">
			<div id="insidehead">
				<div id="logo"><a href="index.php"><div id = "logoBtn"></div></a></div>
				
		</div>
		<div id="mainPage" > 
			<div id="insidePage" > 
		<div id="settings">
					<ul>
						<li id = "settingsbtn"><a href="#"></a>
						<ul> 
							<li><a href="help.php">HELP</a></li>
						</ul>
						</li>
					</ul>
		</div> 
				<div id="welcomeWords">
					Welcome to TinyTalk.<BR>
					Come here and let the world know you.
				</div>
				<div id="loginBoxOut">
					<div id="loginBoxIn">
					<form method =post action="logincheck.php">
					<input class = "textfield" type="text" name="loginusername" required="required" placeholder="username" autocomplete="off" ><BR>
					<input class = "textfield" type="password" name="loginpassword" required="required" placeholder="password" autocomplete="off" >
					<Button class = "button" type="Submit"> Login</Button>
					</form>
					</div>
				</div>
				<div id="registerBoxOut">
					<div id="registerBoxIn">
						<form method =post action="registercheck.php">
						<p id="tips"> New TinyTalker? Register<BR>
						<div id = "inputBox">
						<input class = "textfield" type="text" name="registernickname" required="required" placeholder="nickname" autocomplete="off" ><BR>
						<input class = "textfield" type="text" name="registerusername" required="required" placeholder="username" autocomplete="off" ><BR>
						<input class = "textfield" type="password" name="registerpassword" required="required" placeholder="password" autocomplete="off" ><BR>
						</div>
						<Button id = "Rbutton" class = "button" type="Submit">Register</Button>
						</form>
					</div>
				</div>
			<address id="copyrights">&copy; Cheonhyang 2012</address>
			</div>
		</div>
	</div> 
</body>
</html>
