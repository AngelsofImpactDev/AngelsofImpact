<?php
	session_start();
	include('ue-config/ue-globalconfig.php');
	include('ue-config/ue-globalconnect.php');
	include('ue-config/ue-globalfunction.php');
	
	$detailmode = 'edit';
	$namaTableDatabase		= 'user';
	$namaTableDatabaseId	= $namaTableDatabase.'_id';
	$currentServerTime		= time();
	
	//Get All Posted Vars
	$auPostedElements = array();
	$auCookiesAllow = array(
		
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
	$id						= $auPostedElements['id'];
	$namaPageUtama			= 'usersetting.php';
	$namaHalamanEdit		= 'usersettingedit.php';
	$errorList				= array();
	$errorListStr			= '';
	$pageparam				= '?edit=personal';
	$settingMode			= 'personal';
	if(isset($auPostedElements['bankBtn'])){
		$pageparam			= '?edit=bank';
		$settingMode		= 'bank';
	}
	
	$nextInLine 			= (int)autoIncrementNext($namaTableDatabase);
	
	$cekMembership 	= ue_fetch_array(ue_query("SELECT * FROM user WHERE user_id = '".$_SESSION['currentUserId']."'"));
	
	//Required Fields Name
	$membershipType = $cekMembership["user_membershiptype"];
	$requireFieldsNameArr	= array(
				
	);
	
	//Action START
	foreach($requireFieldsNameArr as $requireFieldsNameArrKey => $requireFieldsNameArrVal) {
		if($auPostedElements["$requireFieldsNameArrVal"] == '') {
			header("Location: $namaHalamanEdit".$pageparam."&err=Please Fill All Fields");
			exit();
		}
	}
	
	if($settingMode == 'personal'){
		if(trim($auPostedElements['password'])!=""){
			$userlogque = ue_query("SELECT * FROM $namaTableDatabase WHERE ".$namaTableDatabase."_id = '".$_SESSION['currentUserId']."' AND ".$namaTableDatabase."_password = '".md5($auPostedElements['password'])."' LIMIT 1");
			$userlognum = (int)ue_num_rows($userlogque);
			if($userlognum <= 0) {
				$errorList[] = 'Invalid Current Password';
			}
			
			if(strlen($auPostedElements['newpassword']) < 4) {
				$errorList[] = 'Password must be at least 4 characters in length';
			}
			else {
				if($auPostedElements['newpassword'] != $auPostedElements['newrepassword']) {
					$errorList[] = 'Password and Re-Password must be the same';
				}
			}	
		}
	}
	
	//Pattern Check END
	
	if(count($errorList) == 0) {
		switch($detailmode) {
			case 'edit':
				if($settingMode == 'personal'){
					$sql = "";
					if($auPostedElements['newrepassword']!=""){
						$editQueryStr	= "UPDATE ".$namaTableDatabase." SET
										".$namaTableDatabase."_editdate = '$currentServerTime',
										".$namaTableDatabase."_password = '".md5($auPostedElements['newrepassword'])."'
										WHERE ".$namaTableDatabase."_id = '".$_SESSION['currentUserId']."' LIMIT 1
						";
						@ $grandQueryResult = ue_query($editQueryStr);
					}	
				}else{
					$editQueryStr	= "UPDATE ".$namaTableDatabase." SET
									".$namaTableDatabase."_editdate = '$currentServerTime',
									".$namaTableDatabase."_bankname = '".$auPostedElements['bankname']."',
									".$namaTableDatabase."_bankaccountname = '".$auPostedElements['bankaccountname']."',
									".$namaTableDatabase."_bankaccountnumber = '".$auPostedElements['bankaccountnumber']."'
									WHERE ".$namaTableDatabase."_id = '".$_SESSION['currentUserId']."' LIMIT 1
					";
					@ $grandQueryResult = ue_query($editQueryStr);
				}
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