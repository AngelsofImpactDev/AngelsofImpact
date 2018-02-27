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
	foreach($_GET as $postedElementsKey => $postedElementsVal) {
		$auPostedElements["$postedElementsKey"] = ueReceiveInput($postedElementsKey,$postedElementsVal);
	}
	
	//Init Vars
	$id						= $auPostedElements['id'];
	$namaPageUtama			= 'index.php';
	$namaHalamanEdit		= 'index.php';
	$errorList				= array();
	$errorListStr			= '';
	$pageparam				= '?';
	
	//Required Fields Name
	$requireFieldsNameArr	= array(
		'rpk'
	);
	
	//Action START
	foreach($requireFieldsNameArr as $requireFieldsNameArrKey => $requireFieldsNameArrVal) {
		if($auPostedElements["$requireFieldsNameArrVal"] == '') {
			header("Location: $namaHalamanEdit".$pageparam."&err=Invalid Link OR Expired");
			exit();
		}
	}
	
	//Pattern Check START
		//decode
		$forgotFlag = false;
		$checkInputStr = $auPostedElements['rpk'];
		$checkForgotAdm = md5($globvar_adminidsite);
		if(strpos($checkInputStr,$checkForgotAdm) >= 0) {
			$checkForgotAdmArr = explode($checkForgotAdm,$checkInputStr);
			$currentUsrId = (int)supermegahyperunbelieveablyawesomeencrypter($checkForgotAdmArr['0'],'dec');
			
			//Check User Exist
			$currentUsrExistQue = ue_query("SELECT * FROM $namaTableDatabase WHERE ".$namaTableDatabase."_id = '$currentUsrId' AND ".$namaTableDatabase."_enabled = 'e' LIMIT 1");
			@ $currentUsrExistNum = (int)ue_num_rows($currentUsrExistQue);
			if($currentUsrExistNum == 1) {
				$currentUsrExistRes = ue_fetch_array($currentUsrExistQue);
				if(strpos($checkForgotAdmArr['1'],md5($currentUsrExistRes["$namaTableDatabase".'_password'])) >= 0) {
					$expirydate = str_replace(md5($currentUsrExistRes["$namaTableDatabase".'_password']),'',$checkForgotAdmArr['1']);
					$expirydate = (int)ueEncrypt($expirydate,'dec');
					$forgotFlag = true;
				}
			}
		}
		
		if(!$forgotFlag) {
			$errorList[] = 'Invalid Link OR Expired';
		}
	//Pattern Check END
	
	if(count($errorList) == 0) {
		switch($detailmode) {
			case 'edit':
				/* NaN */
			break;
			default:
				if($forgotFlag == true) {
					$resetPasswordStr = '';
					$numCharInForgot = 7;
					$curPasMd = md5($currentUsrExistRes["$namaTableDatabase".'_password']);
					$curPasMdNum = ((int)strlen($curPasMd)-1);
					for($i=0;$i<$numCharInForgot;$i++) {
						$resetPasRandNum = (int)rand(0,$curPasMdNum);
						$resetPasswordStr .= $curPasMd["$resetPasRandNum"];
					}
					
					ue_query("UPDATE $namaTableDatabase SET ".$namaTableDatabase."_password = '".md5($resetPasswordStr)."' WHERE ".$namaTableDatabase."_id = '".$currentUsrExistRes["$namaTableDatabase".'_id']."' LIMIT 1");
					
					// temp var, delete on live
					//$globvar_address 					= "103.53.197.234/~geraikom/aoi/";
					//$ue_globvar_purchase_emails_logo 	= $globvar_address."images/angelsOfImpactLogo.png";
					// temp var, delete on live
					
					//Send Forgot Password Mail
					$targetMail = $currentUsrExistRes["$namaTableDatabase".'_email'];
					$messageIp = ueGetClientIp();
					$mesDate = date("F j, Y, g:ia");
					$nl = "<br/>";
					$mesTitle = 'New Password for your '.ucfirst($globvar_address).' account - '.$mesDate;
					$messageQuery = "<div style='border-bottom: 1px solid #3a3a3c; padding-bottom: 10px; margin-bottom: 20px; text-align: center;'>
<a href='".$globvar_address."'><img src='".$ue_globvar_purchase_emails_logo."' alt='".$globvar_sitename."' title='".$globvar_sitename."' /></a>
</div>
Dear ".ucfirst($currentUsrExistRes["$namaTableDatabase".'_name']).",$nl
$nl
Following your forgot password request,$nl
We have resetted your password, your new password is below.$nl
$nl
<strong>$resetPasswordStr</strong>$nl
$nl
Please proceed and login as usual on our site.$nl
After logging in as usual, you can then choose a new password by going to your \"<b>Setting</b>\".$nl
If you have any questions, please don't hesitate to contact us.$nl
$nl
Thank You$nl
$nl
".ucfirst($globvar_address);

						sendMail($targetMail,$globvar_sitecontacts['email1'],$mesTitle,$messageQuery);
				}
			break;
		}
		
		//REDIRECTIONS
		switch($detailmode) {
			case 'edit':
				/* NaN */
			break;
			default:
				header("Location: $namaPageUtama".$pageparam."&sta=We have sent the new password to your e-mail,<br />Please check your Inbox / Spam folder");
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