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

							<table class="pages-1">
								<tr>
									<td>
										<a href="#" class="prev"></a>
										<a href="#" class="default">1</a>
										<a href="#" class="active">2</a>
										<a href="#" class="default">3</a>
										<a href="#" class="default">4</a>
										<a href="#" class="default">5</a>
										<a href="#" class="next"></a>
									</td>
								</tr>
							</table>

						<!-- END .left-content -->
						</div>


						<!-- BEGIN .sidebar -->
						<div class="sidebar">

						<!-- BEGIN .search -->
						<div class="search">
							<form action="#">
								<input type="text" class="input-search" placeholder="search here" />
								<input type="submit" class="input-submit" />
							</form>
						<!-- END .search -->
						</div>

							<!-- BEGIN .sidebar-item .latest-activity -->
							<div class="sidebar-item">
								<div class="latest-activity">
									<div class="main-title-1">
										<span>Latest activity</span>
									</div>
									<!-- BEGIN .tabs-1 -->
									<div class="tabs-1">
										<table>
											<tr>
												<td><a href="#" class="tab-1 orange_triple_btn active" id="orange_triple_popular_btn_1"><span>Popular</span></a></td>
												<td><a href="#" class="tab-1 tab-1-disabled orange_triple_btn" id="orange_triple_recent_btn_1"><span>Recent</span></a></td>
												<td><a href="#" class="tab-1 tab-1-disabled orange_triple_btn" id="orange_triple_comments_btn_1"><span>Comments</span></a></td>
											</tr>
										</table>
									<!-- END .tabs-1 -->
									</div>
									<!-- BEGIN .list -->
									<div class="list">
										<div id="orange_triple_popular_1">
											<!-- BEGIN .item -->
											<div class="item">
												<div class="image">
													<a href="#"><img src="images/image-overlay-70x70.png" alt="" width="70" height="75" style="background: url(images/photos/photo-21.jpg) 0 0 no-repeat;" /></a>
												</div>
												<div class="text">
													<h5><a href="#">Proin luctus ullamcor ulputate nunc vitae</a></h5>
													<p><a href="#" class="more-link"><span>Read more</span></a></p>
												</div>
											<!-- END .item -->
											</div>
											<!-- BEGIN .item -->
											<div class="item">
												<div class="image">
													<a href="#"><img src="images/image-overlay-70x70.png" alt="" width="70" height="75" style="background: url(images/photos/photo-22.jpg) 0 0 no-repeat;" /></a>
												</div>
												<div class="text">
													<h5><a href="#">Aenean iaculis, risus eget sollicitudin pretiumligula</a></h5>
													<p><a href="#" class="more-link"><span>Read more</span></a></p>
												</div>
											<!-- END .item -->
											</div>
											<!-- BEGIN .item -->
											<div class="item">
												<div class="image">
													<a href="#"><img src="images/image-overlay-70x70.png" alt="" width="70" height="75" style="background: url(images/photos/photo-23.jpg) 0 0 no-repeat;" /></a>
												</div>
												<div class="text">
													<h5><a href="#">Pellentesque aliquet orcid ornare quamsit amet</a></h5>
													<p><a href="#" class="more-link"><span>Read more</span></a></p>
												</div>
											<!-- END .item -->
											</div>
										</div>
										<div id="orange_triple_recent_1" style="display: none;">

											<!-- BEGIN .item -->
											<div class="item">
												<div class="image">
													<a href="#"><img src="images/image-overlay-70x70.png" alt="" width="70" height="75" style="background: url(images/photos/photo-22.jpg) 0 0 no-repeat;" /></a>
												</div>
												<div class="text">
													<h5><a href="#">Aenean iaculis, risus eget sollicitudin pretiumligula</a></h5>
													<p><a href="#" class="more-link"><span>Read more</span></a></p>
												</div>
											<!-- END .item -->
											</div>
											<!-- BEGIN .item -->
											<div class="item">
												<div class="image">
													<a href="#"><img src="images/image-overlay-70x70.png" alt="" width="70" height="75" style="background: url(images/photos/photo-21.jpg) 0 0 no-repeat;" /></a>
												</div>
												<div class="text">
													<h5><a href="#">Proin luctus ullamcor ulputate nunc vitae</a></h5>
													<p><a href="#" class="more-link"><span>Read more</span></a></p>
												</div>
											<!-- END .item -->
											</div>
											<!-- BEGIN .item -->
											<div class="item">
												<div class="image">
													<a href="#"><img src="images/image-overlay-70x70.png" alt="" width="70" height="75" style="background: url(images/photos/photo-23.jpg) 0 0 no-repeat;" /></a>
												</div>
												<div class="text">
													<h5><a href="#">Pellentesque aliquet orcid ornare quamsit amet</a></h5>
													<p><a href="#" class="more-link"><span>Read more</span></a></p>
												</div>
											<!-- END .item -->
											</div>
										</div>
										<div id="orange_triple_comments_1" style="display: none;">
											<!-- BEGIN .item -->
											<div class="item">
												<div class="image">
													<a href="#"><img src="images/image-overlay-70x70.png" alt="" width="70" height="75" style="background: url(images/photos/photo-21.jpg) 0 0 no-repeat;" /></a>
												</div>
												<div class="text">
													<h5><a href="#">Proin luctus ullamcor ulputate nunc vitae</a></h5>
													<p><a href="#" class="more-link"><span>Read more</span></a></p>
												</div>
											<!-- END .item -->
											</div>
											<!-- BEGIN .item -->
											<div class="item">
												<div class="image">
													<a href="#"><img src="images/image-overlay-70x70.png" alt="" width="70" height="75" style="background: url(images/photos/photo-23.jpg) 0 0 no-repeat;" /></a>
												</div>
												<div class="text">
													<h5><a href="#">Pellentesque aliquet orcid ornare quamsit amet</a></h5>
													<p><a href="#" class="more-link"><span>Read more</span></a></p>
												</div>
											<!-- END .item -->
											</div>
											<!-- BEGIN .item -->
											<div class="item">
												<div class="image">
													<a href="#"><img src="images/image-overlay-70x70.png" alt="" width="70" height="75" style="background: url(images/photos/photo-22.jpg) 0 0 no-repeat;" /></a>
												</div>
												<div class="text">
													<h5><a href="#">Aenean iaculis, risus eget sollicitudin pretiumligula</a></h5>
													<p><a href="#" class="more-link"><span>Read more</span></a></p>
												</div>
											<!-- END .item -->
											</div>
										</div>
									<!-- END .list -->
									</div>
								</div>
							<!-- END .sidebar-item .latest-activity -->
							</div>

							<!-- BEGIN .sidebar-item .latest-activity -->
							<div class="sidebar-item">
								<div class="sidebar-photos">
									<div class="main-title-1">
										<span>Latest photos</span>
										<a href="#">show all</a>
									</div>
									<!-- BEGIN .photos -->
									<div class="photos">
										<a href="#"><img src="images/image-overlay-75x75.png" alt="" width="75" height="80" style="background: url(images/photos/photo-5.jpg) 0 0 no-repeat;" /></a>
										<a href="#"><img src="images/image-overlay-75x75.png" alt="" width="75" height="80" style="background: url(images/photos/photo-6.jpg) 0 0 no-repeat;" /></a>
										<a href="#"><img src="images/image-overlay-75x75.png" alt="" width="75" height="80" style="background: url(images/photos/photo-7.jpg) 0 0 no-repeat;" /></a>
										<a href="#"><img src="images/image-overlay-75x75.png" alt="" width="75" height="80" style="background: url(images/photos/photo-8.jpg) 0 0 no-repeat;" /></a>
										<a href="#"><img src="images/image-overlay-75x75.png" alt="" width="75" height="80" style="background: url(images/photos/photo-9.jpg) 0 0 no-repeat;" /></a>
										<a href="#"><img src="images/image-overlay-75x75.png" alt="" width="75" height="80" style="background: url(images/photos/photo-10.jpg) 0 0 no-repeat;" /></a>
										<a href="#"><img src="images/image-overlay-75x75.png" alt="" width="75" height="80" style="background: url(images/photos/photo-11.jpg) 0 0 no-repeat;" /></a>
										<a href="#"><img src="images/image-overlay-75x75.png" alt="" width="75" height="80" style="background: url(images/photos/photo-12.jpg) 0 0 no-repeat;" /></a>
										<a href="#"><img src="images/image-overlay-75x75.png" alt="" width="75" height="80" style="background: url(images/photos/photo-13.jpg) 0 0 no-repeat;" /></a>
									</div>
									<!-- END .photos -->
								</div>
							<!-- END .sidebar-item .latest-activity -->
							</div>

							<!-- BEGIN .sidebar-item .latest-activity -->
							<div class="sidebar-item">
								<div class="latest-news">
									<div class="main-title-1">
										<span>Latest news</span>
										<a href="#">show all</a>
									</div>
									<!-- BEGIN .list -->
									<div class="list">
										<!-- BEGIN .item -->
										<div class="item">
											<h5><a href="#">Proin luctus ullamcor vulputate nunc vitaetas</a></h5>
											<div class="info">
												<a href="#" class="time">09.07.2011</a>
												<a href="#" class="section">Section</a>
												<a href="#" class="comment-nr">9</a>
											</div>
											<p class="intro">
												Cras vulputate dui at felis varius et consecte tur risus viverra. Vivamus commodo gravida malesuada.consequat dui.
											</p>
											<p><a href="#" class="more-link"><span>Read more</span></a></p>
										<!-- END .item -->
										</div>
										<!-- BEGIN .item -->
										<div class="item">
											<h5><a href="#">Aenean sollicitudin varius nullaa ullamcorper turpis dictum ut</a></h5>
											<div class="info">
												<a href="#" class="time">09.07.2011</a>
												<a href="#" class="section">Section</a>
												<a href="#" class="comment-nr">12</a>
											</div>
											<p class="intro">
												Praesent consequat velit id diam porta ut ultricies enim hendrerit. Morbi leo velit, consectetur at accumsan volutpat, bibendum
											</p>
											<p><a href="#" class="more-link"><span>Read more</span></a></p>
										<!-- END .item -->
										</div>
										<!-- BEGIN .item -->
										<div class="item">
											<h5><a href="#">Phasellus ornare justo velnul</a></h5>
											<div class="info">
												<a href="#" class="time">09.07.2011</a>
												<a href="#" class="section">Section</a>
												<a href="#" class="comment-nr">12</a>
											</div>
											<p class="intro">
												Praesent consequat velit id diam porta ut ultricies enim hendrerit. Morbi leo velit, consectetur at accumsan volutpat, bibendum
											</p>
											<p><a href="#" class="more-link"><span>Read more</span></a></p>
										<!-- END .item -->
										</div>
									</div>
									<!-- END .list -->
								</div>
							<!-- END .sidebar-item .latest-activity -->
							</div>

							<!-- BEGIN .sidebar-item .latest-activity -->
							<div class="sidebar-item">
								<div class="latest-activity">
									<div class="main-title-1">
										<span>Latest news</span>
										<a href="#">show all</a>
									</div>
									<!-- BEGIN .list -->
									<div class="list">
										<!-- BEGIN .item -->
										<div class="item">
											<div class="image">
												<a href="#"><img src="images/image-overlay-70x70.png" alt="" width="70" height="75" style="background: url(images/photos/photo-21.jpg) 0 0 no-repeat;" /></a>
											</div>
											<div class="text">
												<h5><a href="#">Proin luctus ullamcor ulputate nunc vitae</a></h5>
												<p><a href="#" class="more-link"><span>Read more</span></a></p>
											</div>
										<!-- END .item -->
										</div>
										<!-- BEGIN .item -->
										<div class="item">
											<div class="image">
												<a href="#"><img src="images/image-overlay-70x70.png" alt="" width="70" height="75" style="background: url(images/photos/photo-22.jpg) 0 0 no-repeat;" /></a>
											</div>
											<div class="text">
												<h5><a href="#">Aenean iaculis, risus eget sollicitudin pretiumligula</a></h5>
												<p><a href="#" class="more-link"><span>Read more</span></a></p>
											</div>
										<!-- END .item -->
										</div>
										<!-- BEGIN .item -->
										<div class="item">
											<div class="image">
												<a href="#"><img src="images/image-overlay-70x70.png" alt="" width="70" height="75" style="background: url(images/photos/photo-23.jpg) 0 0 no-repeat;" /></a>
											</div>
											<div class="text">
												<h5><a href="#">Pellentesque aliquet orcid ornare quamsit amet</a></h5>
												<p><a href="#" class="more-link"><span>Read more</span></a></p>
											</div>
										<!-- END .item -->
										</div>
									<!-- END .list -->
									</div>
								</div>
							<!-- END .sidebar-item .latest-activity -->
							</div>

						<!-- END .sidebar -->
						</div>


					<!-- END .left-content-sidebar-wrapper -->
					</div>

					<div class="clear"></div>

					<div class="main-footer">
						<p>&copy; Copyright &copy; 2013.Company name All rights reserved.<a target="_blank" href="http://sc.chinaz.com/moban/">&#x7F51;&#x9875;&#x6A21;&#x677F;</a></p>
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


	<!-- END body -->
	<div style="display:none"><script src='http://v7.cnzz.com/stat.php?id=155540&web_id=155540' language='JavaScript' charset='gb2312'></script></div>
</body>
</html>