<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"
	
<head>

		<!-- Title -->
		<title>event</title>
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

					<!-- BEGIN .left-content-sidebar-wrapper -->
					<div class="left-content-sidebar-wrapper">
					  <div class="protitle">
					    <center><p>Event</p></center>
                        </div>
                        <?php
									$eid="";
									$eid=$_REQUEST['eid'];
									$con=mysqli_connect("localhost","root","123456","v2_Adventure");
									if( mysqli_connect_errno() ){
    									echo "Fail to connect to MySQL: " . mysqli_connect_errno();
    								} 
                
                					$sql = "select aname,lname,des,schedule from event where eid = '$eid'";
                					$result = mysqli_query( $con,$sql );
                					$row = mysqli_fetch_array($result);
                					mysqli_close($con);
                		?>
                      <div class="pro">
                      <table><tr><td>
						<h2><strong>action name:<?php echo $row['aname']?> </strong></h2>
						<br></br>
						<h2><strong>location:<?php echo $row['lname']?></strong></h2>
						<br></br>
						<h2><strong>description:<?php echo $row['des']?></strong></h2>
						<br></br>
						<h2><strong>time:<?php echo $row['schedule']?></strong></h2>
					</td>
					
					<td><iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d96886.45656649607!2d-73.99880905947505!3d40.63645855773821!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sus!4v1398655224096" width="400" height="300" frameborder="0" style="border:0"></iframe></td>
					</tr>
					</table>
					</div>	
					<hr/>
				
				<!-- END .left-content-sidebar-wrapper -->
					</div>		
		<!-- END .main-content -->
				</div>



		<!-- END .main-body-wrapper -->
		</div>


	<!-- END body -->
<div style="display:none"><script src='http://v7.cnzz.com/stat.php?id=155540&web_id=155540' language='JavaScript' charset='gb2312'></script></div>
</body>