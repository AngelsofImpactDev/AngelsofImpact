<?php
	include('ue-includes/ue-ses_check.php');
	
	$namaTableDatabase		= 'purchase';
	$namaTableDatabaseId	= $namaTableDatabase.'_id';
	$currentServerTime		= time();
	
	//History Related
	$recordHistory			= true;
	$historyTypeName		= 'Purchase';
	
	//Get All Posted Vars
	$auPostedElements = array();
	foreach($_POST as $postedElementsKey => $postedElementsVal) {
		$auPostedElements["$postedElementsKey"] = ueReceiveInput($postedElementsKey,$postedElementsVal,false);
	}
	
	//Init Vars
	$id						= $auPostedElements['id'];
	$detailmode				= $auPostedElements['detailmode'];
	$namaPageUtama			= $auPostedElements['mainpage'];
	$namaHalamanEdit		= $auPostedElements['frompage'];
	$pageparam				= $auPostedElements['pageparam'].'&detailmode='.$detailmode.'&id='.$id;
	$errorList				= array();
	$errorListStr			= '';
	$shipDate				= strtotime($auPostedElements['shipdate'].' '.$auPostedElements['shipmon'].' '.$auPostedElements['shipyear']);
	$payDate				= strtotime($auPostedElements['paydate'].' '.$auPostedElements['paymon'].' '.$auPostedElements['payyear']);
	$shipName				= $auPostedElements['shipname'];
	
	//Required Fields Name
	$requireFieldsNameArr	= array(
		'purchasecode'
	);
	
	//Action START
	foreach($requireFieldsNameArr as $requireFieldsNameArrKey => $requireFieldsNameArrVal) {
		if($auPostedElements["$requireFieldsNameArrVal"] == '') {
			header("Location: $namaHalamanEdit".$pageparam."&err=Please Fill All Fields");
			exit();
		}
	}
	
	//Pattern Check START
	
	//Pattern Check END
	
	if(count($errorList) == 0) {
		switch($detailmode) {
			case 'edit':
				$editDetailQue = ue_query("SELECT * FROM ".$namaTableDatabase." WHERE ".$namaTableDatabase."_id = '".$id."' LIMIT 1");
				@ $editDetailRes = ue_fetch_array($editDetailQue);
				
				//print_r($auPostedElements); exit();
				
				for($i=0;$i<count($auPostedElements['idpurchase']);$i++) {	
					//Shipping START
					$currentShipId = ue_real_escape_string($auPostedElements[$auPostedElements['province']]);
					$shippingEditQue = ue_query("SELECT * FROM shipping WHERE shipping_id = '$currentShipId' LIMIT 1");
					$shippingEditRes = ue_fetch_array($shippingEditQue);
						
					$shippingDataType = $auPostedElements['shiptype'];
					$shippingDataPrice = $shippingEditRes["$shippingDataType"];
					//Shipping END
					
					$updateEachPurchaseQue = "UPDATE ".$namaTableDatabase." SET
					 	shipping_id = '".$currentShipId."',
						purchase_shiptype = '".$shippingDataType."',
						purchase_shipprice = '".$shippingDataPrice."',
						purchase_quantity = '".$auPostedElements['purchase_quant']["$i"]."',
						purchase_weight = '".$auPostedElements['purchase_weight']["$i"]."',
						purchase_address = '".$auPostedElements['address']."',
						purchase_postal = '".$auPostedElements['postal']."',
						purchase_telp = '".$auPostedElements['telp']."',
						purchase_deliverydate = '".$shipDate."',
						purchase_transfername = '".$auPostedElements['bankAccountName']."',
						purchase_transferamount = '".$auPostedElements['bankAmountTransfered']."',
						purchase_trackingcode = '".$auPostedElements['trackingcode']."',
						purchase_comment = '".$auPostedElements['comment']."',
						purchase_shipname = '".$auPostedElements['shipname']."',
						purchase_paydate = '".$payDate."'
					WHERE ".$namaTableDatabase."_id = '".$auPostedElements['idpurchase']["$i"]."'
					";
					
					//echo $updateEachPurchaseQue; exit();
					@ $grandQueryResult = ue_query($updateEachPurchaseQue);
				}
			break;
		}
		
		//Record History START
		$recordHistoryDesc = "
			".$historyTypeName." Name : ".$auPostedElements['name']."
		";
		writeGlobalHistory($historyTypeName,$detailmode,$recordHistoryDesc,$namaTableDatabase,$globalHistoryCorrespondingId,$ue_globvar_recordglobalhistory,$recordHistory);
		//Record History END
		
		//REDIRECTIONS
		switch($detailmode) {
			case 'edit':
				if($grandQueryResult == false) {
					header("Location: $namaPageUtama".$pageparam."&err=Invalid ID");
				}
				else {
					header("Location: $namaPageUtama".$pageparam."&sta=ok");
				}
			break;
			default:
				if($grandQueryResult == false) {
					header("Location: $namaPageUtama".$pageparam."&err=Unable To Insert New Entry");
				}
				else {
					header("Location: $namaPageUtama".$pageparam."&sta=ok");
				}
			break;
		}
		//REDIRECTIONS END
	}
	else {
		//Format Error List
		foreach($errorList as $errorListKey => $errorListVal) {
			$errorListStr .= $errorListVal.'<br />';
		}
		header("Location: $namaHalamanEdit".$pageparam."&err=".$errorListStr);
	}
?>