<?php function ueAddPurchase($ueAddPurchaseProductArr,$ueAddPurchaseUserId,$ueAddPurchaseUserName,$ueAddPurchaseUserEmail,$ueAddPurchaseUserPostal,$ueAddPurchaseUserTelp,$ueAddPurchaseBankId,$ueAddPurchaseShippingId,$ueAddPurchaseShippingDate,$ueAddPurchaseShippingName,$ueAddPurchaseShippingAddress,$ueAddPurchaseShippingType,$ueAddPurchasePromoCode,$ueAddPurchaseUseCredit,$ueAddPurchasePayCode,$ueAddPurchaseNote,$ueAddPurchaseUserEmailNotif=true,$ueAddPurchaseAdminEmailNotif=true){$namaTableDatabase='purchase';$namaTableDatabaseId=$namaTableDatabase.'_id';$currentServerTime=time();$nextInLine=(int)autoIncrementNext($namaTableDatabase);$ueAddPurchaseUserId=(int)$ueAddPurchaseUserId;$ueAddPurchaseUseCredit=(int)$ueAddPurchaseUseCredit;$ueReturn=array();$prdLimitArr=array();$bankLimitArr=array();$grandTotalNett=0;$perProductVoucherUsed=false;$defaultPurchaseSta='r';if($ueAddPurchaseUserId>0){$userDetailQue=ue_query("SELECT * FROM user WHERE user_id = '".$ueAddPurchaseUserId."' AND user_enabled = 'e' LIMIT 1");$userDetailRes=ue_fetch_array($userDetailQue);$purchaseUserId=$userDetailRes['user_id'];$purchaseUserName=$userDetailRes['user_name'];$purchaseUserEmail=$userDetailRes['user_email'];$purchasePostal=$userDetailRes['user_postal'];$purchaseTelp=$userDetailRes['user_telp'];$purchaseCurrentCredit=$userDetailRes['user_credit'];}else{$purchaseUserId='';$purchaseUserName=$ueAddPurchaseUserName;$purchaseUserEmail=$ueAddPurchaseUserEmail;$purchasePostal=$ueAddPurchaseUserPostal;$purchaseTelp=$ueAddPurchaseUserTelp;$purchaseCurrentCredit=0;}$hashChar=array('Y','G','F','B','L','T','V','X','Z','R');$frontHash=str_replace($hashChar,'',md5($currentServerTime));$frontHash=strtoupper(substr($frontHash,1,5));$seperatorOne=rand(0,9);$seperatorOne=$hashChar["$seperatorOne"];$randNum=rand(100,999);$seperatorTwo=rand(0,9);$seperatorTwo=$hashChar["$seperatorTwo"];$endPurchaseTime=date("dmy");$codePurchase=$nextInLine.$frontHash.$seperatorOne.$randNum.$seperatorTwo.$endPurchaseTime.$ueAddPurchaseUserId;$currentShipId=ue_real_escape_string($ueAddPurchaseShippingId);$shippingEditQue=ue_query("SELECT * FROM shipping WHERE shipping_id = '$currentShipId' LIMIT 1");@ $shippingEditRes=ue_fetch_array($shippingEditQue);$shippingDataType=$ueAddPurchaseShippingType;$shippingDataPrice=$shippingEditRes["$shippingDataType"];$purchasePostal=$ueAddPurchaseUserPostal;$purchaseTelp=$ueAddPurchaseUserTelp;if($shippingDataPrice<=0){return false;}$voucherCode=$ueAddPurchasePromoCode;if($voucherCode){$promoDataQue=ue_query("SELECT * FROM promo WHERE
											promo_code = '$voucherCode' AND
											promo_enabled = 'e' AND
											promo_expiry > '$currentServerTime'
			LIMIT 1");if(@ue_num_rows($promoDataQue)>0){$promoDataRes=ue_fetch_array($promoDataQue);$promoUsedNew=(int)$promoDataRes['promo_used'] + 1;@ ue_query("UPDATE promo SET promo_used = '".$promoUsedNew."' WHERE promo_id = '".$promoDataRes['promo_id']."' LIMIT 1");if($promoDataRes['promo_mode']==2){$discountAmount=promoVoucherPrice($promoDataRes['promo_id']);}else if($promoDataRes['promo_mode']==1){$shippingDataPrice=0;}@ $prdLimitArr=explode(',',$promoDataRes['promo_productallow']);@ $bankLimitArr=explode(',',$promoDataRes['promo_bankallow']);@ $userLimitArr=explode(',',$promoDataRes['promo_userallow']);if($bankLimitArr['0']>0){if(!in_array($ueAddPurchaseBankId,$bankLimitArr)){$ueReturn['err']='This promo can\'t be used with this payment method';}}if($userLimitArr['0']>0){if(!in_array($ueAddPurchaseUserId,$userLimitArr)){$ueReturn['err']='This user are inelligible for this promotion';}}if($ueReturn['err']==''&&$promoDataRes['promo_onetimeuser']=='e'&&$ueAddPurchaseUserId>0){$checkUserUseBeforeQue=ue_query("SELECT purchase_id FROM purchase WHERE
						promo_id = '".$promoDataRes['promo_id']."' AND
						user_id = '".$ueAddPurchaseUserId."'
						LIMIT 1
					");$checkUserUseBeforeNum=(int)ue_num_rows($checkUserUseBeforeQue);if($checkUserUseBeforeNum>0){$ueReturn['err']='This user are inelligible for this promotion';}}}else{$ueReturn['err']='There\'s no such promo or it\'s already ended';}}if($ueAddPurchaseBankId>0){$bankDataQue=ue_query("SELECT * FROM bank WHERE bank_id = '".$ueAddPurchaseBankId."' AND bank_enabled = 'e' LIMIT 1");$bankDataRes=ue_fetch_array($bankDataQue);if(!$bankDataRes){return false;}}else{$bankDataRes['bank_id']=0;$bankDataRes['bank_name']=$GLOBALS['ue_globvar_free_purchase_bank_data']['bank_name'];$bankDataRes['bank_desc']=$GLOBALS['ue_globvar_free_purchase_bank_data']['bank_desc'];$bankDataRes['bank_image']=$GLOBALS['ue_globvar_free_purchase_bank_data']['bank_image'];$bankDataRes['bank_paygate']='';$defaultPurchaseSta='c';}if($ueAddPurchaseUseCredit>0&&$purchaseUserId>0){$postedCreditUse=$ueAddPurchaseUseCredit;if($purchaseCurrentCredit>=$postedCreditUse){if($purchaseCurrentCredit<$postedCreditUse){$usableCredit=$purchaseCurrentCredit;}else{$usableCredit=$postedCreditUse;}$creditSta='DB';$creditEntry=$currentServerTime;$creditUsrId=$ueAddPurchaseUserId;$creditAdmId=0;$creditMutasi=$usableCredit;$creditBefore=$userDetailRes['user_credit'];$creditDesc='Used for Purchase #'.$codePurchase.' '.moneyFormat($creditMutasi,$GLOBALS['ue_globvar_currency']);ue_query("INSERT INTO usercredithistory VALUES(
					'',
					'$creditEntry',
					'$creditUsrId',
					'$nextInLine',
					'$creditAdmId',
					'$creditMutasi',
					'$creditBefore',
					'$creditSta',
					'$creditDesc'
				)");$sisaCredit=(int)($purchaseCurrentCredit - $usableCredit);@ ue_query("UPDATE user SET user_credit = '$sisaCredit' WHERE user_id = '$purchaseUserId' LIMIT 1");}}if($ueAddPurchasePayCode<1){$ueAddPurchasePayCode=(int)$GLOBALS['ue_globvar_purchase_max_paycode'];}$ueAddPurchaseShippingAddress=nohtml($ueAddPurchaseShippingAddress);$ueAddPurchaseShippingName=nohtml($ueAddPurchaseShippingName);foreach($ueAddPurchaseProductArr as $cartColorArrKey=>$cartColorArrVal){foreach($ueAddPurchaseProductArr["$cartColorArrKey"] as $cartSizeKey=>$cartSizeVal){$viewCartItemDetailQue=ue_query("SELECT * FROM product
								INNER JOIN productsize ON productsize.product_id = product.product_id
								INNER JOIN productcolor ON productcolor.product_id = product.product_id
								INNER JOIN productbrand ON product.productbrand_id 	 = productbrand.productbrand_id
								WHERE
									productcolor_id = '$cartColorArrKey' AND
									productsize_id = '$cartSizeKey' AND
									product_enabled = 'e' AND
									productbrand_enabled = 'e' AND
									productsize_enabled = 'e' AND
									productcolor_enabled = 'e'
							LIMIT 1
				");$viewCartItemDetailRes=ue_fetch_array($viewCartItemDetailQue);$productDataQue=ue_query("SELECT * FROM producttype
								INNER JOIN productcategory ON producttype.productcategory_id = productcategory.productcategory_id
								INNER JOIN productclass ON productcategory.productclass_id = productclass.productclass_id
								WHERE
									producttype_id = '".$viewCartItemDetailRes['producttype_id']."'
							LIMIT 1
				");$productDataRes=ue_fetch_array($productDataQue);$grandWeight=$viewCartItemDetailRes['product_shipweight']*$cartSizeVal;$getShippPriceFin=$shippingDataPrice*ceil($grandWeight);if($GLOBALS['ue_globvar_grosirprice_number']>0&&$cartSizeVal>=$GLOBALS['ue_globvar_grosirprice_number']&&$viewCartItemDetailRes['product_grosirprice']>0){$productPurchasePrice=$viewCartItemDetailRes['product_grosirprice'];}else if($viewCartItemDetailRes['product_saleprice']>0){$productPurchasePrice=$viewCartItemDetailRes['product_saleprice'];}else{$productPurchasePrice=$viewCartItemDetailRes['product_price'];}if(in_array($viewCartItemDetailRes['product_id'],$prdLimitArr)){if($promoDataRes['promo_maxvalue']>0){if(($productPurchasePrice*$cartSizeVal)<$promoDataRes['promo_maxvalue']){$promoDataRes['promo_value']=($productPurchasePrice*$cartSizeVal);}$perProductDiscountMaxMode=true;}else{if($perProductVoucherUsed==false){$perProductVoucherUsed=true;}$productPurchasePrice=ueCountPerproductDiscount($productPurchasePrice,$promoDataRes['promo_id']);}}if($productPurchasePrice<0){$productPurchasePrice=0;}$grandTotalNett+=($productPurchasePrice*$cartSizeVal);$createQueryStr="INSERT INTO ".$namaTableDatabase." VALUES(
									'',
									'$currentServerTime',
									'0',
									'd',
									'$purchaseUserId',
									'".$productDataRes['productclass_id']."',
									'".$productDataRes['productcategory_id']."',
									'".$productDataRes['producttype_id']."',
									'".$viewCartItemDetailRes['product_id']."',
									'".$viewCartItemDetailRes['productbrand_id']."',
									'".$viewCartItemDetailRes['productcolor_id']."',
									'".$viewCartItemDetailRes['productsize_id']."',
									'".$promoDataRes['promo_id']."',
									'$codePurchase',
									'".$purchaseUserName."',
									'".$purchaseUserEmail."',
									'".$purchasePostal."',
									'".$purchaseTelp."',
									'".$shippingEditRes['shipping_id']."',
									'".$shippingDataType."',
									'".$shippingDataPrice."',
									'".$productPurchasePrice."',
									'".$grandWeight."',
									'".$cartSizeVal."',
									'".$discountAmount."',
									'".$ueAddPurchasePayCode."',
									'".$usableCredit."',
									'".$ueAddPurchaseShippingAddress."',
									'".$ueAddPurchaseShippingDate."',
									'".$ueAddPurchaseBankId."',
									'',
									'',
									'".$defaultPurchaseSta."',
									'',
									'".$ueAddPurchaseNote."',
									'".$ueAddPurchaseShippingName."',
									'0'
				)";$addPurchaseFinalQue=ue_query($createQueryStr);writeAnalytics($GLOBALS['ue_globvar_analytics_goals'][8],'','','','','',$nextInLine,$shippingEditRes['shipping_id']);}}if($addPurchaseFinalQue){if($promoDataRes['promo_type']==1){@ ue_query("UPDATE promo SET promo_enabled = 'd' WHERE promo_id = '".$promoDataRes['promo_id']."' LIMIT 1");}if($promoDataRes['promo_mode']==3){$discountAmount=promoVoucherPrice($promoDataRes['promo_id'],$grandTotalNett);ue_query("UPDATE purchase SET purchase_discount = '$discountAmount' WHERE purchase_code = '$codePurchase'");}if($promoDataRes['promo_minpurchase']>0){if($promoDataRes['promo_minpurchase']>$grandTotalNett){ue_query("UPDATE purchase SET purchase_discount = '0' WHERE purchase_code = '$codePurchase'");}}if($perProductVoucherUsed==true){ue_query("UPDATE purchase SET purchase_discount = '0' WHERE purchase_code = '$codePurchase'");}if($ueAddPurchaseUserEmailNotif==true&&$GLOBALS['ue_globvar_purchase_emails']==true&&$GLOBALS['ue_mysql_connect_mode']=='prd'){$purchaseMailSendTo=$purchaseUserEmail;$purchaseMailDate=unixtodate($currentServerTime);$purchaseMailTitle='Your '.ucfirst($GLOBALS['globvar_address']).' Purchase - #'.$codePurchase;$purchaseMailName=$purchaseUserName;$purchaseMailShipTo=$shippingEditRes['shipping_name'].', '.$shippingEditRes['shipping_area'];$nl='<br />';$purchaseMailPrdList='';$purchaseMailPrdQue=ue_query("SELECT * FROM purchase INNER JOIN product ON purchase.product_id = product.product_id WHERE purchase_code = '$codePurchase'");while($purchaseMailPrdRes=ue_fetch_array($purchaseMailPrdQue)){$purchaseMailDiscount=$purchaseMailPrdRes['purchase_discount'];$purchaseMailCreditsUse=$purchaseMailPrdRes['purchase_creditsused'];$purchaseMailShipId=$purchaseMailPrdRes['shipping_id'];$purchaseMailShipPrice=$purchaseMailPrdRes['purchase_shipprice'];$purchaseMailPayCode=$purchaseMailPrdRes['purchase_paycode'];$purchaseMailAddress=$purchaseMailPrdRes['purchase_address'];$purchaseMailUserId=$purchaseMailPrdRes['user_id'];$purchaseMailPrdList.="<tr>
					<td>
						".$purchaseMailPrdRes['product_name']."
					</td>
					<td align='center'>
						".moneyFormat($purchaseMailPrdRes['purchase_price'],$GLOBALS['ue_globvar_currency'])."
					</td>
					<td align='center'>
						".$purchaseMailPrdRes['purchase_quantity']."
					</td>
					<td align='right'>
						".moneyFormat($purchaseMailPrdRes['purchase_price']*$purchaseMailPrdRes['purchase_quantity'],$GLOBALS['ue_globvar_currency'])."
					</td>
				</tr>";}if($perProductVoucherUsed==true){$purchaseMailDiscountStr="<tr style='background-color: #eeeeee;'>
					<td colspan='4' align='center' style='border-top: 1px solid #cccccc; border-bottom: 1px solid #cccccc;' colspan='3'>
						Using Promotional Code: <b>".$promoDataRes['promo_name']."</b>
					</td>
				</tr>";}else if($purchaseMailDiscount>0){$purchaseMailDiscountStr="<tr style='background-color: #eeeeee;'>
					<td align='right' style='border-top: 1px solid #cccccc; border-bottom: 1px solid #cccccc;' colspan='3'>
						Using Promotional Code: <b>".$promoDataRes['promo_name']."</b>
					</td>
					<td align='right' style='border-top: 1px solid #cccccc; border-bottom: 1px solid #cccccc;'>
						- ".moneyFormat($purchaseMailDiscount,$GLOBALS['ue_globvar_currency'])."
					</td>
				</tr>";}if($purchaseMailCreditsUse>0){$purchaseMailCreditsUseStr="<tr style='background-color: #eeeeee;'>
					<td align='right' style='border-bottom: 1px solid #cccccc;' colspan='3'>
						Credit Used
					</td>
					<td align='right' style='border-bottom: 1px solid #cccccc;'>
						- ".moneyFormat($purchaseMailCreditsUse,$GLOBALS['ue_globvar_currency'])."
					</td>
				</tr>";}if($purchaseMailUserId>0){if($defaultPurchaseSta=='c'){$purchaseMailContentText="We have received your purchase request, please wait while we process your purchase. You can check the progress by logging in to your account at ".ucfirst($GLOBALS['globvar_address'])."$nl";}else{$purchaseMailContentText="We have received your purchase request, please check the detail below and finish your purchase by logging in to your account at ".ucfirst($GLOBALS['globvar_address'])." and confirming your payment details$nl";}}else{if($defaultPurchaseSta=='c'){$purhaseMailConfirmLink='
						<div style="background-color: black; color: #fff; text-align: center; padding: 7px; font-weight: bold; margin-top: 10px;">
							<a href="http://'.$GLOBALS['globvar_address'].'/ordercheck.php?ocode='.$codePurchase.'">CLICK HERE TO CHECK YOUR PURCHASE</a>
						</div>
						';$purchaseMailContentText="We have received your purchase request, please wait while we process your purchase. You can check the progress by clicking the button below and inputting your <b>PURCHASE CODE</b> $nl";}else{$purhaseMailConfirmLink='
						<div style="background-color: black; color: #fff; text-align: center; padding: 7px; font-weight: bold; margin-top: 10px;">
							<a href="http://'.$GLOBALS['globvar_address'].'/ordercheck.php?ocode='.$codePurchase.'">CLICK HERE TO CONFIRM YOUR PURCHASE</a>
						</div>
						';$purchaseMailContentText="We have received your purchase request, please check the detail below and finish your purchase by confirming your payment details by clicking the button below and inputting your <b>PURCHASE CODE</b> $nl";}}$purchaseMailContent="<div style='border-bottom: 1px solid #3a3a3c; padding-bottom: 10px; margin-bottom: 20px; text-align: center;'>
<a href='http://".$GLOBALS['globvar_address']."'><img src='".$GLOBALS['ue_globvar_purchase_emails_logo']."' alt='".$GLOBALS['globvar_sitename']."' title='".$GLOBALS['globvar_sitename']."' /></a>
</div>
Dear $purchaseMailName,$nl
".$purchaseMailContentText."
$nl
<table width='100%' style='font-family: Arial, Helvetica, sans-serif; font-size: 12px;'>
<tr>
<td>
	<b>Transaction Date</b>
</td>
<td width='10' align='center'>
	:
</td>
<td>
	$purchaseMailDate
</td>
<td>
	<b>Purchase Code</b>
</td>
<td width='10' align='center'>
	:
</td>
<td>
	$codePurchase
</td>
</tr>
<tr>
<td>
	<b>Name</b>
</td>
<td width='10' align='center'>
	:
</td>
<td>
	$purchaseMailName
</td>
<td>
	<b>Email</b>
</td>
<td width='10' align='center'>
	:
</td>
<td>
	$purchaseMailSendTo
</td>
</tr>
</table>
<br />
<br />
<table cellpadding='5' cellspacing='0' width='100%' style='font-family: Arial, Helvetica, sans-serif; font-size: 12px;'>
<tr style='background-color: #eeeeee; font-weight: bold;'>
<td style='border-top: 1px solid #cccccc; border-bottom: 1px solid #cccccc;'>
	PRODUCT NAME
</td>
<td align='center' width='125' style='border-top: 1px solid #cccccc; border-bottom: 1px solid #cccccc;'>
	PRICE
</td>
<td width='75' align='center' style='border-top: 1px solid #cccccc; border-bottom: 1px solid #cccccc;'>
	QTY
</td>
<td width='125' align='right' style='border-top: 1px solid #cccccc; border-bottom: 1px solid #cccccc;'>
	TOTAL
</td>
</tr>
$purchaseMailPrdList
$purchaseMailDiscountStr
<tr style='background-color: #eeeeee;'>
<td align='right' style='border-bottom: 1px solid #cccccc;' colspan='3'>
	$purchaseMailShipTo
</td>
<td align='right' style='border-bottom: 1px solid #cccccc;'>
	".moneyFormat(getShippingPrice($codePurchase),$GLOBALS['ue_globvar_currency'])."
</td>
</tr>
<tr style='background-color: #eeeeee;'>
<td align='right' style='border-bottom: 1px solid #cccccc;' colspan='3'>
	Payment Code
</td>
<td align='right' style='border-bottom: 1px solid #cccccc;'>
	$purchaseMailPayCode
</td>
</tr>
$purchaseMailCreditsUseStr
<tr style='background-color: #eeeeee; font-weight: bold;'>
<td align='right' style='border-bottom: 1px solid #cccccc;' colspan='3'>
	GRAND TOTAL
</td>
<td align='right' style='border-bottom: 1px solid #cccccc;'>
	".moneyFormat(getPurchaseGrandTotal($codePurchase),$GLOBALS['ue_globvar_currency'])."
</td>
</tr>
</table>
<br />
<br />
<table width='100%' style='font-family: Arial, Helvetica, sans-serif; font-size: 12px;'>
<tr>
<td width='50%' valign='top'>
	<table style='font-family: Arial, Helvetica, sans-serif; font-size: 12px;'>
		<tr>
			<td colspan='3' style='font-weight: bold;'>
				Shipping Details
			</td>
		</tr>
		<tr>
			<td width='100'>
				Name
			</td>
			<td width='10' align='center'>
				:
			</td>
			<td>
				$purchaseMailName
			</td>
		</tr>
		<tr>
			<td>
				Shipping To
			</td>
			<td width='10' align='center'>
				:
			</td>
			<td>
				".$shippingEditRes['shipping_area']."
			</td>
		</tr>
		<tr>
			<td>
				Shipping City
			</td>
			<td width='10' align='center'>
				:
			</td>
			<td>
				".$shippingEditRes['shipping_name']."
			</td>
		</tr>
		<tr>
			<td>
				Shipping Address
			</td>
			<td width='10' align='center'>
				:
			</td>
			<td>
				$purchaseMailAddress
			</td>
		</tr>
		<tr>
			<td>
				Phone #
			</td>
			<td width='10' align='center'>
				:
			</td>
			<td>
				$purchaseTelp
			</td>
		</tr>
	</table>
</td>
<td valign='top'>
	<table style='font-family: Arial, Helvetica, sans-serif; font-size: 12px;'>
		<tr>
			<td colspan='3' style='font-weight: bold;'>
				Payment Method
			</td>
		</tr>
		<tr>
			<td colspan='3'>
				<div style='font-weight: bold;'>".$bankDataRes['bank_name']."</div>
				".ueWritePage($bankDataRes['bank_desc'],true)."
			</td>
		</tr>
	</table>
</td>
</tr>
</table>
$purhaseMailConfirmLink
$nl
<div style='font-family: Arial, Helvetica, sans-serif; font-size: 12px;'>
Please don't hesitate to Contact Us if there's any questions.$nl
$nl
Thank you,$nl
$nl
$nl
".ucfirst($GLOBALS['globvar_address'])."</div>";sendMail($purchaseMailSendTo,$GLOBALS['globvar_sitecontacts']['email3'],$purchaseMailTitle,$purchaseMailContent);}if($ueAddPurchaseAdminEmailNotif==true&&$GLOBALS['ue_globvar_purchase_emails_admin_notif']==true&&$GLOBALS['ue_mysql_connect_mode']=='prd'){$purchaseMailSendToAdmin=$GLOBALS['globvar_sitecontacts']['email3'];$purchaseMailDateAdmin=unixtodate($currentServerTime);$purchaseMailTitleAdmin=ucfirst($GLOBALS['globvar_address']).' Purchase Notification - #'.$codePurchase;$purchaseMailNameAdmin=$purchaseUserName;$purchaseMailBuyerAdmin=$purchaseUserEmail;$messageIpAdmin=ueGetClientIp();$messageQueryAdmin="==========================================$nl
$purchaseMailTitleAdmin $nl
==========================================$nl
IP Address : $messageIpAdmin $nl
Name : $purchaseMailNameAdmin $nl
Alamat : ".$auPostedElements['address']." $nl
No Telp : $purchaseTelp $nl
Email : $purchaseMailBuyerAdmin $nl
Purchase Code : $codePurchase $nl
Total : ".moneyFormat(getPurchaseGrandTotal($codePurchase,'pure'),$GLOBALS['ue_globvar_currency'])." $nl
Ongkir : ".moneyFormat($getShippPriceFin,$GLOBALS['ue_globvar_currency'])." $nl
Grand Total : ".moneyFormat(getPurchaseGrandTotal($codePurchase),$GLOBALS['ue_globvar_currency'])." $nl
==========================================$nl
END OF MESSAGE $nl
==========================================
";sendMail($purchaseMailSendToAdmin,'ue@'.$GLOBALS['globvar_address'],$purchaseMailTitleAdmin,$messageQueryAdmin);}if($bankDataRes['bank_paygate']!=''){header("Location: ue-paygate/".$bankDataRes['bank_paygate']."?pcode=".$codePurchase);exit();}}if(count($ueReturn)>0){return $ueReturn;}else if($addPurchaseFinalQue){return $codePurchase;}else{return false;}}function ueConfirmPurchase($ueConfirmPurchaseId,$ueConfirmPurchaseName,$ueConfirmPurchaseAmount,$ueConfirmPurchasePayDate,$ueConfirmPurchaseNotifAdminFlag=true){$currentServerTime=time();$namaTableDatabase='purchase';$editDetailQue=ue_query("SELECT * FROM ".$namaTableDatabase." WHERE ".$namaTableDatabase."_id = '".$ueConfirmPurchaseId."' LIMIT 1");@ $editDetailRes=ue_fetch_array($editDetailQue);$editQueryStr="UPDATE ".$namaTableDatabase." SET
							".$namaTableDatabase."_transfername = '".$ueConfirmPurchaseName."',
							".$namaTableDatabase."_transferamount = '".$ueConfirmPurchaseAmount."',
							".$namaTableDatabase."_paydate = '".$ueConfirmPurchasePayDate."',
							".$namaTableDatabase."_status = 'c'
						WHERE ".$namaTableDatabase."_code = '".$editDetailRes['purchase_code']."'
		";@ $grandQueryResult=ue_query($editQueryStr);if($grandQueryResult){if($ueConfirmPurchaseNotifAdminFlag==true&&$GLOBALS['ue_globvar_purchase_emails_admin_notif']==true&&$GLOBALS['ue_mysql_connect_mode']=='prd'){if($editDetailRes['bank_id']>0){$approveBankQue=ue_query("SELECT * FROM bank WHERE bank_id = '".$editDetailRes['bank_id']."' LIMIT 1");$approveBankRes=ue_fetch_array($approveBankQue);$bankName=$approveBankRes['bank_name'];}else{$bankName='-';}$codePurchase=$editDetailRes['purchase_code'];$purchaseMailSendToAdmin=$GLOBALS['globvar_sitecontacts']['email3'];$purchaseMailDateAdmin=unixtodate($ueConfirmPurchasePayDate);$purchaseMailTitleAdmin=ucfirst($GLOBALS['globvar_address']).' Purchase Confirmation Notification - #'.$codePurchase;$purchaseMailNameAdmin=$ueConfirmPurchaseName;$purchaseMailBuyerAdmin=$ueConfirmPurchaseAmount;$messageIpAdmin=ueGetClientIp();$messageQueryAdmin="==========================================$nl
$purchaseMailTitleAdmin $nl
==========================================$nl
IP Address : $messageIpAdmin $nl
Purchase Code : $codePurchase $nl
Purchase Name : ".$editDetailRes['purchase_name']." $nl
Purchase Email : ".$editDetailRes['purchase_email']." $nl
Purchase Grand Total : ".moneyFormat(getPurchaseGrandTotal($codePurchase),$GLOBALS['ue_globvar_currency'])." $nl
==========================================$nl
Payment Method : ".$bankName." $nl
Payment Name : $purchaseMailNameAdmin $nl
Payment Amount : $purchaseMailBuyerAdmin $nl
Payment Date : ".$purchaseMailDateAdmin." $nl
==========================================$nl
END OF MESSAGE $nl
==========================================
";sendMail($purchaseMailSendToAdmin,'ue@'.$GLOBALS['globvar_address'],$purchaseMailTitleAdmin,$messageQueryAdmin);}return true;}else{return false;}}function ueRejectPurchase($ueRejectPurchaseId){$currentServerTime=time();$namaTableDatabase='purchase';$editDetailQue=ue_query("SELECT * FROM ".$namaTableDatabase." WHERE ".$namaTableDatabase."_id = '".$ueRejectPurchaseId."' LIMIT 1");@ $editDetailRes=ue_fetch_array($editDetailQue);$editQueryStr="UPDATE ".$namaTableDatabase." SET
							".$namaTableDatabase."_editdate = '$currentServerTime',
							".$namaTableDatabase."_transfername = '',
							".$namaTableDatabase."_transferamount = '0',
							".$namaTableDatabase."_status = 'x',
							".$namaTableDatabase."_trackingcode = '',
							".$namaTableDatabase."_paydate = '0'
						WHERE ".$namaTableDatabase."_code = '".$editDetailRes['purchase_code']."'
		";@ $grandQueryResult=ue_query($editQueryStr);if($grandQueryResult){return true;}else{return false;}}function ueApprovePurchase($ueApprovePurchaseId,$ueApprovePurchaseTrackingCode,$ueApprovePurchaseNotifAdminFlag=true,$ueApprovePurchaseNotifUserFlag=true){$ueReturn=array();$currentServerTime=time();$namaTableDatabase='purchase';$editDetailQue=ue_query("SELECT * FROM ".$namaTableDatabase." WHERE ".$namaTableDatabase."_id = '".$ueApprovePurchaseId."' LIMIT 1");@ $editDetailRes=ue_fetch_array($editDetailQue);$checkUserCanceledQue=ue_query("SELECT usercredithistory_id FROM usercredithistory WHERE purchase_id = '".$ueApprovePurchaseId."' AND usercredithistory_type = 'CR' LIMIT 1");@ $checkUserCanceledRes=ue_num_rows($checkUserCanceledQue);if($checkUserCanceledRes>0){$ueReturn['err']='User Have Already Canceled This Purchase';}else{if($editDetailRes[$namaTableDatabase."_status"]=='a'){if($editDetailRes[$namaTableDatabase."_trackingcode"]!=$ueApprovePurchaseTrackingCode){$editQueryStr="UPDATE ".$namaTableDatabase." SET
										".$namaTableDatabase."_trackingcode = '".$ueApprovePurchaseTrackingCode."'
									WHERE ".$namaTableDatabase."_code = '".$editDetailRes['purchase_code']."'
					";$ueReturn['sta']='Tracking Code Updated';}else{$ueReturn['err']='Already Approved';}$ueApprovePurchaseNotifUserFlag=false;}else{$editQueryStr="UPDATE ".$namaTableDatabase." SET
									".$namaTableDatabase."_editdate = '$currentServerTime',
									".$namaTableDatabase."_status = 'a',
									".$namaTableDatabase."_trackingcode = '".$ueApprovePurchaseTrackingCode."'
								WHERE ".$namaTableDatabase."_code = '".$editDetailRes['purchase_code']."'
				";if($editDetailRes['promo_id']>0){$promoCheckQue=ue_query("SELECT * FROM promo WHERE promo_id = '".$editDetailRes['promo_id']."' LIMIT 1");@ $promoCheckRes=ue_fetch_array($promoCheckQue);if($promoCheckRes['promo_mode']==4){if($editDetailRes['user_id']>0){$userDetailQue=ue_query("SELECT * FROM user WHERE user_id = '".$editDetailRes['user_id']."' LIMIT 1");@ $userDetailRes=ue_fetch_array($userDetailQue);$creditSta='CR';$creditEntry=$currentServerTime;$creditUsrId=$editDetailRes['user_id'];$creditAdmId='0';$creditMutasi=(int)$promoCheckRes['promo_value'];$creditBefore=(int)$userDetailRes['user_credit'];$creditAfter=$creditBefore + $creditMutasi;$creditDesc='Purchase #'.$editDetailRes['purchase_code'].' using "'.$promoCheckRes['promo_name'].'" approved';ue_query("INSERT INTO usercredithistory VALUES(
								'',
								'$creditEntry',
								'$creditUsrId',
								'".$editDetailRes['purchase_id']."',
								'$creditAdmId',
								'$creditMutasi',
								'$creditBefore',
								'$creditSta',
								'$creditDesc'
							)");$refundQueryStr="UPDATE user SET
												user_credit = '".$creditAfter."'
											WHERE user_id = '".$editDetailRes['user_id']."' LIMIT 1
							";@ $refundQueryResult=ue_query($refundQueryStr);}}}}}@ $grandQueryResult=ue_query($editQueryStr);if(count($ueReturn)>0){return $ueReturn;}else if($grandQueryResult){if($GLOBALS['ue_globvar_purchase_emails']==true&&$ueApprovePurchaseNotifUserFlag==true&&$GLOBALS['ue_mysql_connect_mode']=='prd'){$purchaseMailSendTo=$editDetailRes["$namaTableDatabase".'_email'];$purchaseMailDate=unixtodate($currentServerTime);$purchaseMailTitle='Payment Approval - '.ucfirst($GLOBALS['globvar_address']).' Purchase #'.$editDetailRes['purchase_code'];$purchaseMailName=$editDetailRes["$namaTableDatabase".'_name'];$nl='<br />';$purchaseMailContent="<div style='border-bottom: 1px solid #3a3a3c; padding-bottom: 10px; margin-bottom: 20px; text-align: center;'>
				<a href='http://".$GLOBALS['globvar_address']."'><img src='".$GLOBALS['ue_globvar_purchase_emails_logo']."' alt='".$GLOBALS['globvar_sitename']."' title='".$GLOBALS['globvar_sitename']."' /></a>
				</div>
				Dear $purchaseMailName,$nl
				We have received your payment for purchase #".$editDetailRes['purchase_code']."$nl
				Currently we are processing your purchase. You can find more info of your purchase on http://".$GLOBALS['globvar_address']."/ordercheck$nl
				$nl
				Thank You,
				$nl
				$nl".ucfirst($GLOBALS['globvar_address']);sendMail($purchaseMailSendTo,$GLOBALS['globvar_sitecontacts']['email3'],$purchaseMailTitle,$purchaseMailContent);}if($ueApprovePurchaseNotifAdminFlag==true&&$GLOBALS['ue_globvar_purchase_emails_admin_notif']==true&&$GLOBALS['ue_mysql_connect_mode']=='prd'){if($editDetailRes['bank_id']>0){$approveBankQue=ue_query("SELECT * FROM bank WHERE bank_id = '".$editDetailRes['bank_id']."' LIMIT 1");$approveBankRes=ue_fetch_array($approveBankQue);$bankName=$approveBankRes['bank_name'];}else{$bankName='-';}$codePurchase=$editDetailRes['purchase_code'];$purchaseMailSendToAdmin=$GLOBALS['globvar_sitecontacts']['email3'];$purchaseMailDateAdmin=unixtodatefull($currentServerTime);$purchaseMailTitleAdmin=ucfirst($GLOBALS['globvar_address']).' Purchase Automatic-Approval Notification - #'.$codePurchase;$purchaseMailNameAdmin=$editDetailRes["$namaTableDatabase".'_name'];$messageIpAdmin=ueGetClientIp();$messageQueryAdmin="==========================================$nl
$purchaseMailTitleAdmin $nl
==========================================$nl
IP Address : $messageIpAdmin $nl
Purchase Code : $codePurchase $nl
Purchase Name : ".$editDetailRes['purchase_name']." $nl
Purchase Email : ".$editDetailRes['purchase_email']." $nl
Purchase Grand Total : ".moneyFormat(getPurchaseGrandTotal($codePurchase),$GLOBALS['ue_globvar_currency'])." $nl
==========================================$nl
Payment Method : ".$bankName." $nl
Payment Date : ".$purchaseMailDateAdmin." $nl
==========================================$nl
END OF MESSAGE $nl
==========================================
";sendMail($purchaseMailSendToAdmin,'ue@'.$GLOBALS['globvar_address'],$purchaseMailTitleAdmin,$messageQueryAdmin);}return true;}else{return false;}}function ueCancelPurchase($ueCancelPurchaseId,$ueCancelPurchaseRefundFlag=true,$ueCancelPurchaseNotifAdminFlag=true){$currentServerTime=time();$uePurchaseTable='purchase';$purchaseDetailDataQue=ue_query("SELECT * FROM purchase WHERE purchase_id = '$ueCancelPurchaseId' AND (purchase_status = 'r' OR purchase_status = 'x') LIMIT 1");@ $purchaseDetailDataRes=ue_fetch_array($purchaseDetailDataQue);if($purchaseDetailDataRes){$editQueryStr="UPDATE ".$uePurchaseTable." SET
								".$uePurchaseTable."_editdate = '$currentServerTime',
								".$uePurchaseTable."_status = 'z',
								".$uePurchaseTable."_trackingcode = '',
								".$uePurchaseTable."_paydate = '0'
							WHERE ".$uePurchaseTable."_code = '".$purchaseDetailDataRes['purchase_code']."'
			";@ $grandQueryResult=ue_query($editQueryStr);}if($grandQueryResult){if($ueCancelPurchaseRefundFlag){if($purchaseDetailDataRes['user_id']>0&&$purchaseDetailDataRes['purchase_creditsused']>0){$userDetailQue=ue_query("SELECT * FROM user WHERE user_id = '".$purchaseDetailDataRes['user_id']."' LIMIT 1");@ $userDetailRes=ue_fetch_array($userDetailQue);$creditSta='CR';$creditEntry=$currentServerTime;$creditUsrId=$purchaseDetailDataRes['user_id'];$creditAdmId='0';$creditMutasi=$purchaseDetailDataRes['purchase_creditsused'];$creditBefore=$userDetailRes['user_credit'];$creditAfter=$creditBefore + $creditMutasi;$creditDesc='Purchase #'.$purchaseDetailDataRes['purchase_code'].' Canceled';ue_query("INSERT INTO usercredithistory VALUES(
						'',
						'$creditEntry',
						'$creditUsrId',
						'".$purchaseDetailDataRes['purchase_id']."',
						'$creditAdmId',
						'$creditMutasi',
						'$creditBefore',
						'$creditSta',
						'$creditDesc'
					)");$refundQueryStr="UPDATE user SET
										user_credit = '".$creditAfter."'
									WHERE user_id = '".$purchaseDetailDataRes['user_id']."' LIMIT 1
					";@ $refundQueryResult=ue_query($refundQueryStr);}if($purchaseDetailDataRes['promo_id']>0){$promoDetailQue=ue_query("SELECT * FROM promo WHERE promo_id = '".$purchaseDetailDataRes['promo_id']."' LIMIT 1");@ $promoDetailRes=ue_fetch_array($promoDetailQue);if($promoDetailRes['promo_enabled']=='d'&&$promoDetailRes['promo_type']=='1'){$reactiveQueryStr="UPDATE promo SET
											promo_enabled = 'e'
										WHERE promo_id = '".$promoDetailRes['promo_id']."' LIMIT 1
						";@ $reactiveQueryResult=ue_query($reactiveQueryStr);}}}if($ueCancelPurchaseNotifAdminFlag==true&&$GLOBALS['ue_globvar_purchase_emails_admin_notif']==true&&$GLOBALS['ue_mysql_connect_mode']=='prd'){$purchaseMailSendToAdmin=$GLOBALS['globvar_sitecontacts']['email3'];$purchaseMailDateAdmin=unixtodate($currentServerTime);$purchaseMailTitleAdmin=ucfirst($GLOBALS['globvar_address']).' Purchase Cancellation By User - #'.$purchaseDetailDataRes['purchase_code'];$purchaseMailNameAdmin=$purchaseDetailDataRes['purchase_name'];$purchaseMailBuyerAdmin=$purchaseDetailDataRes['purchase_email'];$messageIpAdmin=ueGetClientIp();$messageQueryAdmin="==========================================$nl
$purchaseMailTitleAdmin $nl
==========================================$nl
User Status : $usermode $nl
IP Address : $messageIpAdmin $nl
Name : $purchaseMailNameAdmin $nl
Email : $purchaseMailBuyerAdmin $nl
Purchase Code : ".$purchaseDetailDataRes['purchase_code']." $nl
Grand Total : ".moneyFormat(getPurchaseGrandTotal($purchaseDetailDataRes['purchase_code']),$GLOBALS['ue_globvar_currency'])." $nl
==========================================$nl
THIS PURCHASE HAVE BEEN CANCELED BY THE USER $nl
PLEASE DO NOT APPROVE THIS PURCHASE $nl
ALL CREDIT AND VOUCHER USED HAVE BEEN REVERTED $nl
==========================================
";sendMail($purchaseMailSendToAdmin,'ue@'.$GLOBALS['globvar_address'],$purchaseMailTitleAdmin,$messageQueryAdmin);}}if($grandQueryResult){return true;}else{return false;}}function promoVoucherPrice($promoVoucherPricePromoId,$promoVoucherPriceTotal='none'){$voucherCode=ue_real_escape_string($_POST['voucherCode']);$voucherCodeQue=ue_query("SELECT * FROM promo WHERE
										promo_id = '$promoVoucherPricePromoId'
		LIMIT 1");if(@ue_num_rows($voucherCodeQue)>0){$voucherCodeRes=ue_fetch_array($voucherCodeQue);switch($voucherCodeRes['promo_mode']){case '2':if($promoVoucherPriceTotal=='none'){$numberOfDiscountRet=$voucherCodeRes['promo_value'];}else if($voucherCodeRes['promo_value']>$promoVoucherPriceTotal){$numberOfDiscountRet=$promoVoucherPriceTotal;}else{$numberOfDiscountRet=$voucherCodeRes['promo_value'];}if($voucherCodeRes['promo_maxvalue']>0&&$voucherCodeRes['promo_maxvalue']<$voucherCodeRes['promo_value']){$numberOfDiscountRet=$voucherCodeRes['promo_maxvalue'];}break;case '3':$numberOfDiscountTemp=ceil(($voucherCodeRes['promo_value']/100)*$promoVoucherPriceTotal);if($promoVoucherPriceTotal=='none'){$numberOfDiscountRet=$numberOfDiscountTemp;}else if($numberOfDiscountTemp>$promoVoucherPriceTotal){$numberOfDiscountRet=$promoVoucherPriceTotal;}else{$numberOfDiscountRet=$numberOfDiscountTemp;}if($voucherCodeRes['promo_maxvalue']>0&&$voucherCodeRes['promo_maxvalue']<$numberOfDiscountTemp){$numberOfDiscountRet=$voucherCodeRes['promo_maxvalue'];}break;default:$numberOfDiscountRet=false;break;}return $numberOfDiscountRet;}}function getPurchaseGrandTotal($getPurchaseGrandTotalPurchaseCode,$getPurchaseGrandTotalMode='all'){$getPurchaseGrandTotalReturn=0;$getPurchaseGrandTotalShippingPrice=0;$getPurchaseGrandTotalShippingPaycode=0;$getPurchaseGrandTotalShippingDiscount=0;$getPurchaseGrandTotalCreditsUsed=0;$getPurchaseGrandTotalWeight=0;$getPurchaseGrandTotalReturnQue=ue_query("SELECT * FROM purchase WHERE purchase_code = '$getPurchaseGrandTotalPurchaseCode'");while($getPurchaseGrandTotalReturnRes=ue_fetch_array($getPurchaseGrandTotalReturnQue)){$getPurchaseGrandTotalReturn+=($getPurchaseGrandTotalReturnRes['purchase_price']*$getPurchaseGrandTotalReturnRes['purchase_quantity']);$getPurchaseGrandTotalShippingPrice=$getPurchaseGrandTotalReturnRes['purchase_shipprice'];$getPurchaseGrandTotalShippingPaycode=$getPurchaseGrandTotalReturnRes['purchase_paycode'];$getPurchaseGrandTotalShippingDiscount=$getPurchaseGrandTotalReturnRes['purchase_discount'];$getPurchaseGrandTotalCreditsUsed=$getPurchaseGrandTotalReturnRes['purchase_creditsused'];$getPurchaseGrandTotalWeight+=$getPurchaseGrandTotalReturnRes['purchase_weight'];$getPurchaseGrandTotalShipType=$getPurchaseGrandTotalReturnRes['purchase_shiptype'];}if($GLOBALS['ue_globvar_purchase_shipweight']){if($GLOBALS['ue_globvar_shipping_urgent_by_weight']==false&&$getPurchaseGrandTotalShipType=='shipping_urgent'){$getPurchaseGrandTotalShippingPrice=$getPurchaseGrandTotalShippingPrice;}else{$getPurchaseGrandTotalShippingPrice=$getPurchaseGrandTotalShippingPrice*ceil($getPurchaseGrandTotalWeight);}}else{$getPurchaseGrandTotalShippingPrice=$getPurchaseGrandTotalShippingPrice;}if($getPurchaseGrandTotalReturn>$getPurchaseGrandTotalShippingDiscount){$getPurchaseGrandTotalReturn-=$getPurchaseGrandTotalShippingDiscount;}else{$getPurchaseGrandTotalReturn=0;}switch($getPurchaseGrandTotalMode){case 'pure':break;case 'noship':$getPurchaseGrandTotalReturn+=$getPurchaseGrandTotalShippingPaycode;break;case 'nopaycode':$getPurchaseGrandTotalReturn+=$getPurchaseGrandTotalShippingPrice;break;case 'all':$getPurchaseGrandTotalReturn+=$getPurchaseGrandTotalShippingPrice;$getPurchaseGrandTotalReturn+=$getPurchaseGrandTotalShippingPaycode;break;}if($getPurchaseGrandTotalReturn>$getPurchaseGrandTotalCreditsUsed){$getPurchaseGrandTotalReturn-=$getPurchaseGrandTotalCreditsUsed;}else{$getPurchaseGrandTotalReturn=0;}return $getPurchaseGrandTotalReturn;}function getShippingPrice($getShippingPricePurchaseCode){$getShippingPriceRet=0;$getPurchaseGrandTotalWeight=0;$getPurchaseGrandTotalReturnQue=ue_query("SELECT * FROM purchase WHERE purchase_code = '$getShippingPricePurchaseCode'");while($getPurchaseGrandTotalReturnRes=ue_fetch_array($getPurchaseGrandTotalReturnQue)){$getPurchaseGrandTotalShippingPrice=$getPurchaseGrandTotalReturnRes['purchase_shipprice'];$getPurchaseGrandTotalWeight+=$getPurchaseGrandTotalReturnRes['purchase_weight'];$getPurchaseGrandTotalShipType=$getPurchaseGrandTotalReturnRes['purchase_shiptype'];}if($getPurchaseGrandTotalShippingPrice<=0){$getShippingPriceRet='FREE';}else{if($GLOBALS['ue_globvar_purchase_shipweight']){if($GLOBALS['ue_globvar_shipping_urgent_by_weight']==false&&$getPurchaseGrandTotalShipType=='shipping_urgent'){$getShippingPriceRet=$getPurchaseGrandTotalShippingPrice;}else{$getShippingPriceRet=$getPurchaseGrandTotalShippingPrice*ceil($getPurchaseGrandTotalWeight);}}else{$getShippingPriceRet=$getPurchaseGrandTotalShippingPrice;}}return $getShippingPriceRet;}function ueCountPerproductDiscount($ueCountPercentInit,$ueCountPerproductDiscountPromoId){$currentServerTimePerPrd=time();$uePerPrdDiscQue=ue_query("SELECT * FROM promo WHERE
										promo_id = '$ueCountPerproductDiscountPromoId' AND
										promo_enabled = 'e' AND
										promo_expiry > '$currentServerTimePerPrd'
		LIMIT 1");@ $uePerPrdDiscRes=ue_fetch_array($uePerPrdDiscQue);if($uePerPrdDiscRes){switch($uePerPrdDiscRes['promo_mode']){case '2':$numberOfDiscountRet=(int)($ueCountPercentInit - $uePerPrdDiscRes['promo_value']);break;case '3':$numberOfDiscountTemp=ceil(($uePerPrdDiscRes['promo_value']/100)*$ueCountPercentInit);$numberOfDiscountRet=(int)($ueCountPercentInit - $numberOfDiscountTemp);break;default:$numberOfDiscountRet=false;break;}return $numberOfDiscountRet;}else{return false;}}function checkPrdSold($checkPrdSoldPrdId,$checkPrdSoldClrId='0',$checkPrdSoldSizeId='0'){if($checkPrdSoldClrId>0&&$checkPrdSoldSizeId>0){$checkPrdSoldQue=ue_query("SELECT productsold_id FROM productsold WHERE
				product_id = '$checkPrdSoldPrdId' AND
				productcolor_id = '$checkPrdSoldClrId' AND
				productsize_id = '$checkPrdSoldSizeId'
			LIMIT 0,1
			");@ $checkPrdSoldRes=(int)ue_num_rows($checkPrdSoldQue);if($checkPrdSoldRes==0){return 'a';}else{return 's';}}else{$checkPrdSoldColorQue=ue_query("SELECT productcolor_id FROM productcolor WHERE product_id = '$checkPrdSoldPrdId'");@ $checkPrdSoldColorNum=(int)ue_num_rows($checkPrdSoldColorQue);$checkPrdSoldSizeQue=ue_query("SELECT productsize_id FROM productsize WHERE product_id = '$checkPrdSoldPrdId'");@ $checkPrdSoldSizeNum=(int)ue_num_rows($checkPrdSoldSizeQue);$checkPrdSoldVariations=($checkPrdSoldColorNum*$checkPrdSoldSizeNum);$checkPrdSoldQue=ue_query("SELECT productsold_id FROM productsold WHERE product_id = '$checkPrdSoldPrdId'");@ $checkPrdSoldNum=(int)ue_num_rows($checkPrdSoldQue);if($checkPrdSoldColorNum==0||$checkPrdSoldSizeNum==0){return 'i';}else{if($checkPrdSoldNum==0){return 'a';}else if($checkPrdSoldVariations>$checkPrdSoldNum){return 'p';}else{return 's';}}}}?>