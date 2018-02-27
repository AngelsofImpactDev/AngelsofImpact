<?php
	session_start();
	include('../ue-config/ue-globalconfig.php');
	include('../ue-config/ue-globalconnect.php');
	include('../ue-config/ue-globalfunction.php');
	
	$auPostedElements = array();
	foreach($_GET as $postedElementsKey => $postedElementsVal) {
		$auPostedElements["$postedElementsKey"] = ueReceiveInput($postedElementsKey,$postedElementsVal,false);
	}
	
	$allowCancel = false;
	$editDetailQue = ue_query("SELECT * FROM purchase WHERE purchase_code = '".$auPostedElements['order_id']."' AND purchase_status = 'r' LIMIT 1");
	@ $editDetailRes = ue_fetch_array($editDetailQue);
	if($editDetailRes["user_id"] > 0) {
		if($_SESSION['currentUserId'] == $editDetailRes["user_id"]) {
			$allowCancel = true;
		}
		else {
			$allowCancel = false;
		}
	}
	else {
		$allowCancel = true;
	}
	
	if($allowCancel) {
		$messageBack = 'Payment failed, please contact your issuing bank for more details';
		$grandQueryResult = ueCancelPurchase($editDetailRes['purchase_id']);
		
		if($editDetailRes["user_id"] > 0) {
			if($_SESSION['currentUserId'] == $editDetailRes["user_id"]) {
				header("Location: ../purchasedetail.php?pcode=".$editDetailRes["purchase_code"].'&err='.$messageBack);
				exit();
			}
			else {
				header("Location: ../index.php?pcode=".$editDetailRes["purchase_code"].'&err='.$messageBack);
				exit();
			}
		}
		else {
			header("Location: ../purchasedetail.php?pcode=".$editDetailRes["purchase_code"]."&pconf=".md5($editDetailRes["purchase_email"].$globvar_adminidsite).'&err='.$messageBack);
			exit();
		}
	}
	else {
		header("Location: ../index.php");
	}
?>