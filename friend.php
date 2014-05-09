<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"
	
<head>

		<!-- Title -->
		<title>friend</title>
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
										<li><a href="friend.php">Friend</a></li>
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
					    <center><p>Your friends</p></center>
                        </div>
                        <?php
                        session_start();
						$uid = "";
						$uid = $_SESSION["loged"];
									$sql1 = "select reqname as tmp from friend where accname='$uid' union select accname as tmp from friend where reqname='$uid'"; 
								$con = mysqli_connect("localhost","root","123456","v2_Adventure");
    							if( mysqli_connect_errno() ){
    								echo "Fail to connect to MySQL: " . mysqli_connect_errno();
    							}
    							$result = mysqli_query( $con, $sql1 );
    							if ( $result -> num_rows != 0 ) {
										
         						 while($row = mysqli_fetch_array($result))
  								{
  									echo "<div class=\"item\">";
  					echo "<table><tr><td><h2><a href=\"profileGen.php?id=" . $row['tmp'] . "\">" . $row['tmp'] . "</a></h2></td>";
  					
  					echo "</div>";								
  								}
                           		
    							}
    							mysqli_close($con);
    
                		?>
                      
							<!-- END .blog-list -->
							</div>
					
				<!-- END .left-content -->
				</div>
				
				<!-- END .left-content-sidebar-wrapper -->
					</div>		
		<!-- END .main-content -->
				</div>



		<!-- END .main-body-wrapper -->
		</div>


	<!-- END body -->
<div style="display:none"><script src='http://v7.cnzz.com/stat.php?id=155540&web_id=155540' language='JavaScript' charset='gb2312'></script></div>
</body>