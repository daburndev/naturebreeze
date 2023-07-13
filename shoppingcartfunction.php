<?php	
	require_once('conn.php');

	function insert($cid,$qty)
	{
		connect();
		$ProductSelect = "Select * from camera
		where  cid='$cid' ";
			$ProductRet = mysql_query($ProductSelect) or die (mysql_error());
			$ProductCount = mysql_num_rows($ProductRet);
			$ProductRow = mysql_fetch_array($ProductRet);

			$cbrandname = $ProductRow['cbrandname'];
			$cmodel =$ProductRow['cmodel'];
			$cprice = $ProductRow['cprice'];
			//$qty = $ProductRow['qty'];
			//$modelno = $ProductRow['ModelNo'];
			$photo = $ProductRow['photo'];
			
			if(isset($_SESSION['shoppingcart']))
			{
				$index=IndexOf($cid);			
				if($index==-1)
				{
					$size=count($_SESSION['shoppingcart']);
						$_SESSION['shoppingcart'][$size]['cid'] = $cid;
					$_SESSION['shoppingcart'][$size]['cbrandname'] = $cbrandname;
					$_SESSION['shoppingcart'][$size]['cmodel'] = $cmodel;
					$_SESSION['shoppingcart'][$size]['cprice'] = $cprice;
						$_SESSION['shoppingcart'][$size]['qty'] =$qty;
					$_SESSION['shoppingcart'][$size]['photo'] = $photo;
					//$_SESSION['shoppingcart'][$size]['Quantity'] =$qty;
					//$_SESSION['shoppingcart'][$size]['ImageFileName'] = $ImageFileName;
				}
				if($index!=-1)
				{
					$_SESSION['shoppingcart'][$index]['qty']+=$qty;	
				}
			}
			else
			{
				$_SESSION['shoppingcart'] = array();
				$_SESSION['shoppingcart'][0]['cid'] = $cid;
				$_SESSION['shoppingcart'][0]['cbrandname'] = $cbrandname;
				$_SESSION['shoppingcart'][0]['cmodel'] = $cmodel;
				$_SESSION['shoppingcart'][0]['cprice'] = $cprice;
				$_SESSION['shoppingcart'][0]['qty'] = $qty;
				//$_SESSION['shoppingcart'][0]['modelno'] = $modelno;
				$_SESSION['shoppingcart'][0]['photo'] = $photo;
			}
	}
	function remove($cid)
	{
		$index=IndexOf($cid);
		if($index>-1)
		{
			unset($_SESSION['shoppingcart'][$index]);
		}
		$_SESSION['shoppingcart'] = array_values($_SESSION['shoppingcart']);
	}

	//unset($_SESSION['shoppingcart']; shpopping cart ko phyat tr
	//unset($_SESSION['shoppingcart'][2]); shopping cart htae ka index ko phyat tr
	//unset($_SESSION['shoppingcart'][2]['pid']; 

	function clear()
	{
		unset($_SESSION['shoppingcart']);
	}

	function Get_TotalAmount() //product tway yet total amount ko + pay tat function.
	{
		if(!isset($_SESSION['shoppingcart']))
		{
			return 0;
		}
		$total=0;
		$size=count($_SESSION['shoppingcart']);
		
		for($i=0;$i<$size;$i++)
		{
			$qty=$_SESSION['shoppingcart'][$i]['qty'];
			$cprice=$_SESSION['shoppingcart'][$i]['cprice'];
			
			$total=$total+($qty*$cprice);
		}
		return $total;
	}
	
	
	function Get_Qty() //product tway yet total amount ko + pay tat function.
	{
		if(!isset($_SESSION['shoppingcart']))
		{
			return 0;
		}
		$total=0;
		$size=count($_SESSION['shoppingcart']);
		
		for($i=0;$i<$size;$i++)
		{
			$qty=$_SESSION['shoppingcart'][$i]['qty'];
					
			$total=$total+$qty;
		}
		return $total;
	}

	function IndexOf($productid) // array htae mhr shi tat product id shi tat index(product index) ko htou pya 
	{
		if(!isset($_SESSION['shoppingcart']))
		return -1;
		$size=count($_SESSION['shoppingcart']);
		
		if($size==0)
		return -1;
		for($i=0;$i<$size;$i++)
		{
			if($productid==$_SESSION['shoppingcart'][$i]['cid'])
			{
				return $i;
			}
		}
		return -1;
	}
?>