<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php 
	$logintype = $_GET['type'];
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head><title>Tinytalk</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<link href="css/overall.css" rel="stylesheet" type="text/css" />      
<link href="css/login.css" rel="stylesheet" type="text/css" />      
<body >  
		 <div id="index" >
			<div id="head">
				<div id="insidehead">
					<div id="logo"><a href="index.php"><div id = "logoBtn"></div></a></div>
			</div>
		<div id="mainPage" > 
			<div id="insidePage">
			<div id="settings">
					<ul>
						<li id = "settingsbtn"><a href="#"></a>
						<ul>
 							<li><a href="help.php">HELP</a></li>
 						</ul>
 						</li>
 					</ul>
				</div>
			<div id="logininsidePage" > 
				<?php 
					if ($logintype == normal){
					}
					else{
					print "<div id=\"inforbar\">";
						if ($logintype == registered){
						$infor='You have registered! Now login!';
						}
						else if ($logintype == used){
						$infor='Username has already been used!';
						}
					else
					{
						$infor='Username or password is not correct!';
					}
					print "<p id=\"infor\">$infor</p>";
					print "</div>";
					}
				?>
				<div id="loginloginBoxOut">
					<div id = "loginTip">
						Login Tinytalk<BR><BR>		
					</div>

					<div id="loginloginBoxIn">
					<form method =post action="logincheck.php">
					<input class = "textinput" type="text" name="loginusername" required="required" placeholder="username" autocomplete="off" ><BR><BR>
					<input class = "textinput" type="password" name="loginpassword" required="required" placeholder="password" autocomplete="off" >  <BR><BR>
					<Button class = "button" type="Submit"> Login</Button>
					</form>
					</div>
				</div>
			<address id="copyrights">&copy; Cheonhyang 2012</address>
			</div>
			</div>
		</div>
	</div> 
</body>
</html>
