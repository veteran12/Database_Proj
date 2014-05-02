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
					<div class = "mayknow">
						<p>Maybe Know</p>
						
					</div>
<?php	
session_start();
 
 if(isset($_POST["search"]) && $_POST["search"] == "submit")  
    {  
        $uid = $_POST["uid"];  
        $name = $_POST["name"];
        $city = $_POST["city"];  
        $suid="";
		$suid=$_SESSION["loged"];
        $sql = "";
        if( $uid == "" && $name == "" && $city == "" )  
        {  
             $sql = "select uid,uname,city,age,email from (select * from user where uid not in(
				select reqname as uid from friend where accname = '$suid' union select accname as uid from friend where reqname = '$suid'))m where uid <> '$suid' ";
        }  
        else  
        {  
        	$sql = "select uid,uname,city,age,email from user where";
        	if ( $uid != "" ) {
        		$sql = $sql . " uid like '%$uid%' and";
        	}
        	if ( $name != "" ) {
        		$sql = $sql . " uname like '%$name%' and";
        	}
        	if ( $city != "" ) {
        		$sql = $sql . " city like '%$city%'";
        	}
        	 if ( substr($sql,-3) == "and" ){
        	 	$sql = substr($sql,0,-3);
        	 }
        }
        	
            $con = mysqli_connect("localhost","root","123456","v2_Adventure");
            if( mysqli_connect_errno() ){
            	echo "Fail to connect to MySQL: " . mysqli_connect_errno();
            }

            $result = mysqli_query( $con, $sql );    
            if( $result == false )  
            {  
                echo "<p>no friend found!</p>"; 
            }  
            else  
            {  
            	while($row = mysqli_fetch_array($result))
  				{
 					echo "<div class=\"item\">";
  					echo "<table><tr><td><h2><a href=\"profileGen.php?id=" . $row['uid'] . "\">" . $row['uid'] . "</a></h2></td>";
  					echo "<td><form action=\"addfriend.php\" method=\"post\"><input type=\"hidden\" name=\"reqid\" value=\"" . $row['uid'] . "\" /><input type=\"submit\" name=\"addfriend\" value =\"add\"/></form></td></tr></table>";
  					echo "<div class=\"info\">";
  					echo "<p class=\"time\">" . $row['age'] . "  " . $row['city'] . "</p>";
  					echo "</div>";
  					echo "</div>";
  				} 
            }
            /*echo $sql;*/
            mysqli_close($con);  
        }    
    
?>
					<div class = "map">
						<form action="search.php" method="post">
 						uid:         
                      <input name="uid" type="text" size="50", />
                      <br/>
 						name: 
                      <input name="name" type="text" size="50", />
                      <br/>
 						city: 
                      <input name="city" type="text" size="50", />
                      <br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 						<input type="submit" name="search" value="submit"/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="reset" name="reset" value="reset"/>
					</form>
					</div>		
		<!-- END .main-content -->
				</div>



		<!-- END .main-body-wrapper -->
		</div>


	<!-- END body -->
<div style="display:none"><script src='http://v7.cnzz.com/stat.php?id=155540&web_id=155540' language='JavaScript' charset='gb2312'></script></div>
</body>