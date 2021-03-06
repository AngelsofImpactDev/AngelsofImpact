<?php
	include('ue-includes/ue-ses_check.php');
	
	$namaTableDatabase		= 'newsauthor';
	$namaTableDatabaseId	= $namaTableDatabase.'_id';
	$currentServerTime		= time();
	
	//History Related
	$recordHistory			= true;
	$historyTypeName		= 'News Author';
	
	//Get All Posted Vars
	$auPostedElements = array();
	foreach($_POST as $postedElementsKey => $postedElementsVal) {
		$auPostedElements["$postedElementsKey"] = ueReceiveInput($postedElementsKey,$postedElementsVal);
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
		'desc'
	);
	
	//Action START
	if($auPostedElements['submitMode'] == 'Save Draft') {
		$enableStat = 'd';
	}
	else {
		$enableStat = 'e';
	}
	
	foreach($requireFieldsNameArr as $requireFieldsNameArrKey => $requireFieldsNameArrVal) {
		if($auPostedElements["$requireFieldsNameArrVal"] == '') {
			header("Location: $namaHalamanEdit".$pageparam."&err=Please Fill All Fields");
			exit();
		}
	}
	
	//Pattern Check START

	//Pattern Check END
	
	if(count($errorList) == 0) {
		//Fixed Vars
		$sliderFolderLocation	= '../upload/newsauthor';
		$sliderMaxWidth			= 125;
		$sliderMaxHeight		= 128;
		
		switch($detailmode) {
			case 'edit':
				$editDetailQue = ue_query("SELECT * FROM ".$namaTableDatabase." WHERE ".$namaTableDatabase."_id = '".$id."' LIMIT 1");
				@ $editDetailRes = ue_fetch_array($editDetailQue);
				
				if($_FILES['objek']['name']) {
					$nextInLine = $id;
					$imageName = cleanFileName(ueWritePage($editDetailRes[$namaTableDatabase.'_name'],true)).'-'.$nextInLine.substr(md5($nextInLine.rand(20,30).$globvar_adminidsite),0,4);
					@ unlink($sliderFolderLocation.'/'.$editDetailRes["$namaTableDatabase".'_image']);
					$imageResult = imageUploader($_FILES['objek'],'',$sliderFolderLocation,$imageName,$sliderMaxWidth,$sliderMaxHeight);
				}
				else {
					$imageResult = $editDetailRes["$namaTableDatabase".'_image'];
				}
				
				$editQueryStr	= "UPDATE ".$namaTableDatabase." SET
									".$namaTableDatabase."_editdate = '$currentServerTime',
									".$namaTableDatabase."_enabled = '".$enableStat."',
									".$namaTableDatabase."_name = '".$auPostedElements['name']."',
									".$namaTableDatabase."_desc = '".$auPostedElements['desc']."',
									".$namaTableDatabase."_image = '$imageResult'
								WHERE ".$namaTableDatabase."_id = '$id' LIMIT 1
				";
				
				@ $grandQueryResult = ue_query($editQueryStr);
				$globalHistoryCorrespondingId = $id;
			break;
			default:
				$nextInLine = (int)autoIncrementNext($namaTableDatabase);
				
				if(isset($_FILES['objek'])) {
					if(!$_FILES['objek']['name']) {
						header("Location: $namaHalamanEdit".$pageparam."&err=Please Select Your File");
						exit();
					}
					else {
						if($auPostedElements['watermarkFlag'] == 'watermarkOn') {
							$watermarkFile = 'upload/watermark/'.ueGetSiteData('watermark');
						}
						else {
							$watermarkFile = false;
						}
						
						$imageName = cleanFileName(ueWritePage($auPostedElements['name'],true)).'-'.$nextInLine.substr(md5($nextInLine.rand(20,30).$globvar_adminidsite),0,4);
						$imageResult = imageUploader($_FILES['objek'],'',$sliderFolderLocation,$imageName,$sliderMaxWidth,$sliderMaxHeight,'','','','',$watermarkFile);
					}
				}
				
				$createQueryStr	= "INSERT INTO ".$namaTableDatabase." VALUES(
									'',
									'$nextInLine',
									'$currentServerTime',
									'0',
									'".$enableStat."',
									'".$auPostedElements['name']."',
									'".$auPostedElements['desc']."',
									'$imageResult'
				)";
				
				@ $grandQueryResult = ue_query($createQueryStr);
				$globalHistoryCorrespondingId = $nextInLine;
			break;
		}
		
		//Record History START
		$recordHistoryDesc = "
			".$historyTypeName." Name : ".$auPostedElements['name']."
		";
		writeGlobalHistory($historyTypeName,$detailmode,$recordHistoryDesc,$namaTableDatabase,$globalHistoryCorrespondingId,$ue_globvar_recordglobalhistory,$recordHistory);
		//Record History END
		
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