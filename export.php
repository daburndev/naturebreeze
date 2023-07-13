<?php
	require_once('conn.php');
	connect();

	error_reporting(E_ALL);
	ini_set('display_errors', TRUE);
	ini_set('display_startup_errors', TRUE);
	date_default_timezone_set('Asia/Rangoon');

	if (PHP_SAPI == 'cli')
		die('This example should only be run from a Web Browser');

	/** Include PHPExcel */
	require_once 'PHPExcel.php';
  	//$this->load->library('PHPExcel');


	// Create new PHPExcel object
	$objPHPExcel = new PHPExcel();

	// Set document properties
	$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
								 ->setLastModifiedBy("Maarten Balliauw")
								 ->setTitle("Office 2007 XLSX Test Document")
								 ->setSubject("Office 2007 XLSX Test Document")
								 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
								 ->setKeywords("office 2007 openxml php")
								 ->setCategory("Test result file");

	$file_name = "order_lists";

	$styleArray = array(
    'font'  => array(
        'bold'  => true,
        'color' => array('rgb' => '000000'),
        'size'  => 13
    ));

	$sheet = $objPHPExcel->setActiveSheetIndex(0);
	$sheet->setCellValueByColumnAndRow(0, 1, " -- Order Lists -- ");
	$sheet->mergeCells('A1:H1');
	$sheet->getStyle('A1')->getAlignment()->applyFromArray(
	    array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,)
	);
	$objPHPExcel->setActiveSheetIndex()->getStyle('A1')->applyFromArray($styleArray);

	$sheet->setCellValueByColumnAndRow(0, 2, "order");
	$sheet->mergeCells('A2:H2');
	$sheet->getStyle('A2')->getAlignment()->applyFromArray(
	    array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,)
	);
	$objPHPExcel->setActiveSheetIndex()->getStyle('A2')->applyFromArray($styleArray);

	// Add some data
	$objPHPExcel->setActiveSheetIndex(0)
			            ->setCellValue('A3', 'User ID')
			            ->setCellValue('B3', 'Item')
			            ->setCellValue('C3', 'Price')
			            ->setCellValue('D3', 'Quantity')
			            ->setCellValue('E3', 'Payment')
			            ->setCellValue('F3', 'Status')
			            ->setCellValue('G3', 'Total Amount')
			            ->setCellValue('H3', 'Action');

	$objPHPExcel->setActiveSheetIndex()->getStyle('A3')->applyFromArray($styleArray);
	$objPHPExcel->setActiveSheetIndex()->getStyle('B3')->applyFromArray($styleArray);
	$objPHPExcel->setActiveSheetIndex()->getStyle('C3')->applyFromArray($styleArray);
	$objPHPExcel->setActiveSheetIndex()->getStyle('D3')->applyFromArray($styleArray);
	$objPHPExcel->setActiveSheetIndex()->getStyle('E3')->applyFromArray($styleArray);
	$objPHPExcel->setActiveSheetIndex()->getStyle('F3')->applyFromArray($styleArray);
	$objPHPExcel->setActiveSheetIndex()->getStyle('G3')->applyFromArray($styleArray);
	$objPHPExcel->setActiveSheetIndex()->getStyle('H3')->applyFromArray($styleArray);

	$sheet->getStyle('A3')->applyFromArray(
	    array(
	        'fill' => array(
	            'type' => PHPExcel_Style_Fill::FILL_SOLID,
	            'color' => array('rgb' => 'D2BFFF')
	        )
	    )
	);
	$sheet->getStyle('B3')->applyFromArray(
	    array(
	        'fill' => array(
	            'type' => PHPExcel_Style_Fill::FILL_SOLID,
	            'color' => array('rgb' => 'D2BFFF')
	        )
	    )
	);
	$sheet->getStyle('C3')->applyFromArray(
	    array(
	        'fill' => array(
	            'type' => PHPExcel_Style_Fill::FILL_SOLID,
	            'color' => array('rgb' => 'D2BFFF')
	        )
	    )
	);
	$sheet->getStyle('D3')->applyFromArray(
	    array(
	        'fill' => array(
	            'type' => PHPExcel_Style_Fill::FILL_SOLID,
	            'color' => array('rgb' => 'D2BFFF')
	        )
	    )
	);
	$sheet->getStyle('E3')->applyFromArray(
	    array(
	        'fill' => array(
	            'type' => PHPExcel_Style_Fill::FILL_SOLID,
	            'color' => array('rgb' => 'D2BFFF')
	        )
	    )
	);
	$sheet->getStyle('F3')->applyFromArray(
	    array(
	        'fill' => array(
	            'type' => PHPExcel_Style_Fill::FILL_SOLID,
	            'color' => array('rgb' => 'D2BFFF')
	        )
	    )
	);
	$sheet->getStyle('G3')->applyFromArray(
	    array(
	        'fill' => array(
	            'type' => PHPExcel_Style_Fill::FILL_SOLID,
	            'color' => array('rgb' => 'D2BFFF')
	        )
	    )
	);
	$sheet->getStyle('H3')->applyFromArray(
	    array(
	        'fill' => array(
	            'type' => PHPExcel_Style_Fill::FILL_SOLID,
	            'color' => array('rgb' => 'D2BFFF')
	        )
	    )
	);


	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('B22','Addding');
	$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A22:C22');

	$order = "";
	$query=mysql_query("SELECT o.*,c.*,co.qty as camera_qty,co.cprice as unit_price,p.paymenttype,p.paymentdate, u.* FROM `order` o JOIN camera_order co ON co.orderid = o.orderid JOIN payment p ON p.oderid = o.orderid JOIN camera c ON c.cid = co.cid JOIN user u ON u.userid = o.userid ORDER BY o.orderid");

	$no = 3;
	while($row=mysql_fetch_array($query))
	{
		//$e = 1;
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
    			$sheet = $objPHPExcel->setActiveSheetIndex(0);
				$sheet->setCellValueByColumnAndRow(0, $no+1, $orderid);
				$sheet->mergeCells('A'.($no+1).':G'.($no+1));
				$sheet->getStyle('A'.($no+1))->getAlignment()->applyFromArray(
				    array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,)
				);
				$sheet->getStyle('A'.($no+1))->applyFromArray(
				    array(
				        'fill' => array(
				            'type' => PHPExcel_Style_Fill::FILL_SOLID,
				            'color' => array('rgb' => 'FFC8C8')
				        )
				    )
				);

				$objPHPExcel->setActiveSheetIndex(0)
	            			->setCellValue('H'.($no+1), "Pending");
    			
				$sheet->getStyle('H'.($no+1))->applyFromArray(
				    array(
				        'fill' => array(
				            'type' => PHPExcel_Style_Fill::FILL_SOLID,
				            'color' => array('rgb' => 'FFC8C8')
				        )
				    )
				);
    		}
    		else{
    			$sheet = $objPHPExcel->setActiveSheetIndex(0);
				$sheet->setCellValueByColumnAndRow(0, $no+1, $orderid);
				$sheet->mergeCells('A'.($no+1).':G'.($no+1));
				$sheet->getStyle('A'.($no+1))->getAlignment()->applyFromArray(
				    array(
				    	'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				    )
				);
				$sheet->getStyle('A'.($no+1))->applyFromArray(
				    array(
				        'fill' => array(
				            'type' => PHPExcel_Style_Fill::FILL_SOLID,
				            'color' => array('rgb' => 'D7F5DF')
				        )
				    )
				);

				$objPHPExcel->setActiveSheetIndex(0)
	            			->setCellValue('H'.($no+1), "Approve");

				$sheet->getStyle('H'.($no+1))->applyFromArray(
				    array(
				        'fill' => array(
				            'type' => PHPExcel_Style_Fill::FILL_SOLID,
				            'color' => array('rgb' => 'D7F5DF')
				        )
				    )
				);
    		}

			$order = $orderid;
			$no = $no+1;
		}
		

		$objPHPExcel->setActiveSheetIndex(0)
	            			->setCellValue('A'.($no+1), $customer_id);
		$objPHPExcel->setActiveSheetIndex(0)
	            			->setCellValue('B'.($no+1), $cbrandname.' '.$cmodel);
		$objPHPExcel->setActiveSheetIndex(0)
	            			->setCellValue('C'.($no+1), $cprice);
		$objPHPExcel->setActiveSheetIndex(0)
	            			->setCellValue('D'.($no+1), $qty);
		$objPHPExcel->setActiveSheetIndex(0)
	            			->setCellValue('E'.($no+1), $paymenttype);
		$objPHPExcel->setActiveSheetIndex(0)
	            			->setCellValue('F'.($no+1), $status);
		$objPHPExcel->setActiveSheetIndex(0)
	            			->setCellValue('G'.($no+1), $totalamount);
		$objPHPExcel->setActiveSheetIndex(0)
	            			->setCellValue('H'.($no+1), "");

	    $no++;

	}

	// Miscellaneous glyphs, UTF-8
	/*$objPHPExcel->setActiveSheetIndex(0)
	            ->setCellValue('A4', 'Miscellaneous glyphs')
	            ->setCellValue('A5', 'éàèùâêîôûëïüÿäöüç');*/

	// Rename worksheet
	$objPHPExcel->getActiveSheet()->setTitle('Order');


	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	$objPHPExcel->setActiveSheetIndex(0);


	// Redirect output to a client’s web browser (Excel5)
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="'. $file_name .'.xls"');
	header('Cache-Control: max-age=0');
	// If you're serving to IE 9, then the following may be needed
	header('Cache-Control: max-age=1');

	// If you're serving to IE over SSL, then the following may be needed
	header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
	header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
	header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
	header ('Pragma: public'); // HTTP/1.0

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');
	exit;
?>