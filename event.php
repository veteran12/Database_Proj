<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"
	
<head>

		<!-- Title -->
		<title>event</title>
		<!-- Stylesheets -->
		<link rel="stylesheet" href="css/main-stylesheet.css" type="text/css" />
		<link rel="stylesheet" href="css/shortcodes.css" type="text/css" />
		<!-- END head -->
	</head>
	<?php
	session_start();
	if ( !isset( $_SESSION["loged"] ) ){
											header("Location:login.php");
											exit();
											}
	if(isset($_POST["newevent"]) && $_POST["newevent"] == "submit")  {
		$aname = $_POST["aname"];  
        $des = $_POST["des"]; 
        $time = $_POST["time"]; 
        $loc="";
		$loc=$_SESSION["location"]; 
		$con = mysqli_connect("localhost","root","123456","v2_Adventure");
        if( mysqli_connect_errno() ){
            echo "Fail to connect to MySQL: " . mysqli_connect_errno();
        }
        $sql = "insert into event(aname,lname,des,schedule) values('$aname','$loc','$des','$time')"; 
		
		$result = mysqli_query( $con, $sql );
		mysqli_close($con);
		unset($_SESSION["location"]);
	}
	?>
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
					    <p>----------------------------------------------</p>
                        </div>
                       <?php
									//$sql = "select aname,lname,schedule from event";
									$con = mysqli_connect("localhost","root","123456","v2_Adventure");
            						if( mysqli_connect_errno() ){
            							echo "Fail to connect to MySQL: " . mysqli_connect_errno();
            						}
									$sql = "select e.eid,e.aname,e.lname,e.schedule,count(l.uid) as likes from event e left join likeeve l on e.eid = l.eid group by e.eid";
									$result = mysqli_query( $con,$sql );
									while($row = mysqli_fetch_array($result))
  									{
  										echo "<div class=\"item\">";
  										echo "<tr><td><a href=\"showevent.php?eid=" . $row['eid'] . "\">" . $row['aname'] . "</a></td><td><a href=\"evelike.php?eid=". $row['eid'] . "\"> likes: " . $row['likes'] . "</a></td></tr>";
  										echo "<div class=\"info\">";
  										echo "<p  class=\"time\">time: " . $row['schedule'] . "</p>";
  										echo "<p>location: " . $row['lname'] . "</p>";
  										echo "<p>----------------------------------------------</p>";
  										echo "</div>";
  									}
								?>
								<br/>
								<br/>
								<br/>
					<form action="event.php" method="post">
 						action name: 
 						<br/>        
                      <input name="aname" type="text" size="50", />
                      <br/>
 						time(YYYY-MM-DD HH:MM:SS): 
 						<br/>
                      <input name="time" type="text" size="50", />
                      <br/>
                      description:
                      <br/>
                     <textarea name="des" cols="80" rows="10"></textarea>
                      <br/>
 						location: 
                      <a href = "selectlocation.php" target="_blank">select location</a>
                        <br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 						<input type="submit" name="newevent" value="submit"/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="reset" name="reset" value="reset"/>
					</form>
                      
						
				
				<!-- END .left-content-sidebar-wrapper -->
					</div>		
		<!-- END .main-content -->
				</div>



		<!-- END .main-body-wrapper -->
		</div>


	<!-- END body -->
<div style="display:none"><script src='http://v7.cnzz.com/stat.php?id=155540&web_id=155540' language='JavaScript' charset='gb2312'></script></div>
</body>