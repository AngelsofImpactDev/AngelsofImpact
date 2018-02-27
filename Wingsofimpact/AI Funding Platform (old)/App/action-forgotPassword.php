<?php
	session_start();
	include('ue-config/ue-globalconfig.php');
	include('ue-config/ue-globalconnect.php');
	include('ue-config/ue-globalfunction.php');
	
	$namaTableDatabase		= 'user';
	$namaTableDatabaseId	= $namaTableDatabase.'_id';
	$currentServerTime		= time();
	
	//Get All Posted Vars
	$auPostedElements = array();
	foreach($_POST as $postedElementsKey => $postedElementsVal) {
		$auPostedElements["$postedElementsKey"] = ueReceiveInput($postedElementsKey,$postedElementsVal);
	}
	
	//Init Vars
	$id						= $auPostedElements['id'];
	$namaPageUtama			= 'forgotPassword.php';
	$namaHalamanEdit		= 'forgotPassword.php';
	$errorList				= array();
	$errorListStr			= '';
	$pageparam				= '?';
	
	//Required Fields Name
	$requireFieldsNameArr	= array(
		'email'
	);
	
	//Action START
	foreach($requireFieldsNameArr as $requireFieldsNameArrKey => $requireFieldsNameArrVal) {
		if($auPostedElements["$requireFieldsNameArrVal"] == '') {
			header("Location: $namaHalamanEdit".$pageparam."&err=Please Fill All Fields");
			exit();
		}
	}
	
	//Pattern Check START
	/*
	if(!ueCheckCaptcha($auPostedElements['uecaptcha'])) {
		$errorList[] = 'Wrong Captcha';
	}
	*/
	if(!preg_match("/^[a-zA-Z0-9._-]{2,}[@][a-zA-Z0-9_-]{2,}[.][a-zA-Z]{2,5}([.][a-zA-Z]{2,5})?$/",$auPostedElements['email'])) {
		$errorList[] = 'Invalid E-mail';
	} else {
		$createQueryStr	= "SELECT * FROM $namaTableDatabase WHERE
			".$namaTableDatabase."_email = '".$auPostedElements['email']."' AND
			".$namaTableDatabase."_enabled = 'e'
		LIMIT 1
		";
		
		$forgotQue = ue_query($createQueryStr);
		@ $forgotNum = (int)ue_num_rows($forgotQue);
		if($forgotNum <= 0) {
			$errorList[] = 'Invalid E-mail';
		}
	}
	//Pattern Check END
	
	if(count($errorList) == 0) {
		switch($detailmode) {
			case 'edit':
				/* NaN */
			break;
			default:
				$forgotExpiryDate = strtotime(date("Y-m-d"). ' + 1 day') + 86399;
				$forgotRes = ue_fetch_array($forgotQue);
				$forgotUrlStr = supermegahyperunbelieveablyawesomeencrypter($forgotRes["$namaTableDatabase".'_id'],'enc').md5($globvar_adminidsite).md5($forgotRes["$namaTableDatabase".'_password']).ueEncrypt($forgotExpiryDate,'enc');
				
				// temp var, delete on live
				//$globvar_address 					= "103.53.197.234/~geraikom/aoi/";
				//$ue_globvar_purchase_emails_logo 	= $globvar_address."images/angelsOfImpactLogo.png";
				// temp var, delete on live
				//Send Forgot Password Mail
				$targetMail = $forgotRes["$namaTableDatabase".'_email'];
				$messageIp = ueGetClientIp();
				$mesDate = date("F j, Y, g:ia");
				$nl = "<br/>";
				$mesTitle = 'Password Reset for your '.ucfirst($globvar_address).' account - '.$mesDate;
				$messageQuery = "<div style='border-bottom: 1px solid #3a3a3c; padding-bottom: 10px; margin-bottom: 20px; text-align: center;'>
<a href='".$globvar_address."'><img src='".$ue_globvar_purchase_emails_logo."' alt='".$globvar_sitename."' title='".$globvar_sitename."' /></a>
</div>
Dear ".ucfirst($forgotRes["$namaTableDatabase".'_name']).",$nl
$nl
Following your forgot password request,$nl
Please click the link below to reset your password,$nl
<b>If you DO NOT request a new password, please ignore this email</b>$nl
$nl
<a href=\"$globvar_address/action-resetPassword.php?rpk=$forgotUrlStr\" target=\"_blank\" title=\"CLICK HERE TO RESET YOUR PASSWORD\">CLICK HERE TO RESET PASSWORD</a>$nl
OR copy and paste this link to your browser's address bar$nl
$globvar_address/action-resetPassword.php?rpk=$forgotUrlStr $nl
$nl
We will send your new password after you proceed.$nl
If you have any questions, please don't hesitate to contact us.$nl
$nl
Thank You$nl
$nl
".ucfirst($globvar_address);
		
					//echo $messageQuery; exit();
					sendMail($targetMail,$globvar_sitecontacts['email1'],$mesTitle,$messageQuery);
			break;
		}
		
		//REDIRECTIONS
		switch($detailmode) {
			case 'edit':
				/* NaN */
			break;
			default:
				header("Location: $namaPageUtama".$pageparam."&sta=We have processed your forgot password request,<br />Please Check Your e-Mail Inbox / Spam to proceed.");
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