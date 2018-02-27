<?php
	include('ue-includes/ue-ses_check.php');
	
	//Get All GET Vars
	$auPostedElements = array();
	foreach($_GET as $postedElementsKey => $postedElementsVal) {
		$auPostedElements["$postedElementsKey"] = ue_real_escape_string($postedElementsVal);
	}
	
	$id					= $auPostedElements['id'];
	$table				= 'productsold';
	$page				= 'detail-productsold.php';
	$type				= '';
	$idColumnName		= '';
	$enabledColumnName	= '';
	
	if($id == '' || $auPostedElements['pclr'] == '' || $auPostedElements['psize'] == '') {
		header("Location: $page".'?id='.$id.'&err=Invalid ID');
		break;
	}
	else {
		$checkPrdSoldQue = ue_query("SELECT productsold_id FROM productsold WHERE
			product_id = '".$id."' AND
			productcolor_id = '".$auPostedElements['pclr']."' AND
			productsize_id = '".$auPostedElements['psize']."'
		LIMIT 0,1
		");
		
		@ $checkPrdSoldRes = (int)ue_num_rows($checkPrdSoldQue);
		if($checkPrdSoldRes == 0) {
			$curTime = time();
			
			$query = "INSERT INTO $table VALUES(
				'',
				'$curTime',
				'0',
				'$id',
				'".$auPostedElements['psize']."',
				'".$auPostedElements['pclr']."'
			)";
		}
		else {
			$checkPrdSoldResRes = ue_fetch_array($checkPrdSoldQue);
			$query = "DELETE FROM ".$table." WHERE ".$table."_id = '".$checkPrdSoldResRes["$table".'_id']."' LIMIT 1";
		}
		//echo $query; exit();
		@ $quecek = ue_query($query);
	}

switch($table) {
	default:
		if($quecek) {
			header("Location: $page".'?id='.$id.'&sta=ok');
		}
		else {
			header("Location: $page".'?id='.$id.'&err=Failed to Change Status');
		}
	break;
}
?>