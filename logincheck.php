<?php
/*
 * Created on Apr 25, 2014
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 session_start();
 //echo $_SESSION["loged"];
 if ( isset($_SESSION["loged"]) ){
 	header("Location:welcome.php");
	exit();
 }
 
 
 if(isset($_POST["submit"]) && $_POST["submit"] == "login")  
    {  
        $user = $_POST["username"];  
        $pwd = $_POST["password"];  
        if( $user == "" || $pwd == "" )  
        {  
            echo "<script>alert('please input username and password!'); history.go(-1);</script>";  
        }  
        else  
        {  
            $con = mysqli_connect("localhost","root","123456","v2_Adventure");
            if( mysqli_connect_errno() ){
            	echo "Fail to connect to MySQL: " . mysqli_connect_errno();
            }   
            
            $sql = "select uid,pwd from login where uid = '$_POST[username]' and pwd = '$_POST[password]'";
            //$sql = "select uid,pwd from login where uid = 'jim123' and pwd = '111111'" ; 
            $result = mysqli_query( $con, $sql );  
            $num = mysqli_num_rows( $result );  
            if( $num )  
            {  
                $row = mysqli_fetch_array($result);
                $_SESSION["loged"] = $user;
                echo $row[0] . ":";
                echo "login success!";
                mysqli_close($con);
                header("Location:welcome.php");  
            }  
            else  
            {  
            	mysqli_close($con);
                echo "<script>alert('login error!');history.go(-1);</script>";  
            }  
        }  
    }  
    else  
    {  
    	mysqli_close($con);
        echo "<script>alert('submit error!'); history.go(-1);</script>";  
    }  
?>
