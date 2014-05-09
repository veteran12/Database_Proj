<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"
	
<head>

		<!-- Title -->
		<title>message</title>
		<!-- Meta Tags -->
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />

		<!-- Favicon -->
		<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />

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
										<?php
											session_start();
											$uid =  $_SESSION["loged"];
											$con=mysqli_connect("localhost","root","123456","v2_Adventure");
											if( mysqli_connect_errno() ){
            									echo "Fail to connect to MySQL: " . mysqli_connect_errno();
            									mysqli_close($con);
            								}
            								
            								$sql = "select following,followed from friendreq where followed = '$uid'";
            								$result = mysqli_query( $con,$sql );

               					   			if ( $result -> num_rows != 0 ) {
               					   			
												
										echo "<li><a href=\"information.php\"><div id=\"blink\">new message</div></a></li>";
										echo "<script language=\"javascript\">
												function changeColor(){var color=\"red|black\";
												color=color.split(\"|\");
												document.getElementById(\"blink\").style.color=color[parseInt(Math.random() * color.length)];}
												setInterval(\"changeColor()\",200);
												</script> ";
               					   			}
										?> 
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

						<!-- BEGIN .left-content -->
						<div class="left-content">

							<!-- BEGIN .blog-list -->
							<div class="blog-list">
								<?php
									while($row = mysqli_fetch_array($result))
  									{
  										echo "<div class=\"item\">";
  										echo "<p>" . $row['following'] . "</p>";
  										echo "<table><tr><td><form action=\"accept.php\" method=\"post\"><input type=\"hidden\" name=\"following\" value=\"" . $row['following'] . "\" /><input type=\"submit\" name=\"accept\" value =\"accept\"/></form></td>";
  										echo "<td><form action=\"deny.php\" method=\"post\"><input type=\"hidden\" name=\"following\" value=\"" . $row['following'] . "\" /><input type=\"submit\" name=\"deny\" value =\"deny\"/></form></td></tr></table>";
  										echo "</div>";
  									}
									mysqli_close($con);
								?>

							<!-- END .blog-list -->
							</div>

							
						<!-- END .left-content -->
						</div>


						


					<!-- END .left-content-sidebar-wrapper -->
					</div>

					<div class="clear"></div>

					
				<!-- END .main-content -->
				</div>



		<!-- END .main-body-wrapper -->
		</div>


	<!-- END body -->
	
</body>
</html>