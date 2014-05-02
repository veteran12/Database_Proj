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

		<!-- JavaScripts -->
		<script src="js/jquery.min.js" type="text/javascript"></script>
		<script src="js/jquery.placeholder.min.js" type="text/javascript"></script>
		<script src="js/jquery.sexyslider-blog.js" type="text/javascript"></script>
		<script src="js/cufon-yui.js" type="text/javascript"></script>
		<script src="js/cufon-replace.js" type="text/javascript"></script>
		<script src="js/prima.font.js" type="text/javascript"></script>
		<script src="js/artpost.font.js" type="text/javascript"></script>
		<script src="js/jquery.cookie.js" type="text/javascript"></script>
		<script src="js/scripts.js" type="text/javascript"></script>
		<script type="text/javascript">
			jQuery(document).ready(function($){
				$("#blog-slider").SexySlider({
					autopause  : true,
					auto       : true,
					strips : 10,										 
					direction : 'left', 
					effect : 'wave', 
					onTitleHide     : function() { Cufon.replace('.sexyslider-title a', { textShadow: '#3e0000 0 1px', hover: 'true' } ); } 				
				});
			});
		</script>
		<script type="text/javascript">
		jQuery(document).ready(function($){
		  $.fn.shuffle = function() {
		    return this.each(function(){
		      var items = $(this).children();
		      return (items.length)
		        ? $(this).html($.shuffle(items))
		        : this;
		    });
		  }
		 
		  $.shuffle = function(arr) {
		    for(
		      var j, x, i = arr.length; i;
		      j = parseInt(Math.random() * i),
		      x = arr[--i], arr[i] = arr[j], arr[j] = x
		    );
		    return arr;
		  }
		});
		
		jQuery(document).ready(function($){
			$('.bg-swicher').click(function() {
				var title = jQuery(this).attr("id");
				$(".bg-swicher").removeClass("active");
				jQuery(this).addClass("active");
				
				
					if ( title == "random" ) { 
						var images = ['guitars', 'keyboards', 'drums', 'mics', 'turntable']
						images = $.shuffle(images);
						$("#bg-img").attr('class', "deco-"+images[1]);
					} else { 
						$("#bg-img").attr('class', "deco-"+title);
					}

				$.cookie('rockstar-bg-img', title, { expires: 7, path: '/', domain: window.location.host});
				
			});
			
			if ( $.cookie('rockstar-bg-img') ) {
				$(".bg-swicher").removeClass("active");
				$("#"+$.cookie('rockstar-bg-img')).addClass("active");
			} else {
				$("#guitars").addClass("active");
			}
			
		});
		
		jQuery(document).ready(function($){
			if ( $.cookie('rockstar-bg-img')) {
				$("#bg-img").attr('class', "deco-"+$.cookie('rockstar-bg-img'));
			}
		});
		</script>
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

						<!-- BEGIN .left-content -->
						<div class="left-content">

							<!-- BEGIN .blog-list -->
							<div class="blog-list">

							<!--	<div class="item">
									<h2><a href="#">Maecenas lacus nunc rutrum vitae phaaretra imperdiet</a></h2>
									<div class="info">
										<a href="#" class="time">John Smith @ 09.07.2011</a>
										<a href="#" class="section">Section</a>
										<a href="#" class="comment-nr">9 comments</a>
									</div>
									<a href="#"><img src="images/image-overlay-520x170.png" alt="" width="520" height="195" style="background: url(images/photos/photo-17.jpg) 0 0 no-repeat;" /></a>
									<p class="intro">Maecenas neque est, feugiat quis porta in, condimentum eget arcu. Maecenas fringilla aliquam ultricies. Pellentesque vel turpis nec leo tincidunt sollicitudin ac non risus. Ves tibu lum ultrices feugiat velit, quis tincid unt velit volutpat nec. Vivamus pharetra fringilla augue, a elementum ante ultrices tincidunt. Ut mi ligula, interdum ut pharetra.</p>
									<p><a href="#" class="more-link"><span>Read more</span></a></p>
								</div> -->

								<?php
									/*$cname="";
									$cname=test_input($_REQUEST['name']);*/
									$con=mysqli_connect("localhost","root","123456","v2_Adventure");
									if( mysqli_connect_errno() ){
            							echo "Fail to connect to MySQL: " . mysqli_connect_errno();
            						} 
                
                					/*$sql = "select title,posttime,content,uid from diary";*/
                					$sql = "select * from (select d.did, d.uid, d.title, d.posttime, d.content, count(l.uid) as likes 
																										from diary d left join likedia l on d.did = l.did group by l.did)m natural join
											(select c.did, count(d.cid) as comments from diary c left join dcomment d on c.did = d.did group by c.did)n order by posttime desc;";
                					$result = mysqli_query( $con,$sql );
               					    
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