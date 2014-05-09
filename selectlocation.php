<?php

	
 
 if(isset($_POST["select"]) && $_POST["select"] == "submit") {
 	session_start();
 	$location = $_POST["location"];  
 	$_SESSION["location"] = $location;	
 	echo "you select: " . $_SESSION["location"] . '<br>';
 	//echo "windows close in 3 second";
 	//sleep(3);
 	echo "<script>javascript:window.close();</script>";
 	exit();
 }
	$con=mysqli_connect("localhost","root","123456","v2_Adventure");
	if( mysqli_connect_errno() ){
    	echo "Fail to connect to MySQL: " . mysqli_connect_errno();
	} 
                
    $sql = "select lname from location";
    $result = mysqli_query( $con,$sql );
	$html = "";
	
	while($row = mysqli_fetch_array($result))
  	{
  		$html .= "<input type=checkbox name=\"location\" value=\"" . $row['lname'] . "\">" . $row['lname'] . "<br>";									
  	}
	
	echo "<form action = \"selectlocation.php\" method = \"post\" >";
	echo $html . "</input>";
	echo "<input type = \"submit\" name=\"select\" value = \"submit\">";
	mysqli_close($con);
?>