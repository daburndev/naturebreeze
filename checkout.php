<?php
require_once("conn.php");
require_once("function.php");
require_once("shoppingcartfunction.php");
connect();
$email = $_SESSION["email"];
$Select = "select * from user where email = '$email'";
$CusRet = mysql_query($Select);

$CusRow = mysql_fetch_array($CusRet);

if(isset($_POST['btnCheckOut']))
{
	var_dump($_SESSION);
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

	 $saleInsert = "insert into `order` values('$orderid','$userid','$orderdate','$totalamount','Pending')";
	 var_dump($saleInsert);
	mysql_query($saleInsert) or die(mysql_error());
	
	
	$insert="insert into payment values('$orderid','$paymentid','$paymenttype','$paymentdate','$amount')";
	mysql_query($insert) or die(mysql_error());

	$ShoppingCartSize = count($_SESSION['shoppingcart']);
	for($i=0; $i<$ShoppingCartSize; $i++)
	{
		$cid=$_SESSION['shoppingcart'][$i]['cid'];
		$cprice =$_SESSION['shoppingcart'][$i]['cprice'];
		$qty =$_SESSION['shoppingcart'][$i]['qty'];
		$amount = $_SESSION['shoppingcart'][$i]['cprice'] * $_SESSION['shoppingcart'][$i]['qty'];

		 $saleDetailInset = "insert into camera_order values('$cid','$orderid','$cprice','$qty','$amount')";
		mysql_query($saleDetailInset);
		mysql_query("update camera set qty = qty - '$qty'");
		
	}
	echo "<script>window.alert('Thanks You for Your Order. Payment process is depened on your payment type.');		
	window.location.assign('index.php');
		</script>";
	clear();

	
}

?>

<html>
<head>
<title>Naturebreeze | Checkout</title>
</head>
<body bgcolor="#ffffdf">
<center>
  <div id="main">
    <div class="centerblock">
      <div class="lightgreen">
        
      <!-- To Add Form-->
      		<form action="checkout.php" method="post">
			<table border="1" width="90%" align="centre">
				<tr>
					
					<td>
						<label><input type="radio" name="rdopayment" value="myanpay" id="RadioGroup1_5" />MyanPay</label><br />
						<label><input name="rdopayment" type="radio" id="RadioGroup1_6" value="cashondelivery" checked />Cash On Delivery</label><br />  
						<label><input type="radio" name="rdopayment" value="banktransfer" id="RadioGroup1_7" />Bank Transfer</label><br /> 

						</br><textarea name="deliveryAdd" readonly="yes"><?php echo $CusRow['address']; ?></textarea> </br></br>

						<input type="text" readonly="yes" value="<?php echo $CusRow["name"]; ?>" name="txtContactPerson"/><br /> 
						<input type="text" readonly="yes" value="<?php echo $CusRow["phone"]; ?>" name="txtContactPh"/>
					
					</td>
					<td>
						Customer Name 	-<?php echo $CusRow['name']; ?></br>
						Ref No 		-	<?php echo $CusRow['userid']; ?></br>
						Delivery Add 		-<?php echo $CusRow['address']; ?></br>
						Contact No 	 	-<?php echo $CusRow['phone']; ?></br>
						Email 			-<?php echo $CusRow['email']; ?>
					</td>
				</tr>
				<tr>
					<td colspan="4">
						<table border="1" width="100%">
						<tr>
							<th colspan="7">Your Shopping Cart </th>
						</tr>

						<?php
						if(isset($_SESSION['shoppingcart']))
						{
							$ShoppingCartSize = count($_SESSION['shoppingcart']);
							for($i=0; $i<$ShoppingCartSize; $i++)
							{
								$productid=$_SESSION['shoppingcart'][$i]['cid'];
								echo "<tr>";
									echo "<td>".$_SESSION['shoppingcart'][$i]['cmodel']." ".$_SESSION['shoppingcart'][$i]['cbrandname']."</td>";
									echo "<td>".$_SESSION['shoppingcart'][$i]['cprice']."</td>";
									//echo "<td>".$_SESSION['shoppingcart'][$i]['Quantity']."</td>";
									$photo = $_SESSION['shoppingcart'][$i]['photo'];
									echo "<td><img src=\"photo/$photo\" width=\"150\" height=\"150\"/></td>";
									echo "<td>".$_SESSION['shoppingcart'][$i]['qty']."</td>";
									echo "<td>".$_SESSION['shoppingcart'][$i]['cprice'] 
												*
												$_SESSION['shoppingcart'][$i]['qty']
									."</td>";
									echo "<td><a href='shoppingcart.php?action=remove&pid=$productid'>remove</a></td>";
								echo "</tr>";
							}
						}
						else
						{
							echo "<tr><td><h2>Your Cart is Empty</h2></td></tr>";
						}
						?>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="4" align="Center">
						
							<input type="submit" value="Place Order" name="btnCheckOut" />
						
					</td>
				</tr>
			</table>
			</form>

      
      
      </div>
  
    </div>
  </div>
</center>
</html>

