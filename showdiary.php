<?php
	session_start();
	$did="";
	$did=$_REQUEST['did'];
	if($did == "")
		$did = $_POST["did"];
	$con=mysqli_connect("localhost","root","123456","v2_Adventure");
	if( mysqli_connect_errno() ){
    	echo "Fail to connect to MySQL: " . mysqli_connect_errno();
    }
    
    if(isset($_POST["submitcomment"]) && $_POST["submitcomment"] == "newcomment") {
    	$pdid = $_POST["did"];
    	$pcontent = $_POST["content"];
    	$puid = $_SESSION["loged"]; 
    	$ptime = date("Y-m-d H:i:s");
    	$psql = "insert into dcomment(did,uid,time,content) values('$pdid','$puid','$ptime','$pcontent')";
    	$result = mysqli_query( $con,$psql );
    	if ($result == false){
    		echo "Fail to post comment!";
    	}
    } 
    $uid = $_SESSION["loged"];           
    //$sql = "select title,posttime,content,uid from diary where did = '$did'";
    $sql = "select title,posttime,content,uid,auth,lname from (select a.did,a.title,a.posttime,a.content,a.uid,a.auth,b.lname from diary a left join dialoc b on a.did=b.did)c where c.did='$did'";
    $result = mysqli_query( $con,$sql );
    $row = mysqli_fetch_array( $result );
    /* auth control */
    $num = $row['auth'];
    $tmpid = $row['uid'];
    if( $num == 2){
    	if($uid != $tmpid){
    	mysqli_close($con);
       	echo "<script>alert('no permission!');history.go(-1);</script>";
       	//header("Location:welcome.php");
       	exit;
    	}
    }else if($num == 3){
    	$sql = "select tmp from (select reqname as tmp from friend where accname= '$tmpid' union select accname as tmp from friend where reqname='$tmpid')a where a.tmp = '$uid'";
    	$result = mysqli_query( $con,$sql );                				
              
        if ( $result -> num_rows == 0 ) {
			echo "<script>alert('no permission!');history.go(-1);</script>";
			//echo "<script>alert('login error!');history.go(-1);</script>";
       		//header("Location:welcome.php");
       		exit;
		}
    }else if($num == 4){
    	$sql1 = "select tmp from (select reqname as tmp from friend where accname= '$tmpid' union select accname as tmp from friend where reqname='$tmpid')a where a.tmp = '$uid'";
    	/*$sql2 = "select tmp from (select distinct(reqname) as tmp from friend where accname in (select reqname as reqname from friend where accname='$tmpid')
				 					union
				 					(select accname as reqname from friend where reqname='$tmpid')
				 				union
								select distinct(accname) as tmp from friend where reqname in (select reqname as reqname from friend where accname='$tmpid')
									union
									(select accname as reqname from friend where reqname='$tmpid'))a where a.tmp = '$uid'";*/
		
		$sql2 = "select tmp from (select distinct(reqname) as tmp from friend a join ((select reqname as tmp1 from friend where accname='$tmpid')
union
(select accname as tmp1 from friend where reqname='$tmpid'))b on a.accname=b.tmp1
union
select distinct(accname) as tmp from friend c join ((select reqname as tmp2 from friend where accname='$tmpid')
union
(select accname as tmp2 from friend where reqname='$tmpid'))d on c.reqname = d.tmp2) e where e.tmp='$uid'";
		
		$result1 = mysqli_query( $con,$sql1 );
		$result2 = mysqli_query( $con,$sql2 );
		if( $result1 ->num_rows == 0 && $result2 ->num_rows == 0 ){
			echo "<script>alert('no permission!');history.go(-1);</script>";
       		//header("Location:welcome.php");
       		exit;
		}
    }
   
    
?>	
<head>

		<!-- Title -->
		<title><?php echo $did . "diary"?></title>
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
                  <!-- show diary -->
                  <div class = "diary">
                  <div class="col-1">
					<table><tr><p><b><?php echo $row['title'] . "@" . $row['lname']?></b></p></tr>
					<br/>
					<tr><p><?php echo $row['content'] ?></p></tr>
                    </table>
                    </div>
                  </div>
                  
                  <!-- show photo -->
                  <table border=1>
                  <?php
                  	$sql = "select mid,content from multimedia where did = '$did'";
                  	$result = mysqli_query( $con, $sql );  
                  	if($result -> num_rows > 0){
                  		while($row = mysqli_fetch_array($result))
  						{
  							echo "<tr>";
							echo "<td><img src=\"getimage.php?mid=" . $row['mid'] . "\"></td>";
							echo "</tr>";				
  						}
                  	}
                  ?>
                  </table>
                  
                  <!--add comment -->
                  <form action="showdiary.php" method="post">
                  	<textarea name="content" cols="80" rows="5"></textarea>
 						<br/>
 					<input type="hidden" name="did" value="<?php echo $did; ?>">
 					<input type="submit" name="submitcomment" value="newcomment"/>
                  </form>
                  
                  
                  <!-- show comments -->
                  <div class = "comment">
                  	<?php
                  		$sql = "select uid,time,content from dcomment where did = '$did'";
                  		$result = mysqli_query( $con,$sql );
    					if ( $result -> num_rows == 0 ) {
										echo "<p>no comment yet!</p>";
               					   }
               					   else{
               					    	while($row = mysqli_fetch_array($result))
  										{
  											echo "<div class=\"item\">";
  											echo "<div class=\"info\">";
  											echo "<p class=\"time\">" . $row['uid'] . "@" . $row['time'] . "</p>";
  											echo "</div>";
  											echo "<p class=\"intro\">" . $row['content'] . "</p>";
  											echo "</div>";
  										}
                           		
               			}
               			mysqli_close($con);
                  	?>
                  </div>
                  
                  
			    <!-- END .main-content -->
				</div>
			<!-- END .main-body-wrapper -->
		</div>

	<!-- END body -->
</body>
