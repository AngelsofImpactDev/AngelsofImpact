<?php
	session_start();
	include('../ue-config/ue-globalconfig.php');
	include('../ue-config/ue-globalconnect.php');
	include('../ue-config/ue-globalfunction.php');
	include('ue-includes/ue-globVarAdm.php');
	include('ue-includes/ue-globFuncAdm.php');
	
	//USER ACCESS CHECK START
	if($_SESSION['currentUserIdAdm'] == '' || $_SESSION['currentUserLvl'] == '') {
		if(currentPage() != 'action-index.php') {
			header("Location: index.php");
			exit();
		}
	}
	else if($_SESSION['currentUserIdAdm'] != '' && $_SESSION['currentUserLvl'] != '') {
		$globalCurrentLoggedUserDataQue = ue_query("SELECT * FROM adminuserlogin
						INNER JOIN adminuserlevel ON adminuserlogin.adminuserlevel_id = adminuserlevel.adminuserlevel_id
						WHERE adminuserlogin_id = '".$_SESSION['currentUserIdAdm']."'
		LIMIT 1");
		$globalCurrentLoggedUserDataRes = ue_fetch_array($globalCurrentLoggedUserDataQue);
		
		//Check Access Allow Table
		$currentCheckAccessPage = currentPage();
		$currentCheckAccessQue = ue_query("SELECT * FROM adminsitepages WHERE adminsitepages_url = '$currentCheckAccessPage' LIMIT 1");
		if(@ue_num_rows($currentCheckAccessQue) > 0) {
			$currentCheckAccessRes = ue_fetch_array($currentCheckAccessQue);
			$currentAdminUserAccessQue = ue_query("SELECT * FROM adminuseraccess WHERE adminuserlevel_id = '".$_SESSION['currentUserLvl']."' AND adminsitepages_id = '".$currentCheckAccessRes['adminsitepages_id']."' LIMIT 1");
			@$currentAdminUserAccessRes = ue_fetch_array($currentAdminUserAccessQue);
			if($currentAdminUserAccessRes['adminuseraccess_enabled'] != 'e') {
				header("Location: panel.php?err=Insufficient Access Requirement");
				exit();
			}
		}
		else {
			header("Location: panel.php?err=Insufficient Access Requirement");
			exit();
		}
	}
	//USER ACCESS CHECK END
	
	$pageParamsArr = array(
		'page',
		'mode',
		'search',
		'id',
		'orderwhat',
		'orderby',
		'swapperSelf'
	);
?>