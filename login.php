<?php
require_once('conn.php');

if(isset($_REQUEST['btnLogin']))
{
	$email=$_POST['email'];
	$password=$_POST['password'];
	
	if(empty($email))
	{
		$msg="Please enter email address!";
	}
	else if(empty($password))
	{
		$msg="Please enter password!";
	}
	else
	{
		connect();

		$query=mysql_query("Select * from user where email='$email' And password='$password'");
		$count=mysql_num_rows($query);
		//$userid = $_SESSION["userid"];
		if($count>0)
		{
			$_SESSION['email']=$email;
			header("Location: index.php");
		}
		else
		{
			$msg="Please enter Correct Email Address and Password!";
		}
	}
}

?>
<?php
if(isset($_REQUEST['btnSignup']))
{
	connect();
		$username=$_REQUEST['username'];
		$useremail=$_REQUEST['useremail'];
		$address=$_REQUEST['address'];
		$phone=$_REQUEST['phone'];
		$userpassword=$_REQUEST['userpassword'];
		$usercompassword=$_REQUEST['usercompassword'];
		
		if(empty($username))
		{
			$msg1= "Please Enter User Name";
		}
		else if(empty($useremail))
		{
			$msg1= "Please Enter Email";
		}
		else if(empty($address))
		{
			$msg1= "Please Enter Address";
		}
		else if(empty($phone))
		{
			$msg1= "Please Enter Phone Number";
		}
		else if(empty($userpassword))
		{
			$msg1= "Please Enter Password";
		}
		else if(empty($usercompassword))
		{
			$msg1= "Please Enter Confirm Password";
		}
		else if($userpassword!=$usercompassword)
		{
			$msg1= "Password Do Not Match";
		}
		else
			{
				$query=mysql_query("Select * from user where email='$useremail'")or die("Can't Select Record");
				$num=mysql_num_rows($query);
				if($num>0)
				$msg1="Your email is already exist!";
				else
				$save_query=mysql_query("Insert into user(name,email,address,phone,password,compassword)
				Values('".$username."','".$useremail."','".$address."','".$phone."','".$userpassword."','".$usercompassword."')")or die("Can't Insert Record");
				if($save_query)
				$msg1="Congratulation Your Sign Up!";
			}	
}
?>
<html>
<head>
    <title>Login | Naturebreeze</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

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
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="index.php"><img src="images/home/logo.png" alt="" height="89" width="150" /></a>
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
							
								
								<li><a href="login.php" class="active"><i class="fa fa-lock"></i> Login</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		
	</header><!--/header-->
	
	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
                    
						<h2>Login to your account</h2>
                        <?php
							if(!empty($msg))
							{
								echo "<div style='margin-bottom:20px; color:blue;'>".$msg."</div>";
							}
						?> 
						<form action="#" method="POST">
							<input type="text" placeholder="Email Address" name="email" />
							<input type="password" placeholder="Password" name="password" />
							
							<button type="submit" class="btn btn-default" name="btnLogin">Login</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1" style="width: auto; padding: 0 70px;">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
                        <?php
							if(!empty($msg1))
							echo'<font color=\"red\" style=\"padding-left:10px;\">'.$msg1.'</font>';
						?>
						<form action="#" method="post">
							<input type="text" placeholder="Name" name="username"/>
							<input type="email" placeholder="Email Address" name="useremail"/>
							<input type="text" placeholder="Address" name="address"/>
							<input type="text" placeholder="Phone Number" name="phone"/>
                            <input type="password" placeholder="Password" name="userpassword"/>
							<input type="password" placeholder="Confrim Password" name="usercompassword"/>
                          
							<button type="submit" class="btn btn-default" name="btnSignup">Signup</button>
						</form> 
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
	
	
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