<?php
	session_start();
	$uid = "";
	$uid = $_SESSION["loged"];
	$reqid = $_POST["reqid"];
	if($uid == $reqid){
		echo "<script>alert('you can not add yourself as a friend!'); history.go(-1);</script>";
		//header("Location:search.php");
		exit;
	}
	
	$sql1 = "select reqname as tmp from friend where accname='$uid' union select accname as tmp from friend where reqname='$uid'"; 
	$con = mysqli_connect("localhost","root","123456","v2_Adventure");
    if( mysqli_connect_errno() ){
    	echo "Fail to connect to MySQL: " . mysqli_connect_errno();
    }
    $result = mysqli_query( $con, $sql1 );
    if ( $result -> num_rows != 0 ) {
										
          while($row = mysqli_fetch_array($result))
  		{
  			if($reqid == $row[tmp]){
  				echo "<script>alert('you are already friends!'); history.go(-1);</script>";
		//header("Location:search.php");
		exit;
  			}								
  		}
                           		
    }
    



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
