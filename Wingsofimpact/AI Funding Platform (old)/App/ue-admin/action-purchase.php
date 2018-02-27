<?php
 include('ue-includes/ue-ses_check.php');$namaTableDatabase='purchase';$namaTableDatabaseId=$namaTableDatabase.'_id';$currentServerTime=time();$recordHistory=true;$historyTypeName='Purchase';$auPostedElements=array();foreach($_POST as $postedElementsKey=>$postedElementsVal){$auPostedElements["$postedElementsKey"]=ueReceiveInput($postedElementsKey,$postedElementsVal,false);}$id=$auPostedElements['id'];$detailmode=$auPostedElements['detailmode'];$namaPageUtama=$auPostedElements['mainpage'];$namaHalamanEdit=$auPostedElements['frompage'];$pageparam=$auPostedElements['pageparam'].'&detailmode='.$detailmode.'&id='.$id;$errorList=array();$errorListStr='';$shipDate=strtotime($auPostedElements['shipdate'].' '.$auPostedElements['shipmon'].' '.$auPostedElements['shipyear']);$payDate=strtotime($auPostedElements['paydate'].' '.$auPostedElements['paymon'].' '.$auPostedElements['payyear']);$shipName=$auPostedElements['shipname'];$requireFieldsNameArr=array('purchasecode');foreach($requireFieldsNameArr as $requireFieldsNameArrKey=>$requireFieldsNameArrVal){if($auPostedElements["$requireFieldsNameArrVal"]==''){header("Location: $namaHalamanEdit".$pageparam."&err=Please Fill All Fields");exit();}}if(count($errorList)==0){switch($detailmode){case  'edit':$editDetailQue=ue_query("SELECT * FROM ".$namaTableDatabase." WHERE ".$namaTableDatabase."_id = '".$id."' LIMIT 1");@$editDetailRes=ue_fetch_array($editDetailQue);for($i=0;$i<count($auPostedElements['idpurchase']);$i++){$currentShipId=ue_real_escape_string($auPostedElements[$auPostedElements['province']]);$shippingEditQue=ue_query("SELECT * FROM shipping WHERE shipping_id = '$currentShipId' LIMIT 1");$shippingEditRes=ue_fetch_array($shippingEditQue);$shippingDataType=$auPostedElements['shiptype'];$shippingDataPrice=$shippingEditRes["$shippingDataType"];$updateEachPurchaseQue="UPDATE ".$namaTableDatabase." SET
					 	shipping_id = '".$currentShipId."',
						purchase_shiptype = '".$shippingDataType."',
						purchase_shipprice = '".$shippingDataPrice."',
						purchase_quantity = '".$auPostedElements['purchase_quant']["$i"]."',
						purchase_weight = '".$auPostedElements['purchase_weight']["$i"]."',
						purchase_address = '".$auPostedElements['address']."',
						purchase_postal = '".$auPostedElements['postal']."',
						purchase_telp = '".$auPostedElements['telp']."',
						purchase_deliverydate = '".$shipDate."',
						purchase_transfername = '".$auPostedElements['bankAccountName']."',
						purchase_transferamount = '".$auPostedElements['bankAmountTransfered']."',
						purchase_trackingcode = '".$auPostedElements['trackingcode']."',
						purchase_comment = '".$auPostedElements['comment']."',
						purchase_shipname = '".$auPostedElements['shipname']."',
						purchase_paydate = '".$payDate."'
					WHERE ".$namaTableDatabase."_id = '".$auPostedElements['idpurchase']["$i"]."'
					";@$grandQueryResult=ue_query($updateEachPurchaseQue);}break;}$recordHistoryDesc="
			".$historyTypeName." Name : ".$auPostedElements['name']."
		";writeGlobalHistory($historyTypeName,$detailmode,$recordHistoryDesc,$namaTableDatabase,$globalHistoryCorrespondingId,$ue_globvar_recordglobalhistory,$recordHistory);switch($detailmode){case  'edit':if($grandQueryResult==false){header("Location: $namaPageUtama".$pageparam."&err=Invalid ID");}else{header("Location: $namaPageUtama".$pageparam."&sta=ok");}break;default:if($grandQueryResult==false){header("Location: $namaPageUtama".$pageparam."&err=Unable To Insert New Entry");}else{header("Location: $namaPageUtama".$pageparam."&sta=ok");}break;}}else{foreach($errorList as $errorListKey=>$errorListVal){$errorListStr.=$errorListVal.'<br />';}header("Location: $namaHalamanEdit".$pageparam."&err=".$errorListStr);}?>