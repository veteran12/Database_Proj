<?php
	session_start();
	session_destroy();
	echo "<script>alert('logout...'); history.go(-1);</script>";
    header("Location:login.php"); 
?>
