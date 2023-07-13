<?php

	require_once('conn.php');
	if(!empty($_REQUEST['cid']))
	{
		connect();
		
		$query=mysql_query("Select * from camera where cid=".$_REQUEST['cid']."")or die("Can't Select");
		//$query=mysql_query($test);
		//echo $query;
		while($row=mysql_fetch_assoc($query))
		{
			$cid=$row['cid'];
			$cbrandame=$row['cbrandname'];
			$cmodel=$row['cmodel'];
			$cprice=$row['cprice'];
			$cdate=$row['cdate'];
			$photo=$row['photo'];
			$qty=$row['qty'];

		}
	}


	if(isset($_POST['btnupdate']))
	{
		$cid = $_POST['cid'];
		$cbrandname=$_POST['cbrandname'];
		$cmodel=$_POST['cmodel'];
		$cprice = $_POST['cprice'];
		$cdate= $_POST['cdate'];
		$qty= $_POST['qty'];
		//$mid= $_POST['modelid'];
			
		//.....for image..............
		$photo=$_FILES['photo']['name'];
		$folder="Photo/";
		if($photo)
		{
			$filename=$folder.$photo;
			$copied=copy($_FILES['photo']['tmp_name'], $filename);
			if(!$copied)
			{
				exit("Problem occured.Cannot Upload Item Image.");
			}
		}

		if($photo == ""){
			$productUpdate = "UPDATE camera SET 
			cid = '$cid',
			cbrandname = '$cbrandname',
			cmodel = '$cmodel',
			cprice = '$cprice',
			cdate = '$cdate',
			qty	= '$qty'
			WHERE cid = '$cid'";
			$ProductUpdateRet = mysql_query($productUpdate) or die(mysql_error());

			if($ProductUpdateRet)
			{
				echo "<script>
						alert ('Camera Information is successfully updated');
						window.location.assign('aclist.php');
					</script>";
			}
		}
		else{
			$productUpdate = "UPDATE camera SET 
			cid = '$cid',
			cbrandname = '$cbrandname',
			cmodel = '$cmodel',
			cprice = '$cprice',
			cdate = '$cdate',
			photo = '$photo',
			qty	= '$qty'
			WHERE cid = '$cid'";
			$ProductUpdateRet = mysql_query($productUpdate) or die(mysql_error());

			if($ProductUpdateRet)
			{
				echo "<script>
						alert ('Camera Information is successfully updated');
						window.location.assign('aclist.php');
					</script>";
			}
		}
		
	}

	//.......Start..............
	if(isset($_GET['action']))
	{
		$action = $_GET['action'];
		$cid = $_GET['cid'];
		if($action == 'delete')
		{
			$Delete = "delete from camera where cid = '$cid'";
			$Ret = mysql_query($Delete) or die(mysql_error());
			if($Ret)
			{
				header("Location:aclist.php");
			}
		}

		if($action == 'update')
		{
			$select="Select * from 
			camera where cid = '$cid'";
			$Ret=mysql_query($select) or die(mysql_error());
			$Row=mysql_fetch_array($Ret);
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
		
		<style type="text/css">
			.label_cell{
				width:60%;
				padding-left: 50px;
				padding-top: 30px;
			}

			.value_cell{
				width:40%;
				padding-top: 30px;
			}
		</style>
 <form action="acupdate.php" method="post" enctype="multipart/form-data"> 
 	<?php	echo "<center><img style='margin-bottom:20px; margin-top:30px;' src =\"Photo/$photo\" width=\"190\" /></center>";?>
	<table align="center" style="width:40%; border:1px solid lightgray; margin-bottom:50px;">
		<tr>
			<td class="label_cell">Camera ID</td>
			<td class="value_cell"><input type="text" name="cid" value="<?php echo $Row['cid']?>"  readonly="true"/></td>
		</tr>
        <tr>
        	<td class="label_cell">Brand Name</td>
            <td class="value_cell"><input type="text" name="cbrandname" value="<?php echo $Row['cbrandname']?>" readonly/></td>
        </tr>
		<tr>
			<td class="label_cell">Model</td>
			<td class="value_cell"><input type="text" name="cmodel" value="<?php echo $Row['cmodel']?>" /></td>
		</tr>
        
		<tr>
			<td class="label_cell">Price</td>
			<td class="value_cell"><input type="text" name="cprice" value="<?php echo $Row['cprice']?>" /></td>
		</tr>
            
		<tr>
        	<td class="label_cell">Date</td>
			<td class="value_cell"><input type="date" name="cdate" value="<?php echo $Row['cdate']?>" /></td>
		</tr>
        <tr>
        	<td class="label_cell">Quantity</td>
            <td class="value_cell"><input type="number" name="qty" value="<?php echo $Row['qty']?>"/></td>
        </tr>
		<tr>
			<td class="label_cell">New Image</td>
			<td class="value_cell"><input type="file" name="photo" /></td>
		</tr>
		
		<tr>
        	<td class="label_cell" style="padding-bottom: 30px;"></td>
            <td class="value_cell" style="padding-bottom: 30px;">
				<input type="submit" name="btnupdate" value="Update"/>
				<input type="reset" name="btnclear" value="Clear"/>
			</td>
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
