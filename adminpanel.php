<?php

require_once('conn.php');

?>
<html>
<head><title>Naturebreeze | AdminPanel</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet"></head>
<body>
<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href=""><i class="fa fa-phone"></i> +95 9 970 530 668</a></li>
								<li><a href="mailto:kyawswarml@outlook.com"><i class="fa fa-envelope"></i> kyawswarml@outlook.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="https://www.facebook.com/happykyaw"><i class="fa fa-facebook"></i></a></li>
								<li><a href="http://www.twitter.com/4getab0utkiddi3"><i class="fa fa-twitter"></i></a></li>
								<li><a href=""><i class="fa fa-linkedin"></i></a></li>
								<li><a href=""><i class="fa fa-dribbble"></i></a></li>
								<li><a href="http://www.google.com/"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
        <div class="header-middle"><!--header-middle-->
			<div class="container">
				<?php 
	                if(!empty($_SESSION['aname'])){
	            ?>
				<div style="float:right; width: 100%; text-align: right; padding: 8px 0px; border-bottom: 1px solid lightgray;">
					
					<font color="#000" style="font-weight:bold;">Welcome Admin &nbsp;&nbsp;&nbsp;</font>
					<font color="orange"><?php echo $_SESSION['aname']; ?></font>
					
				</div>
				<?php
					}
				?>
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="adminpanel.php"><img src="images/home/logo.png" alt="" height="89" width="150" /></a>
						</div>
						<div class="btn-group pull-right">
							<div class="btn-group">
							 
							</div>
							
							<div class="btn-group">
							  
							</div>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
							
								<li><a href="aclist.php"><i class="fa fa-star"></i> Camera List</a></li>
								<li><a href="acentry.php"><i class="fa fa-crosshairs"></i> Camera Entry</a></li>
								<li><a href="aorder.php"><i class="fa fa-shopping-cart"></i> Order Reports</a></li>
								<li><a href="adminlogout.php" class="active"><i class="fa fa-lock"></i> Logout</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
           
