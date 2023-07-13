
<?php
	require_once('conn.php');
	connect();

	if(isset($_GET['approve_id'])){
		$o_id = $_GET['approve_id'];

		//var_dump("UPDATE `order` SET status = 'Approve' WHERE orderid = '$o_id';");
		$query = mysql_query("UPDATE `order` SET status = 'Approve' WHERE orderid = '$o_id';");

		echo "<script>window.alert('Successfully Approved');
				</script>";
	}
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

		<section id="cart_items">
			<div class="container">
				<div class="table-responsive cart_info">
					<style type="text/css">
						.btn_buy{
							padding: 3px 20px 3px 20px;
						    background-color: #FE980F;
						    border: 1px solid #E0E0E0;
						    color: white;
						    text-shadow: 1px 1px 2px #2B2B2B;
						    border-radius: 3px;
						    //margin-left: 20px;
						    font-size: 14px;
						}
					</style>
					<table class="table table-condensed">
	                	<tr>
	                		<td colspan="8" align="center"><font style="font-weight: bold; font-size: 20px;"> -- Order List -- </font></td>
	                	</tr>
						<tr class="cart_menu">
			                <td>User ID</td>
			                <td>Item</td>
			                <td>Price</td>
			                <td>Quantity</td>
			                <td>Payment</td>
			                <td>Status</td>
			                <td align="right">Total Amount</td>
			                <td><center>Action</center></td>
						</tr>
						<?php
							$e = 0;
							$order = "";
							$query=mysql_query("SELECT o.*,c.*,co.qty as camera_qty,co.cprice as unit_price,p.paymenttype,p.paymentdate, u.* FROM `order` o JOIN camera_order co ON co.orderid = o.orderid JOIN payment p ON p.oderid = o.orderid JOIN camera c ON c.cid = co.cid JOIN user u ON u.userid = o.userid ORDER BY o.orderid");

							while($row=mysql_fetch_array($query))
							{
								$e = 1;
								//var_dump("aa");
								//$no = $no + 1;
								$customer_id = $row['userid'];
								$orderid = $row['orderid'];
								$cid=$row['cid'];
								$photo=$row['photo'];
								$cbrandname=$row['cbrandname'];
								$cmodel=$row['cmodel'];
								$cprice=$row['cprice'];
								$cdate=$row['cdate'];
								$qty=$row['camera_qty'];
								$totalamount = $row['totalamount'];

								$status = $row['status'];
								$paymenttype = $row['paymenttype'];

								if($order != $orderid){

									if($status == "Pending"){
										echo '
										<tr>
			                				<td style="background-color:#FFC8C8;" colspan="7" align="left"> '. $orderid .' </td>

			                				<td style="background-color:#FFC8C8;"><center><a class="btn_buy" href="aorder.php?approve_id='. $orderid .'" > Approve </a></center></td>
			                			</tr>';
			                		}
			                		else{
			                			echo '
										<tr>
			                				<td style="background-color:#D7F5DF;" colspan="7" align="left"> '. $orderid .' </td>

			                				<td style="background-color:#D7F5DF; color:green;"><center> Approved </center></td>
			                			</tr>';
			                		}

		                			$order = $orderid;
								}

								echo '<tr>';
								echo '<td>'. $customer_id .'</td>';
								echo '<td>'. $cbrandname . ' ' . $cmodel .'</td>';
								echo '<td>'. $cprice .'</td>';
								echo '<td><center>'. $qty .'</center></td>';
								echo '<td>'. $paymenttype .'</td>';
								echo '<td>'. $status .'</td>';
								echo '<td align="right" style="padding-right:20px;">'. $totalamount .'</td>';
								echo '<td></td>';
								//echo '<td><a href="aorder.php?approve" > Approve </a></td>';
								echo '</tr>';
							}

							if($e == 0){
								echo '
								<tr>
	                				<td colspan="7" align="center"> No Orders </td>
	                			</tr>';
							}
						?>
	                </table>
				</div>
                <div style="float:left; width:100%;">
                	<div style="margin-bottom: 20px; width:200px; padding: 4px" class="btn_buy">
                		<a href="export.php"><center style="color:white;"> Export to excel </center></a>
                	</div>
                </div>
			</div>
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