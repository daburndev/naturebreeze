<?php
require_once('conn.php');
if(!empty($_REQUEST['cid']))//***To Delete Record***//
{	connect();
	$query=mysql_query("Delete from camera where cid=".$_REQUEST['cid']."")or die("Can't Delete");
		if($query)
			$msg="Delete Successfully Record";
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
		<script type="text/javascript">
			function confirmation() {
				var comfirm = confirm('Do you want to Delete this record?');
				//alert(comfirm);
				if (comfirm) {
		           $("#atm_del").submit();
		       	}else {
		           event.preventDefault();
		       	}
			}
			//-->
		</script>
           
<form action="aclist.php" method="post">
<section id="cart_items">
		<div class="container">
<div class="table-responsive cart_info">
				<table class="table table-condensed">
                <tr>
                <td colspan="8" align="center">Camera List</td>
                </tr>
				<tr class="cart_menu">
                <td>Camera ID</td>
                <td>Photo</td>
                <td>Brand Name</td>
                <td>Model</td>
                <td>Price</td>
                <td>Released Date</td>
                <td>Quantity</td>
                <td>Action</td>
				</tr>
                
                <?php
		connect();
		$query=mysql_query("Select * from camera")or die("Can't Select");
		while($row=mysql_fetch_array($query))
		{
			$cid=$row['cid'];
			$photo=$row['photo'];
			$cbrandname=$row['cbrandname'];
			$cmodel=$row['cmodel'];
			$cprice=$row['cprice'];
			$cdate=$row['cdate'];
			$qty=$row['qty'];
			echo "<tr>
			<td>$cid</td>
			<td><img src=\"photo/$photo\" width=\"150\" height=\"150\"/></td>
			<td>$cbrandname</td>
			<td>$cmodel</td>
			<td>$$cprice</td>
			<td>$cdate</td>
			<td>$qty</td>
			<td><a href='acupdate.php?action=update&cid=".$row['cid']."'>Update</a> |
			<a href = 'aclist.php?action=delete&cid=".$row['cid']."' onclick='confirmation()''> Delete </a></td></tr>";
		}
		?>
</table>
         </div>
         </div>
         </section>
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