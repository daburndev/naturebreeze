<?php
require_once('conn.php');

	if(isset($_REQUEST['btnSubmit']))
	{
		connect();
		$cbrandname=$_REQUEST['cbrandname'];
		$cmodel=$_REQUEST['cmodel'];
		$cprice=$_REQUEST['cprice'];
		$cdate=$_REQUEST['cdate'];
		$qty=$_REQUEST['qty'];
		$photo=$_FILES['photo']['name'];
		$folder="Photo/";
		
		 if(empty($cbrandname))
		{
			$msg= "Please Choose Brand Name";
		}
		
		else if(empty($cmodel))
		{
			$msg= "Please enter model name";
		}
		
		else if(empty($cprice))
		{
			$msg= "Pleas enter sale price";
		}
		
		else if(empty($cdate))
		{
			$msg="Please enter Released Date";
		}
		else if(empty($qty))
		{
			$msg="Please enter Quantity";
		}

		else 
		{
			$query1=mysql_query("Select * from camera where cbrandname='$cbrandname' AND cmodel='$cmodel'")or die("Can't Select");
			$num=mysql_num_rows($query1);
			if($num>0)
			{
				$msg="This record is already exit!";
			}
			else
			{
				$query1=mysql_query("Insert Into camera(cbrandname,cmodel,cprice,cdate,photo,qty)values('$cbrandname','$cmodel','$cprice','$cdate','$photo','$qty')") or die("Cann't Insert");
				if($photo)
		{
			$filename=$folder.$photo;
	$copied=copy($_FILES['photo']['tmp_name'],$filename);
			$msg="Save Successfully Record";
			if(!$copied)
			{
				exit("Problem occured. Cannot Upload Product Image.");
			}
		}
			}
		}
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
  <?php
			if(!empty($msg))
			{
				echo "<font color=\"blue\">".$msg."</font>";
			}
		?> 
<form action="" method="post" enctype="multipart/form-data">
<table align="center" border="0">
	<tr>
    	<td height="32" colspan="2" align="center"> Input New Camera</td>
    </tr>
	<tr>
    	<td>Camera Brand</td>
        <td ><select name="cbrandname">
        <option>Canon</option>
        <option>Nikon</option>
        <option>Sony</option>
        <option>Fujifilm</option>
        </select>
        </td>
    </tr>
    <tr>
    	<td width="200">Model</td>
        <td><input type="text" name="cmodel"></td>
    </tr>
    <tr>
    <td>Price</td>
    <td><input type="text" name="cprice"></td>
    </tr>
    <tr>
    <td>Released Date</td>
    <td><input type="date" name="cdate" placeholder="y/mm/dd"></td>
    </tr>
    <tr>
        
			<td>Quantity</td>
			<td><input type="number" name="qty"/></td>
		</tr>
    <tr>
    <td>Photo</td>
    <td><input type="file" name="photo"></td>
    </tr>
    <tr>
    <td colspan="2"><input type="submit" name="btnSubmit" value="Submit">      <input type="reset" name="btnReset" value="Reset"></td>
    </tr>
</table>
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