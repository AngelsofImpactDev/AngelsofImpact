<?php
	include('ue-includes/ue-ses_check.php');
	
	//Get All GET Vars
	$auPostedElements = array();
	foreach($_GET as $postedElementsKey => $postedElementsVal) {
		$auPostedElements["$postedElementsKey"] = ue_real_escape_string($postedElementsVal);
	}
	
	$id					= $auPostedElements['id'];
	$table				= $auPostedElements['fromtable'];
	$page				= $auPostedElements['frompage'];
	$idColumnName		= $table.'_id';
	$orderColumnName	= $table.'_showorder';
	
	$queryTop = "SELECT ".$orderColumnName." FROM ".$table." WHERE ".$idColumnName." = '".$id."' LIMIT 1";
	$queryTopQue = ue_query($queryTop);
	$queryTopRes = ue_fetch_array($queryTopQue);
	
	$initId = array();
	$initShowOrder = array();
	$formattedShowOrder = array();
	
	if($auPostedElements['editpageid'] != '') {
		$headerLocationAddStr = '&id='.$auPostedElements['editpageid'].'&detailmode=edit';
	}
	
	$listOfBiggerQue = ue_query("SELECT * FROM $table WHERE ".$orderColumnName." >= '".$queryTopRes["$orderColumnName"]."' ORDER BY ".$orderColumnName." DESC");
	if(@ue_num_rows($listOfBiggerQue) > 1) {
		while($listOfBiggerRes = ue_fetch_array($listOfBiggerQue)) {
			$initId[] = $listOfBiggerRes["$idColumnName"];
			$initShowOrder[] = $listOfBiggerRes["$orderColumnName"];
		}
	
		for($i=0;$i<(count($initId)-1);$i++) {
			$currentArrNum = $i + 1;
			ue_query("UPDATE $table SET ".$orderColumnName." = '".$initShowOrder["$currentArrNum"]."' WHERE ".$idColumnName." = '".$initId["$i"]."' LIMIT 1");
		}
		ue_query("UPDATE $table SET ".$orderColumnName." = '".$initShowOrder['0']."' WHERE ".$idColumnName." = '".$id."' LIMIT 1");
		
		header("Location: $page".pageParamsFormat($pageParamsArr)."&sta=ok".$headerLocationAddStr);
	}
	else {
		header("Location: $page".pageParamsFormat($pageParamsArr)."&err=Already on Top".$headerLocationAddStr);
	}
?>