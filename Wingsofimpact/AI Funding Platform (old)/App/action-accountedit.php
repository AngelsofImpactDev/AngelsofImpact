<?php
	session_start();
	include('ue-config/ue-globalconfig.php');
	include('ue-config/ue-globalconnect.php');
	include('ue-config/ue-globalfunction.php');
	
	if($_SESSION['currentUserId'] != '') {
		$detailmode = 'edit';
	}
	else {
		$detailmode = 'create';
	}
	
	$namaTableDatabase		= 'user';
	$namaTableDatabaseId	= $namaTableDatabase.'_id';
	$currentServerTime		= time();
	
	//Get All Posted Vars
	$auPostedElements = array();
	$auCookiesAllow = array(
		'telp',
		'country',
		'passport',
		'address'
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
	
	//Init Vars
	$id						= $_SESSION['currentUserId'];
	$namaPageUtama			= 'accountinfo.php';
	$namaHalamanEdit		= 'accountedit.php';
	$errorList				= array();
	$errorListStr			= '';
	$pageparam				= '?';
	$nextInLine 			= (int)autoIncrementNext($namaTableDatabase);
	
	$cekMembership 	= ue_fetch_array(ue_query("SELECT * FROM user WHERE user_id = '".$_SESSION['currentUserId']."'"));
	
	//Required Fields Name
	$membershipType = $cekMembership["user_membershiptype"];
	if($membershipType == "startup"){
		$requireFieldsNameArr	= array(
			'country',
			'telp'		
		);
		
	}else{
		$requireFieldsNameArr	= array(
			'passport',
			'country',
			'telp',
			'address'
		);
	}
	
	//Action START
	foreach($requireFieldsNameArr as $requireFieldsNameArrKey => $requireFieldsNameArrVal) {
		if($auPostedElements["$requireFieldsNameArrVal"] == '') {
			header("Location: $namaHalamanEdit".$pageparam."&err=Please Fill All Fields");
			exit();
		}
	}
	
	//Pattern Check START
	/*
	if(!$_SESSION['currentUserId']) {
		if(!preg_match("/^[a-zA-Z0-9._-]{2,}[@][a-zA-Z0-9_-]{2,}[.][a-zA-Z]{2,5}([.][a-zA-Z]{2,5})?$/",$auPostedElements['email'])) {
			$errorList[] = 'Invalid E-mail';
		}
		else {
			@ $userlogque = ue_query("SELECT * FROM $namaTableDatabase WHERE ".$namaTableDatabase."_email = '".$auPostedElements['email']."' LIMIT 1");
			@ $userlognum = (int)ue_num_rows($userlogque);
			if($userlognum) {
				$errorList[] = 'E-mail already exists';
			}
		}
		
		if($auPostedElements['password'] == '' || $auPostedElements['repass'] == '') {
			$errorList[] = 'Invalid Password';
		}
	}
	else {
		//Check if old password matches
		@ $userlogque = ue_query("SELECT * FROM $namaTableDatabase WHERE ".$namaTableDatabase."_id = '".$_SESSION['currentUserId']."' AND ".$namaTableDatabase."_password = '".$auPostedElements['curpassword']."' LIMIT 1");
		@ $userlognum = (int)ue_num_rows($userlogque);
		if($userlognum <= 0) {
			$errorList[] = 'Invalid Current Password';
		}
	}

	if($auPostedElements['password'] != '' && $auPostedElements['repass'] != '' && $detailmode != 'edit') {	
		if(strlen($auPostedElements['password']) < 4) {
			$errorList[] = 'Password must be at least 4 characters in length';
		}
		else {
			if($auPostedElements['password'] != $auPostedElements['repass']) {
				$errorList[] = 'Password and Re-Password must be the same';
			}
		}
	}
	
	if(!preg_match("/^[a-zA-Z ]{2,}$/",$auPostedElements['name'])) {
		$errorList[] = 'Invalid Name';
	}
	*/
	/*
	$currentDob = strtotime($auPostedElements['dob']." 00:00");
	$todayUnix = strtotime(date('j F Y 00:00'));
	if($currentDob >= $todayUnix) {
		$errorList[] = 'Invalid Date of Birth';
	}
	
	if($auPostedElements['gender'] != 'm' && $auPostedElements['gender'] != 'f') {
		$errorList[] = 'Please select a Gender';
	}
	
	if($auPostedElements['province'] == '') {
		$errorList[] = 'Please select a province';
	}
	else {
		$currentShipId = $auPostedElements["$auPostedElements[province]"];
	}
	
	$auPostedElements['address'] = nohtml($auPostedElements['address']);
	if(strlen($auPostedElements['address']) < 4) {
		$errorList[] = 'Please enter a valid Address';
	}
	
	if(!preg_match("/^[0-9 ]{3,}$/",$auPostedElements['postal'])) {
		$errorList[] = 'Please enter a valid postal code';
	}
	*/
	if(!preg_match("/^[0-9 +-]{6,}$/",$auPostedElements['telp'])) {
		$errorList[] = 'Please enter a valid telephone number';
	}
	//Pattern Check END
	
	if(count($errorList) == 0) {
		switch($detailmode) {
			case 'edit':
				$profileFolderLocation	= 'upload/userImage';
				$profileMaxWidth		= 1200;
				$profileMaxHeight		= 1200;
				
				if($_FILES['photo']['name']) {
					$imagePhotoName 	= $id.md5($id);
					$imagePhotoResult 	= imageUploader($_FILES['photo'],'',$profileFolderLocation,$imagePhotoName,$profileMaxWidth,$profileMaxHeight);
					$sql = "user_image = '".$imagePhotoResult."',";
					//echo $sql;die();
				}
			
			
				if($membershipType == "investors"){
					$editQueryStr	= "UPDATE ".$namaTableDatabase." SET
									".$namaTableDatabase."_editdate = '$currentServerTime',
									".$namaTableDatabase."_address = '".$auPostedElements['address']."',
									".$namaTableDatabase."_telp = '".$auPostedElements['telp']."',
									$sql
									".$namaTableDatabase."_country = '".$auPostedElements['country']."',
									".$namaTableDatabase."_passport = '".$auPostedElements['passport']."'
									WHERE ".$namaTableDatabase."_id = '".$id."' LIMIT 1
					";
				}else{
					$editQueryStr	= "UPDATE ".$namaTableDatabase." SET
									".$namaTableDatabase."_editdate = '$currentServerTime',
									".$namaTableDatabase."_telp = '".$auPostedElements['telp']."',
									$sql
									".$namaTableDatabase."_country = '".$auPostedElements['country']."',
									".$namaTableDatabase."_passport = '".$auPostedElements['passport']."'
									WHERE ".$namaTableDatabase."_id = '".$id."' LIMIT 1
					";
				}
				
				@ $grandQueryResult = ue_query($editQueryStr);
			break;
			default:
				//kosoonngg
			break;
		}
		
		//REDIRECTIONS
		switch($detailmode) {
			case 'edit':
				if($grandQueryResult == false) {
					header("Location: $namaPageUtama".$pageparam."&err=Invalid ID");
				}
				else {
					header("Location: $namaPageUtama".$pageparam."&sta=Information Have Been Updated");
				}
			break;
			default:
				if($grandQueryResult == false) {
					header("Location: $namaPageUtama".$pageparam."&err=Unable To Insert New Entry");
				}
				else {
					guestLogout();
					
					//Start Login
					$createQueryStr	= "SELECT * FROM $namaTableDatabase WHERE
										".$namaTableDatabase."_email = '".$auPostedElements['email']."' AND
										".$namaTableDatabase."_password = '".$auPostedElements['repass']."'
									LIMIT 1
									";
					@ $grandQueryResult = ue_query($createQueryStr);
					@ $grandQueryResultRes = ue_fetch_array($grandQueryResult);
					$_SESSION['currentUserId'] = $grandQueryResultRes["$namaTableDatabase"."_id"];
					//End Login
					
					writeAnalytics($GLOBALS['ue_globvar_analytics_goals'][2],'','','','','','',$currentShipId);
					
					header("Location: $namaPageUtama".$pageparam."&sta=Thank You For Registering!");
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
	
	@ ue_close($GLOBALS['mysql_connect_init']);
?>