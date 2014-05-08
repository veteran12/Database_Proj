<?php
	$mid = $_REQUEST['mid'];
	//echo $mid;
	$con=mysqli_connect("localhost","root","123456","v2_Adventure");
	if( mysqli_connect_errno() ){
    	echo "Fail to connect to MySQL: " . mysqli_connect_errno();
    }

	$sql="select content from multimedia where mid='$mid'";
	//echo $sql;
	$result=mysqli_query( $con, $sql );  
	if($result -> num_rows > 0) {
	$row = mysqli_fetch_array($result);
	
	Header( "Content-type:  image/jpg");
	echo $row['content'] ."<br>";
	}else
		echo "get image error!";
?>
