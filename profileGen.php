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
					  
                        <?php
									session_start();
									$self="";
									$self=$_SESSION["loged"];
									$uid = $_REQUEST['id'];
									$con=mysqli_connect("localhost","root","123456","v2_Adventure");
									if( mysqli_connect_errno() ){
            							echo "Fail to connect to MySQL: " . mysqli_connect_errno();
            						} 
                
                					$sql = "select uid,uname,age,city,email,auth from user where uid = '$uid'";
                					$result = mysqli_query( $con,$sql );
                					$row = mysqli_fetch_array($result);
                					/* auth control */
    $num = $row['auth'];
    //$tmpid = $row['uid'];
    if( $num == 2){
    	if($uid != $self){
    	mysqli_close($con);
       	echo "<script>alert('no permission!');history.go(-1);</script>";
       	//header("Location:welcome.php");
       	exit;
    	}
    }else if($num == 3){
    	$sql = "select tmp from (select reqname as tmp from friend where accname= '$uid' union select accname as tmp from friend where reqname='$uid')a where a.tmp = '$self'";
    	$result = mysqli_query( $con,$sql );                				
              
        if ( $result -> num_rows == 0 ) {
			echo "<script>alert('no permission!');history.go(-1);</script>";
			//echo "<script>alert('login error!');history.go(-1);</script>";
       		//header("Location:welcome.php");
       		exit;
		}
    }else if($num == 4){
    	$sql1 = "select tmp from (select reqname as tmp from friend where accname= '$uid' union select accname as tmp from friend where reqname='$uid')a where a.tmp = '$self'";
    	/*$sql2 = "select tmp from (select distinct(reqname) as tmp from friend where accname in (select reqname as reqname from friend where accname='$uid')
				 					union
				 					(select accname as reqname from friend where reqname='$uid')
				 				union
								select distinct(accname) as tmp from friend where reqname in (select reqname as reqname from friend where accname='$uid')
									union
									(select accname as reqname from friend where reqname='$uid'))a where a.tmp = '$self'";*/
		$sql2 = "select tmp from (select distinct(reqname) as tmp from friend a join ((select reqname as tmp1 from friend where accname='$uid')
union
(select accname as tmp1 from friend where reqname='$uid'))b on a.accname=b.tmp1
union
select distinct(accname) as tmp from friend c join ((select reqname as tmp2 from friend where accname='$uid')
union
(select accname as tmp2 from friend where reqname='$uid'))d on c.reqname = d.tmp2) e where e.tmp='$self'";
		
		
		
		$result1 = mysqli_query( $con,$sql1 );
		$result2 = mysqli_query( $con,$sql2 );
		if( $result1 ->num_rows == 0 && $result2 ->num_rows == 0 ){
			echo "<script>alert('no permission!');history.go(-1);</script>";
       		//header("Location:welcome.php");
       		exit;
		}
    }
                					
                					
                					$sql = "select uid,uname,age,city,email,auth from user where uid = '$uid'";
                					$result = mysqli_query( $con,$sql );
                					$row = mysqli_fetch_array($result);
                		?>
                		<div class="protitle">
					    <center><p>Profile</p></center>
                        </div>
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