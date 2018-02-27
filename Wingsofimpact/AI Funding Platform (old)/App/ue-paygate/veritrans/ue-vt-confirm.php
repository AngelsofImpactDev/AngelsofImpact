<?php
session_start();
include('../../ue-config/ue-globalconfig.php');
include('../../ue-config/ue-globalconnect.php');
include('../../ue-config/ue-globalfunction.php');

require_once('Veritrans.php');
Veritrans_Config::$isProduction = true; // Uncomment for production environment

$notif = new Veritrans_Notification();

$transaction = $notif->transaction_status;
$type = $notif->payment_type;
$order_id = $notif->order_id;
$fraud = $notif->fraud_status;

$currentServerTime = time();
$checkAllowConfirm = true;
$editDetailQue = ue_query("SELECT * FROM purchase WHERE purchase_code = '$order_id' LIMIT 1");
@ $editDetailRes = ue_fetch_array($editDetailQue);
if($editDetailRes['purchase_status'] != 'r') {
	$checkAllowConfirm = false;
	$currentPurchasePrice = getPurchaseGrandTotal($editDetailRes['purchase_code']);
}

if($checkAllowConfirm) {
	if ($transaction == 'capture') {
	  	// For credit card transaction, we need to check whether transaction is challenge by FDS or not
		if ($type == 'credit_card'){
			if($fraud == 'challenge'){
				// TODO set payment status in merchant's database to 'Challenge by FDS'
				// TODO merchant should decide whether this transaction is authorized or not in MAP
				ueCancelPurchase($editDetailRes['purchase_id']);
				exit(header("Status: 200 OK"));
				//header("Location: purchasedetail.php?pcode=".$editDetailRes[purchase_code]."&mes=Payment is on hold, please wait for our confirmation");
				// echo "Transaction order_id: " . $order_id ." is challenged by FDS";
			} else {
				// TODO set payment status in merchant's database to 'Success'
				ueConfirmPurchase($editDetailRes['purchase_id'],'Veritrans',$currentPurchasePrice,$currentServerTime,false);
				ueApprovePurchase($editDetailRes['purchase_id'],$auPostedElements['trackingcode']);
				exit(header("Status: 200 OK"));
				//header("Location: purchasedetail.php?pcode=".$editDetailRes[purchase_code]);
				// echo "Transaction order_id: " . $order_id ." successfully captured using " . $type;
			}
	  	}
	}
	else if ($transaction == 'settlement') {
		// TODO set payment status in merchant's database to 'Settlement'
		ueConfirmPurchase($editDetailRes['purchase_id'],'Veritrans',$currentPurchasePrice,$currentServerTime,false);
		ueApprovePurchase($editDetailRes['purchase_id'],$auPostedElements['trackingcode']);
		exit(header("Status: 200 OK"));
		//header("Location: purchasedetail.php?pcode=".$editDetailRes[purchase_code]);
		//echo "Transaction order_id: " . $order_id ." successfully transfered using " . $type;
	}
	else if($transaction == 'pending') {
		// TODO set payment status in merchant's database to 'Pending'
		ueConfirmPurchase($editDetailRes['purchase_id'],'Veritrans',$currentPurchasePrice,$currentServerTime);
		exit(header("Status: 200 OK"));
		//header("Location: purchasedetail.php?pcode=".$editDetailRes[purchase_code]."&mes=Payment is pending, please wait for our confirmation");
		//echo "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
	}
	else if ($transaction == 'deny') {
		// TODO set payment status in merchant's database to 'Denied'
		ueCancelPurchase($editDetailRes['purchase_id']);
		exit(header("Status: 200 OK"));
		//header("Location: purchasedetail.php?pcode=".$editDetailRes[purchase_code]."&err=Your payment is rejected, please contact your issuing bank for more details");
		//echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
	}
}
else {
	header("Location: ../../index.php?pcode=".$editDetailRes['purchase_code']."&err=Payment failed, please try again later");
	exit();
}
?>