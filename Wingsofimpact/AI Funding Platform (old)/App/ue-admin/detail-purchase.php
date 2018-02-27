<?php
	include('head.php');
	
	$namaTableDatabase	= 'purchase';
	$namaPageUtama		= 'purchase.php';
	$namaFolderUpload	= '';						// If any
	$maxFilePxUpload	= '';						// If any
	
	$pageType 			= 'detail';					// list OR detail OR overview
	$id					= ue_real_escape_string($_GET['id']);
	$pageTitle			= $currentCheckAccessRes['adminsitepages_mainmenuname'];
	$namaHalamanEdit	= currentPage();
	
	if($_GET['detailmode'] == 'edit') {
		$detailmodeeditQue = ue_query("SELECT * FROM ".$namaTableDatabase." WHERE ".$namaTableDatabase."_id = '".$id."' LIMIT 1");
		if(!$detailmodeeditRes = ue_fetch_array($detailmodeeditQue)) {
			header("Location: $namaPageUtama?err=Invalid Reference ID");
			exit();
		}
	}
?>
<?php
	include('top.php');
?>
<?php
	include('left.php');
?>
<div class="transFullWidthWrapper" id="topMenu">
    <a href="<?php echo $namaPageUtama?>" style="background-image: url(images/icon/viewall.png);">VIEW ALL</a>
    <a href="<?php echo $namaPageUtama?><?php echo pageParamsFormat($pageParamsArr,array('mode' => 'r'))?>" style="background-image: url(images/icon/requested.png);">VIEW REQUESTS</a>
    <a href="<?php echo $namaPageUtama?><?php echo pageParamsFormat($pageParamsArr,array('mode' => 'c'))?>" style="background-image: url(images/icon/confirmed.png);">VIEW CONFIRMED</a>
    <a href="<?php echo $namaPageUtama?><?php echo pageParamsFormat($pageParamsArr,array('mode' => 'a'))?>" style="background-image: url(images/icon/approved.png);">VIEW APPROVED</a>
    <a href="<?php echo $namaPageUtama?><?php echo pageParamsFormat($pageParamsArr,array('mode' => 's'))?>" style="background-image: url(images/icon/shippedIcon.png);">VIEW SHIPPED</a>
    <a href="<?php echo $namaPageUtama?><?php echo pageParamsFormat($pageParamsArr,array('mode' => 'x'))?>" style="background-image: url(images/icon/rejected.png);">VIEW REJECTED</a>
    <a href="<?php echo $namaPageUtama?><?php echo pageParamsFormat($pageParamsArr,array('mode' => 'z'))?>" style="background-image: url(images/icon/canceled.png);">VIEW CANCELED</a>
    <a href="overview.php?ovtable=<?php echo $namaTableDatabase?>&ovtitle=<?php echo $currentCheckAccessRes['adminsitepages_mainmenuname']?>&ovmainpage=<?php echo $namaPageUtama?>" style="background-image: url(images/icon/stat1.png);">OVERVIEW</a>
    <a href="action-truncate.php" style="background-image: url(images/icon/destroy.png);" <?php echo tooltip('Deletes Purchase Requests Older Than 30 Days',275)?> onclick="return confirmSubmit()">TRUNCATE</a>
    <a href="javascript:$('#purchasePdfForm').submit();" style="background-image: url(images/icon/generatePdf.png);" <?php echo tooltip('Generate a PDF document of this purchase',275)?>>EXPORT PDF</a>
    <div class="clear"></div>
</div>
<?php
	include('ue-includes/ue-currentPageInfo.php');
