<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"
	
<head>

		<!-- Title -->
		<title>welcome</title>

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
										<li><a href="event.php">Event</a></li>
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
            								
            								$sql = "select * from friendreq where followed = '$uid'";
            								$result = mysqli_query( $con,$sql );

               					   			if ( $result -> num_rows != 0 ) {
               					   			
												
										echo "<li><a href=\"information.php\"><div id=\"blink\">new message</div></a></li>";
										echo "<script language=\"javascript\">
												function changeColor(){var color=\"red|black\";
												color=color.split(\"|\");
												document.getElementById(\"blink\").style.color=color[parseInt(Math.random() * color.length)];}
												setInterval(\"changeColor()\",200);
												</script> ";
										/*echo 	"function changeColor(){"; 
										echo	"var color=\"red|black\"; ";
										echo	"color=color.split("|"); ";
										echo	"document.getElementById(\"blink\").style.color=color[parseInt(Math.random() * color.length)];} ";
										echo	"}"; 
										echo "	setInterval(\"changeColor()\",200); ";
										echo "</script>";*/
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
							
								<!-- post event -->
								<?php
									//$sql = "select aname,lname,schedule from event";
									$sql = "select e.eid,e.aname,e.lname,e.schedule,count(l.uid) as likes from event e left join likeeve l on e.eid = l.eid group by e.eid";
									$result = mysqli_query( $con,$sql );
									while($row = mysqli_fetch_array($result))
  									{
  										echo "<div class=\"item\">";
  										echo "<h2><a href=\"showevent.php?eid=" . $row['eid'] . "\">" . $row['aname'] . "</a></h2>";
  										echo "<div class=\"info\">";
  										echo "<p  class=\"time\">schedule: " . $row['schedule'] . "</p>";
  										echo "<p>location: " . $row['lname'] . "</p>";
  										echo "<a href=\"evelike.php?eid=" . $row['eid'] . "\"> likes: " . $row['likes'] . "</a>";
  										echo "</div>";
  									}
								?>

								<!-- post diary -->
								<?php
									/*$cname="";
									$cname=test_input($_REQUEST['name']);* 
                					/*$sql = "select title,posttime,content,uid from diary";*/
                					$sql = "select * from (select d.did, d.uid, d.title, d.posttime, d.content, count(l.uid) as likes 
																										from diary d left join likedia l on d.did = l.did group by d.did)m natural join
											(select c.did, count(d.cid) as comments from diary c left join dcomment d on c.did = d.did group by c.did)n order by posttime desc;";
                					$result = mysqli_query( $con,$sql );
               					    
									while($row = mysqli_fetch_array($result))
  									{
  										echo "<div class=\"item\">";
  										echo "<h2><a href=\"showdiary.php?did=" . $row['did'] . "\">" . $row['title'] . "</a></h2>";
  										echo "<div class=\"info\">";
  										echo "<p  class=\"time\">" . $row['uid'] . "@" . $row['posttime'] . "</p>";
  										echo "<a href=\"like.php?did=" . $row['did'] . "\"> likes: " . $row['likes'] . "</a>";
  										echo "<a> comments: " . $row['comments'] . "</a>"; 
  										echo "</div>";
  										echo "<p class=\"intro\">" . $row['content'] . "</p>";
  										echo "<p><a href=\"showdiary.php?did=" . $row['did'] . "\" class=\"more-link\"><span>Read more</span></a></p>";
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

					<div class="main-footer">
						<div>
							<a href="#"><img src="images/ico-youtube-1.png" alt="YouTube" width="23" height="21" /></a>
							<a href="#"><img src="images/ico-facebook-1.png" alt="Facebook" width="23" height="21" /></a>
							<a href="#"><img src="images/ico-twitter-2.png" alt="Facebook" width="23" height="21" /></a>
							<a href="#"><img src="images/ico-flickr-2.png" alt="Facebook" width="23" height="21" /></a>
							<a href="#"><img src="images/ico-rss-1.png" alt="Facebook" width="23" height="21" /></a>
						</div>
					</div>

					

				<!-- END .main-content -->
				</div>



		<!-- END .main-body-wrapper -->
		</div>

</body>
</html>