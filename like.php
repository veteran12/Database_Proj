<?php
	session_start();
	$did="";
	$did=$_REQUEST['did'];
	$con=mysqli_connect("localhost","root","123456","v2_Adventure");
	if( mysqli_connect_errno() ){
    	echo "Fail to connect to MySQL: " . mysqli_connect_errno();
    } 
    $uid = $_SESSION["loged"];           
    $sql = "insert into likedia values('$did','$uid')";
    
    mysqli_query( $con, $sql );
    mysqli_close($con);
    header("Location:welcome.php");
    
?>