?>
<div class="transFullWidthWrapper" id="ueFormContainer">
    <div class="tableDetailContainer">
    <form enctype="multipart/form-data" method="post" action="<?php
						if($_GET['purchasecode'] != '') {
		?>action-purchase.php<?php } else { ?>action-confirmpurchase.php<?php } ?>">
        <input type="hidden" name="id" value="<?php echo $id?>" />
        <input type="hidden" name="detailmode" value="<?php echo $_GET['detailmode']?>" />
        <input type="hidden" name="mainpage" value="<?php echo $namaPageUtama?>" />
        <input type="hidden" name="frompage" value="<?php echo currentPage()?>" />
        <input type="hidden" name="pageparam" value="<?php echo pageParamsFormat($pageParamsArr)?>" />
    	<table id="detailPageTable" width="100%">
            <tr>
            	<td colspan="3">
    <div style="background-color: #fff; border: 1px solid #dddddd; margin-bottom: 10px;">
    	<table width="100%">
        	<tr>
            	<td align="center" width="50%">
                	<span style="font-weight: bold;">Purchase Date</span>
                	<div style="font-size: 21px;"><?php echo unixtodatefull($detailmodeeditRes['purchase_entrydate'])?></div>
                </td>
            	<td align="center" width="50%">
                	<span style="font-weight: bold;">Purchase Code</span><br />
                	<div style="font-size: 21px;"><?php echo $detailmodeeditRes['purchase_code']?></div>
                </td>
            </tr>
        </table>
    </div>
    <div style="margin: 10px; margin-top: 0;">
		<?php
            switch($detailmodeeditRes['purchase_status']) {
                case 'x':
                    echo '<span class="purchaseStatusEmblem purchaseStatusRejected">Rejected</span>';
                break;
                case 'r':
                    echo '<span class="purchaseStatusEmblem purchaseStatusRequest">Request</span>';
                break;
                case 'c':
                    echo '<span class="purchaseStatusEmblem purchaseStatusConfirmed">Confirmed</span>';
                break;
                case 'a':
					if($detailmodeeditRes['purchase_trackingcode'] != '') {
						echo '<span class="purchaseStatusEmblem purchaseStatusShipped">Shipped</span>';
					}
					else {
						echo '<span class="purchaseStatusEmblem purchaseStatusApproved">Approved</span>';
					}
                break;
                case 'z':
                    echo '<span class="purchaseStatusEmblem purchaseStatusCanceled">Canceled</span>';
                break;
            }
        ?>
    </div>
    <table width="100%" id="purchaseTable">
    	<tr style="background-color: #ededed;">
        	<?php
				if($_GET['purchasecode'] != '') {
			?>
        	<td width="1" align="center" style="padding: 5px;">
            	#
            </td>
            <?php
				}
				else {
			?>
        	<td width="1" align="center" style="padding: 5px;">
            	#
            </td>
            <?php
				}
			?>
            <td width="1" align="center" style="bpadding: 5px;">
            	ITEM
            </td>
            <td align="center">
            	DESCRIPTION
            </td>
            <td width="100" align="center">
            	COLOR
            </td>
            <td width="100" align="center">
            	SIZE
            </td>
            <td width="100" align="center">
            	PRICE
            </td>
            <td width="100" align="center">
            	QTY
            </td>
            <td width="100" align="center">
            	WEIGHT
            </td>
            <td width="100" align="center">
            	TOTAL
            </td>
        </tr>
        <?php
			$currentPromoId = 0;
			$currentShippingId = 0;
			$currentShippingPrice = 0;
			$currentPurchasePaycode = 0;
			$currentDiscount = 0;
			$currentCreditUsed = 0;
			$currentShipAddress = '';
			$currentBankId = 0;
			$grandWeight = 0;
			$currentPurchaseStatus = '';
			
			$numberOfRows = 0;
			$grandTotal = 0;
			
			$printToPDFArr = array();
		
			//MULTI DATA TABLE POPULATE DATA
			$namaTableDatabase = 'purchase';
			$currentRowNumber = 1;
			$search = ue_real_escape_string($_REQUEST['search']);
			$page = $_GET['page'];
			if($page == '' || $page == 0 || $page == NULL) $page = 1;
			
			$pagePerView = 5;
		
			$mainQueryString = "SELECT * FROM $namaTableDatabase
								INNER JOIN product ON ".$namaTableDatabase.".product_id = product.product_id
								INNER JOIN productsize ON ".$namaTableDatabase.".productsize_id = productsize.productsize_id
								INNER JOIN productcolor ON ".$namaTableDatabase.".productcolor_id = productcolor.productcolor_id
								INNER JOIN productbrand ON product.productbrand_id 	 = productbrand.productbrand_id
								WHERE purchase_code = '".$detailmodeeditRes['purchase_code']."'
			";
			
			//echo $mainQueryString;
			
			//For Page System
			$result = ue_query($mainQueryString);
			@ $jumlahData = ue_num_rows($result);
			
			$index = ($page-1)*$pagePerView;
			
			$mainQueryString = $mainQueryString." ORDER BY ".$namaTableDatabase."_entrydate DESC";
			
			$mainQueryQue = ue_query($mainQueryString);
			while($mainQueryRes = ue_fetch_array($mainQueryQue)) {
				$currentPromoId = $mainQueryRes['promo_id'];
				$currentShippingId = $mainQueryRes['shipping_id'];
				$currentShippingPrice = $mainQueryRes['purchase_shipprice'];
				$currentPurchasePaycode = $mainQueryRes['purchase_paycode'];
				$currentDiscount = $mainQueryRes['purchase_discount'];
				$currentCreditUsed = $mainQueryRes['purchase_creditsused'];
				$currentShipAddress = $mainQueryRes['purchase_address'];
				$currentBankId = $mainQueryRes['bank_id'];
				$currentPurchaseStatus = $mainQueryRes['purchase_status'];
				$grandWeight += $mainQueryRes['purchase_weight'];
				$currentShipType = $mainQueryRes['purchase_shiptype'];
				$currentShipDate = $mainQueryRes['purchase_deliverydate'];
				$currentShipName = $mainQueryRes['purchase_shipname'];
		?>
    	<tr<?php $rowMode = $currentRowNumber % 2; if($rowMode != 1) { echo ' class="even"'; } else { echo ' class="odd"'; } ?>>
        	<?php
				if($_GET['purchasecode'] != '') {
			?>
        	<td>
            	<a onclick="return confirmSubmit()" href="action-delete.php<?php echo $pageParams?>&frompage=<?php echo $namaPageUtama?>&fromtable=<?php echo $namaTableDatabase?>&id=<?php echo $mainQueryRes["$namaTableDatabase".'_id']?>" title="Click To Delete This Item" style="margin: 0; padding: 0;"><img src="images/icon/publish_x.png" /></a>
                <input type="hidden" name="idpurchase[]" value="<?php echo $mainQueryRes["$namaTableDatabase".'_id']?>" />
            </td>
            <?php
				}
				else {
			?>
            <td align="center">
            	<?php echo $currentRowNumber?>
            </td>
            <?php
				}
			?>
        	<td align="center">
				<a id="slimboxTarget" class="ue-zoombox" href="../upload/productImage/<?php echo getImageName($mainQueryRes['product_id'],$mainQueryRes['productcolor_id'])?>" title="<?php echo $detailmodeeditRes["$namaTableDatabase".'_name']?>">
					<img src="../upload/productImageThumb/<?php echo getImageName($mainQueryRes['product_id'],$mainQueryRes['productcolor_id'])?>" width="67" />
				</a>
            </td>
            <td style="padding-left: 10px;">
            	<div class="brandName"><a href="detail-productbrand.php?&id=<?php echo $mainQueryRes['productbrand_id']?>&detailmode=edit"><?php echo $mainQueryRes['productbrand_name']?></a></div>
                <div class="productName"><a href="detail-product.php?&id=<?php echo $mainQueryRes['product_id']?>&detailmode=edit"><?php echo $mainQueryRes['product_name']?></a></div>
            </td>
            <td align="center">
            	<?php echo $mainQueryRes['productcolor_name']?>
            </td>
            <td align="center">
            	<?php echo $mainQueryRes['productsize_name']?>
            </td>
            <td align="center">
            	<?php
					$currentPrice = $mainQueryRes['purchase_price'];
					echo moneyFormat($currentPrice,$ue_globvar_currency);
				?>
            </td>
            <td align="center">
                <?php
					if($_GET['purchasecode'] != '') {
				?>
                <input type="text" name="purchase_quant[]" value="<?php echo $mainQueryRes['purchase_quantity']?>" style="width: 20px; text-align: center;" />
                <?php
					}
					else {
				?>
                	<?php echo $mainQueryRes['purchase_quantity']?>
                <?php
					}
				?>
            </td>
            <td align="center">
                <?php
					if($_GET['purchasecode'] != '') {
				?>
                <input type="text" name="purchase_weight[]" value="<?php echo $mainQueryRes['purchase_weight']?>" style="width: 50px; text-align: center;" />
                <?php
					}
					else {
				?>
                	<?php echo $mainQueryRes['purchase_weight']?>
                <?php
					}
				?>
            </td>
            <td align="center">
            	<?php
					$grandTotalQty += $cartSizeVal;
					$currentItemTotal = $currentPrice*$mainQueryRes['purchase_quantity'];
					$grandTotal += $currentItemTotal;
					echo moneyFormat($currentItemTotal,$ue_globvar_currency);
				?>
            </td>
        </tr>
        <?php
				$currentRowNumber++;
				
				// Export to PDF Data START
				$printToPDFCurImgURL = '<img src="../../../upload/productImageThumb/'.getImageName($mainQueryRes['product_id'],$mainQueryRes['productcolor_id']).'" width="65" />';
				$printToPDFCurPrdName = '<b>'.$mainQueryRes['productbrand_name'].'</b> '.$mainQueryRes['product_name'];
				$printToPDFCurEachPrice = moneyFormat($currentPrice,$ue_globvar_currency);
				$printToPDFCurItemTotalPrice = moneyFormat($currentItemTotal,$ue_globvar_currency);
					
				$printToPDFArr[] = array(
					'image' => $printToPDFCurImgURL,
					'desc' => $printToPDFCurPrdName,
					'color' => $mainQueryRes['productcolor_name'],
					'size' => $mainQueryRes['productsize_name'],
					'price' => $printToPDFCurEachPrice,
					'qty' => $mainQueryRes['purchase_quantity'],
					'weight' => $mainQueryRes['purchase_weight'],
					'total' => $printToPDFCurItemTotalPrice
				);
				// Export to PDF Data END
			}
		?>
        <?php	
			$voucherCode = ue_real_escape_string($currentPromoId);
			$voucherCodeQue = ue_query("SELECT * FROM promo WHERE
											promo_id = '$voucherCode'
			LIMIT 1");
			if(@ue_num_rows($voucherCodeQue) > 0) {
				$voucherCodeRes = ue_fetch_array($voucherCodeQue);
		?>
        <tr id="ueShowStatus">
        	<td align="right" colspan="9" style="padding-right: 20px; text-align:center;" class="messageBox">
            	<div>
	            	<span style="font-weight: normal;">Using Promotional Code:</span> <?php echo $voucherCodeRes['promo_name']?>
                </div>
            </td>
        </tr>
        <?php
			}
		?>
        <?php
			if($voucherCodeRes['promo_mode'] == 2 || $voucherCodeRes['promo_mode'] == 3) {
				if($voucherCodeRes['promo_productallow'] == '' || $currentDiscount > 0) {
		?>
        <tr style="font-weight: bold; background-color: #ededed;">
        	<td align="right" colspan="8" style="padding-right: 20px;">
            	<?php
					if($voucherCodeRes['promo_mode'] == 2) {
						$promoRowText = moneyFormat($voucherCodeRes['promo_value'],$ue_globvar_currency).' Price Cut';
					}
					else if($voucherCodeRes['promo_mode'] == 3) {
						$promoRowText = $voucherCodeRes['promo_value'].'% Discount';
					}
					echo $promoRowText;
					if($voucherCodeRes['promo_maxvalue'] > 0) {
						echo ' with maximum of '.moneyFormat($voucherCodeRes['promo_maxvalue'],$ue_globvar_currency);
					}
				?>
            </td>
        	<td align="center">
                <?php
					if($currentDiscount < $grandTotal) {
                		$curDiscount = $currentDiscount;
					}
					else {
						$curDiscount = $grandTotal;
					}
					$grandTotal -= $curDiscount;
					echo '-'.moneyFormat($curDiscount,$ue_globvar_currency);
				?>
            </td>
        </tr>
        <?php
				}
			}
		?>
        <?php
			$shippingEditQue = ue_query("SELECT * FROM shipping WHERE shipping_id = '$currentShippingId' LIMIT 1");
			$shippingEditRes = ue_fetch_array($shippingEditQue);
		?>
        <tr style="font-weight: bold; background-color: #ededed;">
        	<td align="right" colspan="8" style="padding-right: 20px;">
            	Shipping to <?php echo $shippingEditRes['shipping_name']?>, <?php echo $shippingEditRes['shipping_area']?>
            </td>
        	<td align="center">
            	<?php
					$crShipPr = getShippingPrice($detailmodeeditRes['purchase_code']);
                	echo moneyFormat($crShipPr,$ue_globvar_currency);
					$grandTotal += $crShipPr;
				?>
            </td>
        </tr>
        <tr style="font-weight: bold; background-color: #ededed;">
        	<td align="right" colspan="8" style="padding-right: 20px;">
            	Payment Code
            </td>
        	<td align="center">
            	<?php
					$currentPayCode = $currentPurchasePaycode;
					$grandTotal += $currentPayCode;
					echo moneyFormat($currentPayCode,$ue_globvar_currency);
				?>
            </td>
        </tr>
        <?php
			if($currentCreditUsed > 0) {
		?>
        <tr style="font-weight: bold; background-color: #ededed;">
        	<td align="right" colspan="8" style="padding-right: 20px;">
            	Credit Used
            </td>
        	<td align="center">
            	<?php
					$grandTotal -= $currentCreditUsed;
					echo '-'.moneyFormat($currentCreditUsed,$ue_globvar_currency);
				?>
            </td>
        </tr>
        <?php
			}
		?>
        <tr style="font-weight: bold; background-color: #ededed;">
        	<td align="right" colspan="8" style="padding-right: 18px;">
            	GRAND TOTAL
            </td>
        	<td align="center">
            	<?php echo moneyFormat($grandTotal,$ue_globvar_currency)?>
            </td>
        </tr>
        <tr style="font-weight: bold; background-color: #ededed;">
        	<td align="right" style="padding-right: 18px;" colspan="8">
            	TOTAL WEIGHT
            </td>
        	<td align="center">
            	<?php echo $grandWeight?>
            </td>
        </tr>
    </table>
	<div style="background-color: #fff; border: #ddd 1px solid; margin-top: 10px; padding: 10px; font-weight: bold;">
    <?php
		$editGuestShipIp = $currentShippingId;
		$shippingEditQue = ue_query("SELECT * FROM shipping WHERE shipping_id = '$editGuestShipIp' LIMIT 1");
		$shippingEditRes = ue_fetch_array($shippingEditQue);
	?>
    <table width="100%">
    	<tr>
	        <td width="45%" valign="top">
				<?php
					$writeUserInfoArr = array(
						'name' => $detailmodeeditRes['purchase_name'],
						'email' => $detailmodeeditRes['purchase_email'],
						'postal' => $detailmodeeditRes['purchase_postal'],
						'telp' => $detailmodeeditRes['purchase_telp']
					);
                ?>
				<table id="shippingForm" width="100%" style="margin-bottom: 20px;">
                    <tr>
                        <td width="125">
                            Name
                        </td>
                        <td width="10" align="center">
                            :
                        </td>
                        <td>
                        	<?php
								if($detailmodeeditRes['user_id'] != 0) {
							?>
                        	<a style="background-color: #030; color: #fff; float: right; padding: 5px; padding-left: 8px; padding-right: 8px;" href="detail-user.php?id=<?php echo $detailmodeeditRes['user_id']?>&detailmode=edit" title="This purchase was made by a <b>Registered User</b> - Click to view user details" class="tooltip">USER</a>
                            <?php
								} else {
							?>
                        	<span style="background-color: #C60; color: #fff; float: right; padding: 5px; padding-left: 8px; padding-right: 8px;" class="tooltip" title="This purchase was made by <b>Guest</b>">GUEST</span>
                            <?php
								}
							?>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: normal;" colspan="3">
                        	<?php echo $writeUserInfoArr['name']?>
                        </td>
                    </tr>
                    <tr>
                        <td width="125">
                            Email
                        </td>
                        <td width="10" align="center">
                            :
                        </td>
                        <td>&nbsp;
                        	
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: normal;" colspan="3">
                        	<?php echo $writeUserInfoArr['email']?>
                        </td>
                    </tr>
                    <tr>
                        <td width="125">
                            Postal
                        </td>
                        <td width="10" align="center">
                            :
                        </td>
                        <td>&nbsp;
                        	
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: normal;" colspan="3">
						<?php
                            if($_GET['purchasecode'] != '') {
                        ?>
                        		<?php echo ueCreateInputText('postal','',$writeUserInfoArr['postal'])?>
                        <?php
                            }
                            else {
                        ?>
                                <?php echo $writeUserInfoArr['postal']?>
                        <?php
                            }
                        ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="125">
                            Telp
                        </td>
                        <td width="10" align="center">
                            :
                        </td>
                        <td>&nbsp;
                        	
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: normal;" colspan="3">
						<?php
                            if($_GET['purchasecode'] != '') {
                        ?>
                        		<?php echo ueCreateInputText('telp','',$writeUserInfoArr['telp'])?>
                        <?php
                            }
                            else {
                        ?>
                                <?php echo $writeUserInfoArr['telp']?>
                        <?php
                            }
                        ?>
                        </td>
                    </tr>
                </table>
                <table id="shippingForm" width="100%">
                    <tr>
                        <td width="125">
                            Receiver's Name
                        </td>
                        <td width="10" align="center">
                            :
                        </td>
                        <td>&nbsp;
                        </td>
                    </tr>
                    <tr>
                    	<td colspan="3" style="font-weight: normal;">
						<?php
                            if($_GET['purchasecode'] != '') {
                        ?>
                            <input type="text" name="shipname" value="<?php echo $currentShipName?>" />
                        <?php
                            }
							else {
                        ?>
                        	<?php echo $currentShipName?>
                        <?php
							}
						?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Ship To
                        </td>
                        <td align="center">
                            :
                        </td>
                        <td>&nbsp;
                        	
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: normal;" colspan="3">
                <?php
					if($_GET['purchasecode'] != '') {
						$shipBigArr = array();
					
						$regularQueTableName = 'shipping';
						$regularQue = ue_query("SELECT * FROM $regularQueTableName WHERE
									".$regularQueTableName."_enabled = 'e'
						GROUP BY ".$regularQueTableName."_name
						ORDER BY ".$regularQueTableName."_name ASC");
						while($regularRes = ue_fetch_array($regularQue)) {
							if(!array_key_exists($regularRes['shipping_area'],$shipBigArr)) {
								$shipBigArr[$regularRes['shipping_area']] = array();
							}
							$shipBigArr[$regularRes['shipping_area']][$regularRes['shipping_id']] = $regularRes['shipping_name'];
						}
						
						ksort($shipBigArr);
				?>
                    <select name="province" id="province">
                            <option value="">- Please Select -</option>
                        <?php
							foreach($shipBigArr as $shipBigArrKey => $shipBigArrVal) {
                        ?>
                            <option value="<?php echo str_replace(' ','',strtolower($shipBigArrKey))?>" <?php
                                
                            ?> <?php
                                if($shippingEditRes['shipping_area'] == $shipBigArrKey) {
                                    echo ' selected="selected"';
                                }
                            ?>><?php echo $shipBigArrKey?></option>
                        <?php
                            }
                        ?>
                    </select>
                <?php
					}
					else {
				?>
                            <?php echo $shippingEditRes['shipping_area']?>
                <?php
					}
				?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Shipping City
                        </td>
                        <td align="center">
                            :
                        </td>
                        <td>&nbsp;
                            
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: normal;" colspan="3">
                <?php
					if($_GET['purchasecode'] != '') {
				?>
				<?php
                    foreach($shipBigArr as $shipBigArrKey => $shipBigArrVal) {
                ?>
                <div class="shipCity" id="<?php echo str_replace(' ','',strtolower($shipBigArrKey))?>"<?php
                    if($shippingEditRes['shipping_area'] != $shipBigArrKey) {
                        echo ' style="display: none;"';
                    }
                ?>>
                <select name="<?php echo str_replace(' ','',strtolower($shipBigArrKey))?>" data-chosen='fixedwidth'>
                        <?php
                            foreach($shipBigArrVal as $shipBigArrValKey => $shipBigArrValVal) {
                        ?>
                        <option value="<?php echo $shipBigArrValKey?>" <?php
                    if($shippingEditRes['shipping_id'] == $shipBigArrValKey) {
                        echo ' selected="selected"';
                    }
                ?>><?php echo $shipBigArrValVal?></option>
                        <?php
                            }
                        ?>
                </select>
                </div>
                <?php
                    }
                ?>
                <script type="text/javascript">
                    $("#province").change(function() {
                        currentSelectedValue = $(this).val();
                        currentTargetId = '#'+currentSelectedValue;
                        $('.shipCity').attr('style','display: none;');
                        $(currentTargetId).attr('style','display: inline;');
                    });
                </script>
                <?php
					}
					else {
				?>
                            <?php echo $shippingEditRes['shipping_name']?>
                <?php
					}
				?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Shipping Address
                        </td>
                        <td align="center">
                            :
                        </td>
                        <td>&nbsp;
                            
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: normal;" colspan="3">
                <?php
					if($_GET['purchasecode'] != '') {
				?>
                            <!--<input type="text" name="address" value="<?php echo $currentShipAddress?>" style="width: 450px;" />-->
                            <?php echo ueCreateInputTextarea('address','',$currentShipAddress)?>
                <?php
					}
					else {
				?>
                            <?php echo ueWritePage($currentShipAddress)?>
                <?php
					}
				?>
                        </td>
                    </tr>
                    <tr>
                    	<td>
                            Ship Type
                        </td>
                        <td align="center">
                            :
                        </td>
                        <td>&nbsp;
                        	
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: normal;" colspan="3">
						<?php
                            if($_GET['purchasecode'] != '') {
                        ?>
							<?php					
                                $currentSelectArr = array(
                                    'name' => 'shiptype',
                                    'list' => array()
                                );
                            ?>
                            <?php
								foreach($ue_globvar_shipping_mode as $shipOptKey => $shipOptVal) {
									$currentSelectArr['list']["$shipOptVal"] = $shipOptKey;
								}
							?>
                            <?php echo ueCreateSelectOption($currentSelectArr,'',$currentShipType)?>
                        <?php
							}
							else {
						?>
                            <?php echo array_search($currentShipType,$ue_globvar_shipping_mode)?>
                        <?php
							}
						?>
                        </td>
                    </tr>
                    <tr <?php
						if($currentShipType != 'shipping_urgent') {
							echo 'style="visibility: hidden;"';
						}
					?>>
                    	<td>
                            Ship Date
                        </td>
                        <td align="center">
                            :
                        </td>
                        <td>&nbsp;
                        	
                        </td>
                    </tr>
                    <tr <?php
						if($currentShipType != 'shipping_urgent') {
							echo 'style="visibility: hidden;"';
						}
					?>>
                        <td style="font-weight: normal;" colspan="3" class="smallSelect">
						<?php
                            if($_GET['purchasecode'] != '') {
                        ?>
							<?php
								$defaultDate = $currentShipDate;
								
								$currentDate = date('j',$defaultDate);
								$currentMonth = date('F',$defaultDate);
								$currentYear = date('Y',$defaultDate);
                            ?>
                            <?php					
                                $currentSelectArr = array(
                                    'name' => 'shipdate',
                                    'list' => array()
                                );
                            ?>
                            <?php
                                for($i=1;$i<31;$i++) {
                                    $currentSelectArr['list']["$i"] = $i;
                                }
                            ?>
                            <?php echo ueCreateSelectOption($currentSelectArr,$currentDate,'')?>
                            
                            <?php					
                                $currentSelectArr = array(
                                    'name' => 'shipmon',
                                    'list' => array()
                                );
                            ?>
                            <?php
                                $months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
                                for($i=0;$i<count($months);$i++) {
                                    $currentSelectArr['list'][$months["$i"]] = $months["$i"];
                                }
                            ?>
                            <?php echo ueCreateSelectOption($currentSelectArr,$currentMonth,'')?>
                            
                            <?php					
                                $currentSelectArr = array(
                                    'name' => 'shipyear',
                                    'list' => array()
                                );
                            ?>
                            <?php
                                for($i=(date("Y")-4);$i<(date("Y")+5);$i++) {
                                    $currentSelectArr['list']["$i"] = $i;
                                }
                            ?>
                            <?php echo ueCreateSelectOption($currentSelectArr,$currentYear,'')?>
                        <?php
							}
							else {
						?>
                            <?php echo unixtodate($currentShipDate)?>
                        <?php
							}
						?>
                        </td>
                    </tr>
                </table>
    		</td>
            <td valign="top" style="padding-left: 30px;">
            	<?php
					if($currentBankId > 0) {
						$bankDetailQue = ue_query("SELECT * FROM bank WHERE bank_id = '$currentBankId' LIMIT 1");
						$bankDetailRes = ue_fetch_array($bankDetailQue);
						
						$writeBankImage = '<img src="../upload/bankLogo/'.$bankDetailRes['bank_image'].'" />';
					}
					else {
						$bankDetailRes['bank_name'] = $ue_globvar_free_purchase_bank_data['bank_name'];
						$bankDetailRes['bank_desc'] = $ue_globvar_free_purchase_bank_data['bank_desc'];
						$bankDetailRes['bank_image'] = $ue_globvar_free_purchase_bank_data['bank_image'];
						
						if($bankDetailRes['bank_image'] == '' || $bankDetailRes['bank_image'] == ' ' || $bankDetailRes['bank_image'] == '&nbsp;') {
							$writeBankImage = '&nbsp;';
						}
					}
				?>
				<span style="font-size: 15px;">&raquo; Payment Method</span>
            	<table style="font-weight: normal; margin-bottom: 10px; margin-top: 20px;" width="100%">
                	<tr>
                        <td valign="top" width="1">
							<?php echo $writeBankImage ?>
                        </td>
                        <td valign="top" style="padding-left: 5px; font-family: Arial, Helvetica, sans-serif;" colspan="2">
                        		<div style="font-weight: bold;"><?php echo $bankDetailRes['bank_name']?></div>
                                <?php echo ueWritePage($bankDetailRes['bank_desc'],true)?>
                        </td>
                    </tr>
                </table>
                <div style="margin-top: 20px;">
                	<span style="font-size: 15px;">&raquo; Confirmation Data</span>
                    <table width="100%" style="margin-top: 5px;">
                    	<tr style="font-weight: normal;">
                        	<td width="130">
                            	Bank Account Name
                            </td>
                            <td width="20" align="center">
                            	:
                            </td>
                            <td>
								<?php
                                    if($_GET['purchasecode'] != '') {
                                ?>
                                   		<input type="text" name="bankAccountName" value="<?php echo $detailmodeeditRes['purchase_transfername']?>" style="width: 200px;" />
                                <?php
                                    }
                                    else {
                                ?>
                                   		<?php echo $detailmodeeditRes['purchase_transfername']?>
                                <?php
                                    }
                                ?>
                            </td>
                        </tr>
                    	<tr style="font-weight: normal;">
                        	<td>
                            	Amount Transfered
                            </td>
                            <td width="20" align="center">
                            	:
                            </td>
                            <td>
								<?php
                                    if($_GET['purchasecode'] != '') {
                                ?>
                                   		<input type="text" name="bankAmountTransfered" value="<?php echo $detailmodeeditRes['purchase_transferamount']?>" style="width: 200px;" />
                                <?php
                                    }
                                    else {
                                ?>
                                   		<?php echo moneyFormat($detailmodeeditRes['purchase_transferamount'],$ue_globvar_currency)?>
                                <?php
                                    }
                                ?>
                            </td>
                        </tr>
                    	<tr style="font-weight: normal;">
                        	<td>
                            	Payment Date
                            </td>
                            <td width="20" align="center">
                            	:
                            </td>
                            <td class="smallSelect">
								<?php
                                    if($_GET['purchasecode'] != '') {
                                ?>
                                    <?php
										if($detailmodeeditRes['purchase_paydate'] > 0) {
											$defaultDate = $detailmodeeditRes['purchase_paydate'];
											
											$currentDate = date('j',$defaultDate);
											$currentMonth = date('F',$defaultDate);
											$currentYear = date('Y',$defaultDate);
										}
										else {
											$currentDate = '';
											$currentMonth = '';
											$currentYear = '';
										}
                                    ?>
                                    <?php					
                                        $currentSelectArr = array(
                                            'name' => 'paydate',
                                            'list' => array()
                                        );
                                    ?>
                                    <?php
                                        for($i=1;$i<=31;$i++) {
                                            $currentSelectArr['list']["$i"] = $i;
                                        }
                                    ?>
                                    <?php echo ueCreateSelectOption($currentSelectArr,$currentDate,'')?>
                                    
                                    <?php					
                                        $currentSelectArr = array(
                                            'name' => 'paymon',
                                            'list' => array()
                                        );
                                    ?>
                                    <?php
                                        $months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
                                        for($i=0;$i<count($months);$i++) {
                                            $currentSelectArr['list'][$months["$i"]] = $months["$i"];
                                        }
                                    ?>
                                    <?php echo ueCreateSelectOption($currentSelectArr,$currentMonth,'')?>
                                    
                                    <?php					
                                        $currentSelectArr = array(
                                            'name' => 'payyear',
                                            'list' => array()
                                        );
                                    ?>
                                    <?php
                                        for($i=(date("Y")-4);$i<(date("Y")+5);$i++) {
                                            $currentSelectArr['list']["$i"] = $i;
                                        }
                                    ?>
                                    <?php echo ueCreateSelectOption($currentSelectArr,$currentYear,'')?>
                                <?php
                                    }
                                    else {
                                ?>
                                    <?php echo unixtodate($detailmodeeditRes['purchase_paydate'],true)?>
                                <?php
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr>
                        	<td colspan="3" style="padding-top: 15px;">
                            	<span style="font-size: 15px;">&raquo; Shipping Confirmation Data</span>
                            </td>
                        </tr>
                    	<tr style="font-weight: normal;">
                        	<td>
                            	Tracking Code
                            </td>
                            <td width="20" align="center">
                            	:
                            </td>
                            <td>
                                <input type="text" name="trackingcode" value="<?php echo $detailmodeeditRes['purchase_trackingcode']?>" style="width: 200px;" />
                            </td>
                        </tr>
                        <tr <?php
						if(!$detailmodeeditRes['purchase_comment']) {
							echo 'style="visibility: hidden;"';
						}
						?> style="font-weight: normal;">
                        	<td colspan="3" style="padding-top: 15px;">
                            	<span style="font-size: 15px; font-weight: bold;">&raquo; Note / Comment</span>
                            </td>
                        </tr>
                    	<tr <?php
						if(!$detailmodeeditRes['purchase_comment']) {
							echo 'style="visibility: hidden;"';
						}
						?> style="font-weight: normal;">
                        	<td colspan="3">
								<?php
                                    if($_GET['purchasecode'] != '') {
                                ?>
	                                <?php echo ueCreateInputTextarea('comment','',$detailmodeeditRes['purchase_comment'])?>
                                <?php
									}
									else {
								?>
    	                        	<?php echo ueWritePage($detailmodeeditRes['purchase_comment'])?>
                                <?php
									}
								?>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
		</tr>
    </table>
    </div>
                </td>
            </tr>
            <tr>
            	<td align="right" colspan="3">
					<?php
						if($_GET['purchasecode'] != '') {
					?>
                    <table width="100%" cellpadding="0" cellspacing="0">
                    	<tr>
                        	<td width="300">
			                	<input type="hidden" name="purchasecode" value="<?php echo $detailmodeeditRes['purchase_code']?>" />
                            </td>
                            <td align="center">&nbsp;
                            	
                            </td>
                            <td width="300" align="right">
			                	<input type="submit" value="Edit Purchase Details" />
                            </td>
                        </tr>
                    </table>
                    <?php
						}
						else {
					?>
                    <table width="100%" cellpadding="0" cellspacing="0">
                    	<tr>
                        	<td width="300">
			                    <input type="submit" name="cmode" value="Reject Purchase" style="float: left; background-color: #990000" <?php echo tooltip('Rejected purchase <b>CAN</b> be confirmed again by the user')?> />
			                	<input type="hidden" name="purchasecode" value="<?php echo $detailmodeeditRes['purchase_code']?>" />
                            </td>
                            <td align="center">
                            	<input type="submit" name="cmode" value="Cancel Purchase" style="background-color: #80007f;" <?php echo tooltip('Canceled purchase <b>CAN NOT</b> be confirmed again by the user')?> />
                            </td>
                            <td width="300" align="right">
			                	<input type="submit" name="cmode" value="Approve Payment" style="background-color: #008000;" <?php echo tooltip('Approve the payment of this purchase. Product shipment should be processed.')?> />
                            </td>
                        </tr>
                    </table>
                    <?php
						}
					?>
                </td>
            </tr>
        </table>
    </form>
	<!-- Export PDF Formatting START -->
	<div style="width: 1px; height: 1px; visibility: hidden; overflow: hidden;">
	<?php
		switch($detailmodeeditRes['purchase_status']) {
			case 'x':
				$pdfEmblem = '<div style="text-align: center; font-weight: bold; border: 1px solid #000;">Rejected</div>';
			break;
			case 'r':
				$pdfEmblem = '<div style="text-align: center; font-weight: bold; border: 1px solid #000;">Request</div>';
			break;
			case 'c':
				$pdfEmblem = '<div style="text-align: center; font-weight: bold; border: 1px solid #000;">Confirmed</div>';
			break;
			case 'a':
				if($detailmodeeditRes['purchase_trackingcode'] != '') {
					$pdfEmblem = '<div style="text-align: center; font-weight: bold; border: 1px solid #000;">Shipped</div>';
				}
				else {
					$pdfEmblem = '<div style="text-align: center; font-weight: bold; border: 1px solid #000;">Approved</div>';
				}
			break;
			case 'z':
				$pdfEmblem = '<div style="text-align: center; font-weight: bold; border: 1px solid #000;">Canceled</div>';
			break;
		}
		
		$pdfTableContents = '';
		foreach($printToPDFArr as $printToPDFArrKey => $printToPDFArrVal) {
			$pdfTableContents .= '<tr>
				<td>
					'.$printToPDFArrVal['image'].'
				</td>
				<td>
					'.$printToPDFArrVal['desc'].'
				</td>
				<td style="text-align: center;">
					'.$printToPDFArrVal['color'].'
				</td>
				<td style="text-align: center;">
					'.$printToPDFArrVal['size'].'
				</td>
				<td style="text-align: center;">
					'.$printToPDFArrVal['price'].'
				</td>
				<td style="text-align: center;">
					'.$printToPDFArrVal['qty'].'
				</td>
				<td style="text-align: center;">
					'.$printToPDFArrVal['weight'].'
				</td>
				<td style="text-align: right;">
					'.$printToPDFArrVal['total'].'
				</td>
			</tr>
			<div style="border-top: 1px solid #000;"></div>
			';
		}
		
		$pdfTableFooters = '';
		if($voucherCodeRes['promo_name']) {
			$pdfTableFooters .= '<tr>
				<td colspan="8" style="text-align: center; background-color: #2a2a2a; color: #fff;">
					<span style="font-weight: bold;">Using Promotional Code:</span> <i>'.$voucherCodeRes['promo_name'].'</i>
				</td>
			</tr>';
		}
		
		if($voucherCodeRes['promo_mode'] == 2 || $voucherCodeRes['promo_mode'] == 3) {
			if($voucherCodeRes['promo_productallow'] == '' || $voucherCodeRes['promo_value'] == 0) {
				$pdfTableFooters .= '
					<tr>
						<td colspan="7" style="background-color: #2a2a2a; color: #fff; font-weight: bold;">
							'.$promoRowText.'
						</td>
						<td style="text-align: center; background-color: #2a2a2a; color: #fff;">
							-'.moneyFormat($curDiscount,$ue_globvar_currency).'
						</td>
					</tr>
				';
			}
		}
		
		if($currentCreditUsed > 0) {
			$pdfTableCurrentCreditUsed = '
				<tr>
					<td colspan="7" style="background-color: #2a2a2a; color: #fff; font-weight: bold;">
						Credit Used
					</td>
					<td style="text-align: center; background-color: #2a2a2a; color: #fff;">
						-'.moneyFormat($currentCreditUsed,$ue_globvar_currency).'
					</td>
				</tr>
			';
		}
		
		$pdfTableFooters .= '
			<tr>
				<td colspan="7" style="background-color: #2a2a2a; color: #fff; font-weight: bold;">
					Shipping to '.$shippingEditRes['shipping_name'].', '.$shippingEditRes['shipping_area'].'
				</td>
				<td style="text-align: center; background-color: #2a2a2a; color: #fff;">
					'.moneyFormat($crShipPr,$ue_globvar_currency).'
				</td>
			</tr>
			<tr>
				<td colspan="7" style="background-color: #2a2a2a; color: #fff; font-weight: bold;">
					Payment Code
				</td>
				<td style="text-align: center; background-color: #2a2a2a; color: #fff;">
					'.moneyFormat($currentPayCode,$ue_globvar_currency).'
				</td>
			</tr>
			'.$pdfTableCurrentCreditUsed.'
			<tr>
				<td colspan="7" style="background-color: #2a2a2a; color: #fff; font-weight: bold;">
					GRAND TOTAL
				</td>
				<td style="text-align: center; background-color: #2a2a2a; color: #fff;">
					'.moneyFormat($grandTotal,$ue_globvar_currency).'
				</td>
			</tr>
			<tr>
				<td colspan="7" style="background-color: #2a2a2a; color: #fff; font-weight: bold;">
					TOTAL WEIGHT
				</td>
				<td style="text-align: center; background-color: #2a2a2a; color: #fff;">
					'.$grandWeight.'
				</td>
			</tr>
		';
		
		$pdfPurchaseTable = '<table>
			<tr>
				<td style="text-align: center; background-color: #000; color: #fff;">
					ITEM
				</td>
				<td style="text-align: center; background-color: #000; color: #fff;">
					DESCRIPTION
				</td>
				<td style="text-align: center; background-color: #000; color: #fff;">
					COLOR
				</td>
				<td style="text-align: center; background-color: #000; color: #fff;">
					SIZE
				</td>
				<td style="text-align: center; background-color: #000; color: #fff;">
					PRICE
				</td>
				<td style="text-align: center; background-color: #000; color: #fff;">
					QTY
				</td>
				<td style="text-align: center; background-color: #000; color: #fff;">
					WEIGHT
				</td>
				<td style="text-align: center; background-color: #000; color: #fff;">
					TOTAL
				</td>
			</tr>
			<tr>
				<td colspan="8">
					&nbsp;
				</td>
			</tr>
			'.$pdfTableContents.'
			'.$pdfTableFooters.'
		</table>';
		
		if($detailmodeeditRes['user_id'] != 0) {
			$userMode = '[ <i>USER</i> ]';
		}
		else {
			$userMode = '[ <i>GUEST</i> ]';
		}
		
		$pdfShippingTable = '
		<br/>
		<div style="border: 1px solid #000;">
			<br />
			<table>
				<tr>
					<td>
						<div style="font-weight: bold;">Name:</div>
						'.$userMode.' '.$writeUserInfoArr['name'].'
						<div style="font-weight: bold;">Email:</div>
						'.$writeUserInfoArr['email'].'
						<div style="font-weight: bold;">Postal:</div>
						'.$writeUserInfoArr['postal'].'
						<div style="font-weight: bold;">Telp:</div>
						'.$writeUserInfoArr['telp'].'
						<div style="font-weight: bold;">Receiver&lsquo;s Name:</div>
						'.$currentShipName.'
						<div style="font-weight: bold;">Ship To:</div>
						'.$shippingEditRes['shipping_area'].'
						<div style="font-weight: bold;">Shipping City:</div>
						'.$shippingEditRes['shipping_name'].'
						<div style="font-weight: bold;">Shipping Address:</div>
						'.ueWritePage($currentShipAddress).'
						<div style="font-weight: bold;">Shipping Type:</div>
						'.array_search($currentShipType,$ue_globvar_shipping_mode).'
					</td>
					<td>
						<div style="font-weight: bold;">Transfer To:</div>
						<div style="font-weight: bold;">'.$bankDetailRes['bank_name'].'</div>
						'.ueWritePage($bankDetailRes['bank_desc'],true).'
						<br />
						<div style="font-weight: bold;">&raquo; Confirmation Data</div>
						<div style="font-weight: bold;">Bank Account Name:</div>
						'.ueWritePage($detailmodeeditRes['purchase_transfername']).'
						<div style="font-weight: bold;">Amount Transfered:</div>
						'.moneyFormat($detailmodeeditRes['purchase_transferamount'],$ue_globvar_currency).'
						<div style="font-weight: bold;">Payment Date:</div>
						'.unixtodate($detailmodeeditRes['purchase_paydate']).'
						<br />
						<div style="font-weight: bold;">&raquo; Shipping Confirmation Data</div>
						<div style="font-weight: bold;">Tracking Code:</div>
						'.ueWritePage($detailmodeeditRes['purchase_trackingcode']).'
					</td>
				</tr>
			</table>
		</div>
		';
		
		$pdfContent = '
			<div style="font-size: 10px;">'.$pdfEmblem.'</div>
			<br />
			'.$pdfPurchaseTable.'
			'.$pdfShippingTable.'
		';
	?>
	<form method="post" action="../ue-config/ue-function/ue-pdf/ue-tcpdf.php" id="purchasePdfForm">
		<input type="text" name="pdfKey" value="<?php echo md5('uePDFKey'.$globvar_adminidsite); ?>" />
		<input type="text" name="pdfTitle" value="<?php echo 'Purchase #'.$detailmodeeditRes['purchase_code']?> (<?php echo unixtodate($detailmodeeditRes['purchase_entrydate'])?>)" />
		<input type="text" name="pdfContent" value='<?php echo $pdfContent ?>' />
		<input type="text" name="pdfBarcode" value="<?php echo $detailmodeeditRes['purchase_code']?>" />
		<input type="submit" value="Export to PDF" />
	</form>
	</div>
	<!-- Export PDF Formatting END -->
	</div>
</div>
<?php
	include('footer.php');
?>