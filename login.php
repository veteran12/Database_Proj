<?php
	session_start();
	if ( isset( $_SESSION["loged"] ) ){
		header("Location:welcome.php");
		exit();
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="en_US" xml:lang="en_US">
<!--
 * Created on Apr 25, 2014
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
-->
 <head>
  <title> </title>
 </head>
 <body background="images/v2.jpg" style="background-repeat:no-repeat">
 	<form action="logincheck.php" method="post">
 		username: <input type="text", name="username" />
 		<br/>
 		password: <input type="password" name="password" />
 		<br/>
 		<input type="submit" name="submit" value="login"/>
 		<a href="register.php">register</a>
 	</form>
 </body>
</html>
