<?php
	include('ue-includes/ue-ses_check.php');
	
	$namaTableDatabase		= 'promo';
	$namaTableDatabaseId	= $namaTableDatabase.'_id';
	$currentServerTime		= time();
	
	//History Related
	$recordHistory			= true;
	$historyTypeName		= 'Promo';
	
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
		'enddate',
		'endmon',
		'endyear',
		'endhour',
		'endminute',
		'qty',
		'type',
		'mode',
		'prefix'
	);
	
	//Action START
	if($auPostedElements['submitMode'] == 'Save Draft') {
		$enableStat = 'd';
	}
	else {
		$enableStat = 'e';
	}
	
	$auPostedElements['qty'] = (int)$auPostedElements['qty'];
	
	foreach($requireFieldsNameArr as $requireFieldsNameArrKey => $requireFieldsNameArrVal) {
		if($auPostedElements["$requireFieldsNameArrVal"] == '') {
			header("Location: $namaHalamanEdit".$pageparam."&err=Please Fill All Fields");
			exit();
		}
	}
	
	//Pattern Check START
	if($auPostedElements['qty'] <= 0) {
		$errorList[] = 'Invalid Quantity';
	}
	if($auPostedElements['prefix'] != '') {
		$auPostedElements['prefix'] .= '-';
	}
	
	if($auPostedElements['mode'] == 1) {
		if($auPostedElements['promolimit'] == 'bp') {
			$auPostedElements['promolimit'] = 'nl';
		}
	}
	
	if($auPostedElements['promolimit'] == 'nl') {
		$auPostedElements['minpurchase'] = 0;
		unset($auPostedElements['prdlimit']);
	}
	else if($auPostedElements['promolimit'] == 'mp') {
		unset($auPostedElements['prdlimit']);
	}
	else if($auPostedElements['promolimit'] == 'bp') {
		$auPostedElements['minpurchase'] = 0;
	}
	
	if($auPostedElements['banklimittrigger'] != 'banklimityes') {
		unset($auPostedElements['banklimit']);
	}
	
	if($auPostedElements['userlimittrigger'] != 'userlimityes') {
		unset($auPostedElements['userlimit']);
	}
	
	if(count($auPostedElements['prdlimit'])>0) {
		$allowPrdPromo = '';
		foreach($auPostedElements['prdlimit'] as $prdLimitKey => $prdLimitVal) {
			$allowPrdPromo .= $prdLimitVal.',';
		}
		$allowPrdPromo = substr($allowPrdPromo,0,-1);
	}
	
	if(count($auPostedElements['banklimit'])>0) {
		$allowBankPromo = '';
		foreach($auPostedElements['banklimit'] as $bankLimitKey => $bankLimitVal) {
			$allowBankPromo .= $bankLimitVal.',';
		}
		$allowBankPromo = substr($allowBankPromo,0,-1);
	}
	
	if(count($auPostedElements['userlimit'])>0) {
		$allowUserPromo = '';
		foreach($auPostedElements['userlimit'] as $userLimitKey => $userLimitVal) {
			$allowUserPromo .= $userLimitVal.',';
		}
		$allowUserPromo = substr($allowUserPromo,0,-1);
	}
	//Pattern Check END
	
	if(count($errorList) == 0) {
		$endpromounix = strtotime($auPostedElements['enddate'].' '.$auPostedElements['endmon'].' '.$auPostedElements['endyear'].' '.$auPostedElements['endhour'].':'.$auPostedElements['endminute']);
		
		switch($detailmode) {
			case 'edit':
				//NaN
			break;
			default:
				for($i=0;$i<$auPostedElements['qty'];$i++) {
					$nextInLine = (int)autoIncrementNext($namaTableDatabase);
					
					$randPrmCode = '';
					$randPrmCodeNum = 8;
					$mdFin = '';
					$randMd = md5($auPostedElements['prefix'].$nextInLine.rand(0,99).$globvar_sitename);
					$brpLine = $randPrmCodeNum - strlen($nextInLine);
					for($x=0;$x<$brpLine;$x++) {
						$mdFin .= $randMd["$x"];
					}
					$randPrmCode .= $nextInLine.$mdFin;
					$randPrmCode = $auPostedElements['prefix'].strtoupper($randPrmCode);
					
					$createQueryStr	= "INSERT INTO ".$namaTableDatabase." VALUES(
										'',
										'$currentServerTime',
										'0',
										'".$enableStat."',
										'".$auPostedElements['name']."',
										'$randPrmCode',
										'$endpromounix',
										'".$auPostedElements['type']."',
										'".$auPostedElements['mode']."',
										'".$auPostedElements['value']."',
										'".$auPostedElements['minpurchase']."',
										'$allowPrdPromo',
										'$allowBankPromo',
										'$allowUserPromo',
										'0'
					)";
					
					@ $grandQueryResult = ue_query($createQueryStr);
					
					//Record History START
					$globalHistoryCorrespondingId = $nextInLine;
					$recordHistoryDesc = "
						".$historyTypeName." Name : ".$auPostedElements['name']."<br />
						".$historyTypeName." Code : ".$auPostedElements['code']."<br />
						".$historyTypeName." Value : ".$auPostedElements['value']."
					";
					writeGlobalHistory($historyTypeName,$detailmode,$recordHistoryDesc,$namaTableDatabase,$globalHistoryCorrespondingId,$ue_globvar_recordglobalhistory,$recordHistory);
					//Record History END
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