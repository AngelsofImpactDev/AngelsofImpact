<?php
session_start();
include('../../ue-config/ue-globalconfig.php');
include('../../ue-config/ue-globalconnect.php');
include('../../ue-config/ue-globalfunction.php');

require_once('Veritrans.php');
Veritrans_Config::$serverKey = 'KEYHERE';
Veritrans_Config::$isProduction = true; // Uncomment for production environment
Veritrans_Config::$isSanitized = true;
Veritrans_Config::$is3ds = true;
$payGateAllow = true;

//$_GET['pcode'] = '13ADE74B471T2810141';
$auPostedElements = array();
foreach($_GET as $postedElementsKey => $postedElementsVal) {
	$auPostedElements["$postedElementsKey"] = ueReceiveInput($postedElementsKey,$postedElementsVal,false);
}

//Purchase Check
$purchasePayGateQue = ue_query("SELECT * FROM purchase WHERE purchase_code = '".$auPostedElements['pcode']."' LIMIT 1");
if(@$purchasePayGateRes = ue_fetch_array($purchasePayGateQue)) {
	if($purchasePayGateRes['purchase_status'] != 'r') {
		$payGateAllow = false;
	}
}
else {
	$payGateAllow = false;
}

//Get User Data
if($_SESSION['currentUserId']) {
	$namaTableDatabase = 'user';
	$detailmodeeditQue = ue_query("SELECT * FROM $namaTableDatabase WHERE ".$namaTableDatabase."_id = '".$_SESSION['currentUserId']."' LIMIT 1");
	$detailmodeeditRes = ue_fetch_array($detailmodeeditQue);
	$nameArr = explode(' ',$detailmodeeditRes['user_name']);
	
	$billingEditQue = ue_query("SELECT * FROM shipping WHERE shipping_id = '".$detailmodeeditRes['shipping_id']."' LIMIT 1");
	@ $billingEditRes = ue_fetch_array($billingEditQue);
	
	$shippingEditQue = ue_query("SELECT * FROM shipping WHERE shipping_id = '".$purchasePayGateRes['shipping_id']."' LIMIT 1");
	@ $shippingEditRes = ue_fetch_array($shippingEditQue);
	
	$billing_address = array(
		'first_name'    => $nameArr['0'],
		'last_name'     => $nameArr['1'],
		'address'       => $detailmodeeditRes['user_address'],
		'city'          => $billingEditRes['shipping_area'],
		'postal_code'   => $detailmodeeditRes['user_postal'],
		'phone'         => $detailmodeeditRes['user_telp'],
		'country_code'  => 'IDN'
	);
		
	$shipping_address = array(
		'first_name'    => $nameArr['0'],
		'last_name'     => $nameArr['1'],
		'address'       => $purchasePayGateRes['purchase_address'],
		'city'          => $shippingEditRes['shipping_area'],
		'postal_code'   => $purchasePayGateRes['purchase_postal'],
		'phone'         => $purchasePayGateRes['purchase_telp'],
		'country_code'  => 'IDN'
	);
	
	$customer_details = array(
		'first_name'    => $nameArr['0'],
		'last_name'     => $nameArr['1'],
		'email'         => $detailmodeeditRes['user_email'],
		'phone'         => $detailmodeeditRes['user_telp'],
		'billing_address'  => $billing_address,
		'shipping_address' => $shipping_address
	);
	//print_r($customer_details); exit();
}
else if($_SESSION['guestAccount']) {
	$nameArr = explode(' ',$_SESSION['guestAccountDetails']['name']);
	
	$billingEditQue = ue_query("SELECT * FROM shipping WHERE shipping_id = '".$_SESSION['guestAccountDetails']['shippingid']."' LIMIT 1");
	@ $billingEditRes = ue_fetch_array($billingEditQue);
	
	$shippingEditQue = ue_query("SELECT * FROM shipping WHERE shipping_id = '".$purchasePayGateRes['shipping_id']."' LIMIT 1");
	@ $shippingEditRes = ue_fetch_array($shippingEditQue);
	
	$billing_address = array(
		'first_name'    => $nameArr['0'],
		'last_name'     => $nameArr['1'],
		'address'       => $_SESSION['guestAccountDetails']['address'],
		'city'          => $billingEditRes['shipping_area'],
		'postal_code'   => $_SESSION['guestAccountDetails']['postal'],
		'phone'         => $_SESSION['guestAccountDetails']['telp'],
		'country_code'  => 'IDN'
	);
		
	$shipping_address = array(
		'first_name'    => $nameArr['0'],
		'last_name'     => $nameArr['1'],
		'address'       => $purchasePayGateRes['purchase_address'],
		'city'          => $shippingEditRes['shipping_area'],
		'country_code'  => 'IDN'
	);
	
	$customer_details = array(
		'first_name'    => $nameArr['0'],
		'last_name'     => $nameArr['1'],
		'email'         => $_SESSION['guestAccountDetails']['email'],
		'phone'         => $_SESSION['guestAccountDetails']['telp'],
		'billing_address'  => $billing_address,
		'shipping_address' => $shipping_address
	);
}
else {
	$payGateAllow = false;
}

if($payGateAllow) {
	$grossAmount = getPurchaseGrandTotal($purchasePayGateRes['purchase_code']);	  
	$params = array(
    'payment_type' => 'vtweb',
    'vtweb' => array(
		"enabled_payments" => array("credit_card"),
        'credit_card_3d_secure' => true,
         // Add installment payment option
          "payment_options" => array(
              "installment" => array(
                  "required" => true,
                  "installment_terms" => array(
                      //"bni" => array(6,12),
                      "mandiri" => array(3,6)
                    )
                )
            )
        ),
	'transaction_details' => array(
	  'order_id' => $purchasePayGateRes['purchase_code'],
	  'gross_amount' => $grossAmount,
	),
    'customer_details' => $customer_details
    );
	
	try {
	  // Redirect to Veritrans VTWeb page
	  header('Location: ' . Veritrans_Vtweb::getRedirectionUrl($params));
	}
	catch (Exception $e) {
	  echo $e->getMessage();
	}
} else {
	header("Location: purchasedetail.php?pcode=".$purchasePayGateRes['purchase_code']."&err=Payment failed, please try again later");
	exit();
}
?>