<?php
 include('ue-includes/ue-ses_check.php');$namaTableDatabase='subscriber';$namaTableDatabaseId=$namaTableDatabase.'_id';$currentServerTime=time();$recordHistory=true;$historyTypeName='Subscriber';$auPostedElements=array();foreach($_POST as $postedElementsKey=>$postedElementsVal){$auPostedElements["$postedElementsKey"]=ueReceiveInput($postedElementsKey,$postedElementsVal);}$id=$auPostedElements['id'];$detailmode=$auPostedElements['detailmode'];$namaPageUtama=$auPostedElements['mainpage'];$namaHalamanEdit=$auPostedElements['frompage'];$pageparam=$auPostedElements['pageparam'].'&detailmode='.$detailmode.'&id='.$id;$errorList=array();$errorListStr='';$requireFieldsNameArr=array('name','source');foreach($requireFieldsNameArr as $requireFieldsNameArrKey=>$requireFieldsNameArrVal){if($auPostedElements["$requireFieldsNameArrVal"]==''){header("Location: $namaHalamanEdit".$pageparam."&err=Please Fill All Fields");exit();}}if(count($errorList)==0){switch($detailmode){case  'edit':$editDetailQue=ue_query("SELECT * FROM ".$namaTableDatabase." WHERE ".$namaTableDatabase."_id = '".$id."' LIMIT 1");@$editDetailRes=ue_fetch_array($editDetailQue);$editQueryStr="UPDATE ".$namaTableDatabase." SET
									".$namaTableDatabase."_editdate = '$currentServerTime',
									".$namaTableDatabase."_name = '".$auPostedElements['name']."',
									".$namaTableDatabase."_source = '".$auPostedElements['source']."'
								WHERE ".$namaTableDatabase."_id = '$id' LIMIT 1
				";@$grandQueryResult=ue_query($editQueryStr);$globalHistoryCorrespondingId=$id;break;default:$nextInLine=(int)autoIncrementNext($namaTableDatabase);$createQueryStr="INSERT INTO ".$namaTableDatabase." VALUES(
									'',
									'$currentServerTime',
									'0',
									'e',
									'".$auPostedElements['name']."',
									'".$auPostedElements['source']."'
				)";@$grandQueryResult=ue_query($createQueryStr);$globalHistoryCorrespondingId=$nextInLine;break;}$recordHistoryDesc="
			".$historyTypeName." Email : ".$auPostedElements['name']."
		";writeGlobalHistory($historyTypeName,$detailmode,$recordHistoryDesc,$namaTableDatabase,$globalHistoryCorrespondingId,$ue_globvar_recordglobalhistory,$recordHistory);switch($detailmode){case  'edit':if($grandQueryResult==false){header("Location: $namaPageUtama".$pageparam."&err=Invalid ID");}else{header("Location: $namaPageUtama".$pageparam."&sta=ok");}break;default:if($grandQueryResult==false){header("Location: $namaPageUtama".$pageparam."&err=Unable To Insert New Entry");}else{header("Location: $namaPageUtama".$pageparam."&sta=ok");}break;}}else{foreach($errorList as $errorListKey=>$errorListVal){$errorListStr.=$errorListVal.'<br />';}header("Location: $namaHalamanEdit".$pageparam."&err=".$errorListStr);}?>