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
	$enabledColumnName	= $table.'_enabled';
	
	if($id == '') {
		header("Location: $page".pageParamsFormat($pageParamsArr));
		break;
	}
	else {
		if($table == 'product' && $type == 'e') {
			$soldStatusEach = checkPrdSold($id);
			if($soldStatusEach == 'a') {
				$allowChange = true;
			}
			else {
				$allowChange = false;
			}
		}
		else {
			$allowChange = true;
		}
		
		if($allowChange)  {
			if($type == 'd') {
				$query = "UPDATE ".$table." SET ".$enabledColumnName." = 'd', ".$table."_editdate = '".time()."' WHERE ".$idColumnName." = ".$id;
			}
			else if($type == 'e') {
				$query = "UPDATE ".$table." SET ".$enabledColumnName." = 'e', ".$table."_editdate = '".time()."' WHERE ".$idColumnName." = ".$id;
			}
			//echo $query;
			@ $quecek = ue_query($query." LIMIT 1");
		}
	}
	
	if($auPostedElements['editpageid'] != '') {
		$headerLocationAddStr = '&id='.$auPostedElements['editpageid'].'&detailmode=edit';
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
			/*
			if($table == "startup"){
				if($type == "e"){
					
					$rs = ue_fetch_array(ue_query("SELECT a.*, b.user_name, b.user_email FROM startup a LEFT JOIN user b ON a.user_id = b.user_id WHERE a.startup_id = '".$id."' LIMIT 1"));
					$nl = '<br />';
					$purchaseMailTitle 	= "New startup ".$auPostedElements['name']." Approved";
					$mesTitle			= "Startup seek funding approved";
					$admtargetMail 		= $rs['user_email'];
					$messageIp = ueGetClientIp();
					$mesDate = date("F j, Y, g:ia");
					$mesTitle = $mesTitle.' - '.$mesDate;
					$messageQuery = "==========================================$nl
									Hello, ".$rs['user_name']." $nl
									Your startup has been published to the angels $nl
									==========================================$nl
									Startup ID : ".$rs['startup_id']." $nl
									Startup name: ".$rs['startup_name']." $nl
									Amount: $ ".$rs['startup_amount']." $nl
									==========================================$nl
									END OF MESSAGE $nl
									==========================================
									";
					//echo $messageQuery;die();
					sendMail($admtargetMail,'notif@angelofimpact.com',$purchaseMailTitle,$messageQuery);
				}
			}
			*/
			header("Location: $page".pageParamsFormat($pageParamsArr)."&sta=ok".$headerLocationAddStr);
		}
		else if(!$allowChange) {
			header("Location: $page".pageParamsFormat($pageParamsArr)."&err=At least one product Size and Color required".$headerLocationAddStr);
		}
		else {
			header("Location: $page".pageParamsFormat($pageParamsArr)."&err=Failed to Change Status".$headerLocationAddStr);
		}
	break;
}
?>