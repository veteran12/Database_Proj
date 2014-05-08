<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"
<?php	session_start();
 
 if(isset($_POST["newlocation"]) && $_POST["newlocation"] == "submit")  
    {  
        $lname = $_POST["lname"];  
        $longti = $_POST["longti"];
        $lati = $_POST["lati"]; 
        $uid="";
		$uid=$_SESSION["loged"]; 
        if( $longti == "" || $lname == "" || $lati == "" )  
        {  
            echo "<script>alert('name, longtitude and latitude can not be empty!'); history.go(-1);</script>";  
        }  
        else  
        {  
            $con = mysqli_connect("localhost","root","123456","v2_Adventure");
            if( mysqli_connect_errno() ){
            	echo "Fail to connect to MySQL: " . mysqli_connect_errno();
            }
            $sql = "insert into location(uid,lname,longitude,latitude) values('$uid','$lname','$longti','$lati')";
            $result = mysqli_query( $con, $sql );    
            if( $result )  
            {  
                echo "<script>alert('new location success!');history.go(-1);</script>"; 
                mysqli_close($con);  
            }  
            else  
            {  
            	mysqli_close($con);
                echo "<script>alert('post error!');history.go(-1);</script>";  
            }
            header("Location:location.php");  
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
					<div class = "map">
						<table>
						<tr><td><form action="location.php" method="post">
 						name:         
                      <input name="lname" type="text" size="50", />
                      <br/>
 						longtitude: 
                      <input name="longti" type="text" size="50", />
                      <br/>
 						latitude: 
                      <input name="lati" type="text" size="50", />
                      <br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 						<input type="submit" name="newlocation" value="submit"/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="reset" name="reset" value="reset"/>
					</form></td>
							<td><iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d96886.45656649607!2d-73.99880905947505!3d40.63645855773821!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sus!4v1398655224096" width="400" height="300" frameborder="0" style="border:0"></iframe></td>
						</tr>
						</table>
					</div>		
		<!-- END .main-content -->
				</div>
		<!-- END .main-body-wrapper -->
		</div>
		<div class = "listlocation">
			<p>Location List </p>
			<?php 
			$con = mysqli_connect("localhost","root","123456","v2_Adventure");
            if( mysqli_connect_errno() ){
            	echo "Fail to connect to MySQL: " . mysqli_connect_errno();
            }
            $sql = "select lname,longitude,latitude from location";
            $result = mysqli_query( $con, $sql );    
            if ( $result -> num_rows == 0 ) {
				echo "<p>no diary post yet!</p>";
            }
            else{
               while($row = mysqli_fetch_array($result))
  			   {
  					echo "<tr><td>" . $row['lname'] . "</td><td>  longitude:" . $row['longitude'] . "</td><td>  latitude:" . $row['latitude'] . "</td></tr>";
  				}                		
           }
		   mysqli_close($con);
            ?>  
		</div>

	<!-- END body -->
<div style="display:none"><script src='http://v7.cnzz.com/stat.php?id=155540&web_id=155540' language='JavaScript' charset='gb2312'></script></div>
</body>