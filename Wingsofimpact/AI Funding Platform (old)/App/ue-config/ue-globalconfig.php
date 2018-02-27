<?php
	$ue_maintenance_flag = false;
	
	//MySQL Database Connectivity
	$ue_mysql_connect_mode = 'prd'; // 'dev' for development, change to 'prd' for production
	
	$ue_mysql_connect_host_dev = 'localhost';
	$ue_mysql_connect_user_dev = 'root';
	$ue_mysql_connect_pass_dev = '';
	$ue_mysql_connect_daba_dev = 'aoi';
	
	$ue_mysql_connect_host_prd = 'localhost';
	$ue_mysql_connect_user_prd = 'wingsofi_admin';
	$ue_mysql_connect_pass_prd = 'BD@G-uw3-i(N';
	$ue_mysql_connect_daba_prd = 'wingsofi_aoi';
	
	/*
	$ue_mysql_connect_host_prd = 'localhost';
	$ue_mysql_connect_user_prd = 'geraikom_aoi';
	$ue_mysql_connect_pass_prd = 'A1xZ16-MJrtP';
	$ue_mysql_connect_daba_prd = 'geraikom_aoi';
	*/

	//Website Global Variables
	$globvar_sitename		= 'Angel Of Impact';
	$globvar_address		= 'wingsofimpact.com';
	$globvar_title			= 'Be Part Of Our Movement :: Angel Of Impact';
	$globvar_siteyear		= '2017';
	$globvar_timezone		= 'Asia/Jakarta'; // http://php.net/manual/en/timezones.php


	//SEO Related Variables
	$globvar_description	= 'Seek funding for your startup company';
	$globvar_keywords		= 'angel,investor,social enterprise,startup,funding,funded,community';
	$globvar_author			= 'angelosfimpact.com';
	$globvar_developer		= 'Ultima Engine Developer';
	$globvar_developeraddr	= 'ultimaenginedev.com';

	//Security Related Variables
	$globvar_adminidsite	= 'asdj34uashd321bnlyjnalasd68';

	//Support / Contacts Related Variables
	$globvar_sitecontacts	= array(
							'admin' 	=> 'admin@terlaku.com',
							'whatsapp'	=> '081297037765',
							'line'		=> 'csterlaku',
							'kakao'		=> 'csterlaku',
							'yahoochat' => 'ultimaengine@yahoo.com',
							'facebook' 	=> 'facebook.com/terlaku',
							'twitter' 	=> 'twitter.com/TerlakuID',
							'instagram'	=> 'instagram.com/terlaku',
							'youtube'	=> 'youtube.com/terlaku',
							'tel' 		=> '(021)83635674',
							'bbpin' 	=> '32892B52',
							'email0'	=> 'contact@angelsofimpact.com',
							'email1'	=> 'inquiries@angelsofimpact.com',	//Engine Use Mail
							'email2' 	=> 'member@angelsofimpact.com',			//Main Contact Mail
							'email3' 	=> 'payment@angelsofimpact.com',		//Purchase Related Mail
							'email4' 	=> 'notif@angelsofimpact.com',
							'email5'	=> 'Audrey@angelsofimpact.com'
						);
						
	//Membership System ANGELS OF IMPACT
	$aolMembership = array(
		'investors' => array(
			'0' => array(
				'name' => 'Free',
				'member' => 'Free',
				'price' => 0,
				'duration' => 0,
				'desc' => 'Meet more friends - see Angel Social Enterprises in your network.<br/>Meet Angel funders who are champions for Social Enterprises.<br/>Get more done with best practice advice from our knowledge base.<br/>'
			),
			'1' => array(
				'name' => '$500/Year',
				'member' => 'Premium',
				'price' => 500 ,
				'duration' => 365,
				'desc' => 'Save time searching for credible social enterprises to fund.
Save money while having a bigger social impact. Unlike with normal charity, your money comes back to you.
Save 10% on the cost of events and conferences in the region.
Exclusive access to other members. Connect with potential customers, suppliers and employers.
Save money on tailor-made eco-tourism trips.
Clear measures of the impact of your money
Save time looking for responsibly-produced products.
'
			),
			'2' => array(
				'name' => '$800/Year',
				'member' => 'Corporate',
				'price' => 800,
				'duration' => 365,
				'desc' => 'Receive up to 3 unique logins for individuals in your organisation.
Obtain Corporate branding on the Angels of Impact platform.
Gain access to curated social enterprises that you can fund and support as a Corporate Angel
Leverage strategic collaboration with fellow Angels & Corporate members.
Meet and network exclusively with fellow Angels and Corporates who support & fund the social enterprises.
Support a business with clear measures of benefit of your funding. Keep on funding as an SE repays you
Purchase responsibly-produced products.
Receive up to 10% discount on selected items from our responsibly made social enterprise goods.
Access to events and conferences at a discount on driving impact.
Book tailor-made travel trips to places where our social enterprises operate and serve.
Learn from our Angels on the best practices of social impact space
'
			)
		),
		'startup' => array(
			'0' => array(
				'name' => 'Free',
				'member' => 'Free',
				'price' => 0,
				'duration' => 0,
				'desc' => 'Meet more friends - see Angel Social Enterprises in your network.<br/>Meet Angel funders who are champions for Social Enterprises.<br/>Get more done with best practice advice from our knowledge base.<br/>'
			),
			'1' => array(
				'name' => '$300/Year',
				'member' => 'Premium',
				'price' => 300,
				'duration' => 365,
				'desc' => 'Access to a trusted network of Angels, Corporates and receive 0 to low interest loans and funding
Innovative way of repaying interest through in-kind goods and services
Pipeline of customers, both individual and Corporate buyers, of your social enterprise\'s goods and services
Access our monthly community gatherings of Angels
'
			)
		)
	);
	
	$countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Zambia", "Zimbabwe");
	
	//Site Settings
	$ue_globvar_currency						= 'Rp. ';
	$ue_globvar_purchase_expiry_days			= 2;
	$ue_globvar_purchase_max_paycode			= 999;
	$ue_globvar_grosirprice_number				= 3;													//Put 0 to disable
	$ue_globvar_sitemap_mode					= 'product';											//'product' OR 'news'
	$ue_globvar_https_enabled					= false;
	$ue_globvar_remember_me_toggle				= true;
	$ue_globvar_purchase_shipweight				= true;
	$ue_globvar_purchase_emails					= true;													//Send Purchase and Confirmation Mail
	$ue_globvar_purchase_emails_logo			= $globvar_address.'/images/angelsOfImpactLogo.png';	//Leave empty for no logo on emails
	$ue_globvar_purchase_emails_admin_notif		= true;
	$ue_globvar_purchase_confirm_admin_notif	= true;
	$ue_globvar_recordrecentproduct				= false;
	$ue_globvar_recordglobalhistory				= false;
	$ue_globvar_watermarkdefaultchecked			= false;
	$ue_globvar_productgroup_enabled			= true;
	$ue_globvar_shipping_mode					= array(
													"Normal Shipping"		=> 'shipping_price',
													"Economical Shipping"	=> 'shipping_priceeco',
													"Urgent Shipping"		=> 'shipping_urgent'
	);
	$ue_globvar_shipping_urgent_by_weight		= false;
	$ue_globvar_free_purchase_bank_data			= array(
													"bank_name"				=> 'FREE PURCHASE',
													"bank_descviewcart"		=> 'Click on the "Confirm Purchase" button below to continue!',
													"bank_desc"				=> 'This purchase have a GRAND TOTAL of 0 and have been automatically confirmed by the system.',
													"bank_image"			=> '&nbsp;'
	);
	
	//UE Analytics Settings
	$ue_globvar_analytics_enabled				= true;													//Requires `analytics`,`campaign`,`ip2location` & PHP 5.6.8+
	$ue_globvar_analytics_full_tracking			= true;													//If set to 'true' all NON CAMPAIGN traffic will also be recorded
	$ue_globvar_analytics_allpage_tracking		= true;													//If set to 'false' will only record visift to, `Purchase`,`Register`,`Search`,`User Login`,`Guest Login`,`Subscribe`,`View Product`,`Read News`,`Contact Form`
	$ue_globvar_analytics_maximum_products		= 20;													//Maximum Product Page Visits per Session
	$ue_globvar_analytics_goals					= array(
													0 => 'Visit',
													1 => 'Search',
													2 => 'Register',
													3 => 'Login',
													4 => 'Guest',
													5 => 'Subscribe',
													6 => 'View Product',
													7 => 'News Read',
													8 => 'Purchase',
													9 => 'Contact Form',
													10 => 'Favorite'
	);

	//No Changes Needed Below
	$GLOBALS['ue_mysql_connect_mode']					= $ue_mysql_connect_mode;
	$GLOBALS['globvar_address']							= $globvar_address;
	$GLOBALS['ue_globvar_https_enabled']				= $ue_globvar_https_enabled;
	$GLOBALS['ue_globvar_analytics_enabled']			= $ue_globvar_analytics_enabled;
	$GLOBALS['ue_globvar_analytics_full_tracking']		= $ue_globvar_analytics_full_tracking;
	$GLOBALS['ue_globvar_analytics_allpage_tracking']	= $ue_globvar_analytics_allpage_tracking;
	$GLOBALS['ue_globvar_analytics_maximum_products']	= $ue_globvar_analytics_maximum_products;
	$GLOBALS['ue_globvar_analytics_goals']				= $ue_globvar_analytics_goals;
	@ date_default_timezone_set($globvar_timezone);

	//Maintenance Redirect
	if($ue_maintenance_flag) {
		header("Location: /ue-defaultpages/maintenance.php");
		exit();
	}
?>