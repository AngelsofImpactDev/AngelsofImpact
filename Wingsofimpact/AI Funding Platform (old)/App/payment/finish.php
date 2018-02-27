<?php
	session_start();
	include('../ue-config/ue-globalconfig.php');
	include('../ue-config/ue-globalconnect.php');
	include('../ue-config/ue-globalfunction.php');
	
	$auPostedElements = array();
	foreach($_GET as $postedElementsKey => $postedElementsVal) {
		$auPostedElements["$postedElementsKey"] = ueReceiveInput($postedElementsKey,$postedElementsVal,false);
	}
	
	$editDetailQue = ue_query("SELECT * FROM purchase WHERE purchase_code = '".$auPostedElements['order_id']."' LIMIT 1");
	@ $editDetailNum = (int)ue_num_rows($editDetailQue);
	
	if($editDetailNum > 0) {
		@ $editDetailRes = ue_fetch_array($editDetailQue);
		$messageBack = 'Your payment have been confirmed, Thank You!';
		
		if($editDetailRes["user_id"] > 0) {
			if($_SESSION['currentUserId'] == $editDetailRes["user_id"]) {
				header("Location: ../purchasedetail.php?pcode=".$editDetailRes["purchase_code"].'&sta='.$messageBack);
				exit();
			}
			else {
				header("Location: ../index.php?pcode=".$editDetailRes["purchase_code"].'&sta='.$messageBack);
				exit();
			}
		}
		else {
			header("Location: ../purchasedetail.php?pcode=".$editDetailRes["purchase_code"]."&pconf=".md5($editDetailRes["purchase_email"].$globvar_adminidsite).'&sta='.$messageBack);
			exit();
		}
	}
	else {
		header("Location: ../index.php");
	}
?>