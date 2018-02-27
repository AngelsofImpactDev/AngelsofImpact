<?php
	session_start();
	include('ue-config/ue-globalconfig.php');
	include('ue-config/ue-globalconnect.php');
	include('ue-config/ue-globalfunction.php');
	
	$namaTableDatabase		= 'company';
	$namaTableDatabaseId	= $namaTableDatabase.'_id';
	$currentServerTime		= time();
	
	//Get All Posted Vars
	$auPostedElements = array();
	$auCookiesAllow = array(
		'companyname',
		'website',
		'companyindustry',
		'companyareaofinterest',
		'probono',
		'market',
		'connection',
		'revenue',
		'companyimpact'
	);
	foreach($_POST as $postedElementsKey => $postedElementsVal) {
		$auPostedElements["$postedElementsKey"] = ueReceiveInput($postedElementsKey,$postedElementsVal,false);
		if($postedElementsKey == "prdlimit"){
			$arrElem = array();
			foreach($auPostedElements['prdlimit'] as $val){
				$arrElem[] =  $val;
			}
			setcookie($postedElementsKey,json_encode($arrElem),time()+5);
		}else if(in_array($postedElementsKey,$auCookiesAllow)) {
			setcookie($postedElementsKey,$postedElementsVal,time()+5);
		}
		else if($postedElementsKey == $auPostedElements['province']){
			setcookie('shipping_id',$postedElementsVal,time()+5);
		}
	}
	
	if($auPostedElements['cid'] != '') {
		$detailmode = 'edit';
	}
	else {
		$detailmode = 'create';
	}
	
	//Init Vars
	$id						= $_SESSION['currentUserId'];
	$namaPageUtama			= 'accountinfo.php';
	$namaHalamanEdit		= 'companyedit.php';
	$errorList				= array();
	$errorListStr			= '';
	$pageparam				= '?';
	$nextInLine 			= (int)autoIncrementNext($namaTableDatabase);
	
	$cekMembership 	= ue_fetch_array(ue_query("SELECT * FROM user WHERE user_id = '".$_SESSION['currentUserId']."'"));
	
	//Required Fields Name
	$membershipType = $cekMembership["user_membershiptype"];
	if($membershipType == "startup"){
		$requireFieldsNameArr	= array(
			'companyname',
			'website',
			'companyindustry'
		);
		
	}else{
		if($auPostedElements['radioCode'] == "1"){
			$requireFieldsNameArr	= array(
				'companycode'
			);
		}else{
			$requireFieldsNameArr	= array(
				'companyname',
				'website',
				'companyareaofinterest'
			);
		}	
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
	if(!preg_match("/^[0-9 +-]{6,}$/",$auPostedElements['telp'])) {
		$errorList[] = 'Please enter a valid telephone number';
	}
	*/
	//Pattern Check END
	
	if(count($errorList) == 0) {
		switch($detailmode) {
			case 'edit':
				if($membershipType == "investors"){
					$mission 		= implode(",",$auPostedElements['prdlimit']);
					$editQueryStr	= "UPDATE ".$namaTableDatabase." SET
									".$namaTableDatabase."_editdate = '$currentServerTime',
									".$namaTableDatabase."_name = '".$auPostedElements['companyname']."',
									".$namaTableDatabase."_website = '".$auPostedElements['website']."',
									".$namaTableDatabase."_industry = '".$auPostedElements['companyindustry']."',
									".$namaTableDatabase."_interest = '".$auPostedElements['companyareaofinterest']."',
									".$namaTableDatabase."_mission = '".$mission."',
									".$namaTableDatabase."_probono = '".$auPostedElements['probono']."',
									".$namaTableDatabase."_newmarket = '".$auPostedElements['market']."',
									".$namaTableDatabase."_connection = '".$auPostedElements['connection']."'
									WHERE ".$namaTableDatabase."_id = '".$auPostedElements['cid']."' LIMIT 1
					";
				}else{
					$editQueryStr	= "UPDATE ".$namaTableDatabase." SET
									".$namaTableDatabase."_editdate = '$currentServerTime',
									".$namaTableDatabase."_name = '".$auPostedElements['companyname']."',
									".$namaTableDatabase."_website = '".$auPostedElements['website']."',
									".$namaTableDatabase."_industry = '".$auPostedElements['companyindustry']."',
									".$namaTableDatabase."_revenue = '".$auPostedElements['revenue']."',
									".$namaTableDatabase."_impact = '".$auPostedElements['companyimpact']."'
									WHERE ".$namaTableDatabase."_id = '".$auPostedElements['cid']."' LIMIT 1";
				}
				echo $editQueryStr;die();
				@ $grandQueryResult = ue_query($editQueryStr);
			break;
			default:
				if($membershipType == "investors"){
					if($auPostedElements['radioCode'] == "1"){
						$f = ue_fetch_array(ue_query("SELECT * FROM company WHERE company_code = '".$auPostedElements['companycode']."'"));
						if($f['company_id'] == ""){
							header("Location: $namaPageUtama".$pageparam."&err=Invalid company code");
							die();
						}else{
							$insertQueryStr = "UPDATE user SET company_id = '".$f['company_id']."' WHERE user_id = '".$id."' LIMIT 1";
						}
					}else{
						$companyId 		= (int)autoIncrementNext("company");
						$companyCode 	= $companyId.substr(trim($auPostedElements['companyname']),0,3).mt_rand(100,999);
						$mission 		= implode(",",$auPostedElements['prdlimit']);
						$insertQueryStr = "INSERT INTO company VALUES('',
																	'$currentServerTime',
																	'0',
																	'".$id."',
																	'".$auPostedElements['companyname']."',
																	'".$companyCode."',
																	'".$auPostedElements['website']."',
																	'',
																	'".$auPostedElements['companyindustry']."',
																	'',
																	'".$auPostedElements['companyimpact']."',
																	'".$auPostedElements['companyareaofinterest']."',
																	'".$mission."',
																	'".$auPostedElements['probono']."',
																	'".$auPostedElements['market']."',
																	'".$auPostedElements['connection']."'
																	)";
					}
					@ $grandQueryResult = ue_query($insertQueryStr);
					if($companyId!=""){
						$qUpdate = ue_query("UPDATE user SET company_id = '".$companyId."' WHERE user_id = '".$id."' LIMIT 1");
					}
				}
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
					header("Location: $namaPageUtama".$pageparam."&sta=Information Have Been Updated");
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