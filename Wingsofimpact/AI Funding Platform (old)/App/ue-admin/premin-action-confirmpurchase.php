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
	
	//print_r($auPostedElements); exit();
	
	//Init Vars
	$id						= $auPostedElements['id'];
	$detailmode				= $auPostedElements['detailmode'];
	$namaPageUtama			= $auPostedElements['mainpage'];
	$namaHalamanEdit		= $auPostedElements['frompage'];
	$pageparam				= $auPostedElements['pageparam'].'&detailmode='.$detailmode.'&id='.$id;
	$cmode					= $auPostedElements['cmode'];
	$errorList				= array();
	$errorListStr			= '';
	
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
				
				if($cmode == 'Reject Purchase') {
					if($editDetailRes[$namaTableDatabase."_status"] == 'x') {
						header("Location: $namaPageUtama".$pageparam."&err=Already Rejected");
						exit();
					}
					else {
						$grandQueryResult = ueRejectPurchase($editDetailRes['purchase_id']);
					}
				}
				else if($cmode == 'Cancel Purchase') {
					if($editDetailRes[$namaTableDatabase."_status"] == 'z') {
						header("Location: $namaPageUtama".$pageparam."&err=Already Canceled");
						exit();
					}
					else {
						$grandQueryResult = ueCancelPurchase($editDetailRes['purchase_id'],true,false);
					}
				}
				else {
					$grandQueryResult = ueApprovePurchase($editDetailRes['purchase_id'],$auPostedElements['trackingcode'],false);
				}
				$globalHistoryCorrespondingId = $id;
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
					if($grandQueryResult['sta'] != '') {
						$writeGetKey = 'sta';
						$writeGetVal = $grandQueryResult['sta'];
					}
					else if($grandQueryResult['err'] != '') {
						$writeGetKey = 'err';
						$writeGetVal = $grandQueryResult['err'];
					}
					else {
						$writeGetKey = 'sta';
						$writeGetVal = 'ok';
					}
					//Send Approval Email END
					header("Location: $namaPageUtama".$pageparam."&".$writeGetKey."=".$writeGetVal);
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