<?php

require_once('conn.php');
$cid=$_GET['cid'];

?>
<html>
<head><title>Naturebreeze | Add Cart</title>
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
							<a href="#"><img src="images/home/logo.png" alt="" height="89" width="150" /></a>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<li><a href="order-status.php"><i class="fa fa-star"></i>Order Status</a></li>
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
 			connect();
			$query=mysql_query("Select * from camera where cid=".$_GET['cid']."")or die("Can't Select");
		
		
			while($row=mysql_fetch_array($query))
			{
				$cid=$row['cid'];
				$photo=$row['photo'];
				$cbrandname=$row['cbrandname'];
				$cmodel=$row['cmodel'];
				$cprice=$row['cprice'];
				$cdate=$row['cdate'];
				$qty=$row['qty'];
				
			}     
		?>
		<form action="shoppingcart.php" method="get">
			<input type='hidden' name='cid' value="<?php echo $cid; ?>">

    		<!--table align="center">
      			<tr>
        			<td rowspan="8"><?php echo"<img src=\"photo/$photo\" width=\"400\" height=\"500\"/>" ?></td>
      			</tr>
	      		<tr>
	        		<td><?php echo "Brand Name--  ".$cbrandname; ?></td>
	      		</tr>
	      		<tr>
	        		<td><?php echo "Model--  ".$cmodel; ?></td>
	      		</tr>
	      		<tr>
	        		<td><?php echo "Price--  ".$cprice; ?></td>
	      		</tr>
	      		<tr>
	        		<td><?php echo "Released Date-- ".$cdate; ?></td>
	      		</tr>
	      		<tr>
	        		<td><?php echo "Quantity--".$qty; ?></td>
	      		</tr>
	      		<tr>
        			<td></td>
        		</tr>
      			<tr>
        			<td>
						<?php 
							//$qty = $row['qty'];

							if ($qty < 1)
							{
								echo "Out of Stock! Check back Later";
							}
							else
							{
								
								echo "Enter Quanity That You Want";
								echo "<input type='number' placeholder='Please Type Quantity' onKeyUp='calc()' name='txtqty'
								min='1' max='$qty'>";
							}
						 ?>
         			</td>
      			</tr>
      			<tr>
        			<td colspan="2"><button type="submit" class="btn btn-default" value="add" name="action">Add</button></td>
      			</tr>
    		</table-->

    		<style type="text/css">
    			.product_title{
    				padding: 4px 6px 4px;
    				width: 1140px;
    				margin: 0 auto;
    				font-size: 22px;
    				margin-bottom: 20px;
    			}

    			.product_photo{
    				width: 50%;
    				float: left;
    				padding-left: 10%;
    				overflow: hidden;
    			}

    			.product_photo img{
    				height: 424px;
    			}

    			.product_desc{
    				width: 44.5%;
    				float: left;
    			}

    			.lbl{
    				font-size: 18px;
    			}

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
    		<script type="text/javascript">
    			<?php
    				if(isset($_GET['choose'])){
    					$choose = $_GET['choose'];

    					if($choose == 1){
    			?>
    				alert("Please Choose Quantity for this products.");
    			<?php
    					}
					}
    			?>
    		</script>
    		<div style="width:1140px; margin: 0 auto; height:80%; background-color:white; padding: 20px 0;">
    			<div class="product_title">
    				<?php echo $cbrandname; ?>&nbsp;&nbsp;<?php echo $cmodel; ?>
    			</div>
    			<div class="product_photo">
    				<img src="photo/<?php echo $photo; ?>">
    			</div>
    			<div class="product_desc">
    				<div style="margin-top:10px; padding: 10px 20px; float:left;">
						<div style="float:left; width:100%; margin-bottom:20px;">
							<div class="lbl" style="float:left; width: 65%; font-weight:bold; padding:3px 0 3px 20px; color: #FE980F;">Brand</div>
							<div style="float:left; width: 35%; height: 40px;overflow: hidden;"><?php echo $cbrandname; ?></div>
						</div>
						<div style="float:left; width:100%; margin-bottom:20px;">
							<div class="lbl" style="float:left; width: 65%; font-weight:bold; padding:3px 0 3px 20px; color: #FE980F;">Model</div>
							<div style="float:left; width: 35%; height: 40px;overflow: hidden;"><?php echo $cmodel; ?></div>
						</div>
						<div style="float:left; width:100%; margin-bottom:20px;">
							<div class="lbl" style="float:left; width: 65%; font-weight:bold; padding:3px 0 3px 20px; color: #FE980F;">Price</div>
							<div style="float:left; width: 35%; height: 40px;overflow: hidden;"><?php echo $cprice; ?></div>
						</div>
						<div style="float:left; width:100%; margin-bottom:20px;">
							<div class="lbl" style="float:left; width: 65%; font-weight:bold; padding:3px 0 3px 20px; color: #FE980F;">Release Date</div>
							<div style="float:left; width: 35%; height: 40px;overflow: hidden;"><?php echo $cdate; ?></div>
						</div>
						<div style="float:left; width:100%; margin-bottom:20px;">
							<div class="lbl" style="float:left; width: 65%; font-weight:bold; padding:3px 0 3px 20px; color: #FE980F;">Stock left</div>
							<div style="float:left; width: 35%; height: 40px;overflow: hidden;"><?php echo $qty; ?></div>
						</div>
						<?php 
							if ($qty < 1){
						?>
						<div style="float:left; width:100%; margin-bottom:30px; padding: 7px; border-top: 1px solid lightgray; border-bottom: 1px solid lightgray; color:red;">
							<center> Out of Stock! Check back Later </center>
						</div>
						<div style="float:left; width:100%; margin-bottom:20px;">
							<a href="index.php" class="btn_buy" > Back to Camera Lists </a>
						</div>
						<?php
							}
							else{
								//echo "Enter Quanity That You Want";
								//echo "";
						?>
						<div style="float:left; width:100%; margin-bottom:20px;">
							<div class="lbl" style="float:left; width: 65%; font-weight:bold; padding:3px 0 3px 20px; color: #FE980F;">Enter Quanity That You Want</div>
							<div style="float:left; width: 35%; height: 40px;overflow: hidden;">
								<input style="padding: 3px 0px 0px 6px;" type='number' placeholder='Please Type Quantity' onKeyUp='calc()' name='txtqty' min='1' max='$qty'>
							</div>
						</div>

						<div style="float:left; width:100%; margin-bottom:20px;">
							<button class="btn_buy" value="add" name="action" > Add to Cart </button>
						</div>
							
						<?php
							}
						?>
						
						
						
					</div>
    			</div>
    		</div>
		</form>


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