<?php
	session_start();
	include('ue-config/ue-globalconfig.php');
	include('ue-config/ue-globalconnect.php');
	include('ue-config/ue-globalfunction.php');
	include('ue-paygate/stripe/stripe-start.php');
	/*
	require 'ue-paygate/stripe/Stripe.php';
	require 'ue-paygate/stripe/stripe-config.php';
	*/
	$namaTableDatabase		= 'user';
	$namaTableDatabaseId	= $namaTableDatabase.'_id';
	$currentServerTime		= time();
	
	//Get All Posted Vars
	$auPostedElements = array();
	foreach($_GET as $postedElementsKey => $postedElementsVal) {
		$auPostedElements["$postedElementsKey"] = ueReceiveInput($postedElementsKey,$postedElementsVal);
	}
	
	//Init Vars
	$id						= $auPostedElements['id'];
	$namaPageUtama			= 'dashboard.php';
	$namaHalamanEdit		= 'index.php';
	$errorList				= array();
	$errorListStr			= '';
	$pageparam				= '?';
	
	//Required Fields Name
	$requireFieldsNameArr	= array(

	);
	
	//Action START
	foreach($requireFieldsNameArr as $requireFieldsNameArrKey => $requireFieldsNameArrVal) {
		if($auPostedElements["$requireFieldsNameArrVal"] == '') {
			header("Location: $namaHalamanEdit".$pageparam."&err=Invalid Link OR Expired");
			exit();
		}
	}
	
	//Pattern Check START
	if(isset($_POST['stripeToken'])){
		$fPayment 		= ue_fetch_array(ue_query("SELECT * FROM user WHERE user_id = '".$_SESSION['currentUserId']."' LIMIT 1"));
		$amount_cents	= $aolMembership[$fPayment['user_membershiptype']][$fPayment['user_membershipid']]['price'];
		$type 			= "Social Enterprises";
		if($fPayment['user_membershiptype'] == "investors"){
			$type 		= "Angel";
		}
		$description 	= "Payment for ".$aolMembership[$fPayment['user_membershiptype']][$fPayment['user_membershipid']]['member']." ".$type." membership";
		$result 		= stripe_confirm($amount_cents,$_POST['stripeToken'],$description,"usd");
		
		/*
		echo "<BR>Stripe Payment Status : ".$result;
		
		echo "<BR>Stripe Response : ";
		echo "<pre>";
		print_r($charge); 
		echo "</pre>";
		exit;
		*/
	}
	
	//Pattern Check END
	
	if(count($errorList) == 0) {
		switch($detailmode) {
			case 'edit':
				/* NaN */
			break;
			default:
				if($result == "success"){
					$plusOneYear = time()+31536000;
					$sqlUpdate 	 = "UPDATE user SET user_expiry = '".$plusOneYear."' WHERE user_id = '".$_SESSION['currentUserId']."'";
					$msg		 = "sta=Payment Successful, Your premium membership is active";
				}else{
					$namaPageUtama 	= "payment.php";
					$msg		 	= "err=Payment Failed, Please redo your payment";
				}
				ue_query($sqlUpdate);
			break;
		}
		
		//REDIRECTIONS
		switch($detailmode) {
			case 'edit':
				/* NaN */
			break;
			default:
				header("Location: $namaPageUtama".$pageparam."&".$msg);
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
	
	@ ue_close($GLOBALS['mysql_connect_init']);
?>