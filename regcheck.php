<?php
/*
 * Created on Apr 25, 2014
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 if( isset($_POST["submit"]) && $_POST["submit"] == "register" )  
    {  
        $user = $_POST["username"];  
        $psw = $_POST["password"];  
        $psw_confirm = $_POST["confirm"];  
        $nickname = $_POST["nickname"];
        $age = $_POST["age"];
        $city = $_POST["city"];
        $email = $_POST["email"];
        
        if( $user == "" || $psw == "" || $psw_confirm == "" || $nickname == "" || $age == "" || $city == "" || $email == "" )  
        {  
            echo "<script>alert('some information missing,please check again!'); history.go(-1);</script>";  
        }  
        else  
        {  
            if($psw == $psw_confirm)  
            {  
                $con = mysqli_connect("localhost","root","123456","v2_Adventure");
            	if( mysqli_connect_errno() ){
            		echo "Fail to connect to MySQL: " . mysqli_connect_errno();
            	} 
                
                $sql = "select uid from login where uid = '$_POST[username]'";
                $result = mysqli_query( $con,$sql );
                $num = mysqli_num_rows( $result );
                if( $num ) 
                {  
                	mysqli_close($con);
                    echo "<script>alert('the username has been used,please select another one :-)'); history.go(-1);</script>";  
                }  
                else
                {   /* here can be improved to use a procedure to ensure the consistancy of the two sql, TBD */
                    $user_insert = "insert into user (uid,uname,age,city,email) values('$_POST[username]','$_POST[nickname]','$_POST[age]','$_POST[city]','$_POST[email]')";  
                    $res_user_insert = mysqli_query( $con,$user_insert );  
                    $login_insert = "insert into login (uid,pwd,lastlogin) values('$_POST[username]','$_POST[password]','')";  
                    $res_login_insert = mysqli_query( $con,$login_insert );
                    
                    if( $res_user_insert && $res_login_insert )  
                    {  
                    	mysqli_close($con);
                        echo "<script>alert('register success'); history.go(-1);</script>";
                        header("Location:login.php");  
                    }  
                    else  
                    {  
                    	mysqli_close($con);
                        echo "<script>alert('error, please try again'); history.go(-1);</script>";  
                    }  
                }  
            }  
            else  
            {  
            	mysqli_close($con);
                echo "<script>alert('the two passwords are not the same!'); history.go(-1);</script>";  
            }  
        }  
    }  
    else  
    {  
        echo "<script>alert('submit failed!'); history.go(-1);</script>";  
    }
?>
