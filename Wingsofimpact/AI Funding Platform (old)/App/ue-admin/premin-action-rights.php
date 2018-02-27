<?php
	include('ue-includes/ue-ses_check.php');
	
	//Get All GET Vars
	$auPostedElements = array();
	foreach($_GET as $postedElementsKey => $postedElementsVal) {
		$auPostedElements["$postedElementsKey"] = ue_real_escape_string($postedElementsVal);
	}
	
	$id					= $auPostedElements['id'];
	$currentAdminId		= $auPostedElements['currentAdminId'];
	$table				= 'adminuseraccess';
	$page				= 'detail-rights.php';
	$type				= $auPostedElements['action'];
	$idColumnName		= $table.'_id';
	$enabledColumnName	= $table.'_enabled';
	
	if($id == '') {
		header("Location: $page".pageParamsFormat($pageParamsArr));
		break;
	}
	else {
		$checkRightsExistQue = ue_query("SELECT * FROM $table WHERE adminsitepages_id = '$id' AND adminuserlevel_id = '$currentAdminId' LIMIT 1");
		if(@ue_num_rows($checkRightsExistQue) > 0) {
			$checkRightsExistRes = ue_fetch_array($checkRightsExistQue);
			$levelExist = true;
		}
		else {
			$levelExist = false;
		}
		
		switch($levelExist) {
			case true:
				if($type == 'd') {
					$query = "UPDATE ".$table." SET ".$enabledColumnName." = 'd' WHERE ".$idColumnName." = ".$checkRightsExistRes['adminuseraccess_id'];
				}
				else if($type == 'e') {
					$query = "UPDATE ".$table." SET ".$enabledColumnName." = 'e' WHERE ".$idColumnName." = ".$checkRightsExistRes['adminuseraccess_id'];
				}
			break;
			case false:
				if($type == 'd') {
					$query = "INSERT INTO ".$table." VALUES('','$currentAdminId','$id','d')";
				}
				else if($type == 'e') {
					$query = "INSERT INTO ".$table." VALUES('','$currentAdminId','$id','e')";
				}
			break;
		}
		
		$queryUpdateEditTime = "UPDATE adminuserlevel SET adminuserlevel_editdate = '".time()."' WHERE adminuserlevel_id = '".$currentAdminId."' LIMIT 1";
		
		//echo $query;
		@ $quecek = ue_query($query);
		@ ue_query($queryUpdateEditTime);
	}

switch($table) {
	case 'adminuseraccess':
		if($quecek) {
			header("Location: $page".pageParamsFormat($pageParamsArr)."&sta=ok&id=".$auPostedElements['currentAdminId']);
		}
		else {
			header("Location: $page".pageParamsFormat($pageParamsArr)."&err=Failed to Change Status&id=".$auPostedElements['currentAdminId']);
		}
	break;
	default:
		if($quecek) {
			header("Location: $page".pageParamsFormat($pageParamsArr)."&sta=ok");
		}
		else {
			header("Location: $page".pageParamsFormat($pageParamsArr)."&err=Failed to Change Status");
		}
	break;
}
?>