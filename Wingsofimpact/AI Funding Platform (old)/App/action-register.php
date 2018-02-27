<?php
	session_start();
	include('ue-config/ue-globalconfig.php');
	include('ue-config/ue-globalconnect.php');
	include('ue-config/ue-globalfunction.php');
	
	if($_SESSION['currentUserId'] != '') {
		$detailmode = 'edit';
	}
	else {
		$detailmode = 'create';
	}
	
	$namaTableDatabase		= 'user';
	$namaTableDatabaseId	= $namaTableDatabase.'_id';
	$currentServerTime		= time();
	
	//Get All Posted Vars
	$auPostedElements = array();
	$auCookiesAllow = array(
		'usertype',
		'name',
		'email',
		'country',
		'telp',
		'companyname',
		'website',
		'companycountry',
		'companyindustry',
		'revenue',
		'companyimpact',
		'fundingamount',
		'fundingperiod',
		'fundingpurpose',
		'fundingimpact',
		'fundingrepaymentoption',
		'fundingrepaymentperiod',
		'membership',
		'address',
		'companyareaofinterest',
		'desc1',
		'desc2',
		'desc3',
		'yearstart',
		'probono',
		'market',
		'connection',
		'companycode',
		'prdlimit',
		'published',
		'emailnote',
		'companyCodeTrigger',
		'passport'
	);
	
	foreach($_POST as $postedElementsKey => $postedElementsVal) {
		$auPostedElements["$postedElementsKey"] = ueReceiveInput($postedElementsKey,$postedElementsVal,false);
		if($postedElementsKey == "prdlimit"){
			$arrElem = array();
			foreach($auPostedElements['prdlimit'] as $val){
				$arrElem[] =  $val;
			}
			setcookie($postedElementsKey,json_encode($arrElem),time()+5);
		}
		else if(in_array($postedElementsKey,$auCookiesAllow)) {
			setcookie($postedElementsKey,$postedElementsVal,time()+5);
		}
		else if($postedElementsKey == $auPostedElements['province']){
			setcookie('shipping_id',$postedElementsVal,time()+5);
		}
	}
	
	
	//print_r($auPostedElements['prdlimit']);die();
	//Init Vars
	$id						= $auPostedElements['id'];
	//$namaPageUtama			= 'dashboard.php';
	$namaPageUtama			= 'login.php';
	$namaHalamanEdit		= basename($auPostedElements['frompage'],'.php');
	$errorList				= array();
	$errorListStr			= '';
	$pageparam				= '?';
	$nextInLine 			= (int)autoIncrementNext($namaTableDatabase);
	
	//Required Fields Name
	
	if($namaHalamanEdit == "registerfunding"){
		$requireFieldsNameArr	= array(
			'name',
			'email',
			'country',
			'telp',
			'companyname',
			'website',
			'companyindustry',
			'revenue',
			'membership',
			'companyimpact',
			'yearstart'		
		);
		$membershipType = "startup";
	}else if($namaHalamanEdit == "registerinvestor"){
		$requireFieldsNameArr	= array(
			'name',
			'email'
		);
		$membershipType = "investors";
	}else{
		$requireFieldsNameArr	= array(
			'usertype',
			'name',
			'email'
		);
		$membershipType = "startup";
		if($auPostedElements['usertype'] == "2"){
			$membershipType = "investors";
		}
		
		$auPostedElements['membership'] = "0";
		if(isset($auPostedElements['premiumBtn'])){
			$auPostedElements['membership'] = "1";
		}
		
		/*
		if(isset($auPostedElements['companyCodeTrigger']) and trim($auPostedElements['companycode']!="")){
			$requireFieldsNameArr	= array(
				'name',
				'email',
				'country',
				'telp',
				'address',
				'membership'
			);
			$companyCode= trim($auPostedElements['companycode']);
			$sqlCompany	= ue_query("SELECT * FROM company WHERE company_code = '".$companyCode."'");
			$getComp	= ue_fetch_array($sqlCompany);
			if($getComp['company_id']==""){
				$errorList[] = 'Company not exists';
			}
		}
		*/
	}
	
	//Action START
	foreach($requireFieldsNameArr as $requireFieldsNameArrKey => $requireFieldsNameArrVal) {
		if($auPostedElements["$requireFieldsNameArrVal"] == '') {
			header("Location: $namaHalamanEdit".$pageparam."&err=Please Fill All Fields");
			exit();
		}
	}
	
	//Pattern Check START
	if(!$_SESSION['currentUserId']) {
		if(!preg_match("/^[a-zA-Z0-9._-]{2,}[@][a-zA-Z0-9_-]{2,}[.][a-zA-Z]{2,5}([.][a-zA-Z]{2,5})?$/",$auPostedElements['email'])) {
			$errorList[] = 'Invalid E-mail';
		}
		else {
			@ $userlogque = ue_query("SELECT * FROM $namaTableDatabase WHERE ".$namaTableDatabase."_email = '".$auPostedElements['email']."' LIMIT 1");
			@ $userlognum = (int)ue_num_rows($userlogque);
			if($userlognum) {
				$errorList[] = 'E-mail already exists';
			}
		}
		if($membershipType == "startup"){
			if($auPostedElements['password'] == '' || $auPostedElements['repass'] == '') {
				$errorList[] = 'Invalid Password';
			}
		}
	}
	else {
		/*
		//Check if old password matches
		@ $userlogque = ue_query("SELECT * FROM $namaTableDatabase WHERE ".$namaTableDatabase."_id = '".$_SESSION['currentUserId']."' AND ".$namaTableDatabase."_password = '".$auPostedElements['curpassword']."' LIMIT 1");
		@ $userlognum = (int)ue_num_rows($userlogque);
		if($userlognum <= 0) {
			$errorList[] = 'Invalid Current Password';
		}
		*/
	}
	/*
	if($auPostedElements['password'] != '' && $auPostedElements['repass'] != '' && $detailmode != 'edit') {	
		if(strlen($auPostedElements['password']) < 4) {
			$errorList[] = 'Password must be at least 4 characters in length';
		}
		else {
			if($auPostedElements['password'] != $auPostedElements['repass']) {
				$errorList[] = 'Password and Re-Password must be the same';
			}
		}
	}
	*/
	if(!preg_match("/^[a-zA-Z ]{2,}$/",$auPostedElements['name'])) {
		$errorList[] = 'Invalid Name';
	}
	/*
	$currentDob = strtotime($auPostedElements['dob']." 00:00");
	$todayUnix = strtotime(date('j F Y 00:00'));
	if($currentDob >= $todayUnix) {
		$errorList[] = 'Invalid Date of Birth';
	}
	
	if($auPostedElements['gender'] != 'm' && $auPostedElements['gender'] != 'f') {
		$errorList[] = 'Please select a Gender';
	}
	
	if($auPostedElements['province'] == '') {
		$errorList[] = 'Please select a province';
	}
	else {
		$currentShipId = $auPostedElements["$auPostedElements[province]"];
	}
	
	$auPostedElements['address'] = nohtml($auPostedElements['address']);
	if(strlen($auPostedElements['address']) < 4) {
		$errorList[] = 'Please enter a valid Address';
	}
	
	if(!preg_match("/^[0-9 ]{3,}$/",$auPostedElements['postal'])) {
		$errorList[] = 'Please enter a valid postal code';
	}
	*/
	/*
	if(!preg_match("/^[0-9 +-]{6,}$/",$auPostedElements['telp'])) {
		$errorList[] = 'Please enter a valid telephone number';
	}
	*/
	//Pattern Check END
	
	$resetPasswordStr = '';
	$numCharInForgot = 7;
	$curPasMd = md5($nextInLine.str_replace(" ","",$auPostedElements['name']).date("Ymd"));
	$curPasMdNum = ((int)strlen($curPasMd)-1);
	for($i=0;$i<$numCharInForgot;$i++) {
		$resetPasRandNum = (int)rand(0,$curPasMdNum);
		$resetPasswordStr .= $curPasMd["$resetPasRandNum"];
	}
	
	$password 		= $resetPasswordStr;
	$hashPassword 	= md5($password);
	if($membershipType == "startup"){
		$hashPassword 	= md5($auPostedElements['repass']);
	}
	 
	if(count($errorList) == 0) {
		switch($detailmode) {
			case 'edit':
				/**/
			break;
			default:
				if($namaHalamanEdit == "registerinvestor" or $membershipType == "investors"){
					/*
					$profileFolderLocation	= 'upload/userImage';
					$profileMaxWidth		= 1200;
					$profileMaxHeight		= 1200;
					
					if($_FILES['photo']['name']) {
						$imagePhotoName 	= $nextInLine.md5($nextInLine);
						$imagePhotoResult 	= imageUploader($_FILES['photo'],'',$profileFolderLocation,$imagePhotoName,$profileMaxWidth,$profileMaxHeight);
					}
					$published = "d";
					if(isset($auPostedElements['published'])){
						$published = "e";
					}
					
					$emailnote = "d";
					if(isset($auPostedElements['emailnote'])){
						$emailnote = "e";
					}
					
					if(isset($auPostedElements['companyCodeTrigger']) and trim($auPostedElements['companycode']!="")){
						$companyId 	= $getComp['company_id'];
					}else{
						$companyId 		= (int)autoIncrementNext("company");
						$companyCode 	= $companyId.substr(trim($auPostedElements['companyname']),0,3).mt_rand(100,999);
						$mission		= implode(", ",$auPostedElements['prdlimit']);
						$sqlCompany 	= "INSERT INTO company VALUES('',
																'$currentServerTime',
																'0',
																'".$nextInLine."',
																'".$auPostedElements['companyname']."',
																'".$companyCode."',
																'".$auPostedElements['website']."',
																'0',
																'".$auPostedElements['companyindustry']."',
																'0',
																'0',
																'".$auPostedElements['companyareaofinterest']."',
																'".$mission."',
																'".$auPostedElements['probono']."',
																'".$auPostedElements['market']."',
																'".$auPostedElements['connection']."'
															)";
						$qCompany = ue_query($sqlCompany);
					}
					*/
					$createQueryStr	= "INSERT INTO ".$namaTableDatabase." VALUES(
										'',
										'$currentServerTime',
										'0',
										'e',
										'',
										'',
										'',
										'',
										'".$auPostedElements['email']."',
										'',
										'".$auPostedElements['name']."',
										'".$hashPassword."',
										'',
										'',
										'',
										'',
										'',
										'',
										'',
										'',
										'".$membershipType."',
										'".$auPostedElements['membership']."',
										'e',
										'e',
										''
									)";
					
				}else{
					if($_FILES['catalogue']['name']){
						$target_dir 	= "upload/userCatalogue/";
						$target_file 	= $target_dir . basename($_FILES["catalogue"]["name"]);
						$uploadOk 		= 1;
						$fileType 		= pathinfo($target_file,PATHINFO_EXTENSION);
						if ($_FILES["catalogue"]["size"] > 10000000) {
							$uploadOk = 0;
							$errorList[] = "File size too big";
						}
						// Allow certain file formats
						if($fileType != "pdf") {
							$uploadOk = 0;
							$errorList[] = "File must be pdf only";
						}
						
						if ($uploadOk == 0) {
							foreach($errorList as $errorListKey => $errorListVal) {
								$errorListStr .= $errorListVal.'<br />';
							}
							header("Location: $namaHalamanEdit".$pageparam."&err=".$errorListStr);
						// if everything is ok, try to upload file
						} else {
							if (move_uploaded_file($_FILES["catalogue"]["tmp_name"], $target_file)) {
								$fileName = $_FILES['catalogue']['name'];
							} else {
								header("Location: $namaHalamanEdit".$pageparam."&err=Something is wrong, please try again");
							}
						}
					}
					
					$profileFolderLocation	= 'upload/userImage';
					$profileMaxWidth		= 1200;
					$profileMaxHeight		= 1200;
					
					if($_FILES['photo']['name']) {
						$imagePhotoName 	= $nextInLine.md5($nextInLine);
						$imagePhotoResult 	= imageUploader($_FILES['photo'],'',$profileFolderLocation,$imagePhotoName,$profileMaxWidth,$profileMaxHeight);
					}
					
					$companyId 		= (int)autoIncrementNext("company");
					$companyCode 	= $companyId.substr(trim($auPostedElements['companyname']),0,3).mt_rand(100,999);
					$sqlCompany 	= "INSERT INTO company VALUES('',
															'$currentServerTime',
															'0',
															'".$nextInLine."',
															'".$auPostedElements['companyname']."',
															'".$companyCode."',
															'".$auPostedElements['website']."',
															'".$auPostedElements['yearstart']."',
															'".$auPostedElements['companyindustry']."',
															'".$auPostedElements['revenue']."',
															'".$auPostedElements['companyimpact']."',
															'',
															'',
															'',
															'',
															''
														)";
					$qCompany = ue_query($sqlCompany);
								
					$createQueryStr	= "INSERT INTO ".$namaTableDatabase." VALUES(
										'',
										'$currentServerTime',
										'0',
										'e',
										'".$companyId."',
										'',
										'',
										'',
										'".$auPostedElements['email']."',
										'',
										'".$auPostedElements['name']."',
										'".$hashPassword."',
										'".$auPostedElements['address']."',
										'".$auPostedElements['telp']."',
										'',
										'',
										'',
										'',
										'".$auPostedElements['country']."',
										'".$imagePhotoResult."',
										'".$membershipType."',
										'".$auPostedElements['membership']."',
										'e',
										'e',
										''
									)";
					//echo $createQueryStr;die();
				}	
				@ $grandQueryResult = ue_query($createQueryStr);
			break;
		}
		
		//REDIRECTIONS
		switch($detailmode) {
			case 'edit':
				if($grandQueryResult == false) {
					header("Location: $namaPageUtama".$pageparam."&err=Invalid ID");
				}
				else {
					header("Location: $namaPageUtama".$pageparam."&sta=Information Have Been Updated");
				}
			break;
			default:
				if($grandQueryResult == false) {
					header("Location: $namaPageUtama".$pageparam."&err=Unable To Insert New Entry");
				}
				else {
					guestLogout();
					$createQueryStr	= "SELECT * FROM $namaTableDatabase WHERE
										".$namaTableDatabase."_email = '".$auPostedElements['email']."' AND
										".$namaTableDatabase."_name = '".$auPostedElements['name']."'
									LIMIT 1
									";
					@ $grandQueryResult = ue_query($createQueryStr);
					@ $grandQueryResultRes = ue_fetch_array($grandQueryResult);
					/*Start Login
					$_SESSION['currentUserId'] = $grandQueryResultRes["$namaTableDatabase"."_id"];
					$_SESSION['currentUserName'] = $grandQueryResultRes["$namaTableDatabase"."_name"];
					$_SESSION['currentUserType'] = $grandQueryResultRes["$namaTableDatabase"."_membershiptype"];
					//End Login*/
					
					if($namaHalamanEdit == "registerinvestor" or $membershipType == "investors"){
						$nl = '<br />';
						$admtargetMail 	= $grandQueryResultRes["$namaTableDatabase"."_email"];
						$mesDate 		= date("F j, Y, g:ia");
						//$mesTitle 		= $mesTitle.' - '.$mesDate;
						if($auPostedElements['membership'] == '0'){
							/*
							$purchaseMailTitle 	= "Angels of Impact welcomes you onboard the community! ";
							$messageQuery 		= "Dearest ".$grandQueryResultRes["$namaTableDatabase"."_name"].", $nl
												Welcome to the Angels of Impact community! You will meet angel social entrepreneurs, $nl
												funders and mentors. Angels of impact supports women led social entrepreneurs who are $nl 
												focused on impact first with an aim to fulfill the 3 UN Sustainable Development goals, #1 No $nl 
												Poverty, #5 Gender Equality and #12 Responsible Production & Consumption. $nl
												$nl
												We support women led enterprises with access to $nl
												<ul>
													<li>New market networks as we champion your products and services into supply chain of organisations we call this corporate shared values</li>
													<li>Funding needs that come in the form of prepaid credits for your working capital needs</li>
													<li>Connect you to domain experts and mentors who can help you business overcome</li>
												</ul>
												$nl
												<ul>
													<li>Open doors to new markets, networks and potential customers</li>
													<li>Be more involved in supporting social enterprises with funding needs</li>
													<li>Mentor social enterprise in areas of finance, marketing, hiring or any other operational areas</li>
												</ul>
												$nl
												Feel free to be in touch with us and hit reply to this email if you will like to be more involved. $nl 
												Read more about our events, news and how we support our social enterprises in our network. $nl
												(Link to http://www.angelsofimpact.com/news--events)  $nl 
												We welcome you onboard the movement! $nl
												$nl
												<a href=\'angelofimpact.com/login\'>[Click here]</a> login to your account.$nl
												$nl
												With gratitude, $nl
												Audrey & Laina
												";
							*/
							$purchaseMailTitle 	= "Welcome aboard Angels of Impact Movement! - Creating a world without poverty in unity with women!";
							$messageQuery 		= "Dearest ".$grandQueryResultRes["$namaTableDatabase"."_name"].", $nl
												Welcome on board the Angels of Impact movement, $nl
												we warmly welcome you as an Angel who's part of a larger purpose where we are all, $nl
												Creating a world without poverty in unity with women! $nl
												$nl
												Here is your password:$nl
												<strong>".$password."</strong> $nl 
												<i>Note: please change the password immediately after you sign in.</i> $nl
												$nl
												Feel free to also sign up your full profile <a href=\"".$globvar_address."/login?f=automail\">here</a> $nl
												$nl
												We now have a growing list of 8 social enterprises from handicrafts $nl 
												as well as agriculture sector from countries such as Thailand,  Indonesia, Malaysia and Cambodia. $nl 
												You are joined with purposeful Corporates such as Facebook, NUS Enterprise, LinkedIn and Patek Philippe $nl
												who are customers supporting social enterprises through corporate shared values. $nl
												$nl
												We aim to create greater market access as well as support our social enterprises in their funding needs. $nl 
												If you do have networks in the following verticals who may be looking to engage in creating shared value $nl
												by integrating social enterprises goods and services in supply chains, or in corporate gifting, do reply us and let us know! $nl
												$nl
												<ul>
													<li>Hotels</li>
													<li>Restaurants</li>
													<li>Technology</li>
													<li>Corporates big on creating social good in the world</li>
												</ul>
												$nl
												$nl
												With gratitude, $nl
												Audrey
												";
						}else{
							/*
							$purchaseMailTitle 	= "Angels of Impact welcomes you our Angel Member";
							$messageQuery 		= "Dearest ".$grandQueryResultRes["$namaTableDatabase"."_name"].", $nl
												Thank you for signing up to be a Angels member! You will meet angel social entrepreneurs, $nl
												funders and mentors. Angels of impact supports women led social entrepreneurs who are $nl 
												focused on impact first with an aim to fulfill the 3 UN Sustainable Development goals, $nl 
												#1 No Poverty, #5 Gender Equality and #12 Responsible Production & Consumption. $nl
												$nl
												Here are some of the social enterprises who are looking to receive funding support $nl
												<ul>
													<li>Torajamelo (Click through to the page where they can see the funding options) If you are inspired to</li>
													<li>Open doors to new markets, networks and potential customers </li>
													<li>Be more involved in supporting social enterprises with funding needs</li>
													<li>Mentor social enterprise in areas of finance, marketing, hiring or any other operational areas</li>
												</ul>
												$nl
												Feel free to be in touch with us and hit reply to this email! $nl 
												Read more about our events, news and how we support our social enterprises in our $nl 
												network. (Link to http://www.angelsofimpact.com/news--events)  $nl
												$nl
												We welcome you onboard the movement! $nl 
												<a href=\'angelofimpact.com/login\'>[Click here]</a> login to your account and meet some of your fellow Angel funder members too!.$nl
												$nl
												With gratitude, $nl
												Audrey & Laina
												";
							*/
							$purchaseMailTitle 	= "Welcome aboard Angels of Impact Movement! - Creating a world without poverty in unity with women!";
							$messageQuery 		= "Dearest ".$grandQueryResultRes["$namaTableDatabase"."_name"].", $nl
												Welcome on board the Angels of Impact movement, $nl
												we warmly welcome you as an Angel who's part of a larger purpose where we are all, $nl
												Creating a world without poverty in unity with women! $nl
												$nl
												Here is your password:$nl
												<strong>".$password."</strong> $nl 
												<i>Note: please change the password immediately after you sign in.</i> $nl
												$nl
												Feel free to also sign up your full profile <a href=\"".$globvar_address."/login?f=automail\">here</a> $nl
												$nl
												We now have a growing list of 8 social enterprises from handicrafts $nl 
												as well as agriculture sector from countries such as Thailand,  Indonesia, Malaysia and Cambodia. $nl 
												You are joined with purposeful Corporates such as Facebook, NUS Enterprise, LinkedIn and Patek Philippe $nl
												who are customers supporting social enterprises through corporate shared values. $nl
												$nl
												We aim to create greater market access as well as support our social enterprises in their funding needs. $nl 
												If you do have networks in the following verticals who may be looking to engage in creating shared value $nl
												by integrating social enterprises goods and services in supply chains, or in corporate gifting, do reply us and let us know! $nl
												$nl
												<ul>
													<li>Hotels</li>
													<li>Restaurants</li>
													<li>Technology</li>
													<li>Corporates big on creating social good in the world</li>
												</ul>
												$nl
												$nl
												With gratitude, $nl
												Audrey
												";
						}
						
						$sqlInsert = "INSERT INTO inbox VALUES ('',
																'".time()."',
																'0',
																'".$grandQueryResultRes["$namaTableDatabase"."_id"]."',
																'0',
																'".$purchaseMailTitle."',
																'".$messageQuery."'
																)";
						ue_query($sqlInsert);
						sendMail($admtargetMail,'notif@angelofimpact.com',$purchaseMailTitle,$messageQuery);
					}else{
						$nl = '<br />';
						//$mesTitle		= "";
						$admtargetMail 	= $grandQueryResultRes["$namaTableDatabase"."_email"];
						$mesDate 		= date("F j, Y, g:ia");
						//$mesTitle 		= $mesTitle.' - '.$mesDate;
						if($auPostedElements['membership'] == '0'){
							$purchaseMailTitle 	= "Angels of Impact welcomes you to the network!";
							$messageQuery 		= "Dearest ".$grandQueryResultRes["$namaTableDatabase"."_name"].", $nl
												Welcome to the Angels of Impact community! You will meet angel funders, mentors and $nl
												fellow angel social entrepreneurs. Angels of impact supports women led social $nl 
												entrepreneurs who are focused on impact first with an aim to fulfill the 3 UN Sustainable $nl 
												Development goals, #1 No Poverty, #5 Gender Equality and #12 Responsible Production & Consumption. $nl
												$nl
												We support women led enterprises with access to $nl
												<ul>
													<li>New market networks as we champion your products and services into supply chain of organisations we call this corporate shared values</li>
													<li>Funding needs that come in the form of prepaid credits for your working capital needs</li>
													<li>Connect you to domain experts and mentors who can help you business overcome</li>
												</ul>
												$nl
												Feel free to be in touch with us if you will like to learn more about becoming a social $nl 
												enterprise member and hit reply to this email if you have any specific questions! $nl 
												We welcome you onboard the movement! $nl
												$nl
												Read more about our events, news and how we support our social enterprises in our $nl 
												network.$nl
												$nl
												<a href=\"".$globvar_address."/login?f=automail\">[Click here]</a> login to your account.$nl
												$nl
												With gratitude, $nl
												Audrey & Laina
												";
						}else{
							$purchaseMailTitle 	= "Angels of Impact welcomes you our Angel Social Entrepreneur Member";
							$messageQuery 		= "Dearest ".$grandQueryResultRes["$namaTableDatabase"."_name"].", $nl
												Welcome to the Angels of Impact community! Thank you for signing up to be a paid Angel $nl 
												social enterprise member! Angels of impact supports women led social entrepreneurs who $nl 
												are focused on impact first with an aim to fulfill the 3 UN Sustainable Development goals, $nl 
												#1 No Poverty, #5 Gender Equality and #12 Responsible Production & Consumption. $nl 
												$nl 
												Here are the following areas that we will be championing, supporting and serving you: $nl 
												<ul>
													<li>New market networks as we champion your products and services into supply chains of organisations who practice corporate shared value</li>
													<li>Funding needs that come in the form of prepaid credits for your cash flow needs</li>
													<li>Connect you to domain experts and mentors who can help your business overcome specific and strategic challenges</li>
												</ul>
												$nl
												Feel free to be in touch with us if you will like to learn more about becoming a social $nl 
												enterprise member and hit reply to this email if you have any specific questions! $nl
												We welcome you onboard the movement! $nl
												Read more about our events, news and how we support our social enterprises in our network. $nl 
												$nl
												<a href=\"".$globvar_address."/login?f=automail\">[Click here]</a> login to your account. $nl
												$nl
												We will get back shortly to inform you regarding your payment details. Please wait for our next email.$nl
												$nl
												With gratitude, $nl
												Audrey & Laina";
						}
						$sqlInsert = "INSERT INTO inbox VALUES ('',
																'".time()."',
																'0',
																'".$grandQueryResultRes["$namaTableDatabase"."_id"]."',
																'0',
																'".$purchaseMailTitle."',
																'".$messageQuery."'
																)";
						//echo $sqlInsert;die();
						ue_query($sqlInsert);
						sendMail($admtargetMail,'notif@angelofimpact.com',$purchaseMailTitle,$messageQuery);
						
						/*Start Login*/
						$_SESSION['currentUserId'] 	= $grandQueryResultRes["$namaTableDatabase"."_id"];
						$_SESSION['currentUserName'] = $grandQueryResultRes["$namaTableDatabase"."_name"];
						$_SESSION['currentUserType'] = $grandQueryResultRes["$namaTableDatabase"."_membershiptype"];
						//End Login
						/*
						if($grandQueryResultRes["$namaTableDatabase"."_membershipid"] == "0"){
							$namaPageUtama = "dashboard.php";
						}else{
							$namaPageUtama = "payment.php";
						}
						*/
						
					}
					if($membershipType == "startup"){
						header("Location: $namaPageUtama".$pageparam."&sta=Thank You For Registering!");
					}else{
						header("Location: $namaPageUtama".$pageparam."&sta=Thank You For Registering!, <br /> Please check your email to find your password");
					}
					
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