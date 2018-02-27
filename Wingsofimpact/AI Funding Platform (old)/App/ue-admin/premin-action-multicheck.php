<?php
	include('ue-includes/ue-ses_check.php');
	
	//Get All POST Vars
	$auPostedElements = array();
	foreach($_POST as $postedElementsKey => $postedElementsVal) {
		$auPostedElements["$postedElementsKey"] = ueReceiveInput($postedElementsKey,$postedElementsVal);
	}
	
	$table				= $auPostedElements['multiCheckAllTable'];
	$page				= $auPostedElements['multiCheckAllFrompage'];
	$type				= $auPostedElements['multiCheckAllMode'];
	$idColumnName		= $table.'_id';
	$enabledColumnName	= $table.'_enabled';
	$multiCheckInput	= $auPostedElements['multiCheckInput'];
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
	
	if($table == 'adminuseraccess') {
		$idColumnName = 'adminsitepages_id';
	}
	
	if(count($multiCheckInput) <= 0) {
		header("Location: $page".pageParamsFormat($pageParamsArr)."&err=Invalid IDs");
		exit();
	}
	else {
		switch($type) {
			case 'a':
			if($table == 'productsold') {
				foreach($multiCheckInput as $multiCheckInputKey => $multiCheckInputVal) {
					$soldData = explode('|',$multiCheckInputVal);
					$query = "DELETE FROM ".$table." WHERE
						product_id = '".$soldData['0']."' AND
						productcolor_id = '".$soldData['1']."' AND
						productsize_id = '".$soldData['2']."'
					 LIMIT 1";
					 
					@ ue_query($query);
				}
			}
			break;
			case 's':
			if($table == 'productsold') {
				foreach($multiCheckInput as $multiCheckInputKey => $multiCheckInputVal) {
					$soldData = explode('|',$multiCheckInputVal);
					$checkPrdSoldQue = ue_query("SELECT productsold_id FROM productsold WHERE
						product_id = '".$soldData['0']."' AND
						productcolor_id = '".$soldData['1']."' AND
						productsize_id = '".$soldData['2']."'
					LIMIT 0,1
					");
					
					@ $checkPrdSoldRes = (int)ue_num_rows($checkPrdSoldQue);
					if($checkPrdSoldRes == 0) {
						$curTime = time();
						
						$query = "INSERT INTO $table VALUES(
							'',
							'$curTime',
							'0',
							'".$soldData['0']."',
							'".$soldData['2']."',
							'".$soldData['1']."'
						)";
						
						@ ue_query($query);
					}
				}
			}
			break;
			case 'e':
				foreach($multiCheckInput as $multiCheckInputKey => $multiCheckInputVal) {
					
					if($auPostedElements['multiCheckAllcurrentAdminId']) {
						$currentAdminId = $auPostedElements['multiCheckAllcurrentAdminId'];
						$checkRightsExistQue = ue_query("SELECT * FROM $table WHERE adminsitepages_id = '$multiCheckInputVal' AND adminuserlevel_id = '$currentAdminId' LIMIT 1");
						if(@ue_num_rows($checkRightsExistQue) > 0) {
							$checkRightsExistRes = ue_fetch_array($checkRightsExistQue);
							$levelExist = true;
						}
						else {
							$levelExist = false;
						}
						
						switch($levelExist) {
							case true:
								$idColumnName = 'adminuseraccess_id';
								$query = "UPDATE ".$table." SET ".$enabledColumnName." = 'e' WHERE ".$idColumnName." = ".$checkRightsExistRes['adminuseraccess_id'];
							break;
							case false:
								$query = "INSERT INTO ".$table." VALUES('','$currentAdminId','$multiCheckInputVal','e')";
							break;
						}
					}
					else {
						$query = "UPDATE ".$table." SET ".$enabledColumnName." = 'e' WHERE ".$idColumnName." = ".$multiCheckInputVal." LIMIT 1";;
					}
					
					//echo $query; exit();
					
					@ ue_query($query);
				}
			break;
			case 'd':
				foreach($multiCheckInput as $multiCheckInputKey => $multiCheckInputVal) {
					
					if($auPostedElements['multiCheckAllcurrentAdminId']) {
						$currentAdminId = $auPostedElements['multiCheckAllcurrentAdminId'];
						$checkRightsExistQue = ue_query("SELECT * FROM $table WHERE adminsitepages_id = '$multiCheckInputVal' AND adminuserlevel_id = '$currentAdminId' LIMIT 1");
						if(@ue_num_rows($checkRightsExistQue) > 0) {
							$checkRightsExistRes = ue_fetch_array($checkRightsExistQue);
							$levelExist = true;
						}
						else {
							$levelExist = false;
						}
						
						switch($levelExist) {
							case true:
								$idColumnName = 'adminuseraccess_id';
								$query = "UPDATE ".$table." SET ".$enabledColumnName." = 'd' WHERE ".$idColumnName." = ".$checkRightsExistRes['adminuseraccess_id'];
							break;
							case false:
								$query = "INSERT INTO ".$table." VALUES('','$currentAdminId','$multiCheckInputVal','d')";
							break;
						}
					}
					else {
						$query = "UPDATE ".$table." SET ".$enabledColumnName." = 'd' WHERE ".$idColumnName." = ".$multiCheckInputVal." LIMIT 1";;
					}
					
					@ ue_query($query);
				}
			break;
			case 'top':
				//Get Smallest Showorder
				$sortedShoworderArr = array();
				foreach($multiCheckInput as $multiCheckInputKey => $multiCheckInputVal) {
					$currentShoworderQue = ue_query("SELECT ".$table."_showorder FROM ".$table." WHERE ".$table."_id = '$multiCheckInputVal' LIMIT 1");
					$currentShoworderRes = ue_fetch_array($currentShoworderQue);
					$sortedShoworderArr[$currentShoworderRes[$table.'_showorder']] = $multiCheckInputVal;
					
					if(!isset($smallestSortedShoworder) || $smallestSortedShoworder > $currentShoworderRes[$table.'_showorder']) {
						$smallestSortedShoworder = $currentShoworderRes[$table.'_showorder'];
					}
				}
				ksort($sortedShoworderArr);
				
				//Get Current Showorder State
				$currentShoworderArr = array();
				$currentIdArr = array();
				
				$beforeSortedArrQue = ue_query("SELECT ".$table."_showorder,".$table."_id FROM ".$table." WHERE ".$table."_showorder >= '".$smallestSortedShoworder."' ORDER BY ".$table."_showorder DESC");
				while($beforeSortedArrRes = ue_fetch_array($beforeSortedArrQue)) {
					$currentShoworderArr[] = $beforeSortedArrRes[$table."_showorder"];
					$currentIdArr[] = $beforeSortedArrRes[$table."_id"];
				}
				
				//Make Showorder Result
				foreach($sortedShoworderArr as $sortedShoworderArrKey => $sortedShoworderArrVal) {
					$willBeDeletedArrKey = array_search($sortedShoworderArrVal,$currentIdArr);
					unset($currentIdArr[$willBeDeletedArrKey]);
					array_unshift($currentIdArr,$sortedShoworderArrVal);
				}
				
				//Moving Start
				for($i=0;$i<=count($currentIdArr);$i++) {
					ue_query("UPDATE ".$table." SET ".$table."_showorder = ".$currentShoworderArr[$i]." WHERE ".$table."_id = ".$currentIdArr[$i]." LIMIT 1");
				}
			break;
			case 'delete':			
				foreach($multiCheckInput as $multiCheckInputKey => $multiCheckInputVal) {
					$id = $multiCheckInputVal;
					
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
					
					$query = "DELETE FROM ".$table." WHERE ".$idColumnName." = '".$multiCheckInputVal."' LIMIT 1";
					@ ue_query($query);
				}
			break;
			case 'fon':
				$enabledColumnName = 'product_featured';
				foreach($multiCheckInput as $multiCheckInputKey => $multiCheckInputVal) {
					$query = "UPDATE ".$table." SET ".$enabledColumnName." = 'e' WHERE ".$idColumnName." = ".$multiCheckInputVal." LIMIT 1";
					@ ue_query($query);
				}
			break;
			case 'foff':
				$enabledColumnName = 'product_featured';
				foreach($multiCheckInput as $multiCheckInputKey => $multiCheckInputVal) {
					$query = "UPDATE ".$table." SET ".$enabledColumnName." = 'd' WHERE ".$idColumnName." = ".$multiCheckInputVal." LIMIT 1";
					@ ue_query($query);
				}
			break;
			case 'son':
				$enabledColumnName = 'product_sold';
				foreach($multiCheckInput as $multiCheckInputKey => $multiCheckInputVal) {
					$query = "UPDATE ".$table." SET ".$enabledColumnName." = 'e' WHERE ".$idColumnName." = ".$multiCheckInputVal." LIMIT 1";
					@ ue_query($query);
				}
			break;
			case 'soff':
				$enabledColumnName = 'product_sold';
				foreach($multiCheckInput as $multiCheckInputKey => $multiCheckInputVal) {
					$query = "UPDATE ".$table." SET ".$enabledColumnName." = 'd' WHERE ".$idColumnName." = ".$multiCheckInputVal." LIMIT 1";
					@ ue_query($query);
				}
			break;
		}
		
		header("Location: $page".pageParamsFormat($pageParamsArr)."&sta=ok".$headerLocationAddStr);
	}
?>