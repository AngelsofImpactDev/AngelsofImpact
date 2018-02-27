<?php
	if(!$globalfunctionIncluded) {
		@ session_start();
		include('ue-config/ue-globalconfig.php');
		include('ue-config/ue-globalconnect.php');
		include('ue-config/ue-globalfunction.php');
	}

	wwwFix();
	if($ue_globvar_recordrecentproduct) { ueRecentProduct($_GET['idp']); }
	if($ue_globvar_remember_me_toggle == true) {
		if(!$_SESSION['currentUserId']) {
			if($_COOKIE['ueSignKey']) {
				ueAutoLogin($_COOKIE['ueSignKey']);
			}
		}
	}
	
	$arrMenuLeft = array("dashboard.php",
						"enterprises.php",
						"angel.php",
						"fundinghistory.php",
						"accountinfo.php",
						"seprofile.php",
						"fundenterprises.php",
						"fundnow.php",
						"angel.php",
						"fundinghistory.php",
						"accountinfo.php",
						"inbox.php",
						"usersetting.php",
						"help.php",
						"seekfunding.php",
						"angelprofile.php",
						"detail-inbox.php",
						"fundinglist.php",
						"accountedit.php",
						"usersettingedit.php",
						"upgradepage.php",
						"terms.php",
						"companyedit.php"
					);
	if(in_array(currentPage(),$arrMenuLeft)){
		if(!$_SESSION['currentUserId']){
			header("Location: index.php?err=Sorry, you must login to access the page ");
			exit();
		}
	}
	
	$redirDashboard = array("login.php","register.php","registerfunding.php","registerinvestor.php");
	if(in_array(currentPage(),$redirDashboard)){
		if($_SESSION['currentUserId']){
			header("location:dashboard.php");
			exit();
		}
	}
	
	if(currentPage() == 'fundenterprises.php' and $_SESSION['currentUserType'] != 'investors'){
		header("location:dashboard.php?err=Sorry, you are not authorized to access the page ");
		exit();
	}
	
	if(currentPage() == 'seekfunding.php'){
		$cekStartup = ue_fetch_array(ue_query("SELECT * FROM startup WHERE user_id = '".$_SESSION['currentUserId']."'"));
		if($cekStartup['user_id'] != ""){
			if($cekStartup['startup_enabled'] == 'd'){
				header("location:dashboard.php?err=Pending for approval, admin will show your funding request once we have approved it");
				exit();
			}else{
				header("location:dashboard.php?err=You already created a startup");
				exit();
			}
		}
		/*
		$cekUsermember = ue_fetch_array(ue_query("SELECT * FROM user WHERE user_id = '".$_SESSION['currentUserId']."' LIMIT 1"));
		if($cekUsermember['user_membershipid'] == 0 || $cekUsermember['user_membershiptype']!="startup" || $cekUsermember['user_expiry'] < time()){
			header("location:dashboard.php?err=You must become premium member to seek funding from angel");
			exit();
		}
		*/
	}
	
	if(currentPage() == 'confirmcart.php') {
		$checkUrgentShipId = $_POST[$_POST['province']];
		$checkUrgentShipQue = ue_query("SELECT ".$_POST['shipType']." FROM shipping WHERE shipping_id = '$checkUrgentShipId' LIMIT 1");
		@ $checkUrgentShipRes = ue_fetch_array($checkUrgentShipQue);
		if($checkUrgentShipRes['0'] <= 0) {
			header("Location: viewcart.php?err=That Shipping Method Is Not Available Yet On That Area");
			exit();
		}
	}
	
	@ ueAnalytics();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="en, in"/>
