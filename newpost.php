<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"
<?php
	session_start();
	if ( !isset( $_SESSION["loged"] ) ){
											header("Location:login.php");
											exit();
											}
 
 if(isset($_POST["submitpost"]) && $_POST["submitpost"] == "newpost")  
    {  
        $title = $_POST["title"];  
        $content = $_POST["content"]; 
        $uid="";
		$uid=$_SESSION["loged"]; 
		$auth = $_POST["auth"]; 
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
            $sql = "select max(did) as didtmp from diary";
            $result = mysqli_query( $con, $sql );
            $row = mysqli_fetch_array($result);
            $did = $row['didtmp']+1;
            $sql = "insert into diary(did,title,posttime,content,uid,auth) values('$did','$title','$posttime','$content','$uid','$auth')";
            $result = mysqli_query( $con, $sql );
            
            if( $result )  
            {  
                echo "<script>alert('new post success!');history.go(-1);</script>";   
            }  
            else  
            {  
            	mysqli_close($con);
                echo "<script>alert('post error!');history.go(-1);</script>";  
            }
            
            /* processing photo upload as binary code and saved in mysql */
            if (isset($_FILES["photo"]) && $_FILES["photo"]['size']) {
        		$date = date('Y-m-d H:i:s');
        		$fp = fopen($_FILES["photo"]['tmp_name'], 'rb');
        		if (!$fp) {
            		echo "photo upload error";
        		} else {
            		$image = addslashes(fread($fp, filesize($_FILES["photo"]['tmp_name'])));
                	$sql = "insert into multimedia ( did, content, uid, uploadtime) values ('$did','$image','$uid','$date')";
                	$result = mysqli_query( $con, $sql );
                	/*if ($result) {
                		echo "photo upload success!";
                	} else {
                		echo "photo upload error!";
                	}*/
        		}    
            }
            if (isset($_FILES["video"]) && $_FILES["video"]['size']) {
        		$date = date('Y-m-d H:i:s');
        		$fp = fopen($_FILES["video"]['tmp_name'], 'rb');
        		if (!$fp) {
            		echo "video upload error";
        		} else {
            		$video = addslashes(fread($fp, filesize($_FILES["video"]['tmp_name'])));
                	$sql = "insert into multimedia ( did, content, uid, uploadtime) values ('$did','$video','$uid','$date')";
                	$result = mysql_query($sql);
                	if ($result) {
                    	echo "video upload success!";
                	} else {
                    	echo "video upload error!";
                	}
        		}    
            }
            //add location
            if(isset($_SESSION["location"])){
            	$locationtmp = $_SESSION["location"];
            	$sql = "insert into dialoc values('$did','$locationtmp')";
            	$result = mysqli_query( $con, $sql );
            	unset($_SESSION["location"]);
            }
            mysqli_close($con);
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
					<form enctype="multipart/form-data" action="newpost.php" method="post">
 						title:
                        <br/>       
                      <input name="title" type="text" size="110" />
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
 						content: 
                        <br/>
                      <textarea name="content" cols="80" rows="20"></textarea>
 						<br/>
                        Photo:<input name="photo" type="file" />
                        <br/>
                        Video:<input name="video" type="file"/>
                        <br/>
                        <a href = "selectlocation.php" target="_blank">select location</a>
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
</body>
