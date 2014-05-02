<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"
	
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

					<!-- BEGIN .left-content-sidebar-wrapper -->
					<div class="left-content-sidebar-wrapper">
					  <div class="protitle">
					    <center><p>Profile</p></center>
                        </div>
                        <?php
									session_start();
									$uid="";
									$uid=$_SESSION["loged"];
									$con=mysqli_connect("localhost","root","123456","v2_Adventure");
									if( mysqli_connect_errno() ){
            							echo "Fail to connect to MySQL: " . mysqli_connect_errno();
            						} 
                
                					$sql = "select uname,age,city,email from user where uid = '$uid'";
                					$result = mysqli_query( $con,$sql );
                					$row = mysqli_fetch_array($result);
                		?>
                      <div class="pro">
						<h2><strong>nickname:<?php echo $row['uname']?> </strong></h2>
						<br></br>
						<h2><strong>age:<?php echo $row['age']?></strong></h2>
						<br></br>
						<h2><strong>city:<?php echo $row['city']?></strong></h2>
						<br></br>
						<h2><strong>email:<?php echo $row['email']?></strong></h2>
					</div>
					<hr/>
						<!-- BEGIN .left-content -->
<div class="left-content">

							<!-- BEGIN .blog-list -->
							<div class="blog-list">
								<?php
                
                					/*$sql = "select title,posttime,content,uid from diary";*/
                					$sql = "select * from (select * from (select d.did, d.uid, d.title, d.posttime, d.content, count(l.uid) as likes 
																										from diary d left join likedia l on d.did = l.did group by l.did)m natural join
											(select c.did, count(d.cid) as comments from diary c left join dcomment d on c.did = d.did group by c.did)n order by posttime desc)v where uid='$uid';";
								   $result = mysqli_query( $con,$sql );                				
              
               					   if ( $result == false ) {
										echo "<p>no diary post yet!</p>";
               					   }
               					   else{
               					    	while($row = mysqli_fetch_array($result))
  										{
  											echo "<div class=\"item\">";
  											echo "<h2><a href=\"#\">" . $row['title'] . "</a></h2>";
  											echo "<div class=\"info\">";
  											echo "<a href=\"#\" class=\"time\">" . $row['uid'] . "@" . $row['posttime'] . "</a>";
  											echo "<a href=\"like.php?did=" . $row['did'] . "\"> likes: " . $row['likes'] . "</a>";
  											echo "<a> comments: " . $row['comments'] . "</a>"; 
  											echo "</div>";
  											echo "<p class=\"intro\">" . $row['content'] . "</p>";
  											echo "<p><a href=\"\" class=\"more-link\"><span>Read more</span></a></p>";
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