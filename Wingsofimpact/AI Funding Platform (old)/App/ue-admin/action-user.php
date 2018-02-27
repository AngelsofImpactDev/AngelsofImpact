<?php
	include('ue-includes/ue-ses_check.php');
	
	$namaTableDatabase		= 'user';
	$namaTableDatabaseId	= $namaTableDatabase.'_id';
	$currentServerTime		= time();
	
	//History Related
	$recordHistory			= true;
	$historyTypeName		= 'User';
	
	//Get All Posted Vars
	$auPostedElements = array();
	foreach($_POST as $postedElementsKey => $postedElementsVal) {
		$auPostedElements["$postedElementsKey"] = ueReceiveInput($postedElementsKey,$postedElementsVal,false);
	}
	
	//Init Vars
	$id						= $auPostedElements['id'];
	$detailmode				= $auPostedElements['detailmode'];
	$namaPageUtama			= $auPostedElements['mainpage'];
	$namaHalamanEdit		= $auPostedElements['frompage'];
	$pageparam				= $auPostedElements['pageparam'].'&detailmode='.$detailmode.'&id='.$id;
	$errorList				= array();
	$errorListStr			= '';
	
	//Required Fields Name
	$requireFieldsNameArr	= array(
		'name',
		'email',
		'membership'
	);
	
	//Action START
	foreach($requireFieldsNameArr as $requireFieldsNameArrKey => $requireFieldsNameArrVal) {
		if($auPostedElements["$requireFieldsNameArrVal"] == '') {
			header("Location: $namaHalamanEdit".$pageparam."&err=Please Fill All Fields");
			exit();
		}
	}
	
	//Pattern Check START

	//Pattern Check END
	if(trim($auPostedElements['password'])!=""){
		$sql = $namaTableDatabase."_password = '".md5($auPostedElements['password'])."',";
	}
	
	if(count($errorList) == 0) {
		switch($detailmode) {
			case 'edit':
				$editQueryStr	= "UPDATE ".$namaTableDatabase." SET
									".$namaTableDatabase."_editdate = '$currentServerTime',
									".$namaTableDatabase."_email = '".$auPostedElements['email']."',
									".$namaTableDatabase."_name = '".$auPostedElements['name']."',
									$sql
									".$namaTableDatabase."_address = '".$auPostedElements['address']."',
									".$namaTableDatabase."_telp = '".$auPostedElements['telp']."',
									".$namaTableDatabase."_membershipid = '".$auPostedElements['membership']."',
									".$namaTableDatabase."_expiry = '".strtotime($auPostedElements['membershipex'])."'
								WHERE ".$namaTableDatabase."_id = '$id' LIMIT 1
				";
				
				@ $grandQueryResult = ue_query($editQueryStr);
				$globalHistoryCorrespondingId = $id;
			break;
		}
		/*
		//Record History START
		$recordHistoryDesc = "
			".$historyTypeName." Name : ".$auPostedElements['name']."
		";
		writeGlobalHistory($historyTypeName,$detailmode,$recordHistoryDesc,$namaTableDatabase,$globalHistoryCorrespondingId,$ue_globvar_recordglobalhistory,$recordHistory);
		//Record History END
		*/
		//REDIRECTIONS
		switch($detailmode) {
			case 'edit':
				if($grandQueryResult == false) {
					header("Location: $namaPageUtama".$pageparam."&err=Invalid ID");
				}
				else {
					header("Location: $namaPageUtama".$pageparam."&sta=ok");
				}
			break;
			default:
				if($grandQueryResult == false) {
					header("Location: $namaPageUtama".$pageparam."&err=Unable To Insert New Entry");
				}
				else {
					header("Location: $namaPageUtama".$pageparam."&sta=ok");
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
?>