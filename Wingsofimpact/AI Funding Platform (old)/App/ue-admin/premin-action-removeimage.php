<?php
	include('ue-includes/ue-ses_check.php');
	
	//Get All GET Vars
	$auPostedElements = array();
	foreach($_GET as $postedElementsKey => $postedElementsVal) {
		$auPostedElements["$postedElementsKey"] = ueReceiveInput($postedElementsKey,$postedElementsVal);
	}
	
	$id					= $auPostedElements['id'];
	$table				= $auPostedElements['fromtable'];
	$page				= $auPostedElements['frompage'];
	$type				= $auPostedElements['action'];
	$idColumnName		= $table.'_id';
	$purchasecode		= $auPostedElements['purchasecode'];
	$targetFolder		= $auPostedElements['trgtFldr'];
	$targetFile			= $auPostedElements['trgtFile'];
	
	
	if($id == '') {
		header("Location: $page".pageParamsFormat($pageParamsArr));
		break;
	}
	else {
		$query = "UPDATE ".$table." SET ".$table."_image = '' WHERE ".$idColumnName." = '".$id."' LIMIT 1";
		@ $quecek = ue_query($query);
		@ unlink($targetFolder.$targetFile);
	}
	
	if($auPostedElements['id'] != '') {
		$headerLocationAddStr = '&id='.$auPostedElements['id'].'&detailmode=edit';
	}
	
	if($quecek) {
		header("Location: $page".pageParamsFormat($pageParamsArr)."&sta=ok".$headerLocationAddStr);
	}
	else {
		header("Location: $page".pageParamsFormat($pageParamsArr)."&err=Remove Failed".$headerLocationAddStr);
	}
?>