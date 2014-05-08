<?php
session_start();
 
 if(isset($_POST["modify"]) && $_POST["modify"] == "submit")  
    {  
        $name = $_POST["nickname"];  
        $age = $_POST["age"];
        $city =  $_POST["city"];
        $email =  $_POST["email"];
        $auth =  $_POST["auth"];
        $uid="";
		$uid=$_SESSION["loged"]; 
		$sql = "update user set ";
		if($name!=""){
			$sql .= "uname = '$name',";
		}
		if($age!=""){
			$sql .= "age = '$age',";
		}
		if($city!=""){
			$sql .= "city = '$city',";
		}
		if($email!=""){
			$sql .= "email = '$email',";
		}
		if($auth!=""){
			$sql .= "auth = '$auth',";
		}
		if ( substr($sql,-1) == "," ){
        	 	$sql = substr($sql,0,-1);
        	 }
        $sql .= "where uid ='$uid'";
        $con=mysqli_connect("localhost","root","123456","v2_Adventure");
									if( mysqli_connect_errno() ){
            							echo "Fail to connect to MySQL: " . mysqli_connect_errno();
            						}
        $result = mysqli_query( $con,$sql );
        mysqli_close($con);
        echo "<script>javascript:window.close();</script>";
 	exit();
 
    }
?>

<form action="changeauth.php" method="post">
 						nickname: <input type="text" name="nickname"/>  
    	<br/>
    	age:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <input type="text" name="age"/>  
    	<br/>
    	city: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <input type="text" name="city"/>  
    	<br/>
    	email: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" name="email"/>  
    	<br/>
                        permission:
                        <br/>
                        <select name="auth"  >
    							<option value="1">public</option>
    							<option value="2">private</option>
    							<option value="3">only friend can see</option>
    							<option value="4">friend and friend of friend can see</option>
 						</select>  
 						<br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 						<input type="submit" name="modify" value="submit"/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="reset" name="reset" value="reset"/>
					</form>
