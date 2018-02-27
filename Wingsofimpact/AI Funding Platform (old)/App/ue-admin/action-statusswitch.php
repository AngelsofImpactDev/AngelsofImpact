<?php
	include('ue-includes/ue-ses_check.php');
	
	//Get All GET Vars
	$auPostedElements = array();
	foreach($_GET as $postedElementsKey => $postedElementsVal) {
		$auPostedElements["$postedElementsKey"] = ue_real_escape_string($postedElementsVal);
	}
	
	$id					= $auPostedElements['id'];
	$table				= $auPostedElements['targetdatabasename'];
	$page				= $auPostedElements['frompage'];
	$type				= $auPostedElements['action'];
	$idColumnName		= $auPostedElements['targetcolumnid'];
	$enabledColumnName	= $auPostedElements['targetcolumnname'];
	$idt				= $auPostedElements['idt'];
	if($id == '') {
		header("Location: $page".pageParamsFormat($pageParamsArr));
		break;
	}
	else {
		if($table=="user" and $enabledColumnName == "user_expiry"){
			if($type == 'd') {
				$query = "UPDATE ".$table." SET ".$enabledColumnName." = '0' WHERE ".$idColumnName." = ".$id;
			}
			else if($type == 'e') {
				$fetchTime 	= ue_fetch_array(ue_query("SELECT * FROM user WHERE user_id = '".$id."' LIMIT 1"));
				//if($fetchTime['user_expiry']=="0"){
				$addYear = strtotime(date("Y-m-d",strtotime('+1 year')));
				/*
				}else{
					$addYear = $fetchTime['user_expiry'] + 31536000;
				}
				*/
				$query = "UPDATE ".$table." SET ".$enabledColumnName." = '".$addYear."' WHERE ".$idColumnName." = ".$id;
			}
		}else if($table == "transactiondetail"){
			if($type == 'unpaid') {
				$query = "UPDATE ".$table." SET ".$enabledColumnName." = 'unpaid', transactiondetail_editdate = '".time()."' WHERE ".$idColumnName." = ".$id;
			}else if($type == 'paid'){
				$query = "UPDATE ".$table." SET ".$enabledColumnName." = 'paid', transactiondetail_editdate = '".time()."', transactiondetail_confirmdate = '".time()."' WHERE ".$idColumnName." = ".$id;
			}
		}else{
			if($type == 'd') {
				$query = "UPDATE ".$table." SET ".$enabledColumnName." = 'd' WHERE ".$idColumnName." = ".$id;
			}
			else if($type == 'e') {
				$query = "UPDATE ".$table." SET ".$enabledColumnName." = 'e' WHERE ".$idColumnName." = ".$id;
			}
		}
		//echo pageParamsFormat($pageParamsArr);die();
		@ $quecek = ue_query($query." LIMIT 1");
	}
	
	if($auPostedElements['editpageid'] != '') {
		$headerLocationAddStr = '&id='.$auPostedElements['editpageid'].'&detailmode=edit';
	}

switch($table) {
	default:
		if($quecek) {
			if($table == "transactiondetail"){
				header("Location: $page?idt=".$idt."&sta=ok".$headerLocationAddStr);
			}else{
				header("Location: $page".pageParamsFormat($pageParamsArr)."&sta=ok".$headerLocationAddStr);
			}
		}
		else {
			if($table == "transactiondetail"){
				header("Location: $page?idt=".$idt."&err=Failed to Change Status".$headerLocationAddStr);
			}else{
				header("Location: $page".pageParamsFormat($pageParamsArr)."&err=Failed to Change Status".$headerLocationAddStr);
			}
		}
	break;
}
?>