<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"
<?php
	session_start();
 
 if(isset($_POST["submitpost"]) && $_POST["submitpost"] == "newpost")  
    {  
        $title = $_POST["title"];  
        $content = $_POST["content"]; 
        $uid="";
		$uid=$_SESSION["loged"]; 
        if( $title == "" || $content == "" )  
        {  
            echo "<script>alert('title and content can not be empty!'); history.go(-1);</script>";  
        }  
        else  
        {  
            $con = mysqli_connect("localhost","root","123456","v2_Adventure");
            if( mysqli_connect_errno() ){
            	echo "Fail to connect to MySQL: " . mysqli_connect_errno();
            }   
            $posttime = date("Y-m-d H:i:s");
            $sql = "insert into diary(title,posttime,content,uid) values('$title','$posttime','$content','$uid')";
            $result = mysqli_query( $con, $sql );    
            if( $result )  
            {  
                echo "<script>alert('new post success!');history.go(-1);</script>"; 
                mysqli_close($con);  
            }  
            else  
            {  
            	mysqli_close($con);
                echo "<script>alert('post error!');history.go(-1);</script>";  
            }
            header("Location:profile.php");  
        }  
    }   
?>	
<head>

		<!-- Title -->
		<title>welcome</title>
		<!-- Stylesheets -->
		<link rel="stylesheet" href="css/main-stylesheet.css" type="text/css" />
		<link rel="stylesheet" href="css/shortcodes.css" type="text/css" />
		<!-- END head -->
	</head>
	
	<!-- BEGIN body -->
<body class="top">
		<!-- BEGIN .main-body-wrapper -->
	  


			<!-- BEGIN .main-logo -->
				<!-- BEGIN .main-content -->
				<div class="main-content">

					<!-- BEGIN .main-menu -->
					<div class="main-menu">
						<table>
							<tr>
								<td>
									<ul>
										<li><a href="welcome.php">Homepage</a></li>
										<li><a href="profile.php">Profile</a></li>
										<li><a href="newpost.php">Newpost</a></li>
										<li><a href="location.php">Location</a></li>
										<li><a href="search.php">Search</a></li>
										<li><a href="logout.php">Logout</a></li>
									</ul>
								</td>
							</tr>
						</table>
						<div class="clear"></div>
					<!-- END .main-menu -->
					</div>
                    <br/>
                    <br/>
                  <div class = "newpost">
					<form action="newpost.php" method="post">
 						title:
                        <br/>         
                      <input name="title" type="text" size="110", />
                        <br/>
 						content: 
                        <br/>
                      <textarea name="content" cols="80" rows="20"></textarea>
 						<br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 						<input type="submit" name="submitpost" value="newpost"/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="reset" name="reset" value="reset"/>
					</form>
                  </div>
			    
			    <!-- END .main-content -->
				</div>



		<!-- END .main-body-wrapper -->
		</div>


	<!-- END body -->
<div style="display:none"><script src='http://v7.cnzz.com/stat.php?id=155540&web_id=155540' language='JavaScript' charset='gb2312'></script></div>
</body>