<?php
	if(currentPage() == 'productdetail.php') {
		$seo_idp = ue_real_escape_string($_GET['idp']);
		$seo_idp_queStr = "SELECT * FROM product
		INNER JOIN producttype ON product.producttype_id = producttype.producttype_id
		INNER JOIN productbrand ON product.productbrand_id = productbrand.productbrand_id
		WHERE
			product.product_id = '$seo_idp'
	 	LIMIT 1
		";
		$seo_idp_que = ue_query($seo_idp_queStr);
		$seo_idp_res = ue_fetch_array($seo_idp_que);
?>
<title><?php echo $seo_idp_res['product_name']?> | <?php echo $globvar_title?></title>
<meta name="description" content="<?php echo nohtml(str_replace('&nbsp;',' ',ueWritePage($seo_idp_res['product_desc'],true)))?>" />
<meta name="keywords" content="<?php echo $seo_idp_res['productbrand_name']?>,<?php echo $seo_idp_res['product_tags']?>,<?php echo $seo_idp_res['producttype_name']?>,<?php echo $globvar_keywords?>" />
<meta property="og:image" content="http://<?php echo $globvar_address.'/upload/productImageThumb/'?><?php echo getImageName($seo_idp_res['product_id'])?>" />
<?php		
	}
	else {
	if(currentPage() == 'product.php') {
		if($_GET['search']) {
			$seo_idp = htmlspecialchars($_GET['search']);
			$globvar_title = 'Search Result for '.$seo_idp.' | '.$globvar_title;
		}
		else if($_GET['mode'] == 'new' || $_GET['mode'] == 'sale' || $_GET['mode'] == 'bestSeller' || $_GET['mode'] == 'mustHave' || $_GET['mode'] == 'restocked') {
			switch($_GET['mode']) {
				case 'new':
					$globvar_title = 'Featured Products | '.$globvar_title;
				break;
				case 'sale':
					$globvar_title = 'Sale Items | '.$globvar_title;
				break;
				case 'bestSeller':
					$globvar_title = 'Best Seller | '.$globvar_title;
				break;
				case 'mustHave':
					$globvar_title = 'Must Have | '.$globvar_title;
				break;
				case 'restocked':
					$globvar_title = 'Restocked | '.$globvar_title;
				break;
			}
		}
		else if($_GET['pbrand'] > 0) {
			$currentSeoTable = 'productbrand';
			$seo_idp = ue_real_escape_string($_GET['pbrand']);
			$seo_idp_queStr = "SELECT * FROM ".$currentSeoTable."
			WHERE
				".$currentSeoTable."_id = '$seo_idp' AND
				".$currentSeoTable."_enabled = 'e'
			LIMIT 1
			";
			$seo_idp_que = ue_query($seo_idp_queStr);
			$seo_idp_res = ue_fetch_array($seo_idp_que);
			$globvar_title = $seo_idp_res[$currentSeoTable.'_name'].' | '.$globvar_title;
		}
		else if($_GET['pgroup'] > 0) {
			$currentSeoTable = 'productgroup';
			$seo_idp = ue_real_escape_string($_GET['pgroup']);
			$seo_idp_queStr = "SELECT * FROM ".$currentSeoTable."
			WHERE
				".$currentSeoTable."_id = '$seo_idp' AND
				".$currentSeoTable."_enabled = 'e'
			LIMIT 1
			";
			$seo_idp_que = ue_query($seo_idp_queStr);
			$seo_idp_res = ue_fetch_array($seo_idp_que);
			$globvar_title = $seo_idp_res[$currentSeoTable.'_name'].' | '.$globvar_title;
		}
		else if($_GET['ptype'] > 0) {
			$currentSeoTable = 'producttype';
			$seo_idp = ue_real_escape_string($_GET['ptype']);
			$seo_idp_queStr = "SELECT * FROM ".$currentSeoTable."
			WHERE
				".$currentSeoTable."_id = '$seo_idp' AND
				".$currentSeoTable."_enabled = 'e'
			LIMIT 1
			";
			$seo_idp_que = ue_query($seo_idp_queStr);
			$seo_idp_res = ue_fetch_array($seo_idp_que);
			$globvar_title = $seo_idp_res[$currentSeoTable.'_name'].' | '.$globvar_title;
		}
		else if($_GET['pcategory'] > 0) {
			$currentSeoTable = 'productcategory';
			$seo_idp = ue_real_escape_string($_GET['pcategory']);
			$seo_idp_queStr = "SELECT * FROM ".$currentSeoTable."
			WHERE
				".$currentSeoTable."_id = '$seo_idp' AND
				".$currentSeoTable."_enabled = 'e'
			LIMIT 1
			";
			$seo_idp_que = ue_query($seo_idp_queStr);
			$seo_idp_res = ue_fetch_array($seo_idp_que);
			$globvar_title = $seo_idp_res[$currentSeoTable.'_name'].' | '.$globvar_title;
		}
		else if($_GET['pclass'] > 0) {
			$currentSeoTable = 'productclass';
			$seo_idp = ue_real_escape_string($_GET['pclass']);
			$seo_idp_queStr = "SELECT * FROM ".$currentSeoTable."
			WHERE
				".$currentSeoTable."_id = '$seo_idp' AND
				".$currentSeoTable."_enabled = 'e'
			LIMIT 1
			";
			$seo_idp_que = ue_query($seo_idp_queStr);
			$seo_idp_res = ue_fetch_array($seo_idp_que);
			$globvar_title = $seo_idp_res[$currentSeoTable.'_name'].' | '.$globvar_title;
		}
	}
		
	//Get BRAND Lists
	$seo_brand_list = '';
	$seo_brand_sep = ',';
	$seo_brand_que = ue_query("SELECT productbrand_name FROM productbrand WHERE productbrand_enabled = 'e'");
	while($seo_brand_res = ue_fetch_array($seo_brand_que)) {
		$seo_brand_list .= $seo_brand_sep.$seo_brand_res['productbrand_name'];
	}
	
	//Get CATEGORY Lists
	$seo_category_list = '';
	$seo_category_sep = ',';
	$seo_category_que = ue_query("SELECT productcategory_name FROM productcategory WHERE productcategory_enabled = 'e'");
	while($seo_category_res = ue_fetch_array($seo_category_que)) {
		$seo_category_list .= $seo_category_sep.$seo_category_res['productcategory_name'];
	}
?>
<title><?php echo $globvar_title?></title>
<meta name="description" content="<?php echo $globvar_description?> <?php echo $seo_category_list?>" />
<meta name="keywords" content="<?php echo $globvar_keywords?>,<?php echo $seo_brand_list?>" />
<meta property="og:image" content="http://<?php echo $globvar_address.'/images/favicon.jpg'?>" />
<?php
	}
?>
<meta name="author" content="<?php echo $globvar_author?>" />
<meta name="robots" content="follow, index" />
<meta name="revisit-after" content="7 days" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" type="text/css" href="ue-css/bootstrap.min.css" />
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
<script type="text/javascript" src="ue-js/jquery.js"></script>
<script type="text/javascript" src="ue-js/ue-jsgeneral.js"></script>
<link rel="stylesheet" href="ue-css/ue-style.css" type="text/css" media="screen" />
<!-- Chosen Select START -->
<script type="text/javascript" src="ue-js/chosen/chosen.jquery.min.js"></script>
<link rel="stylesheet" href="ue-js/chosen/chosen.min.css" type="text/css" />
<!-- Chosen Select END -->
<!-- Modal Popup START -->
<script type="text/javascript" src="ue-js/uepopup/jquery.magnific-popup.min.js"></script>
<link rel="stylesheet" href="ue-js/uepopup/magnific-popup.css" />
<!-- Modal Popup END -->
<?php
	include('ue-template/head.php');
?>
</head>