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
	$foreignKeyDelete	= array();
	$imageDelete		= array(
		'product' 			=> array('productImage','productImageThumb'),
		'productimage'		=> array('productImage','productImageThumb'),
		'bank'				=> array('bankLogo'),
		'lookbook' 			=> array('lookbook','lookbookslider'),
		'lookbookimage'		=> array('lookbookslider'),
		'news' 				=> array('news'),
		'newsauthor' 		=> array('newsauthor'),
		'productbrand' 		=> array('productBrandImage'),
		'productcategory' 	=> array('productCategoryImage'),
		'productclass' 		=> array('productClassImage'),
		'producttype' 		=> array('productTypeImage'),
		'slider' 			=> array('sliderImage'),
		'testimonial'		=> array('testimonial')
	);
	
	switch($table) {
		case 'product':
			$foreignKeyDelete[] = 'productcolor';
			$foreignKeyDelete[] = 'productimage';
			$foreignKeyDelete[] = 'productsize';
			$foreignKeyDelete[] = 'productsold';
		break;
		case 'lookbook':
			$foreignKeyDelete[] = 'lookbookimage';
		break;
	}
	
	if($id == '') {
		header("Location: $page".pageParamsFormat($pageParamsArr));
		break;
	}
	else {
		//Delete Images START
		if(count($imageDelete["$table"]) > 0) {
			foreach($imageDelete["$table"] as $imageDeleteKey => $imageDeleteVal) {
				switch($table) {
					case 'product':
						$getImageNameQue = ue_query("SELECT productimage_image FROM productimage WHERE ".$table."_id = '".$id."'");
						while($getImageNameRes = ue_fetch_array($getImageNameQue)) {
							if($getImageNameRes["productimage_image"] != '') {
								@ unlink('../upload/'.$imageDeleteVal.'/'.$getImageNameRes["productimage_image"]);
							}							
						}
					break;
					case 'lookbook':
						if($imageDeleteVal == 'lookbook') {
							$getImageNameQue = ue_query("SELECT ".$table."_image FROM ".$table." WHERE ".$table."_id = '".$id."' LIMIT 1");
							@ $getImageNameRes = ue_fetch_array($getImageNameQue);
							if($getImageNameRes["$table"."_image"] != '') {
								@ unlink('../upload/'.$imageDeleteVal.'/'.$getImageNameRes["$table"."_image"]);
							}
						}
						else if($imageDeleteVal == 'lookbookslider') {
							$getImageNameQue = ue_query("SELECT lookbookimage_image FROM lookbookimage WHERE ".$table."_id = '".$id."'");
							while($getImageNameRes = ue_fetch_array($getImageNameQue)) {
								if($getImageNameRes["lookbookimage_image"] != '') {
									@ unlink('../upload/'.$imageDeleteVal.'/'.$getImageNameRes["lookbookimage_image"]);
								}							
							}
						}
					break;
					default:
						$getImageNameQue = ue_query("SELECT ".$table."_image FROM ".$table." WHERE ".$table."_id = '".$id."' LIMIT 1");
						@ $getImageNameRes = ue_fetch_array($getImageNameQue);
						if($getImageNameRes["$table"."_image"] != '') {
							@ unlink('../upload/'.$imageDeleteVal.'/'.$getImageNameRes["$table"."_image"]);
						}
					break;
				}
			}
		}
		//Delete Images END
		
		//Delete Foreign Keys START
		if(count($foreignKeyDelete) > 0) {
			foreach($foreignKeyDelete as $foreignKeyDeleteKey => $foreignKeyDeleteVal) {
				ue_query("DELETE FROM ".$foreignKeyDeleteVal." WHERE ".$table."_id = '".$id."'");
			}
		}
		//Delete Foreign Keys END
		
		if($purchasecode != '') {
			$query = "DELETE FROM ".$table." WHERE ".$table."_code = '".$purchasecode."'";
		}
		else {
			$query = "DELETE FROM ".$table." WHERE ".$idColumnName." = '".$id."' LIMIT 1";
		}
		//echo $query;
		@ $quecek = ue_query($query);
	}
	
	if($auPostedElements['editpageid'] != '') {
		$headerLocationAddStr = '&id='.$auPostedElements['editpageid'].'&detailmode=edit';
	}
	
	if($quecek) {
		/*
		if($table == "startup"){
			$rs = ue_fetch_array(ue_query("SELECT a.*, b.user_name, b.user_email FROM startup a LEFT JOIN user b ON a.user_id = b.user_id WHERE a.startup_id = '".$id."' LIMIT 1"));
			$nl = '<br />';
			$purchaseMailTitle 	= "New startup ".$auPostedElements['name']." Rejected";
			$mesTitle			= "Startup seek funding rejected";
			$admtargetMail 		= $rs['user_email'];
			$messageIp = ueGetClientIp();
			$mesDate = date("F j, Y, g:ia");
			$mesTitle = $mesTitle.' - '.$mesDate;
			$messageQuery = "==========================================$nl
							Hello, ".$rs['user_name']." $nl
							We're sorry, your startup funding request has been rejected $nl
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
		
		if($table == "transaction"){
			$sql= "SELECT a.*, b.user_name as investorName, b.user_email as investorEmail, c.startup_name, c.startup_repaymentperiod, c.startup_repaymentstart, d.user_name as seName, d.user_email as seEmail FROM ".$table." a 
								LEFT JOIN user b ON a.user_id = b.user_id 
								LEFT JOIN startup c ON a.startup_id = c.startup_id
								LEFT JOIN user d ON c.user_id = d.user_id
								WHERE a.".$table."_id = '".$id."' LIMIT 1";
			$rs = ue_fetch_array(ue_query($sql));
			$nl = '<br />';
			$purchaseMailTitle 	= "Startup ".$rs['startup_name']." Funding Rejected";
			//$mesTitle			= "Startup seek funding approved";
			$mesDate = date("F j, Y, g:ia");
			$admtargetMail 		= $rs['investorEmail'];
			//$mesTitle = $mesTitle.' - '.$mesDate;
			$messageQuery = "==========================================$nl
							Hello, ".$rs['investorName']." $nl
							Your funding has been rejected by admin $nl
							==========================================$nl
							Startup name: ".$rs['startup_name']." $nl
							Amount: $ ".$rs['transaction_amount']." $nl
							==========================================$nl
							END OF MESSAGE $nl
							==========================================
							";
			
			sendMail($admtargetMail,'notif@angelofimpact.com',$purchaseMailTitle,$messageQuery);
			//echo $messageQuery;
			
			$admtargetMail 		= $rs['seEmail'];
			//$mesTitle = $mesTitle.' - '.$mesDate;
			$messageQuery = "==========================================$nl
							Hello, ".$rs['seName']." $nl
							Your startup funding has been rejected by admin $nl
							==========================================$nl
							Startup name: ".$rs['startup_name']." $nl
							Amount: $ ".$rs['transaction_amount']." $nl
							==========================================$nl
							END OF MESSAGE $nl
							==========================================
							";
			//echo $messageQuery;die();
			sendMail($admtargetMail,'notif@angelofimpact.com',$purchaseMailTitle,$messageQuery);
		}
		*/
		header("Location: $page".pageParamsFormat($pageParamsArr)."&sta=ok".$headerLocationAddStr);
	}
	else {
		header("Location: $page".pageParamsFormat($pageParamsArr)."&err=Delete Failed".$headerLocationAddStr);
	}
?>