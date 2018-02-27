<?php
	include('ue-includes/ue-ses_check.php');
	
	$namaTableDatabase		= 'product';
	$namaTableDatabaseId	= $namaTableDatabase.'_id';
	$currentServerTime		= time();
	
	//History Related
	$recordHistory			= true;
	$historyTypeName		= 'Product';
	
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
		'producttype',
		'productbrand',
		'price',
		'weight'
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
	if(!preg_match("/^[a-zA-Z0-9 _~:\/\?#@!$&'()\[\]*+,;=.-]{2,}$/",$auPostedElements['name'])) {
		$errorList[] = 'Invalid Name';
	}
	
	$auPostedElements['tags'] = str_replace(', ',',',$auPostedElements['tags']);
	
	if(count($auPostedElements['productgroup'])>0) {
		$prdInGroup = '';
		foreach($auPostedElements['productgroup'] as $groupKey => $groupVal) {
			$prdInGroup .= $groupVal.',';
		}
		//$prdInGroup = substr($prdInGroup,0,-1);
	}
	
	if($auPostedElements['saleMode'] == 'percent') {
		if($auPostedElements['salepercent'] > 0 && $auPostedElements['salepercent'] <= 100 && $auPostedElements['price'] > 0) {
			$discAmount = round(($auPostedElements['salepercent'] / 100) * $auPostedElements['price']);
			$auPostedElements['saleprice'] = $auPostedElements['price'] - $discAmount;
			if($auPostedElements['saleprice'] < 0) {
				$auPostedElements['saleprice'] = 0;
			}
		}
	}
	
	if($auPostedElements['shipMode'] == 'volume') {
		$shipVolArr = explode('x',$auPostedElements['volume']);
		$curWeightWrite = round(($shipVolArr[0]*$shipVolArr[1]*$shipVolArr[2])/6000);
		if($curWeightWrite <= 0) {
			$curWeightWrite = 1;
		}
		$auPostedElements['weight'] = $curWeightWrite;
	}
	else {
		$auPostedElements['volume'] = '';
	}
	//Pattern Check END
	
	if(count($errorList) == 0) {
		switch($detailmode) {
			case 'edit':
				$editDetailQue = ue_query("SELECT * FROM ".$namaTableDatabase." WHERE ".$namaTableDatabase."_id = '".$id."' LIMIT 1");
				@ $editDetailRes = ue_fetch_array($editDetailQue);
				
				//Product Size
				$createMultiRowEditListTableName = 'productsize';
				$createMultiRowEditList = $auPostedElements['productsize'];
				$createMultiRowEditListId = $auPostedElements['productsizecurrenteditid'];
				$createMultiRowEditListNum = count($auPostedElements['productsize']);
				for($i=0;$i<$createMultiRowEditListNum;$i++) {
					$createMultiRowEditListQue = '';
					if($createMultiRowEditListId["$i"] != '') {
						$createMultiRowEditListQue = "UPDATE $createMultiRowEditListTableName SET
								".$createMultiRowEditListTableName."_name = '".$createMultiRowEditList["$i"]."'
								WHERE ".$createMultiRowEditListTableName."_id = '".$createMultiRowEditListId["$i"]."' LIMIT 1
						";
					}
					else {
						if($createMultiRowEditList["$i"] != '') {
							$createMultiRowEditListAin = autoIncrementNext($createMultiRowEditListTableName);
							$createMultiRowEditListQue = "INSERT INTO $createMultiRowEditListTableName VALUES(
									'',
									'$createMultiRowEditListAin',
									'e',
									'$id',
									'".$createMultiRowEditList["$i"]."'
								)
							";
						}
					}
					ue_query($createMultiRowEditListQue);
				}
				
				//Product Color
				$createMultiRowEditListTableName = 'productcolor';
				$createMultiRowEditList = $auPostedElements['productcolorname'];
				$createMultiRowEditListId = $auPostedElements['productcolorcurrenteditid'];
				$createMultiRowEditListNum = count($auPostedElements['productcolorname']);
				for($i=0;$i<$createMultiRowEditListNum;$i++) {
					$createMultiRowEditListQue = '';
					if($createMultiRowEditListId["$i"] != '') {
						$createMultiRowEditListQue = "UPDATE $createMultiRowEditListTableName SET
								".$createMultiRowEditListTableName."_name = '".$createMultiRowEditList["$i"]."',
								".$createMultiRowEditListTableName."_hex = '".$auPostedElements['productcolorhex']["$i"]."'
								WHERE ".$createMultiRowEditListTableName."_id = '".$createMultiRowEditListId["$i"]."' LIMIT 1
						";
					}
					else {
						if($createMultiRowEditList["$i"] != '' && $auPostedElements['productcolorhex']["$i"] != '') {
							$createMultiRowEditListAin = autoIncrementNext($createMultiRowEditListTableName);
							$createMultiRowEditListQue = "INSERT INTO $createMultiRowEditListTableName VALUES(
									'',
									'$createMultiRowEditListAin',
									'e',
									'$id',
									'".$createMultiRowEditList["$i"]."',
									'".$auPostedElements['productcolorhex']["$i"]."'
								)
							";
						}
					}
					ue_query($createMultiRowEditListQue);
				}
				
				$editQueryStr	= "UPDATE ".$namaTableDatabase." SET
									".$namaTableDatabase."_editdate = '$currentServerTime',
									".$namaTableDatabase."_enabled = '".$enableStat."',
									producttype_id = '".$auPostedElements['producttype']."',
									productbrand_id = '".$auPostedElements['productbrand']."',
									".$namaTableDatabase."_groupid = '".$prdInGroup."',
									".$namaTableDatabase."_name = '".$auPostedElements['name']."',
									".$namaTableDatabase."_desc = '".$auPostedElements['productdesc']."',
									".$namaTableDatabase."_price = '".$auPostedElements['price']."',
									".$namaTableDatabase."_tags = '".$auPostedElements['tags']."',
									".$namaTableDatabase."_info = '".$auPostedElements['productinfo']."',
									".$namaTableDatabase."_guide = '".$auPostedElements['productguide']."',
									".$namaTableDatabase."_saleprice = '".$auPostedElements['saleprice']."',
									".$namaTableDatabase."_shipweight = '".$auPostedElements['weight']."',
									".$namaTableDatabase."_shipvolume = '".$auPostedElements['volume']."',
									".$namaTableDatabase."_grosirprice = '".$auPostedElements['grosirprice']."'
								WHERE ".$namaTableDatabase."_id = '$id' LIMIT 1
				";
				
				@ $grandQueryResult = ue_query($editQueryStr);
				$globalHistoryCorrespondingId = $id;
			break;
			default:
				$nextInLine = (int)autoIncrementNext($namaTableDatabase);
				
				//Product Size
				$createMultiRowEditListTableName = 'productsize';
				$createMultiRowEditList = $auPostedElements['productsize'];
				$createMultiRowEditListId = $auPostedElements['productsizecurrenteditid'];
				$createMultiRowEditListNum = count($auPostedElements['productsize']);
				for($i=0;$i<$createMultiRowEditListNum;$i++) {
					$createMultiRowEditListQue = '';
					if($createMultiRowEditListId["$i"] != '') {
						$createMultiRowEditListQue = "UPDATE $createMultiRowEditListTableName SET
								".$createMultiRowEditListTableName."_name = '".$createMultiRowEditList["$i"]."'
								WHERE ".$createMultiRowEditListTableName."_id = '".$createMultiRowEditListId["$i"]."' LIMIT 1
						";
					}
					else {
						if($createMultiRowEditList["$i"] != '') {
							$createMultiRowEditListAin = autoIncrementNext($createMultiRowEditListTableName);
							$createMultiRowEditListQue = "INSERT INTO $createMultiRowEditListTableName VALUES(
									'',
									'$createMultiRowEditListAin',
									'e',
									'$nextInLine',
									'".$createMultiRowEditList["$i"]."'
								)
							";
						}
					}
					ue_query($createMultiRowEditListQue);
				}
				
				//Product Color
				$createMultiRowEditListTableName = 'productcolor';
				$createMultiRowEditList = $auPostedElements['productcolorname'];
				$createMultiRowEditListId = $auPostedElements['productcolorcurrenteditid'];
				$createMultiRowEditListNum = count($auPostedElements['productcolorname']);
				for($i=0;$i<$createMultiRowEditListNum;$i++) {
					$createMultiRowEditListQue = '';
					if($createMultiRowEditListId["$i"] != '') {
						$createMultiRowEditListQue = "UPDATE $createMultiRowEditListTableName SET
								".$createMultiRowEditListTableName."_name = '".$createMultiRowEditList["$i"]."',
								".$createMultiRowEditListTableName."_hex = '".$auPostedElements['productcolorhex']["$i"]."'
								WHERE ".$createMultiRowEditListTableName."_id = '".$createMultiRowEditListId["$i"]."' LIMIT 1
						";
					}
					else {
						if($createMultiRowEditList["$i"] != '' && $auPostedElements['productcolorhex']["$i"] != '') {
							$createMultiRowEditListAin = autoIncrementNext($createMultiRowEditListTableName);
							$createMultiRowEditListQue = "INSERT INTO $createMultiRowEditListTableName VALUES(
									'',
									'$createMultiRowEditListAin',
									'e',
									'$nextInLine',
									'".$createMultiRowEditList["$i"]."',
									'".$auPostedElements['productcolorhex']["$i"]."'
								)
							";
						}
					}
					ue_query($createMultiRowEditListQue);
				}
				
				$createQueryStr	= "INSERT INTO ".$namaTableDatabase." VALUES(
									'',
									'$nextInLine',
									'$currentServerTime',
									'0',
									'".$enableStat."',
									'".$auPostedElements['producttype']."',
									'".$auPostedElements['productbrand']."',
									'".$prdInGroup."',
									'".$auPostedElements['name']."',
									'".$auPostedElements['productdesc']."',
									'".$auPostedElements['price']."',
									'".$auPostedElements['tags']."',
									'".$auPostedElements['productinfo']."',
									'".$auPostedElements['productguide']."',
									'".$auPostedElements['saleprice']."',
									'd',
									'e',
									'".$auPostedElements['weight']."',
									'".$auPostedElements['volume']."',
									'd',
									'd',
									'd',
									'".$auPostedElements['grosirprice']."'
				)";
				
				@ $grandQueryResult = ue_query($createQueryStr);
				$globalHistoryCorrespondingId = $nextInLine;
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