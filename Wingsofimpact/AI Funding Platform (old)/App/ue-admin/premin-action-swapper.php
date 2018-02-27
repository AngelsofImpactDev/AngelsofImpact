<?php
	include('ue-includes/ue-ses_check.php');
	
	//Get All GET Vars
	$auPostedElements = array();
	foreach($_GET as $postedElementsKey => $postedElementsVal) {
		$auPostedElements["$postedElementsKey"] = ue_real_escape_string($postedElementsVal);
	}
	
	$swapperTable	= $auPostedElements['swapperTable'];
	$page			= $auPostedElements['frompage'];
	$swapperSelf	= $auPostedElements['swapperSelf'];
	$swapperTarget	= $auPostedElements['swapperTarget'];
	
	//Get SELF Showorder
	$getSelfQue = ue_query("SELECT ".$swapperTable."_id FROM $swapperTable WHERE ".$swapperTable."_showorder = '$swapperSelf' LIMIT 1");
	$getSelfRes = ue_fetch_array($getSelfQue);
	$selfShoworderId = $getSelfRes["$swapperTable".'_id'];
	$selfShoworder = $swapperSelf;
	
	//Get TARGET Showorder
	$getTargetQue = ue_query("SELECT ".$swapperTable."_id FROM $swapperTable WHERE ".$swapperTable."_showorder = '$swapperTarget' LIMIT 1");
	$getTargetRes = ue_fetch_array($getTargetQue);
	$targetShoworderId = $getTargetRes["$swapperTable".'_id'];
	$targetShoworder = $swapperTarget;
	
	if($auPostedElements['editpageid'] != '') {
		$headerLocationAddStr = '&id='.$auPostedElements['editpageid'].'&detailmode=edit';
	}
	
	if($selfShoworder != '' && $targetShoworder != '') {
		//Update SELF To TARGET;
		ue_query("UPDATE $swapperTable SET ".$swapperTable."_showorder = '$targetShoworder' WHERE ".$swapperTable."_id = '$selfShoworderId' LIMIT 1");
		
		//Update TARGET To SELF;
		ue_query("UPDATE $swapperTable SET ".$swapperTable."_showorder = '$selfShoworder' WHERE ".$swapperTable."_id = '$targetShoworderId' LIMIT 1");
		
		header("Location: $page".pageParamsFormat($pageParamsArr,array('swapperSelf' => ''))."&sta=ok".$headerLocationAddStr);
	}
	else {
		header("Location: $page".pageParamsFormat($pageParamsArr)."&err=Can't Move Object".$headerLocationAddStr);
	}
?>