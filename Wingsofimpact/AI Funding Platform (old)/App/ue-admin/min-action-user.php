<?php include('ue-includes/ue-ses_check.php');$namaTableDatabase='user';$namaTableDatabaseId=$namaTableDatabase.'_id';$currentServerTime=time();$recordHistory=true;$historyTypeName='User';$auPostedElements=array();foreach($_POST as $postedElementsKey=>$postedElementsVal){$auPostedElements["$postedElementsKey"]=ueReceiveInput($postedElementsKey,$postedElementsVal,false);}$id=$auPostedElements['id'];$detailmode=$auPostedElements['detailmode'];$namaPageUtama=$auPostedElements['mainpage'];$namaHalamanEdit=$auPostedElements['frompage'];$pageparam=$auPostedElements['pageparam'].'&detailmode='.$detailmode.'&id='.$id;$errorList=array();$errorListStr='';$requireFieldsNameArr=array('name','email','password','address','telp','gender','postal');foreach($requireFieldsNameArr as $requireFieldsNameArrKey=>$requireFieldsNameArrVal){if($auPostedElements["$requireFieldsNameArrVal"]==''){header("Location: $namaHalamanEdit".$pageparam."&err=Please Fill All Fields");exit();}}if($auPostedElements['province']==''){$errorList[]='Please select a province';}else{$currentShipId=$auPostedElements[$auPostedElements['province']];}if($ue_globvar_remember_me_toggle==true){$rememberMeString=$auPostedElements['rememberMe'];}else{$rememberMeString='';}if(count($errorList)==0){switch($detailmode){case 'edit':$currentDob=strtotime($auPostedElements['enddate'].' '.$auPostedElements['endmon'].' '.$auPostedElements['endyear'].'00:00');$editDetailQue=ue_query("SELECT * FROM ".$namaTableDatabase." WHERE ".$namaTableDatabase."_id = '".$id."' LIMIT 1");@ $editDetailRes=ue_fetch_array($editDetailQue);$creditSta='';if($editDetailRes["$namaTableDatabase".'_credit']<$auPostedElements['credit']){$creditSta='CR';$creditEntry=$currentServerTime;$creditUsrId=$id;$creditAdmId=$_SESSION['currentUserIdAdm'];$creditMutasi=(int)$auPostedElements['credit'] -(int)$editDetailRes["$namaTableDatabase".'_credit'];$creditBefore=$editDetailRes["$namaTableDatabase".'_credit'];$creditDesc='Added by Admin '.moneyFormat($creditMutasi,$ue_globvar_currency);ue_query("INSERT INTO usercredithistory VALUES(
						'',
						'$creditEntry',
						'$creditUsrId',
						'$creditAdmId',
						'$creditMutasi',
						'$creditBefore',
						'$creditSta',
						'$creditDesc'
					)");}else if($editDetailRes["$namaTableDatabase".'_credit']>$auPostedElements['credit']){$creditSta='DB';$creditEntry=$currentServerTime;$creditUsrId=$id;$creditAdmId=$_SESSION['currentUserIdAdm'];$creditMutasi=(int)$editDetailRes["$namaTableDatabase".'_credit'] -(int)$auPostedElements['credit'];$creditBefore=$editDetailRes["$namaTableDatabase".'_credit'];$creditDesc='Substracted by Admin '.moneyFormat($creditMutasi,$ue_globvar_currency);ue_query("INSERT INTO usercredithistory VALUES(
						'',
						'$creditEntry',
						'$creditUsrId',
						'$creditAdmId',
						'$creditMutasi',
						'$creditBefore',
						'$creditSta',
						'$creditDesc'
					)");}$editQueryStr="UPDATE ".$namaTableDatabase." SET
									".$namaTableDatabase."_editdate = '$currentServerTime',
									shipping_id = '$currentShipId',
									".$namaTableDatabase."_email = '".$auPostedElements['email']."',
									".$namaTableDatabase."_name = '".$auPostedElements['name']."',
									".$namaTableDatabase."_password = '".$auPostedElements['password']."',
									".$namaTableDatabase."_address = '".$auPostedElements['address']."',
									".$namaTableDatabase."_telp = '".$auPostedElements['telp']."',
									".$namaTableDatabase."_gender = '".$auPostedElements['gender']."',
									".$namaTableDatabase."_dob = '".$currentDob."',
									".$namaTableDatabase."_postal = '".$auPostedElements['postal']."',
									".$namaTableDatabase."_credit = '".$auPostedElements['credit']."',
									".$namaTableDatabase."_rememberkey = '".$auPostedElements['rememberMe']."'
								WHERE ".$namaTableDatabase."_id = '$id' LIMIT 1
				";@ $grandQueryResult=ue_query($editQueryStr);$globalHistoryCorrespondingId=$id;break;}$recordHistoryDesc="
			".$historyTypeName." Name : ".$auPostedElements['name']."
		";writeGlobalHistory($historyTypeName,$detailmode,$recordHistoryDesc,$namaTableDatabase,$globalHistoryCorrespondingId,$ue_globvar_recordglobalhistory,$recordHistory);switch($detailmode){case 'edit':if($grandQueryResult==false){header("Location: $namaPageUtama".$pageparam."&err=Invalid ID");}else{header("Location: $namaPageUtama".$pageparam."&sta=ok");}break;default:if($grandQueryResult==false){header("Location: $namaPageUtama".$pageparam."&err=Unable To Insert New Entry");}else{header("Location: $namaPageUtama".$pageparam."&sta=ok");}break;}}else{foreach($errorList as $errorListKey=>$errorListVal){$errorListStr.=$errorListVal.'<br />';}header("Location: $namaHalamanEdit".$pageparam."&err=".$errorListStr);}?>