<?php
	session_start();
 	$following = $_POST["following"];
 	$followed = $_SESSION["loged"];
 
 	$con=mysqli_connect("localhost","root","123456","v2_Adventure");
	if( mysqli_connect_errno() ){
            echo "Fail to connect to MySQL: " . mysqli_connect_errno();
            mysqli_close($con);
     }

    $sql = "delete from friendreq where following = '$following' and followed = '$followed'";
 
 	mysqli_query( $con,$sql );
	
	mysqli_close($con);
 	header("Location:information.php");

?>
