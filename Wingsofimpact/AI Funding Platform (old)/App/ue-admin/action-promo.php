<?php include('ue-includes/ue-ses_check.php');$namaTableDatabase='promo';$namaTableDatabaseId=$namaTableDatabase.'_id';$currentServerTime=time();$recordHistory=true;$historyTypeName='Promo';$auPostedElements=array();foreach($_POST as $postedElementsKey=>$postedElementsVal){$auPostedElements["$postedElementsKey"]=ueReceiveInput($postedElementsKey,$postedElementsVal);}$id=$auPostedElements['id'];$detailmode=$auPostedElements['detailmode'];$namaPageUtama=$auPostedElements['mainpage'];$namaHalamanEdit=$auPostedElements['frompage'];$pageparam=$auPostedElements['pageparam'].'&detailmode='.$detailmode.'&id='.$id;$errorList=array();$errorListStr='';$requireFieldsNameArr=array('name','enddate','endmon','endyear','endhour','endminute','code','type','mode');if($auPostedElements['submitMode']=='Save Draft'){$enableStat='d';}else{$enableStat='e';}foreach($requireFieldsNameArr as $requireFieldsNameArrKey=>$requireFieldsNameArrVal){if($auPostedElements["$requireFieldsNameArrVal"]==''){header("Location: $namaHalamanEdit".$pageparam."&err=Please Fill All Fields");exit();}}$promoCodeExistQue=ue_query("SELECT * FROM ".$namaTableDatabase." WHERE ".$namaTableDatabase."_code = '".$auPostedElements['code']."' AND ".$namaTableDatabase."_id != '".$id."' LIMIT 1");if(@ue_num_rows($promoCodeExistQue)>0){$errorList[]='Voucher Code Already Exist';}if($auPostedElements['mode']==1){if($auPostedElements['promolimit']=='bp'){$auPostedElements['promolimit']='nl';}}if($auPostedElements['type']!=2){$auPostedElements['onetimeuser']='';}if($auPostedElements['mode']!=2&&$auPostedElements['mode']!=3){$auPostedElements['maxvalue']=0;}if($auPostedElements['promolimit']=='nl'){$auPostedElements['minpurchase']=0;unset($auPostedElements['prdlimit']);}else if($auPostedElements['promolimit']=='mp'){unset($auPostedElements['prdlimit']);}else if($auPostedElements['promolimit']=='bp'){$auPostedElements['minpurchase']=0;}if($auPostedElements['banklimittrigger']!='banklimityes'){unset($auPostedElements['banklimit']);}if($auPostedElements['userlimittrigger']!='userlimityes'){unset($auPostedElements['userlimit']);}if(count($auPostedElements['prdlimit'])>0){$allowPrdPromo='';foreach($auPostedElements['prdlimit'] as $prdLimitKey=>$prdLimitVal){$allowPrdPromo.=$prdLimitVal.',';}$allowPrdPromo=substr($allowPrdPromo,0,-1);}if(count($auPostedElements['banklimit'])>0){$allowBankPromo='';foreach($auPostedElements['banklimit'] as $bankLimitKey=>$bankLimitVal){$allowBankPromo.=$bankLimitVal.',';}$allowBankPromo=substr($allowBankPromo,0,-1);}if(count($auPostedElements['userlimit'])>0){$allowUserPromo='';foreach($auPostedElements['userlimit'] as $userLimitKey=>$userLimitVal){$allowUserPromo.=$userLimitVal.',';}$allowUserPromo=substr($allowUserPromo,0,-1);}if(count($errorList)==0){$endpromounix=strtotime($auPostedElements['enddate'].' '.$auPostedElements['endmon'].' '.$auPostedElements['endyear'].' '.$auPostedElements['endhour'].':'.$auPostedElements['endminute']);switch($detailmode){case 'edit':$editDetailQue=ue_query("SELECT * FROM ".$namaTableDatabase." WHERE ".$namaTableDatabase."_id = '".$id."' LIMIT 1");@ $editDetailRes=ue_fetch_array($editDetailQue);$editQueryStr="UPDATE ".$namaTableDatabase." SET
									".$namaTableDatabase."_editdate = '$currentServerTime',
									".$namaTableDatabase."_enabled = '".$enableStat."',
									".$namaTableDatabase."_name = '".$auPostedElements['name']."',
									".$namaTableDatabase."_code = '".$auPostedElements['code']."',
									".$namaTableDatabase."_expiry = '$endpromounix',
									".$namaTableDatabase."_type = '".$auPostedElements['type']."',
									".$namaTableDatabase."_mode = '".$auPostedElements['mode']."',
									".$namaTableDatabase."_value = '".$auPostedElements['value']."',
									".$namaTableDatabase."_minpurchase = '".$auPostedElements['minpurchase']."',
									".$namaTableDatabase."_productallow = '$allowPrdPromo',
									".$namaTableDatabase."_bankallow = '$allowBankPromo',
									".$namaTableDatabase."_userallow = '$allowUserPromo',
									".$namaTableDatabase."_maxvalue = '".$auPostedElements['maxvalue']."',
									".$namaTableDatabase."_onetimeuser = '".$auPostedElements['onetimeuser']."'
								WHERE ".$namaTableDatabase."_id = '$id' LIMIT 1
				";@ $grandQueryResult=ue_query($editQueryStr);$globalHistoryCorrespondingId=$id;break;default:$nextInLine=(int)autoIncrementNext($namaTableDatabase);$createQueryStr="INSERT INTO ".$namaTableDatabase." VALUES(
									'',
									'$currentServerTime',
									'0',
									'".$enableStat."',
									'".$auPostedElements['name']."',
									'".$auPostedElements['code']."',
									'$endpromounix',
									'".$auPostedElements['type']."',
									'".$auPostedElements['mode']."',
									'".$auPostedElements['value']."',
									'".$auPostedElements['minpurchase']."',
									'$allowPrdPromo',
									'$allowBankPromo',
									'$allowUserPromo',
									'0',
									'".$auPostedElements['maxvalue']."',
									'".$auPostedElements['onetimeuser']."'
				)";@ $grandQueryResult=ue_query($createQueryStr);$globalHistoryCorrespondingId=$nextInLine;break;}$recordHistoryDesc="
			".$historyTypeName." Name : ".$auPostedElements['name']."<br />
			".$historyTypeName." Code : ".$auPostedElements['code']."<br />
			".$historyTypeName." Value : ".$auPostedElements['value']."
		";writeGlobalHistory($historyTypeName,$detailmode,$recordHistoryDesc,$namaTableDatabase,$globalHistoryCorrespondingId,$ue_globvar_recordglobalhistory,$recordHistory);switch($detailmode){case 'edit':if($grandQueryResult==false){header("Location: $namaPageUtama".$pageparam."&err=Invalid ID");}else{header("Location: $namaPageUtama".$pageparam."&sta=ok");}break;default:if($grandQueryResult==false){header("Location: $namaPageUtama".$pageparam."&err=Unable To Insert New Entry");}else{header("Location: $namaPageUtama".$pageparam."&sta=ok");}break;}}else{foreach($errorList as $errorListKey=>$errorListVal){$errorListStr.=$errorListVal.'<br />';}header("Location: $namaHalamanEdit".$pageparam."&err=".$errorListStr);}?>