<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
                	<!--features_items-->
                	<form action="aclist.php" method="post">
						<section id="cart_items">
							<div class="container">
								<style type="text/css">
									.itemc{
										width: 30%;
										float: left;
										border:1px solid lightgray;
										padding: 8px 2%;
										box-shadow: 1px 1px 2px lightgray;
										border-radius: 2px;
										margin-bottom: 30px;
									}
									.itemc_inter{
										width: 5%;
										float: left;
									}

									.itemc img{
										//width: 70%;
										height: 226px;
									}

									.btn_buy{
										padding: 6px 10px 5px 10px;
									    background-color: #FE980F;
									    border: 1px solid #E0E0E0;
									    color: white;
									    text-shadow: 1px 1px 2px #2B2B2B;
									    border-radius: 3px;
									}

									.img_block{
										width: 100%;
										overflow: hidden;
									}

									.title_c{
										margin-top: 10px;
									    margin-bottom: 20px;
									    padding: 5px 0 5px;
									    font-size: 20px;
									    font-weight: bold;
									    color: #565656;
									    background-color: whitesmoke;
									}
								</style>
								<div class="table-responsive cart_info" style="width:100%; float:left; border: 0;">
									
									<center class="title_c"> Top 3 Popular Camera Lists </center>
									<div style="width:100%; float:left; margin-top:10px;">
										<?php
											connect();
											$query=mysql_query("SELECT c.*,SUM(co.qty) as item_count FROM `camera_order` co JOIN camera c ON c.cid = co.cid GROUP BY co.cid ORDER BY item_count DESC LIMIT 0,3;")or die("Can't Select");
											$no = 0;
											while($row=mysql_fetch_array($query))
											{
												$no = $no + 1;
												$cid=$row['cid'];
												$photo=$row['photo'];
												$cbrandname=$row['cbrandname'];
												$cmodel=$row['cmodel'];
												$cprice=$row['cprice'];
												$cdate=$row['cdate'];
												$qty=$row['qty'];
												$item_count = $row['item_count'];
												
												$remain = $no%3;
												//var_dump($remain);
												if($remain != 0){
										?>
										<div class="itemc">
											<center class="img_block" style="border-bottom: 1px solid lightgray; padding-bottom: 20px;">
												<img src="photo/<?php echo $photo; ?>">
											</center>
											<div style="margin-top:10px; padding: 10px 20px; float:left;">
												<div style="float:left; width:100%; margin-bottom:10px;">
													<div style="float:left; width: 55%; font-weight:bold; padding:3px 0 3px 20px; color: #FE980F;">Brand</div>
													<div style="float:left; width: 45%; height: 20px;overflow: hidden;"><?php echo $cbrandname; ?></div>
												</div>
												<div style="float:left; width:100%; margin-bottom:10px;">
													<div style="float:left; width: 55%; font-weight:bold; padding:3px 0 3px 20px; color: #FE980F;">Model</div>
													<div style="float:left; width: 45%; height: 20px;overflow: hidden;"><?php echo $cmodel; ?></div>
												</div>
												<div style="float:left; width:100%; margin-bottom:10px;">
													<div style="float:left; width: 55%; font-weight:bold; padding:3px 0 3px 20px; color: #FE980F;">Price</div>
													<div style="float:left; width: 45%; height: 20px;overflow: hidden;">$<?php echo $cprice; ?></div>
												</div>
												<div style="float:left; width:100%; margin-bottom:10px;">
													<div style="float:left; width: 55%; font-weight:bold; padding:3px 0 3px 20px; color: #FE980F;">Release Date</div>
													<div style="float:left; width: 45%; height: 20px;overflow: hidden;"><?php echo $cdate; ?></div>
												</div>
												<div style="float:left; width:100%; margin-bottom:10px;">
													<div style="float:left; width: 55%; font-weight:bold; padding:3px 0 3px 20px; color: #FE980F;">Stock left</div>
													<div style="float:left; width: 45%; height: 20px;overflow: hidden;"><?php echo $qty; ?></div>
												</div>
												<div style="float:left; width:100%; margin-bottom:10px;">
													<div style="float:left; width: 55%; font-weight:bold; padding:3px 0 3px 20px; color: #FE980F;">Sold Out</div>
													<div style="float:left; width: 45%; height: 20px;overflow: hidden;"><?php echo $item_count; ?></div>
												</div>
												<!--div style="float:left; width:100%; margin-bottom:10px;">
													<a href="order.php?cid=<?php echo $row['cid']; ?>"><center class="btn_buy"> Buy Now </center></a>
												</div-->
											</div>
										</div>

										<div class="itemc_inter">&nbsp;
										</div>

										<?php
												}
												else{
										?>

										<div class="itemc">
											<center class="img_block" style="border-bottom: 1px solid lightgray; padding-bottom: 20px;">
												<img src="photo/<?php echo $photo; ?>">
											</center>
											<div style="margin-top:10px; padding: 10px 20px; float:left;">
												<div style="float:left; width:100%; margin-bottom:10px;">
													<div style="float:left; width: 55%; font-weight:bold; padding:3px 0 3px 20px; color: #FE980F;">Brand</div>
													<div style="float:left; width: 45%; height: 20px;overflow: hidden;"><?php echo $cbrandname; ?></div>
												</div>
												<div style="float:left; width:100%; margin-bottom:10px;">
													<div style="float:left; width: 55%; font-weight:bold; padding:3px 0 3px 20px; color: #FE980F;">Model</div>
													<div style="float:left; width: 45%; height: 20px;overflow: hidden;"><?php echo $cmodel; ?></div>
												</div>
												<div style="float:left; width:100%; margin-bottom:10px;">
													<div style="float:left; width: 55%; font-weight:bold; padding:3px 0 3px 20px; color: #FE980F;">Price</div>
													<div style="float:left; width: 45%; height: 20px;overflow: hidden;">$<?php echo $cprice; ?></div>
												</div>
												<div style="float:left; width:100%; margin-bottom:10px;">
													<div style="float:left; width: 55%; font-weight:bold; padding:3px 0 3px 20px; color: #FE980F;">Release Date</div>
													<div style="float:left; width: 45%; height: 20px;overflow: hidden;"><?php echo $cdate; ?></div>
												</div>
												<div style="float:left; width:100%; margin-bottom:10px;">
													<div style="float:left; width: 55%; font-weight:bold; padding:3px 0 3px 20px; color: #FE980F;">Stock left</div>
													<div style="float:left; width: 45%; height: 20px;overflow: hidden;"><?php echo $qty; ?></div>
												</div>
												<div style="float:left; width:100%; margin-bottom:10px;">
													<div style="float:left; width: 55%; font-weight:bold; padding:3px 0 3px 20px; color: #FE980F;">Sold Out</div>
													<div style="float:left; width: 45%; height: 20px;overflow: hidden;"><?php echo $item_count; ?></div>
												</div>
												<!--div style="float:left; width:100%; margin-bottom:10px;">
													<a href="order.php?cid=<?php echo $row['cid']; ?>"><center class="btn_buy"> Buy Now </center></a-->
												</div>
											</div>
										</div>
										<?php

												}
												/*
												echo "<tr>
												<td>$cid</td>
												<td><img src=\"photo/$photo\" width=\"150\" height=\"150\"/></td>
												<td>$cbrandname</td>
												<td>$cmodel</td>
												<td>$$cprice</td>
												<td>$cdate</td>
												<td>$qty</td>
												<td><a href='order.php?cid=".$row['cid']."'>Buy Now !</a></td></tr>";
												*/
											}
										?>
									</div>
         						</div>
         					</div>
         				</section>
            		</form> 
            		<!--features_items-->
            	</div>
            </div>  
            <div class="row">
				<div class="col-sm-3">
					<section id="cart_items">
						<div class="container">
							<div class="table-responsive cart_info" style="width:100%; float:left; border: 0;">
									
								<center class="title_c"> The Most used Payment Type </center>
								<div style="width:100%; float:left; margin-top:10px;">
									<?php
										connect();
										$query=mysql_query("SELECT paymentid, paymenttype, COUNT(paymenttype) as count_payment FROM `payment` GROUP BY paymenttype;")or die("Can't Select");
										$no = 0;
										while($row1=mysql_fetch_array($query))
										{
											$paymenttype = $row1['paymenttype'];
											$count_payment = $row1['count_payment'];
									?>	
										<center>
											<div style="width:60%; margin: 0 auto; padding:10px 15% 30px 15%; border: 1px solid lightgray; margin-bottom: 10px;">
												<div style="float:left; width:50%;"><?php echo $paymenttype; ?></div>
												<div style="float:left; width:50%;"><?php echo $count_payment; ?></div>
											</div>
										</center>
									<?php
										}	
									?>
								</div>
							</div>
     					</div>
     				</section>
            	</div>
            </div>  
        <div>
    </section>


 <footer id="footer"><!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
							<h2><span>N</span>aturebreeze</h2>
							<p>Simple is Implicity</p>
						</div>
					</div>
					<div class="col-sm-7">
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe1.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>EOS 7D DSLR</p>
								<h2>21 SEP 2015</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe2.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Canon EOS C100</p>
								<h2>18 SEP 2015</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe3.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Latest Cameras</p>
								<h2>24 SEP 2015</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe4.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Canon SX 200</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="address">
							<img src="images/home/map.png" alt="" />
							<p>No (105), Upper Pansoedann Road, Kyauk Ta Da Township, Yangon</p>
						</div>
					</div>
				</div>
			</div>
  </div>
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2015 KSML Inc. All rights reserved.</p>
					<p class="pull-right">Designed by <span><a target="_blank" href="https://www.facebook.com/happykyaw">Kyaw Swar Min Lwin</a></span></p>
				</div>
			</div>
		</div>
		
</footer><!--/Footer-->
	

  
<script src="js/jquery.js"></script>
<script src="js/price-range.js"></script>
<script src="js/jquery.scrollUp.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.prettyPhoto.js"></script>
<script src="js/main.js"></script>
</body>
</html>
</body>
</html>