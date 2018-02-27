<?php
    session_start();
    include('../ue-config/ue-globalconfig.php');
    include('../ue-config/ue-globalconnect.php');
    include('../ue-config/ue-globalfunction.php');
    include('ue-includes/ue-globVarAdm.php');
    include('ue-includes/ue-globFuncAdm.php');
    
    //Get All Posted Vars
    $auPostedElements = array();
    foreach($_POST as $postedElementsKey => $postedElementsVal) {
        $auPostedElements["$postedElementsKey"] = ue_real_escape_string($postedElementsVal);
    }
	
	$numberDepan = 1;
    $dates = array();
	$isiReport = array();
    $fcurrent = strtotime($auPostedElements['startdate'].' '.$auPostedElements['startmon'].' '.$auPostedElements['startyear'].' 00:00');
    $current = strtotime($auPostedElements['startdate'].' '.$auPostedElements['startmon'].' '.$auPostedElements['startyear'].' 00:00');
    $last = strtotime($auPostedElements['enddate'].' '.$auPostedElements['endmon'].' '.$auPostedElements['endyear'].' 23:59');
    $namaTableDatabase = $auPostedElements['ovtable'];
	$reportType = $auPostedElements['reportType'];
	$ovtitle = $auPostedElements['ovtitle'];
	$ovmainpage = $auPostedElements['ovmainpage'];
	$currentServerTime = time();
	
	switch($namaTableDatabase) {
		case 'purchase':
			// Type C Start
			if($reportType == 'typeC') {
				$overviewReportQueStr = '
					SELECT * FROM '.$namaTableDatabase.'
					INNER JOIN product ON
						'.$namaTableDatabase.'.product_id = product.product_id
					INNER JOIN productcolor ON
						'.$namaTableDatabase.'.productcolor_id = productcolor.productcolor_id
					INNER JOIN productsize ON
						'.$namaTableDatabase.'.productsize_id = productsize.productsize_id
					INNER JOIN producttype ON
						product.producttype_id = producttype.producttype_id
					INNER JOIN productcategory ON
						producttype.productcategory_id = productcategory.productcategory_id
					INNER JOIN productclass ON
						productcategory.productclass_id = productclass.productclass_id
					WHERE
						'.$namaTableDatabase.'_status = "a" AND
						'.$namaTableDatabase.'_entrydate >= "'.$current.'" AND
						'.$namaTableDatabase.'_entrydate <= "'.$last.'"
					ORDER BY '.$namaTableDatabase.'_entrydate DESC
				';
				
				$overviewReportQue = ue_query($overviewReportQueStr);
				@ $overviewReportNum = ue_num_rows($overviewReportQue);
				
				if($overviewReportNum > 0) {
					$isiReport[] = array('Sold Items Report'); // CSV Title
					$isiReport[] = array(
						'No.',
						'Purchase Date',
						'Confirm Date',
						'Purchase Code',
						'Product ID',
						'Class Name',
						'Category Name',
						'Type Name',
						'Brand Name',
						'Product Name',
						'Product Color',
						'Product Size',
						'Quantity'
					); //CSV Header
					
					while($overviewReportRes = ue_fetch_array($overviewReportQue)) {
						//Date Format
						if($overviewReportRes["$namaTableDatabase"."_entrydate"] > 0) {
							$entryDateCSV = unixtodatefull($overviewReportRes["$namaTableDatabase"."_entrydate"]);
						}
						else {
							$entryDateCSV = '';
						}
						if($overviewReportRes["$namaTableDatabase"."_editdate"] > 0) {
							$editDateCSV = unixtodatefull($overviewReportRes["$namaTableDatabase"."_editdate"]);
						}
						else {
							$editDateCSV = '';
						}
						
						//Brand Check
						if($overviewReportRes["productbrand_id"] > 0) {
							$brandCheckQue = ue_query("SELECT productbrand_name FROM productbrand WHERE productbrand_id = '".$overviewReportRes["productbrand_id"]."' LIMIT 1");
							@ $brandCheckRes = ue_fetch_array($brandCheckQue);
							if($brandCheckRes['productbrand_name']) {
								$brandNameWrite = $brandCheckRes['productbrand_name'];
							}
							else {
								$brandNameWrite = '';
							}
						}
						
						$isiReport[] = array(
							$numberDepan,
							$entryDateCSV,
							$editDateCSV,
							$overviewReportRes["$namaTableDatabase"."_code"],
							$overviewReportRes["product_id"],
							$overviewReportRes["productclass_name"],
							$overviewReportRes["productcategory_name"],
							$overviewReportRes["producttype_name"],
							$brandNameWrite,
							$overviewReportRes["product_name"],
							$overviewReportRes["productcolor_name"],
							$overviewReportRes["productsize_name"],
							$overviewReportRes["$namaTableDatabase"."_quantity"]
						);
						$numberDepan++;
					}
				}
			} // Type C End
			else if($reportType == 'typeB') { // Type B Start
				$overviewReportQueStr = '
					SELECT * FROM '.$namaTableDatabase.'
					WHERE
						'.$namaTableDatabase.'_entrydate >= "'.$current.'" AND
						'.$namaTableDatabase.'_entrydate <= "'.$last.'"
					GROUP BY '.$namaTableDatabase.'_code
					ORDER BY '.$namaTableDatabase.'_entrydate DESC
				';
				
				$overviewReportQue = ue_query($overviewReportQueStr);
				@ $overviewReportNum = ue_num_rows($overviewReportQue);
				if($overviewReportNum > 0) {
					$isiReport[] = array('Sales Report'); // CSV Title
					$isiReport[] = array(
						'No.',
						'Purchase Date',
						'Confirm Date',
						'Purchase Code',
						'Name',
						'Email',
						'Shipping Province',
						'Shipping City',
						'Shipping Address',
						'Shipping Price',
						'Shipping Weight',
						'Promo Name',
						'Promo Code',
						'Promo Discount Amount',
						'Payment Code',
						'Credits Used',
						'Trasferred To',
						'Bank Account Name',
						'Transfer Amount',
						'Purchase Status',
						'Tracking Code',
						'GRAND TOTAL'
					); //CSV Header
					while($overviewReportRes = ue_fetch_array($overviewReportQue)) {
						//Date Format
						if($overviewReportRes["$namaTableDatabase"."_entrydate"] > 0) {
							$entryDateCSV = unixtodatefull($overviewReportRes["$namaTableDatabase"."_entrydate"]);
						}
						else {
							$entryDateCSV = '';
						}
						if($overviewReportRes["$namaTableDatabase"."_editdate"] > 0) {
							$editDateCSV = unixtodatefull($overviewReportRes["$namaTableDatabase"."_editdate"]);
						}
						else {
							$editDateCSV = '';
						}
						
						//Shipping Data
						$overviewShipDataQue = ue_query("SELECT * FROM shipping WHERE shipping_id = '".$overviewReportRes["shipping_id"]."' LIMIT 1");
						@ $overviewShipDataRes = ue_fetch_array($overviewShipDataQue);
						$currentGrandShippingCSV = getShippingPrice($overviewReportRes["$namaTableDatabase".'_code']);
						
						//Promo Data
						$promoDataQue = ue_query("SELECT * FROM promo WHERE promo_id = '".$overviewReportRes["promo_id"]."' LIMIT 1");
						@ $promoDataRes = ue_fetch_array($promoDataQue);
						if($promoDataRes['promo_code']) {
							$promoNameWrite = $promoDataRes['promo_name'];
							$promoCodeWrite = $promoDataRes['promo_code'];
						}
						else {
							$promoNameWrite = '';
							$promoCodeWrite = '';
						}
						
						//Bank Data
						$bankDataQue = ue_query("SELECT * FROM bank WHERE bank_id = '".$overviewReportRes["bank_id"]."' LIMIT 1");
						@ $bankDataRes = ue_fetch_array($bankDataQue);
						
						//Purchase Status
						switch($overviewReportRes["$namaTableDatabase"."_status"]) {
							case 'r':
								$purchaseStatusOverviewCSV = 'Request';
							break;
							case 'c':
								$purchaseStatusOverviewCSV = 'Confirmed';
							break;
							case 'a':
								$purchaseStatusOverviewCSV = 'Approved';
							break;
							case 'x':
								$purchaseStatusOverviewCSV = 'Rejected';
							break;
							case 'z':
								$purchaseStatusOverviewCSV = 'Canceled';
							break;
						}
						
						//Grand Total
						$currentGrandTotalCSV = getPurchaseGrandTotal($overviewReportRes["$namaTableDatabase".'_code']);
						
						$isiReport[] = array(
							$numberDepan,
							$entryDateCSV,
							$editDateCSV,
							$overviewReportRes["$namaTableDatabase"."_code"],
							$overviewReportRes["$namaTableDatabase"."_name"],
							$overviewReportRes["$namaTableDatabase"."_email"],
							$overviewShipDataRes["shipping_area"],
							$overviewShipDataRes["shipping_name"],
							$overviewReportRes["$namaTableDatabase"."_address"],
							$currentGrandShippingCSV,
							$overviewReportRes["$namaTableDatabase"."_weight"],
							$promoNameWrite,
							$promoCodeWrite,
							$overviewReportRes["$namaTableDatabase"."_discount"],
							$overviewReportRes["$namaTableDatabase"."_paycode"],
							$overviewReportRes["$namaTableDatabase"."_creditsused"],
							$bankDataRes["bank_name"],
							$overviewReportRes["$namaTableDatabase"."_transfername"],
							$overviewReportRes["$namaTableDatabase"."_transferamount"],
							$purchaseStatusOverviewCSV,
							$overviewReportRes["$namaTableDatabase"."_trackingcode"],
							$currentGrandTotalCSV
						);
						$numberDepan++;
					}
				}
			} //Type B END
			else if($reportType == 'typeA') { //Type A START
				//Get Product Types
				$ptypeArr = array();
				$ptypeIdAndName = array();
				$pcateIdAndName = array();
				$pclassIdAndName = array();
				$productTypeDataQueStr = "
					SELECT * FROM producttype
					INNER JOIN productcategory ON
						producttype.productcategory_id = productcategory.productcategory_id
					INNER JOIN productclass ON
						productcategory.productclass_id = productclass.productclass_id
					WHERE producttype_enabled = 'e'
					ORDER BY producttype_showorder DESC
				";
				$productTypeDataQue = ue_query($productTypeDataQueStr);
				while($productTypeDataRes = ue_fetch_array($productTypeDataQue)) {
					$ptypeArr[$productTypeDataRes["producttype_name"]] = 0;
					$ptypeIdAndName[$productTypeDataRes["producttype_id"]] = $productTypeDataRes["producttype_name"];
					$pcateIdAndName[$productTypeDataRes["productcategory_id"]] = $productTypeDataRes["productcategory_name"];
					$pclassIdAndName[$productTypeDataRes["productclass_id"]] = $productTypeDataRes["productclass_name"];
				}
				
				for($i=$current;$i<=$last;$i+=86400) {
					$currentDate = unixtodate($i);
					$dates["$currentDate"] = $ptypeArr;
				}
				
				$overviewReportQueStr = '
					SELECT * FROM '.$namaTableDatabase.'
					WHERE
						'.$namaTableDatabase.'_status = "a" AND
						'.$namaTableDatabase.'_entrydate >= "'.$current.'" AND
						'.$namaTableDatabase.'_entrydate <= "'.$last.'"
				';
				
				$overviewReportQue = ue_query($overviewReportQueStr);
				@ $overviewReportNum = ue_num_rows($overviewReportQue);
				if($overviewReportNum > 0) {
					while($overviewReportRes = ue_fetch_array($overviewReportQue)) {
						$cekArrTypeDate = unixtodate($overviewReportRes["$namaTableDatabase".'_entrydate']);
						$dates["$cekArrTypeDate"][$ptypeIdAndName[$overviewReportRes['producttype_id']]] = $dates["$cekArrTypeDate"][$ptypeIdAndName[$overviewReportRes['producttype_id']]] + (int)$overviewReportRes["$namaTableDatabase".'_quantity'];
					}
					
					$isiReport[] = array('Product Class, Category and Type Sales Report'); // CSV Title
					
					//Product Classes
					foreach($pclassIdAndName as $pclassIdAndNameKey => $pclassIdAndNameVal) {
						$isiReport[] = array(
							'',
							'',
							$pclassIdAndNameVal
						); 
					}
					
					//Product Categories
					foreach($pcateIdAndName as $pcateIdAndNameKey => $pcateIdAndNameVal) {
						$isiReport[] = array(
							'',
							'',
							$pcateIdAndNameVal
						); 
					}
					
					//Product Types
					$isiReport[] = array(
						'No.',
						'Purchase Date',
					); 
					foreach($ptypeIdAndName as $ptypeIdAndNameKey => $ptypeIdAndNameVal) {
						$isiReport['3'][] = $ptypeIdAndNameVal;
					}
					
					foreach($dates as $datesKey => $datesVal) {
						array_unshift($datesVal, $numberDepan, $datesKey);
						$isiReport[] = $datesVal;
						$numberDepan++;
					}
					//CSV Header
				}
			} //Type A END
		break;
		default:
			if($reportType == 'typeD') {
				$overviewReportQueStr = '
					SELECT * FROM '.$namaTableDatabase.'
					WHERE
						'.$namaTableDatabase.'_entrydate >= "'.$current.'" AND
						'.$namaTableDatabase.'_entrydate <= "'.$last.'"
				';
				
				$overviewReportQue = ue_query($overviewReportQueStr);
				@ $overviewReportNum = ue_num_rows($overviewReportQue);
				if($overviewReportNum > 0) {
					$arrayIdx = 2;
					$arrayHeadWritten = false;
					
					$rawDataExportAllowColumn = array(
						'enabled'	=> 'Status',
						'desc'		=> 'Description',
						'source'	=> 'Source',
						'email'		=> 'Email',
						'address'	=> 'Address',
						'telp'		=> 'Tel',
						'gender'	=> 'Gender',
						'postal'	=> 'Postal',
						'credit'	=> 'Credit',
						'code'		=> 'Code',
						'used'		=> 'Times Used'
					);
					
					$reportTitleCSV = ucfirst($ovtitle).' Data Export';
					$isiReport[] = array($reportTitleCSV); // CSV Title
					$isiReport['1'] = array('No.');
					$isiReport['1'][] = 'Entry Date';
					$isiReport['1'][] = 'Name';
					
					while($overviewReportRes = ue_fetch_array($overviewReportQue)) {
						if(!$arrayHeadWritten) {
							foreach($rawDataExportAllowColumn as $rawDataExportAllowColumnKey => $rawDataExportAllowColumnVal) {
								if($overviewReportRes["$namaTableDatabase".'_'.$rawDataExportAllowColumnKey] != '') {
									$isiReport['1'][] = $rawDataExportAllowColumnVal;
								}
							}
							$arrayHeadWritten = true;
						}
						
						$isiReport["$arrayIdx"][] = $overviewReportRes["$namaTableDatabase".'_id'];
						$isiReport["$arrayIdx"][] = unixtodate($overviewReportRes["$namaTableDatabase".'_entrydate']);
						$isiReport["$arrayIdx"][] = $overviewReportRes["$namaTableDatabase".'_name'];
						foreach($rawDataExportAllowColumn as $rawDataExportAllowColumnKey => $rawDataExportAllowColumnVal) {
							if($overviewReportRes["$namaTableDatabase".'_'.$rawDataExportAllowColumnKey] != '') {
								$isiReport["$arrayIdx"][] = $overviewReportRes["$namaTableDatabase".'_'.$rawDataExportAllowColumnKey];
							}
						}
						$arrayIdx++;
					}
				}
			}
			else {
				for($i=$current;$i<=$last;$i+=86400) {
					$currentDate = unixtodate($i);
					$dates["$currentDate"] = array(
						'e' => 0,
						'd' => 0
					);
				}
					
				$overviewReportQueStr = '
					SELECT * FROM '.$namaTableDatabase.'
					WHERE
						'.$namaTableDatabase.'_entrydate >= "'.$current.'" AND
						'.$namaTableDatabase.'_entrydate <= "'.$last.'"
				';
				
				$overviewReportQue = ue_query($overviewReportQueStr);
				@ $overviewReportNum = ue_num_rows($overviewReportQue);
				if($overviewReportNum > 0) {
					while($overviewReportRes = ue_fetch_array($overviewReportQue)) {
						$cekArrTypeDate = unixtodate($overviewReportRes["$namaTableDatabase".'_entrydate']);					
						$dates["$cekArrTypeDate"][$overviewReportRes["$namaTableDatabase".'_enabled']]++;
					}
					
					$reportTitleCSV = ucfirst($ovtitle).' Report';
					$isiReport[] = array($reportTitleCSV); // CSV Title
					$isiReport[] = array(
						'No.',
						'Date',
						'Enabled',
						'Disabled',
					); 
					foreach($dates as $datesKey => $datesVal) {
						array_unshift($datesVal, $numberDepan, $datesKey);
						$isiReport[] = $datesVal;
						$numberDepan++;
					}
					//CSV Header				
					//print_r($isiReport); exit();
				}
			}
		break;
	}
	
	//print_r($isiReport); exit();
	if($overviewReportNum > 0) {
		$filename = $reportTitleCSV.' '.unixtodatefull($currentServerTime).' UE Report.csv';
		$filename = str_replace(' ','-',$filename);
		$delimiter = ',';
		header('Content-Type: application/csv');
		header('Content-Disposition: attachement; filename="'.$filename.'";');
	
		$f = fopen('php://output', 'w');
		
		foreach ($isiReport as $line) {
			fputcsv($f, $line, $delimiter);
		} 
	}
	else {
		header("Location: overview.php?err=No Data to Report&ovtable=".$namaTableDatabase."&ovtitle=".$ovtitle."&ovmainpage=".$ovmainpage);
		exit();
	}
?>