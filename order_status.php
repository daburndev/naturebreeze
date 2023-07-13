<?php

require_once('conn.php');

?>
<html>
<head><title>Naturebreeze | Cart</title>
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
	                if(!empty($_SESSION['email'])){
	            ?>
				<div style="float:right; width: 100%; text-align: right; padding: 8px 0px; border-bottom: 1px solid lightgray;">
					
					<font color="#000" style="font-weight:bold;">Welcome&nbsp;&nbsp;&nbsp;</font>
					<font color="orange"><?php echo $_SESSION['email']; ?></font>
					
				</div>
				<?php
					}
				?>
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="index.php"><img src="images/home/logo.png" alt="" height="89" width="150" /></a>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-star"></i>Order Status</a></li>
								<li><a href="checkout2.php"><i class="fa fa-crosshairs"></i> Checkout</a></li>
								<li><a href="shoppingcart.php"><i class="fa fa-shopping-cart"></i> Cart</a></li>
								<?php 
	                             	if(!empty($_SESSION['email'])){
	                             		echo '<li><a href="logout.php"><i class="fa fa-lock"></i> Logout</a></li>';
	                             	}
									else{
										echo '<li><a href="login.php"><i class="fa fa-lock"></i> Login</a></li>';
									}
								?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
		<?php

			require_once('conn.php');
			require_once('shoppingcartfunction.php');
		 	
			if(isset($_GET['action']))
			{
				$action= $_GET['action'];
				if($action=='add')
				{
					$cid=$_GET['cid'];
					$qty=$_GET['txtqty'];
					if($qty == ""){
						header("Location: order.php?cid=$cid&choose=1");
					}
					insert($cid,$qty);
				}

				if($action=='remove')
				{
					$cid=$_GET['cid'];
					remove($cid);
				}

				if($action=='clear')
				{
					clear();
				}
			}
		?>

      	<section>
			<div class="container">
				<div class="row">
					<div class="col-sm-3">
	                	<section id="cart_items">
							<div class="container" style="padding-left: 0; padding-right: 30px; margin-top:20px;">

								

								<div class="table-responsive cart_info" style="margin-bottom:20px;  float:left; width:100%;">
      								<table class="table table-condensed" style="padding:0; margin:0;">
								      	<tr>
								      		<td colspan="7" align="center" style="font-size:22px; font-weight:bold;"><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;&nbsp; Your Ordered Items &nbsp;&nbsp;&nbsp;<i class="fa fa-shopping-cart"></i></td>
								      	</tr>
										<tr class="cart_menu">
											
											<th><center>Image</center></th>
											<th>Brand Name</th>
											<th>Model Name</th>
											<th>Price</th>
											<th>Date</th>
									        <th><center>Total Quantity</center></th>
											<th>Status</th>
											
										</tr>

										<?php
											connect();
											$e = 0;
											if(empty($_SESSION["email"])){
												//var_dump("aaa");
												echo "<script>window.alert('Please Login your account to see your order status.');		
												//window.location.assign('shoppingcart.php');
													</script>";

												echo "<tr><td  colspan='7'><center style='color:gray;'><h4>Your Order is Empty</h2></center></td></tr>";
											}
											else{
												$email = $_SESSION["email"];
												$Select = "select * from user where email = '$email'";
												$CusRet = mysql_query($Select);

												$CusRow = mysql_fetch_array($CusRet);

												$userid = $CusRow['userid'];

												//var_dump("SELECT o.*,c.*,co.qty as camera_qty,co.cprice as unit_price,p.paymenttype,p.paymentdate FROM `order` o JOIN camera_order co ON co.orderid = o.orderid JOIN payment p ON p.oderid = o.orderid JOIN camera c ON c.cid = co.cid WHERE o.userid = $userid;");
												$query=mysql_query("SELECT o.*,c.*,co.qty as camera_qty,co.cprice as unit_price,p.paymenttype,p.paymentdate FROM `order` o JOIN camera_order co ON co.orderid = o.orderid JOIN payment p ON p.oderid = o.orderid JOIN camera c ON c.cid = co.cid WHERE o.userid = $userid;");
												//$query=mysql_query("Select * from camera")or die("Can't Select");
												//$order = mysql_fetch_array($query);
												//var_dump($query);
												
													//$ShoppingCartSize = count($_SESSION['shoppingcart']);
												while($row=mysql_fetch_array($query))
												{
													$e = 1;
													//var_dump("aa");
													//$no = $no + 1;
													$cid=$row['cid'];
													$photo=$row['photo'];
													$cbrandname=$row['cbrandname'];
													$cmodel=$row['cmodel'];
													$cprice=$row['cprice'];
													$cdate=$row['cdate'];
													$qty=$row['camera_qty'];
													$date = $row['orderdate'];

													$status = $row['status'];


													//$productid=$_SESSION['shoppingcart'][$i]['cid'];  //shopping cart htae ka data twy lo chin yin looping loat ya ml.
													echo "<tr>";
													//echo "<td>".$_SESSION['shoppingcart'][$i]['brandName'].
													//" ".$_SESSION['shoppingcart'][$i]['categoryName']."</td>";
													//echo "<td>".$_SESSION['shoppingcart'][$i]['InstrumentID']."</td>";
													//$photo = $_SESSION['shoppingcart'][$i]['photo'];
													echo "<td style='padding: 10px 0 10px 10px; border-right: 1px solid rgba(211, 211, 211, 0.22);'><center><img style='padding-left:10px; width100%;' src=\"photo/$photo\" width=\"150\" height=\"150\"/></center></td>";
													echo "<td style='padding: 10px 0 10px 10px; border-right: 1px solid rgba(211, 211, 211, 0.22);'>".$cbrandname."</td>";
													echo "<td style='padding: 10px 0 10px 10px; border-right: 1px solid rgba(211, 211, 211, 0.22);'>".$cmodel."</td>";
													echo "<td style='padding: 10px 0 10px 10px; border-right: 1px solid rgba(211, 211, 211, 0.22);'>$".$cprice."</td>";
													echo "<td style='padding: 10px 0 10px 10px; border-right: 1px solid rgba(211, 211, 211, 0.22);'>".$date."</td>";
													echo "<td style='padding: 10px 0 10px 10px; border-right: 1px solid rgba(211, 211, 211, 0.22);'><center>".$qty."</center></td>";
													//echo "<td>".Get_TotalAmount()."</td>";
													//echo "<td>".$_SESSION['shoppingcart'][$i]['price'] 
														//		*
															//	$_SESSION['shoppingcart'][$i]['Quantity']
													//				."</td>";
													if($status == "Approve"){
														echo "<td><center> Approved </center></td>";
													}
													else{
														echo "<td><center>". $status ."</center></td>";
													}
													echo "</tr>";
													
												}

												if($e == 0)
												{
													echo "<tr><td  colspan='7'><center style='color:gray;'><h4>Your Order is Empty</h2></center></td></tr>";
												}
											}
										?>
									</table>
    							</div>
    						</div>
    					</section>
    				</div>
    			</div>
    		</div>
    	</section>
    
		

      
    </div>
  
    </div>
  </div>
</center>






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