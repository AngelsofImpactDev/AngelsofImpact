<?php
	session_start();
	include('ue-config/ue-globalconfig.php');
	include('ue-config/ue-globalconnect.php');
	include('ue-config/ue-globalfunction.php');
	
	$namaTableDatabase		= 'transaction';
	$namaTableDatabaseId	= $namaTableDatabase.'_id';
	$currentServerTime		= time();
	$detailmode 			= 'create';
	//Get All Posted Vars
	$auPostedElements = array();
	$auCookiesAllow = array(
		'gift'
	);
	
	foreach($_POST as $postedElementsKey => $postedElementsVal) {
		$auPostedElements["$postedElementsKey"] = ueReceiveInput($postedElementsKey,$postedElementsVal,false);
		if(in_array($postedElementsKey,$auCookiesAllow)) {
			setcookie($postedElementsKey,$postedElementsVal,time()+5);
		}
		else if($postedElementsKey == $auPostedElements['province']){
			setcookie('shipping_id',$postedElementsVal,time()+5);
		}
	}
	
	//Init Vars
	$id						= $auPostedElements['id'];
	$namaPageUtama			= "fundenterprises.php";
	$namaHalamanEdit		= "seprofile.php";
	$errorList				= array();
	$errorListStr			= '';
	$pageparam				= '?';
	$nextInLine 			= (int)autoIncrementNext($namaTableDatabase);
	
	//Required Fields Name
	
	$requireFieldsNameArr	= array(
		
	);
	
	//Action START
	foreach($requireFieldsNameArr as $requireFieldsNameArrKey => $requireFieldsNameArrVal) {
		if($auPostedElements["$requireFieldsNameArrVal"] == '') {
			header("Location: $namaHalamanEdit".$pageparam."&err=Please Fill All Fields");
			exit();
		}
	}
	
	//Pattern Check START
	
	//Pattern Check END
	
	if(count($errorList) == 0) {
		switch($detailmode) {
			case 'edit':
				/*kosong*/
			break;
			default:
				$sessionData 	= json_decode($_SESSION['fundingSession'],true);
				$cekData		= ue_fetch_array(ue_query("SELECT * FROM startup WHERE startup_id = '".$sessionData['startupId']."' LIMIT 1"));
				$createQueryStr	= "INSERT INTO ".$namaTableDatabase." VALUES(
									'',
									'$currentServerTime',
									'0',
									'".$_SESSION['currentUserId']."',
									'".$sessionData['startupId']."',
									'".$auPostedElements['gift']."',
									'".$sessionData['fundingAmount']."',
									'unpaid',
									'0',
									'0'
								)";
				//echo $createQueryStr;die();
				@ $grandQueryResult = ue_query($createQueryStr);
				
				if($grandQueryResult == true) {
					$nl = '<br />';
					/*
					$totalInsert 	= round($sessionData['fundingAmount'] / $cekData['startup_repaymentperiod'],2);
					$repayDue		= $cekData['startup_repaymentstart'];
					for($a=0;$a<$cekData['startup_repaymentperiod'];$a++){
						$detailQueryStr	= "INSERT INTO transactiondetail VALUES(
											'',
											'$currentServerTime',
											'0',
											'".$totalInsert."',
											'unpaid',
											'0',
											'".$repayDue."',
											'".$nextInLine."'
										)";
						$detailQueryRes = ue_query($detailQueryStr);
						$realDate = date("Y-m-d",$repayDue);
						$repayDue = strtotime(date("Y-m-d",strtotime($realDate."+ 1 Month")));
					}
					*/
					// Send mail to angel
					$getData			= ue_fetch_array(ue_query("SELECT * FROM user WHERE user_id = '".$_SESSION['currentUserId']."' LIMIT 1"));
					$admtargetMail 		= $getData['user_email'];
					$purchaseMailTitle 	= 'Angel Pledge Funding Received!';
					$mesDate 			= date("F j, Y, g:ia");
					$messageQuery 		= "Dearest ".$getData['user_name'].",$nl $nl
											We have received your funding pledge of $ ".$sessionData['fundingAmount']." to ".$cekData['startup_name']." social enterprise. $nl 
											$nl
											<a href=\"".$globvar_address."/login\">[Click here]</a> login to your account to see the other Angel funders who are supporting the social enterprise you have supported. $nl
											$nl
											With gratitude, $nl
											Audrey & Laina";
					sendMail($admtargetMail,$globvar_sitecontacts['email4'],$purchaseMailTitle,$messageQuery);
					$sqlInsert = "INSERT INTO inbox VALUES ('',
															'".time()."',
															'0',
															'".$_SESSION['currentUserId']."',
															'".$cekData["startup_id"]."',
															'".$purchaseMailTitle."',
															'".$messageQuery."'
															)";
					ue_query($sqlInsert);
					// Send mail to angel
					
					// Send mail to admin n SE
					$getUserStartup 	= ue_fetch_array(ue_query("SELECT * FROM user WHERE user_id = '".$cekData['user_id']."' LIMIT 1"));
					$admtargetMail 		= $getUserStartup['user_email'];
					$bccTargetMail		= $globvar_sitecontacts['email1'];
					$purchaseMailTitle 	= 'You have received a funding pledge from an Angel Funder!';
					$mesDate 			= date("F j, Y, g:ia");
					$messageQuery 		= "Dearest ".$getUserStartup['user_name'].", $nl $nl
											We have received a funding pledge of $ ".$sessionData['fundingAmount']." for your funds request by ".$getData['user_name'].". $nl 
											$nl
											<a href=\"".$globvar_address."/login\">[Click here]</a> login to your account and track the progress of your funding needs. $nl
											$nl
											With gratitude, $nl
											Audrey & Laina";
					sendMail($admtargetMail,$globvar_sitecontacts['email4'],$purchaseMailTitle,$messageQuery,$bccTargetMail);
					$sqlInsert = "INSERT INTO inbox VALUES ('',
															'".time()."',
															'0',
															'".$cekData['user_id']."',
															'".$cekData['startup_id']."',
															'".$purchaseMailTitle."',
															'".$messageQuery."'
															)";
					ue_query($sqlInsert);
					// Send mail to admin n SE
				}
			break;
		}
		
		//REDIRECTIONS
		switch($detailmode) {
			case 'edit':
				if($grandQueryResult == false) {
					header("Location: $namaHalamanEdit".$pageparam."&err=Invalid ID");
				}
				else {
					header("Location: $namaHalamanEdit".$pageparam."&sta=Information Have Been Updated");
				}
			break;
			default:
				if($grandQueryResult == false) {
					header("Location: $namaHalamanEdit".$pageparam."&err=Unable To Insert New Entry");
				}
				else {
					header("Location: $namaPageUtama".$pageparam."&sta=Thank you, we are checking your payment!");
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
		header("Location: $namaHalamanEdit".$pageparam."&err=".$errorListStr);
	}
	
	@ ue_close($GLOBALS['mysql_connect_init']);
?>