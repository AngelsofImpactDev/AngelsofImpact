<?php
	session_start();
	include('ue-config/ue-globalconfig.php');
	include('ue-config/ue-globalconnect.php');
	include('ue-config/ue-globalfunction.php');
	
	$detailmode = 'edit';
	$namaTableDatabase		= 'transactiondetail';
	$namaTableDatabaseId	= $namaTableDatabase.'_id';
	$currentServerTime		= time();
	
	//Get All Posted Vars
	$auPostedElements = array();
	$auCookiesAllow = array(
		
	);
	foreach($_GET as $postedElementsKey => $postedElementsVal) {
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
	$namaPageUtama			= 'fundinghistory.php';
	$namaHalamanEdit		= 'fundinghistory.php';
	$errorList				= array();
	$errorListStr			= '';
	$pageparam				= '?id='.$auPostedElements['tid'].'&page='.$auPostedElements['page'];
	$nextInLine 			= (int)autoIncrementNext($namaTableDatabase);
	
	$cekMembership 	= ue_fetch_array(ue_query("SELECT * FROM user WHERE user_id = '".$_SESSION['currentUserId']."'"));
	
	//Required Fields Name
	$membershipType = $cekMembership["user_membershiptype"];
	if($membershipType != "startup"){
		header("location:$namaHalamanEdit".$pageparam."&err=Invalid ID");
		
	}
	
	//Action START
	foreach($requireFieldsNameArr as $requireFieldsNameArrKey => $requireFieldsNameArrVal) {
		if($auPostedElements["$requireFieldsNameArrVal"] == '') {
			header("Location: $namaHalamanEdit".$pageparam."&err=Please Fill All Fields");
			exit();
		}
	}
	
	if(count($errorList) == 0) {
		switch($detailmode) {
			case 'edit':	
				$editQueryStr	= "UPDATE ".$namaTableDatabase." SET
								".$namaTableDatabase."_editdate = '$currentServerTime',
								".$namaTableDatabase."_status = 'paid'
								WHERE ".$namaTableDatabase."_id = '".$id."' LIMIT 1
				";
				
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