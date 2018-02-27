<?php include('ue-includes/ue-ses_check.php');$namaTableDatabase='shipping';$namaTableDatabaseId=$namaTableDatabase.'_id';$currentServerTime=time();$recordHistory=true;$historyTypeName='Shipping';$auPostedElements=array();foreach($_POST as $postedElementsKey=>$postedElementsVal){$auPostedElements["$postedElementsKey"]=ueReceiveInput($postedElementsKey,$postedElementsVal);}$id=$auPostedElements['id'];$detailmode=$auPostedElements['detailmode'];$namaPageUtama=$auPostedElements['mainpage'];$namaHalamanEdit=$auPostedElements['frompage'];$pageparam=$auPostedElements['pageparam'].'&detailmode='.$detailmode.'&id='.$id;$errorList=array();$errorListStr='';$requireFieldsNameArr=array('name','area');foreach($ue_globvar_shipping_mode as $shipKey=>$shipVal){$requireFieldsNameArr[]=$shipVal;}if($auPostedElements['submitMode']=='Save Draft'){$enableStat='d';}else{$enableStat='e';}foreach($requireFieldsNameArr as $requireFieldsNameArrKey=>$requireFieldsNameArrVal){if($auPostedElements["$requireFieldsNameArrVal"]==''){header("Location: $namaHalamanEdit".$pageparam."&err=Please Fill All Fields");exit();}}if(count($errorList)==0){switch($detailmode){case 'edit':$editDetailQue=ue_query("SELECT * FROM ".$namaTableDatabase." WHERE ".$namaTableDatabase."_id = '".$id."' LIMIT 1");@ $editDetailRes=ue_fetch_array($editDetailQue);$queryShipStr='';foreach($ue_globvar_shipping_mode as $shipKey=>$shipVal){$queryShipStr.=" $shipVal = '".$auPostedElements["$shipVal"]."',";}$queryShipStr=substr($queryShipStr,0,-1);$editQueryStr="UPDATE ".$namaTableDatabase." SET
									".$namaTableDatabase."_editdate = '$currentServerTime',
									".$namaTableDatabase."_enabled = '".$enableStat."',
									".$namaTableDatabase."_name = '".$auPostedElements['name']."',
									".$namaTableDatabase."_area = '".$auPostedElements['area']."',
									$queryShipStr
								WHERE ".$namaTableDatabase."_id = '$id' LIMIT 1
				";@ $grandQueryResult=ue_query($editQueryStr);$globalHistoryCorrespondingId=$id;break;default:$nextInLine=(int)autoIncrementNext($namaTableDatabase);$queryShipStr='';foreach($ue_globvar_shipping_mode as $shipKey=>$shipVal){$queryShipStr.=" '".$auPostedElements["$shipVal"]."',";}$queryShipStr=substr($queryShipStr,0,-1);$createQueryStr="INSERT INTO ".$namaTableDatabase." VALUES(
									'',
									'$nextInLine',
									'$currentServerTime',
									'0',
									'".$enableStat."',
									'".$auPostedElements['name']."',
									'".$auPostedElements['area']."',
									'',
									'".$auPostedElements['shipping_price']."',
									'".$auPostedElements['shipping_priceeco']."',
									'".$auPostedElements['shipping_urgent']."'
				)";@ $grandQueryResult=ue_query($createQueryStr);$globalHistoryCorrespondingId=$nextInLine;break;}$recordHistoryDesc="
			".$historyTypeName." Name : ".$auPostedElements['name']."
		";writeGlobalHistory($historyTypeName,$detailmode,$recordHistoryDesc,$namaTableDatabase,$globalHistoryCorrespondingId,$ue_globvar_recordglobalhistory,$recordHistory);switch($detailmode){case 'edit':if($grandQueryResult==false){header("Location: $namaPageUtama".$pageparam."&err=Invalid ID");}else{header("Location: $namaPageUtama".$pageparam."&sta=ok");}break;default:if($grandQueryResult==false){header("Location: $namaPageUtama".$pageparam."&err=Unable To Insert New Entry");}else{header("Location: $namaPageUtama".$pageparam."&sta=ok");}break;}}else{foreach($errorList as $errorListKey=>$errorListVal){$errorListStr.=$errorListVal.'<br />';}header("Location: $namaHalamanEdit".$pageparam."&err=".$errorListStr);}?>