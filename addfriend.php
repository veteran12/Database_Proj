<?php
	session_start();
	$uid = "";
	$uid = $_SESSION["loged"];
	$reqid = $_POST["reqid"];

	$sql = "insert into friendreq(following,followed) values ('$uid','$reqid')";
	$con = mysqli_connect("localhost","root","123456","v2_Adventure");
    if( mysqli_connect_errno() ){
    	echo "Fail to connect to MySQL: " . mysqli_connect_errno();
    }
    $result = mysqli_query( $con, $sql );    
    if( $result ){  
    	echo "<script>alert('request send!');history.go(-1);</script>"; 
    }else
    	echo "<script>alert('request send failed!');history.go(-1);</script>";
	 mysqli_close($con);   
	 header("Location:search.php");
?>
