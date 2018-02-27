<?php
	include('ue-includes/ue-ses_check.php');
	
	$namaTableDatabase		= 'transaction';
	$namaTableDatabaseId	= $namaTableDatabase.'_id';
	$currentServerTime		= time();
	
	//History Related
	$recordHistory			= true;
	$historyTypeName		= 'Transaction';
	
	//Get All Posted Vars
	$auPostedElements = array();
	foreach($_POST as $postedElementsKey => $postedElementsVal) {
		$auPostedElements["$postedElementsKey"] = ueReceiveInput($postedElementsKey,$postedElementsVal,false);
	}
	
	//Init Vars
	$id						= $auPostedElements['id'];
	$detailmode				= $auPostedElements['detailmode'];
	$namaPageUtama			= $auPostedElements['mainpage'];
	$namaHalamanEdit		= $auPostedElements['frompage'];
	$pageparam				= $auPostedElements['pageparam'].'&detailmode='.$detailmode;
	$errorList				= array();
	$errorListStr			= '';
	
	//Required Fields Name
	$requireFieldsNameArr	= array(
		'amount'
	);
	
	//Action START
	foreach($requireFieldsNameArr as $requireFieldsNameArrKey => $requireFieldsNameArrVal) {
		if($auPostedElements["$requireFieldsNameArrVal"] == '') {
			header("Location: $namaHalamanEdit".$pageparam."&err=Please Fill All Fields");
			exit();
		}
	}
	
	//Pattern Check START
	if(!is_numeric($auPostedElements['amount'])) {
		$errorList[] = 'Amount must be number without formatting';
	}
	//Pattern Check END
	
	if(count($errorList) == 0) {
		switch($detailmode) {
			case 'edit':
				$editQueryStr	= "UPDATE ".$namaTableDatabase." SET
									".$namaTableDatabase."_editdate = '$currentServerTime',
									".$namaTableDatabase."_confirmdate = '$currentServerTime',
									".$namaTableDatabase."_amount = '".$auPostedElements['amount']."',
									".$namaTableDatabase."_gift = '".$auPostedElements['gift']."',
									".$namaTableDatabase."_status = '".strtolower($auPostedElements['status'])."'
								WHERE ".$namaTableDatabase."_id = '$id' LIMIT 1
				";
				//echo $editQueryStr;die();
				@ $grandQueryResult = ue_query($editQueryStr);
				$globalHistoryCorrespondingId = $id;
			break;
		}
		
		//Record History START
		/*
		$recordHistoryDesc = "
			".$historyTypeName." Name : ".$auPostedElements['name']."
		";
		writeGlobalHistory($historyTypeName,$detailmode,$recordHistoryDesc,$namaTableDatabase,$globalHistoryCorrespondingId,$ue_globvar_recordglobalhistory,$recordHistory);
		*/
		//Record History END
		
		//REDIRECTIONS
		switch($detailmode) {
			case 'edit':
				if($grandQueryResult == false) {
					header("Location: $namaPageUtama".$pageparam."&err=Invalid ID");
				}
				else {
					$sql= "SELECT a.*, b.user_name as investorName, b.user_email as investorEmail, c.startup_name, c.startup_repaymentperiod, c.startup_repaymentstart, d.user_id as seId, d.user_name as seName, d.user_email as seEmail FROM ".$namaTableDatabase." a 
											LEFT JOIN user b ON a.user_id = b.user_id 
											LEFT JOIN startup c ON a.startup_id = c.startup_id
											LEFT JOIN user d ON c.user_id = d.user_id
											WHERE a.".$namaTableDatabase."_id = '".$id."' LIMIT 1";
					$rs = ue_fetch_array(ue_query($sql));
					
					if(strtolower($auPostedElements['status']) == 'unpaid'){
						ue_query("DELETE FROM transactiondetail WHERE transaction_id = '$id'");
					}
					
					$cekId = ue_num_rows(ue_query("SELECT * FROM transactiondetail WHERE transaction_id = '".$id."'"));
					if($cekId<=0 and strtolower($auPostedElements['status']) == 'paid'){
						$totalInsert 	= round($auPostedElements['amount'] / $rs['startup_repaymentperiod'],2);
						$repayDue		= $rs['startup_repaymentstart'];
						for($a=0;$a<$rs['startup_repaymentperiod'];$a++){
							$detailQueryStr	= "INSERT INTO transactiondetail VALUES(
												'',
												'$currentServerTime',
												'0',
												'".$totalInsert."',
												'unpaid',
												'0',
												'".$repayDue."',
												'".$id."'
											)";
							$detailQueryRes = ue_query($detailQueryStr);
							$realDate = date("Y-m-d",$repayDue);
							$repayDue = strtotime(date("Y-m-d",strtotime($realDate."+ 1 Month")));
						}
						
						$nl = '<br />';
						//Mail send to Angel start
						$purchaseMailTitle 	= "Enabling Impact through the flow of money";
						$admtargetMail 		= $rs['investorEmail'];
						$messageQuery 		= "Dearest ".$rs['investorName'].", $nl $nl
												Thank you for your pledge, it has enabled the social enterprise to meet their funding needs! $nl 
												$nl
												<a href=\"".$globvar_address."/login\">[Click here]</a> login to your account. $nl
												$nl
												With gratitude, $nl
												Audrey & Laina";
						sendMail($admtargetMail,'notif@angelofimpact.com',$purchaseMailTitle,$messageQuery);
						$sqlInsert = "INSERT INTO inbox VALUES ('',
																'".time()."',
																'0',
																'".$rs['user_id']."',
																'".$rs["startup_id"]."',
																'".$purchaseMailTitle."',
																'".$messageQuery."'
																)";
						ue_query($sqlInsert);
						//Mail send to Angel end
						
						//Mail send to SE start
						$purchaseMailTitle 	= "Flow of funds confirmed";
						$admtargetMail 		= $rs['seEmail'];
						$messageQuery 		= "Dearest ".$rs['seName'].", $nl $nl
												Congrats on receiving the monies for your funding needs! $nl 
												The monies will be disbursed to your account in due course and $nl 
												instructions will be further sent for you to send your bank account details.$nl 
												$nl
												<a href=\"".$globvar_address."/login\">[Click here]</a> login to your account. $nl
												$nl
												With gratitude, $nl
												Audrey & Laina";
						sendMail($admtargetMail,'notif@angelofimpact.com',$purchaseMailTitle,$messageQuery);
						$sqlInsert = "INSERT INTO inbox VALUES ('',
																'".time()."',
																'0',
																'".$rs['seId']."',
																'".$rs['startup_id']."',
																'".$purchaseMailTitle."',
																'".$messageQuery."'
																)";
						ue_query($sqlInsert);
					}
					//Mail send to SE end
					//echo $messageQuery;die();
					header("Location: $namaPageUtama".$pageparam."&id=".$rs['startup_id']."&sta=ok");
				}
			break;
			default:
				if($grandQueryResult == false) {
					header("Location: $namaPageUtama".$pageparam."&id=".$rs['startup_id']."&err=Unable To Insert New Entry");
				}
				else {
					header("Location: $namaPageUtama".$pageparam."&id=".$rs['startup_id']."&sta=ok");
				}
			break;
		}
		//REDIRECTIONS END
	}
	else {
		//Format Error List
		foreach($errorList as $errorListKey => $errorListVal) {
			$errorListStr .= $errorListVal.'<br />';
		}
		header("Location: $namaHalamanEdit".$pageparam."&id=".$rs['startup_id']."&err=".$errorListStr);
	}
?>