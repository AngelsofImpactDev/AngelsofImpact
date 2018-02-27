<?php
	include('ue-includes/ue-ses_check.php');
	
	$namaTableDatabase		= 'lookbookimage';
	$namaTableDatabaseParent= 'lookbook';
	$namaTableDatabaseId	= $namaTableDatabase.'_id';
	$currentServerTime		= time();
	
	//History Related
	$recordHistory			= false;
	$historyTypeName		= 'Lookbook';
	
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
	
	if(count($errorList) == 0) {
		switch($detailmode) {
			default:
				//Product Detail Images
				$imageFieldEditId = 'productimagedetaileditid';
				$imageFieldName = 'productimage';
				$imageTextFieldName = '';
				$imageFieldWatermarkName = 'watermarkFlag';
				$imageDatabaseTable = 'lookbookimage';
				$imageTargetLocation = '../upload/lookbookslider';
				$imageThumbLocation = '';
				$imageAllowedFormat = ''; // Empty String '' = Allow All Image Types
				$imageMaxSize = array(
								'width'		=> 500,
								'height'	=> 281
							 );
				$imageThumbSize = array(
								'width'		=> 10,
								'height'	=> 10
							 );
				$numberOfElement = count($_FILES["$imageFieldName"]['name']);
				for($i=0;$i<$numberOfElement;$i++) {
					$imageid = '';
					$currentComment = $auPostedElements["$imageTextFieldName"]["$i"];
					$currentEditId = $auPostedElements["$imageFieldEditId"]["$i"];
					$currentWatermarkFlag = $auPostedElements["$imageFieldWatermarkName"]["$i"];
					
					if($_FILES["$imageFieldName"]['name']["$i"] != '') {
						if($currentEditId != '') {
							$imageEditGetDetailsQue = ue_query("SELECT * FROM $imageDatabaseTable WHERE ".$imageDatabaseTable.'_id = '.$currentEditId." LIMIT 1");
							$imageEditGetDetailsRes = ue_fetch_array($imageEditGetDetailsQue);
							$nextIncrement = $currentEditId;
							@ unlink($imageTargetLocation.'/'.$imageEditGetDetailsRes["$imageDatabaseTable".'_image']);
							@ unlink($imageThumbLocation.'/'.$imageEditGetDetailsRes["$imageDatabaseTable".'_image']);
						}
						else {
							$nextIncrement = (int)autoIncrementNext($imageDatabaseTable);
						}
						
						if($currentWatermarkFlag == 'watermarkOn') {
							$watermarkFile = 'upload/watermark/'.ueGetSiteData('watermark');
						}
						else {
							$watermarkFile = false;
						}
						
						//Get Parent Name START
						$parentNameQue = ue_query("SELECT ".$namaTableDatabaseParent."_name FROM ".$namaTableDatabaseParent." WHERE ".$namaTableDatabaseParent."_id = '".$id."' LIMIT 1");
						$parentNameRes = ue_fetch_array($parentNameQue);
						//Get Parent Name END
												
						$imageName = cleanFileName(ueWritePage($parentNameRes[$namaTableDatabaseParent.'_name'],true)).'-'.$nextInLine.substr(md5($nextInLine.rand(20,30).$globvar_adminidsite),0,4);
						$currentImage = rebuiltMultiImage($_FILES["$imageFieldName"]['name']["$i"],$_FILES["$imageFieldName"]['type']["$i"],$_FILES["$imageFieldName"]['tmp_name']["$i"],$_FILES["$imageFieldName"]['error']["$i"],$_FILES["$imageFieldName"]['size']["$i"]);
						$imageid = imageUploader($currentImage,$imageAllowedFormat,$imageTargetLocation,$imageName,$imageMaxSize['width'],$imageMaxSize['height'],'','','','',$watermarkFile);
					}
					else if($currentEditId != '') {
						$imageEditGetDetailsQue = ue_query("SELECT * FROM $imageDatabaseTable WHERE ".$imageDatabaseTable.'_id = '.$currentEditId." LIMIT 1");
						$imageEditGetDetailsRes = ue_fetch_array($imageEditGetDetailsQue);
						$imageid = $imageEditGetDetailsRes["$imageDatabaseTable".'_image'];
					}
					
					if($imageid != '') {
						if($currentEditId != '') {
							ue_query("UPDATE $imageDatabaseTable SET
											".$imageDatabaseTable."_editdate = '$currentServerTime',
											".$imageDatabaseTable."_image = '$imageid'
										WHERE ".$imageDatabaseTable."_id = '$currentEditId' LIMIT 1
							");
						}
						else {
							ue_query("INSERT INTO $imageDatabaseTable VALUES(
											'',
											'$nextIncrement',
											'$currentServerTime',
											'0',
											'e',
											'$id',
											'$imageid'
							)");
						}
					}
				}
			break;
		}
		
		//Record History START
		$recordHistoryDesc = "
			".$historyTypeName." Name : ".$auPostedElements['name']."<br />
			Product Category ID : ".$auPostedElements[$auPostedElements['productclass']]."
		";
		writeGlobalHistory($historyTypeName,$detailmode,$recordHistoryDesc,$namaTableDatabase,$globalHistoryCorrespondingId,$ue_globvar_recordglobalhistory,$recordHistory);
		//Record History END
		
		//REDIRECTIONS
		switch($detailmode) {
			default:
				header("Location: $namaPageUtama".$pageparam."&sta=ok");
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