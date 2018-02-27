<?php
	session_start();
	include('ue-config/ue-globalconfig.php');
	include('ue-config/ue-globalconnect.php');
	include('ue-config/ue-globalfunction.php');
	
	$namaTableDatabase		= 'startup';
	$namaTableDatabaseId	= $namaTableDatabase.'_id';
	$currentServerTime		= time();
	$detailmode 			= 'create';
	//Get All Posted Vars
	$auPostedElements = array();
	$auCookiesAllow = array(
		'name',
		'desc',
		'longdesc',
		'fundingdeadline',
		'amount',
		'purpose',
		'impact',
		'repaymentperiod',
		'startdate'
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
	$namaPageUtama			= 'dashboard.php';
	$namaHalamanEdit		= basename($auPostedElements['frompage'],'.php');
	$errorList				= array();
	$errorListStr			= '';
	$pageparam				= '?';
	$nextInLine 			= (int)autoIncrementNext($namaTableDatabase);
	
	//Required Fields Name
	
	
	$requireFieldsNameArr	= array(
		'name',
		'desc',
		'longdesc',
		'fundingdeadline',
		'amount',
		'purpose',
		'impact',
		'repaymentperiod',
		'startdate'
	);
	
	//Action START
	foreach($requireFieldsNameArr as $requireFieldsNameArrKey => $requireFieldsNameArrVal) {
		if($auPostedElements["$requireFieldsNameArrVal"] == '') {
			header("Location: $namaHalamanEdit".$pageparam."&err=Please Fill All Fields");
			exit();
		}
	}
	
	//Pattern Check START
	if(strlen($auPostedElements["desc"])>250) {
		$errorList[] = 'Brief desc too long';
	}
	
	if(!isset($auPostedElements['allCheck'])){
		$errorList[] = 'Please tick the agreement box';
	}
	
	if(!is_numeric($auPostedElements['amount'])){
		$errorList[] = 'Invalid amount';
	}
	
	if(trim($auPostedElements['youtube'])!=""){
		$yutub = preg_match("/^(http\:\/\/)?(www\.)?(youtube\.com|youtu\.be)\/watch\?v\=\w+$/", $auPostedElements['youtube']);
		if(!$yutub) {
			$errorList[] = 'Invalid Youtube link';
		}
	}
	
	
	//Pattern Check END
	
	if(count($errorList) == 0) {
		switch($detailmode) {
			case 'edit':
				/*kosong*/
			break;
			default:
				$profileFolderLocation	= 'upload/startupLogo';
				$profileMaxWidth		= 200;
				$profileMaxHeight		= 200;
				
				$coverFolderLocation	= 'upload/startupCover';
				$coverMaxWidth			= 400;
				$coverMaxHeight			= 200;
				
				$campaignFolderLocation = 'upload/startupCampaign';
				$campaignMaxWidth		= 2000;
				$campaignMaxHeight		= 2000;
				
				if($_FILES['campaign1']['name']){
					$imageCampaignName 		= $nextInLine.md5($nextInLine)."1";
					$imageCampaignResult1 	= imageUploader($_FILES['campaign1'],'',$campaignFolderLocation,$imageCampaignName,$campaignMaxWidth,$campaignMaxHeight);
				}
				
				if($_FILES['campaign2']['name']){
					$imageCampaignName 		= $nextInLine.md5($nextInLine)."2";
					$imageCampaignResult2	= imageUploader($_FILES['campaign2'],'',$campaignFolderLocation,$imageCampaignName,$campaignMaxWidth,$campaignMaxHeight);
				}
				
				if($_FILES['campaign3']['name']){
					$imageCampaignName 		= $nextInLine.md5($nextInLine)."3";
					$imageCampaignResult3 	= imageUploader($_FILES['campaign3'],'',$campaignFolderLocation,$imageCampaignName,$campaignMaxWidth,$campaignMaxHeight);
				}
				
				if($_FILES['logo']['name']){
					$logoName 		= $nextInLine.md5($nextInLine);
					$logoResult 	= imageUploader($_FILES['logo'],'',$profileFolderLocation,$logoName,$profileMaxWidth,$profileMaxHeight);
				}
				
				if($_FILES['cover']['name']){
					$coverName 		= $nextInLine.md5($nextInLine);
					$coverResult 	= imageUploader($_FILES['cover'],'',$coverFolderLocation,$coverName,$coverMaxWidth,$coverMaxHeight);
				}
				
				if($_FILES['pdfgift']['name']){
					$target_dir 	= "upload/startupGift/";
					$target_file 	= $target_dir . basename($_FILES["pdfgift"]["name"]);
					$uploadOk 		= 1;
					$fileType 		= pathinfo($target_file,PATHINFO_EXTENSION);
					if ($_FILES["pdfgift"]["size"] > 10000000) {
						$uploadOk = 0;
						$errorMsg = "File size too big";
					}
					// Allow certain file formats
					if($fileType != "pdf") {
						$uploadOk = 0;
						$errorMsg = "File must be pdf only";
					}
					
					if ($uploadOk == 0) {
						header("Location: $namaHalamanEdit".$pageparam."&err=".$errorMsg);
					} else {
						if (move_uploaded_file($_FILES["pdfgift"]["tmp_name"], $target_file)) {
							$fileName = $_FILES['pdfgift']['name'];
						} else {
							header("Location: $namaHalamanEdit".$pageparam."&err=Something is wrong, please try again");
						}
					}
				}

				if($_FILES['financial']['name']){
					$target_dir_finance 	= "upload/startupFinancial/";
					$target_file_finance 	= $target_dir_finance . basename($_FILES["financial"]["name"]);
					$uploadOk_finance 		= 1;
					$fileType_finance 		= pathinfo($target_file_finance,PATHINFO_EXTENSION);
					$allowedFile	= array("pdf","xls","xlsx","ppt","xlsm","pptx","pptm","ppsx");
					if ($_FILES["financial"]["size"] > 10000000) {
						$uploadOk_finance 	= 0;
						$errorMsg_finance 	= "File size too big";
					}
					// Allow certain file formats
					if(!in_array(strtolower($fileType_finance),$allowedFile)) {
						$uploadOk_finance 	= 0;
						$errorMsg_finance 	= "File must be pdf, excel or powerpoint only";
					}
					
					if ($uploadOk_finance == 0) {
						header("Location: $namaHalamanEdit".$pageparam."&err=".$errorMsg_finance);
					} else {
						if (move_uploaded_file($_FILES["financial"]["tmp_name"], $target_file_finance)) {
							$fileNameReport = $_FILES['financial']['name'];
						} else {
							header("Location: $namaHalamanEdit".$pageparam."&err=Something is wrong, please try again");
						}
					}
				}
				
				$createQueryStr	= "INSERT INTO ".$namaTableDatabase." VALUES(
									'',
									'$nextInLine',
									'$currentServerTime',
									'0',
									'd',
									'".$_SESSION['currentUserId']."',
									'".$auPostedElements['name']."',
									'".$auPostedElements['desc']."',
									'".$auPostedElements['longdesc']."',
									'".$auPostedElements['amount']."',
									'".strtotime($auPostedElements['fundingdeadline'])."',
									'".$logoResult."',
									'".$imageCampaignResult1."',
									'".$imageCampaignResult2."',
									'".$imageCampaignResult3."',
									'".$auPostedElements['youtube']."',
									'".$fileName."',
									'".$fileNameReport."',
									'".$coverResult."',
									'".$auPostedElements['purpose']."',
									'".$auPostedElements['impact']."',
									'".$auPostedElements['repaymentperiod']."',
									'".strtotime($auPostedElements['startdate'])."',
									'd'
								)";
				//echo $createQueryStr;die();
			@ $grandQueryResult = ue_query($createQueryStr);
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
					//send mail to admin
					$nl = '<br />';
					$getData		= ue_fetch_array(ue_query("SELECT * FROM user WHERE user_id = '".$_SESSION['currentUserId']."' LIMIT 1"));
					$admtargetMail 	= $globvar_sitecontacts['email1'];
					$bccTargetMail	= $getData['user_email'];
					$purchaseMailTitle 	= 'We have received a Funding Request! ';
					$mesDate 		= date("F j, Y, g:ia");
					$messageQuery 	= "Dearest ".$getData['user_name'].",
										We have received your funding request and we have shared it with the Angel funders in the $nl 
										Angels of Impact network. We ask for your patience and will be in touch with you on how we $nl 
										can support your funding needs. $nl
										$nl
										<a href=\"".$globvar_address."/login\">[Click here]</a> login to your account to see the progress of your funding requests. $nl
										$nl
										With gratitude, $nl
										Audrey & Laina";
					
					sendMail($admtargetMail,$globvar_sitecontacts['email4'],$purchaseMailTitle,$messageQuery,$bccTargetMail.",".$globvar_sitecontacts['email0']);
					
					$qInbox = ue_query("INSERT INTO inbox VALUES ('',
																'$currentServerTime',
																'0',
																'".$_SESSION['currentUserId']."',
																'".$nextInLine."',
																'".$purchaseMailTitle."',
																'".$messageQuery."'
																)"
															);
					//send mail to startup
					header("Location: $namaPageUtama".$pageparam."&sta=Seek funding submit data success!");
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