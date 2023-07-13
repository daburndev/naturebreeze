<?php
session_start();
	require_once('conn.php');
	require_once('ccartfunction.php');

	if(isset($_GET['action']))
	{
		$action= $_GET['action'];
		if($action=='add')
		{
			$cid=$_GET['cid'];
			$qty=$_GET['quantity'];
			insert($cid,$qty);
		}

		if($action=='remove')
		{
			$pid=$_GET['pid'];
			remove($cid);
		}

		if($action=='clear')
		{
			clear();
		}
	}
?>
   <html>
   <head></head>
   <body>   
      <table border="1" width="80%">
	<tr>
		
		<th>Brand Name</th>
		<th>Model Name</th>
		<th>Price</th>
        <th>Total Quantity</th>
		<th>Image</th>
		
	</tr>

	<?php
	if(isset($_SESSION['ccart']))
	{
		$ShoppingCartSize = count($_SESSION['ccart']);
		for($i=0; $i<$ShoppingCartSize; $i++)
		{
			$productid=$_SESSION['ccart'][$i]['cid'];  //shopping cart htae ka data twy lo chin yin looping loat ya ml.
			echo "<tr>";
				//echo "<td>".$_SESSION['shoppingcart'][$i]['brandName'].
				//" ".$_SESSION['shoppingcart'][$i]['categoryName']."</td>";
				//echo "<td>".$_SESSION['shoppingcart'][$i]['InstrumentID']."</td>";
				echo "<td>".$_SESSION['ccart'][$i]['cbrandname']."</td>";
				echo "<td>".$_SESSION['ccart'][$i]['cmodel']."</td>";
				echo "<td>".$_SESSION['ccart'][$i]['cprice']."</td>";
				echo "<td>".$_SESSION['ccart'][$i]['quantity']."</td>";
				echo "<td><img src='".$_SESSION['ccart'][$i]['photo']."' width='100' height='100'></td>";
				
				//echo "<td>".$_SESSION['shoppingcart'][$i]['price'] 
					//		*
						//	$_SESSION['shoppingcart'][$i]['Quantity']
//				."</td>";
				echo "<td><a href='ccart.php?
				action=remove&pid=$productid'>remove</a></td>";
			echo "</tr>";
		}
	}
	else
	{
		echo "<tr><td><h2>Your Cart is Empty</h2></td></tr>";
	}
	?>
	</table>
	<h2><a href="ccart.php?action=clear">Clear Cart</a>&nbsp;&nbsp;
	<?php echo  Get_TotalAmount() ; ?>&nbsp;&nbsp;<a href="checkout.php">Check Out</a></h2>
<?php echo  Get_Qty() ; ?>
      
      </div>
  
    </div>
  </div>
</center>
</body>

</html>


