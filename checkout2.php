<?php
require_once("conn.php");
require_once("function.php");
require_once("shoppingcartfunction.php");
connect();
$ShoppingCartSize = 0;
if(empty($_SESSION["email"])){
	//var_dump("aaa");
	header("Location: login.php");
}
else{
	$email = $_SESSION["email"];
	$Select = "select * from user where email = '$email'";
	$CusRet = mysql_query($Select);

	$CusRow = mysql_fetch_array($CusRet);

	if(isset($_POST['btnCheckOut']) && !empty($_SESSION['shoppingcart']))
	{
		//var_dump($_SESSION);
		connect();
		$orderid = AutoID("order","orderid","Or-",6);
		$orderdate = Date("Y-m-d");
		$userid = $CusRow['userid'];
		$address = $_POST["deliveryAdd"] . " "  .$_POST["txtContactPh"];
		$phone = $_POST["txtContactPh"];
		$payid=AutoID('payment','paymentid','Pay_',6);
		$paydate=date('d-m-Y');
		$type=$_POST['rdopayment'];
		$totalamount = Get_TotalAmount();

		if(empty($_SESSION['shoppingcart'])){
			//var_dump("aa");
		}
		else{
			//var_dump("vvv");
		}

		$ShoppingCartSize = count($_SESSION['shoppingcart']);

		if($ShoppingCartSize != 0){

			$saleInsert = "insert into `order` values('$orderid','$userid','$orderdate','$totalamount','Pending')";
			 //var_dump($saleInsert);
			mysql_query($saleInsert) or die(mysql_error());
			
			
			$insert="insert into payment values('$orderid','$payid','$type','$orderdate','$totalamount')";
			mysql_query($insert) or die(mysql_error());

			
			
			//var_dump($ShoppingCartSize);
			for($i=0; $i<$ShoppingCartSize; $i++)
			{
				$cid=$_SESSION['shoppingcart'][$i]['cid'];
				$cprice =$_SESSION['shoppingcart'][$i]['cprice'];
				$qty =$_SESSION['shoppingcart'][$i]['qty'];
				$amount = $_SESSION['shoppingcart'][$i]['cprice'] * $_SESSION['shoppingcart'][$i]['qty'];

				$saleDetailInset = "INSERT INTO camera_order(cid,orderid,cprice,qty,amount) values('$cid','$orderid','$cprice','$qty','$amount')";
				//var_dump($saleDetailInset);
				mysql_query($saleDetailInset);
				mysql_query("UPDATE camera SET qty = qty - '$qty' WHERE cid = $cid;");
				
			}
			echo "<script>window.alert('Thanks You for Your Order. Payment process is depened on your payment type.');		
			window.location.assign('index.php');
				</script>";
			clear();
		}
		else{
			echo "<script>window.alert('Your Shopping Cart is empty.');		
			window.location.assign('shoppingcart.php');
				</script>";
			//clear();
		}
		
	}
	else{
		if(empty($_SESSION['shoppingcart'])){
			echo "<script>window.alert('You can't checkout. Your Shopping Cart is empty.');		
			window.location.assign('shoppingcart.php');
				</script>";
			//clear();
		}
	}
}
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
								<li><a href="order_status.php"><i class="fa fa-star"></i>Order Status</a></li>
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
								<div style="width: 100%; float: left; background-color: #7D7D7D; padding: 8px 20px 4px 20px; color: white; margin-bottom: 20px; font-size: 20px; border-bottom: 2px solid black;">
									Check Out
								</div>
								<form action="checkout2.php" method="post">
									<div>
										<div style="width:100%; float:left; margin-bottom: 20px;">
											<div style="width:38%; float:left; margin-right: 2%;">
												<div style="width:100%; float:left; border: 1px solid #E2E2E2; padding: 6px 10px 4px 10px; color:#D88C00; background-color:#EFEFEF;">
													Choose Payment Method
												</div>
												<div style="width:100%; float:left; padding: 20px 5%; border-left: 1px solid #E2E2E2; border-right: 1px solid #E2E2E2; border-bottom: 1px solid #E2E2E2;">
													<label>
														<input type="radio" name="rdopayment" value="myanpay" id="RadioGroup1_5" />
														&nbsp;&nbsp;&nbsp;MyanPay
													</label>
													<br />
													<label>
														<input name="rdopayment" type="radio" id="RadioGroup1_6" value="cashondelivery" checked />
														&nbsp;&nbsp;&nbsp;Cash On Delivery
													</label>
													<br />  
													<label>
														<input type="radio" name="rdopayment" value="banktransfer" id="RadioGroup1_7" />
														&nbsp;&nbsp;&nbsp;Bank Transfer
													</label>
													<br /> 
													<hr>
													<textarea name="deliveryAdd" readonly="yes"><?php echo $CusRow['address']; ?></textarea> </br></br>

													<input type="text" readonly="yes" value="<?php echo $CusRow["name"]; ?>" name="txtContactPerson"/><br /> 
													<input type="text" readonly="yes" value="<?php echo $CusRow["phone"]; ?>" name="txtContactPh"/>
												</div>
											</div>
											<div style="width:58%; float:left; margin-left: 2%;">
												<div style="width:100%; float:left; border: 1px solid #E2E2E2; padding: 6px 10px 4px 10px; color:#D88C00;  background-color:#EFEFEF;">
													Customer Information
												</div>
												<div style="width:100%; float:left; padding: 20px 5%; border-left: 1px solid #E2E2E2; border-right: 1px solid #E2E2E2; border-bottom: 1px solid #E2E2E2;">
													<div style="width:100%; float:left;">
														<div style="width:36%; float:left; padding: 4px 2%; font-weight:bold; text-shadow: 1px 1px 1px gray; font-size:15px;"> Customer Name </div>
														<div style="width:56%; float:left; padding: 4px 2%;"><?php echo $CusRow['name']; ?></div>
													</div>
													<div style="width:100%; float:left;">
														<div style="width:36%; float:left; padding: 4px 2%; font-weight:bold; text-shadow: 1px 1px 1px gray; font-size:15px;"> Ref No </div>
														<div style="width:56%; float:left; padding: 4px 2%;"><?php echo $CusRow['userid']; ?></div>
													</div>
													<div style="width:100%; float:left;">
														<div style="width:36%; float:left; padding: 4px 2%; font-weight:bold; text-shadow: 1px 1px 1px gray; font-size:15px;"> Delivery Address </div>
														<div style="width:56%; float:left; padding: 4px 2%;"><?php echo $CusRow['address']; ?></div>
													</div>
													<div style="width:100%; float:left;">
														<div style="width:36%; float:left; padding: 4px 2%; font-weight:bold; text-shadow: 1px 1px 1px gray; font-size:15px;"> Contact No. </div>
														<div style="width:56%; float:left; padding: 4px 2%;"><?php echo $CusRow['phone']; ?></div>
													</div>
													<div style="width:100%; float:left;">
														<div style="width:36%; float:left; padding: 4px 2%; font-weight:bold; text-shadow: 1px 1px 1px gray; font-size:15px;"> E-mail </div>
														<div style="width:56%; float:left; padding: 4px 2%;"><?php echo $CusRow['email']; ?></div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="table-responsive cart_info" style="margin-bottom:20px;  float:left; width:100%;">
	      								<table class="table table-condensed" style="padding:0; margin:0;">
									      	<tr>
									      		<td colspan="7" align="center" style="font-size:22px; font-weight:bold; color:#D88C00;"><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;&nbsp; Shopping Cart &nbsp;&nbsp;&nbsp;<i class="fa fa-shopping-cart"></i></td>
									      	</tr>
											<tr class="cart_menu">
												
												<th><center>Image</center></th>
												<th>Brand Name</th>
												<th>Model Name</th>
												<th>Price</th>
										        <th><center>Total Quantity</center></th>
												<th>Action</th>
												
											</tr>

											<?php
												if(isset($_SESSION['shoppingcart']))
												{
													$ShoppingCartSize = count($_SESSION['shoppingcart']);
													for($i=0; $i<$ShoppingCartSize; $i++)
													{
														if(($i%2) == 1){
															$productid=$_SESSION['shoppingcart'][$i]['cid'];  //shopping cart htae ka data twy lo chin yin looping loat ya ml.
															echo "<tr>";
															//echo "<td>".$_SESSION['shoppingcart'][$i]['brandName'].
															//" ".$_SESSION['shoppingcart'][$i]['categoryName']."</td>";
															//echo "<td>".$_SESSION['shoppingcart'][$i]['InstrumentID']."</td>";
															$photo = $_SESSION['shoppingcart'][$i]['photo'];
															echo "<td style='padding: 10px 0 10px 10px; border-right: 1px solid rgba(211, 211, 211, 0.22);'><center><img style='padding-left:10px; width100%;' src=\"photo/$photo\" width=\"150\" height=\"150\"/></center></td>";
															echo "<td style='padding: 10px 0 10px 10px; border-right: 1px solid rgba(211, 211, 211, 0.22);'>".$_SESSION['shoppingcart'][$i]['cbrandname']."</td>";
															echo "<td style='padding: 10px 0 10px 10px; border-right: 1px solid rgba(211, 211, 211, 0.22);'>".$_SESSION['shoppingcart'][$i]['cmodel']."</td>";
															echo "<td style='padding: 10px 0 10px 10px; border-right: 1px solid rgba(211, 211, 211, 0.22);'>$".$_SESSION['shoppingcart'][$i]['cprice']."</td>";
															echo "<td style='padding: 10px 0 10px 10px; border-right: 1px solid rgba(211, 211, 211, 0.22);'><center>".$_SESSION['shoppingcart'][$i]['qty']."</center></td>";
															//echo "<td>".Get_TotalAmount()."</td>";
															//echo "<td>".$_SESSION['shoppingcart'][$i]['price'] 
																//		*
																	//	$_SESSION['shoppingcart'][$i]['Quantity']
															//				."</td>";
															echo "<td><center><a href='shoppingcart.php?
															action=remove&cid=$productid'>remove</a></center></td>";
															echo "</tr>";
														}
														else{
															$productid=$_SESSION['shoppingcart'][$i]['cid'];  //shopping cart htae ka data twy lo chin yin looping loat ya ml.
															echo "<tr>";
															//echo "<td>".$_SESSION['shoppingcart'][$i]['brandName'].
															//" ".$_SESSION['shoppingcart'][$i]['categoryName']."</td>";
															//echo "<td>".$_SESSION['shoppingcart'][$i]['InstrumentID']."</td>";
															$photo = $_SESSION['shoppingcart'][$i]['photo'];
															echo "<td style='padding: 10px 0 10px 10px; border-right: 1px solid rgba(211, 211, 211, 0.22);'><center><img style='padding-left:10px; width100%;' src=\"photo/$photo\" width=\"150\" height=\"150\"/></center></td>";
															echo "<td style='padding: 10px 0 10px 10px; border-right: 1px solid rgba(211, 211, 211, 0.22);'>".$_SESSION['shoppingcart'][$i]['cbrandname']."</td>";
															echo "<td style='padding: 10px 0 10px 10px; border-right: 1px solid rgba(211, 211, 211, 0.22);'>".$_SESSION['shoppingcart'][$i]['cmodel']."</td>";
															echo "<td style='padding: 10px 0 10px 10px; border-right: 1px solid rgba(211, 211, 211, 0.22);'>$".$_SESSION['shoppingcart'][$i]['cprice']."</td>";
															echo "<td style='padding: 10px 0 10px 10px; border-right: 1px solid rgba(211, 211, 211, 0.22);'><center>".$_SESSION['shoppingcart'][$i]['qty']."</center></td>";
															//echo "<td>".Get_TotalAmount()."</td>";
															//echo "<td>".$_SESSION['shoppingcart'][$i]['price'] 
																//		*
																	//	$_SESSION['shoppingcart'][$i]['Quantity']
															//				."</td>";
															echo "<td><center><a href='shoppingcart.php?
															action=remove&cid=$productid'>remove</a></center></td>";
															echo "</tr>";
														}
														
														
													}
												}
												else
												{
													echo "<tr><td  colspan='7'><center style='color:gray;'><h4>Your Cart is Empty</h2></center></td></tr>";
												}
											?>
										</table>
	    							</div>
									<div style="margin-bottom:30px; float:left; width:100%;">
										<h4 style="float:left;">
											<a href="shoppingcart.php?action=clear">Clear Cart</a>
										</h4>
										<div style="float:right; font-size:20px;" >
											<font style="color:red;">Total Amount </font> - $<?php echo Get_TotalAmount(); ?>
										</div>
									</div>
									<style type="text/css">


										.btn_buy{
											padding: 6px 70px 5px 70px;
										    background-color: #FE980F;
										    border: 1px solid #E0E0E0;
										    color: white;
										    text-shadow: 1px 1px 2px #2B2B2B;
										    border-radius: 3px;
										    margin-left: 20px;
										}
									</style>
									<div style="margin-bottom:30px; float:left; width:100%;">
										<center><input class="btn_buy" type="submit" value="Place Order" name="btnCheckOut" /></center>
									</div>

								</form>
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