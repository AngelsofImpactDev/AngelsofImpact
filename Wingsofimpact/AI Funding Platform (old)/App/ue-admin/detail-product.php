<?php
	include('head.php');
	
	$namaTableDatabase	= 'product';
	$namaPageUtama		= 'product.php';
	$namaFolderUpload	= '';					// If any
	$maxFilePxUpload	= '';					// If any
	
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
    <a href="<?php echo $namaPageUtama?><?php echo pageParamsFormat($pageParamsArr,array('mode' => 'd'))?>" style="background-image: url(images/icon/disabled.png);">VIEW DISABLED</a>
    <a href="<?php echo $namaPageUtama?><?php echo pageParamsFormat($pageParamsArr,array('mode' => 'e'))?>" style="background-image: url(images/icon/enable.png);">VIEW ENABLED</a>
    <a href="overview.php?ovtable=<?php echo $namaTableDatabase?>&ovtitle=<?php echo $currentCheckAccessRes['adminsitepages_mainmenuname']?>&ovmainpage=<?php echo currentpage()?>" style="background-image: url(images/icon/stat1.png);">OVERVIEW</a>
    <div class="clear"></div>
</div>
<?php
	include('ue-includes/ue-currentPageInfo.php');
?>
<div class="transFullWidthWrapper" id="ueFormContainer">
    <div class="tableDetailContainer">
    <form enctype="multipart/form-data" method="post" action="action-product.php">
        <input type="hidden" name="id" value="<?php echo $id?>" />
        <input type="hidden" name="detailmode" value="<?php echo $_GET['detailmode']?>" />
        <input type="hidden" name="mainpage" value="<?php echo $namaPageUtama?>" />
        <input type="hidden" name="frompage" value="<?php echo currentPage()?>" />
        <input type="hidden" name="pageparam" value="<?php echo pageParamsFormat($pageParamsArr)?>" />
    	<table id="detailPageTable" width="100%">
        	<tr>
            	<td width="150">
                	<?php echo $pageTitle?> Type*
                </td>
                <td width="10" align="center">
                	:
                </td>
                <td>
					<?php					
                        $currentSelectArr = array(
                            'name' => 'producttype',
                            'list' => array()
                        );
                    ?>
                    <?php
                        $namaTableDatabaseSel = 'producttype';
                        $promotypeQue = ue_query("SELECT * FROM $namaTableDatabaseSel WHERE ".$namaTableDatabaseSel."_enabled = 'e' ORDER BY ".$namaTableDatabaseSel."_showorder DESC");
                        while($promotypeRes = ue_fetch_array($promotypeQue)) {
                            $currentSelectArr['list'][$promotypeRes["$namaTableDatabaseSel".'_id']] = $promotypeRes["$namaTableDatabaseSel".'_name'];
                        }
                    ?>
                    <?php echo ueCreateSelectOption($currentSelectArr,'',$detailmodeeditRes['producttype_id'])?>
                </td>
            </tr>
        	<tr>
            	<td width="150">
                	<?php echo $pageTitle?> Brand*
                </td>
                <td width="10" align="center">
                	:
                </td>
                <td>
					<?php					
                        $currentSelectArr = array(
                            'name' => 'productbrand',
                            'list' => array()
                        );
                    ?>
                    <?php
                        $namaTableDatabaseSel = 'productbrand';
                        $promotypeQue = ue_query("SELECT * FROM $namaTableDatabaseSel WHERE ".$namaTableDatabaseSel."_enabled = 'e' ORDER BY ".$namaTableDatabaseSel."_showorder DESC");
                        while($promotypeRes = ue_fetch_array($promotypeQue)) {
                            $currentSelectArr['list'][$promotypeRes["$namaTableDatabaseSel".'_id']] = $promotypeRes["$namaTableDatabaseSel".'_name'];
                        }
                    ?>
                    <?php echo ueCreateSelectOption($currentSelectArr,'',$detailmodeeditRes['productbrand_id'])?>
                </td>
            </tr>
			<?php
				if($ue_globvar_productgroup_enabled) {
			?>
        	<tr>
            	<td width="150">
                	<?php echo $pageTitle?> Group
                </td>
                <td width="10" align="center">
                	:
                </td>
                <td>
                  <select data-placeholder="Choose a Product..." multiple name="productgroup[]" data-chosen="multiselect">
                    <?php
                        $namaTableDatabaseSel = 'productgroup';
                        $promotypeQue = ue_query("SELECT * FROM $namaTableDatabaseSel ORDER BY ".$namaTableDatabaseSel."_showorder DESC");
						$preSelArr = explode(',',$detailmodeeditRes['product_groupid']);
                        while($promotypeRes = ue_fetch_array($promotypeQue)) {
                    ?>
                    <option value="<?php echo $promotypeRes["$namaTableDatabaseSel".'_id']?>" <?php
                        if(in_array($promotypeRes["$namaTableDatabaseSel".'_id'],$preSelArr)) {
                            echo 'selected="selected"';
                        }
                    ?>><?php echo $promotypeRes["$namaTableDatabaseSel"."_name"]?></option>
                    <?php
                        }
                    ?>
                  </select>
                </td>
            </tr>
			<?php
				}
			?>
        	<tr>
            	<td width="150">
                	<?php echo $pageTitle?> Name*
                </td>
                <td width="10" align="center">
                	:
                </td>
                <td>
					<?php echo ueCreateInputText('name','',$detailmodeeditRes["$namaTableDatabase".'_name'])?>
                </td>
            </tr>
        	<tr>
            	<td width="150">
                	<?php echo $pageTitle?> Description
                </td>
                <td width="10" align="center">
                	:
                </td>
                <td>
					<?php echo ueCreateInputTextareaRTF('productdesc','',$detailmodeeditRes["$namaTableDatabase".'_desc'])?>
                </td>
            </tr>
        	<tr>
            	<td width="150">
                	<?php echo $pageTitle?> Price*
                </td>
                <td width="10" align="center">
                	:
                </td>
                <td <?php echo tooltip('<b>No Formatting Needed</b> (No . , -)')?>>
					<?php echo ueCreateInputText('price','0',$detailmodeeditRes["$namaTableDatabase".'_price'])?>
                </td>
            </tr>
        	<tr>
            	<td width="150">
                	<?php echo $pageTitle?> Tags*
                </td>
                <td width="10" align="center">
                	:
                </td>
                <td <?php echo tooltip('SEO Tags, Separated By Comma (,)<br />ex: (<b>Handphone,3G,Touchscreen</b>)')?>>
					<?php echo ueCreateInputText('tags','',$detailmodeeditRes["$namaTableDatabase".'_tags'])?>
                </td>
            </tr>
        	<tr>
            	<td width="150">
                	<?php echo $pageTitle?> Info
                </td>
                <td width="10" align="center">
                	:
                </td>
                <td>
                    <?php echo ueCreateInputTextareaRTF('productinfo','',$detailmodeeditRes["$namaTableDatabase".'_info'])?>
                </td>
            </tr>
        	<tr>
            	<td width="150">
                	<?php echo $pageTitle?> Guide
                </td>
                <td width="10" align="center">
                	:
                </td>
                <td>
                    <?php echo ueCreateInputTextareaRTF('productguide','',$detailmodeeditRes["$namaTableDatabase".'_guide'])?>
                </td>
            </tr>
        	<tr>
            	<td width="150">
                	<?php echo $pageTitle?> Sale
                </td>
                <td width="10" align="center">
                	:
                </td>
                <td <?php echo tooltip('Product Discount<br /><b>No Formatting Needed</b> (. , - %)')?>>
					<table width="100%" cellpadding="0" cellspacing="0">
						<tr>
							<td width="50%">
								<div style="background-color: #fff; border: 1px solid #ddd; padding-top: 10px; padding-bottom: 10px; margin-right: 2.5px;" class="centerText">
									<div class="bold"><label><input type="radio" name="saleMode" value="direct" checked="checked" /> Price After Discount</label></div>
									<div class="spacer10"></div>
									<input type="text" name="saleprice" id="saleprice" value="<?php
										if($_COOKIE['saleprice'] > 0) {
											echo $_COOKIE['saleprice'];
										}
										else if($detailmodeeditRes["$namaTableDatabase".'_saleprice'] > 0) {
											echo $detailmodeeditRes["$namaTableDatabase".'_saleprice'];
										}
										else {
											echo '0';
										}
									?>" style="width: 90%;" />
									<div class="spacer10"></div>
									<span class="italic">*Price <span class="bold">AFTER</span> sale. Leave <span class="bold">0</span> for no discount</span>
								</div>
							</td>
							<td>
								<div style="background-color: #fff; border: 1px solid #ddd; padding-top: 10px; padding-bottom: 10px; margin-left: 2.5px;" class="centerText">
									<div class="bold"><label><input type="radio" name="saleMode" value="percentage" /> Percentage Discount</label></div>
									<div class="spacer10"></div>
									<input type="text" name="salepercent" id="salepercent" value="0" style="width: 90%;" readonly="readonly" />
									<div class="spacer10"></div>
									<span class="italic">*Integer <span class="bold">ONLY</span> no '%' required</span>
								</div>
							</td>
						</tr>
					</table>
					<script type="text/javascript">						
						checkSaleMode();
						calculateDiscPercent('init');
						
						$("input[type='radio'][name='saleMode']").change(function() {
							checkSaleMode();
						});
						$('#salepercent,#price').keyup(function() {
							calculateDiscPercent();
						});
						$('#saleprice').keyup(function() {
							curPurePrice = parseInt($('#price').val());
							curPureSalePrice = parseInt($('#saleprice').val());
							if(curPurePrice > 0 && curPureSalePrice > 0 && curPureSalePrice < curPurePrice) {
								curWritePercentage = 100 - (Math.round((curPureSalePrice / curPurePrice)*100));
								$('#salepercent').val(curWritePercentage);
							}
							else {
								$('#salepercent').val('0');
							}
						});
					</script>
					<!--
                	<?php echo ueCreateInputText('saleprice','0',$detailmodeeditRes["$namaTableDatabase".'_saleprice'])?>
					-->
                </td>
            </tr>
        	<tr>
            	<td width="150">
                	<?php echo $pageTitle?> Bulk Price
                </td>
                <td width="10" align="center">
                	:
                </td>
                <td <?php echo tooltip('Price After Sale<br /><b>No Formatting Needed</b> (. , - %)')?>>
                	<?php echo ueCreateInputText('grosirprice','0',$detailmodeeditRes["$namaTableDatabase".'_grosirprice'])?>
                </td>
            </tr>
        	<tr>
            	<td>
                	<?php echo $pageTitle?> Weight*
                </td>
                <td align="center">
                	:
                </td>
                <td>
					<table width="100%" cellpadding="0" cellspacing="0">
						<tr>
							<td width="50%">
								<div style="background-color: #fff; border: 1px solid #ddd; padding-top: 10px; padding-bottom: 10px; margin-right: 2.5px;" class="centerText">
									<div class="bold"><label><input type="radio" name="shipMode" value="weight" checked="checked" /> By Product Weight</label></div>
									<div class="spacer10"></div>
									<input type="text" name="weight" id="weight" value="<?php
										if($_COOKIE['weight'] > 0) {
											echo $_COOKIE['weight'];
										}
										else if($_GET['detailmode'] != 'edit') {
											echo '1';
										}
										else if($detailmodeeditRes["$namaTableDatabase".'_shipweight'] > 0) {
											echo $detailmodeeditRes["$namaTableDatabase".'_shipweight'];
										}
										else {
											echo '0';
										}
									?>" style="width: 90%;" />
									<div class="spacer10"></div>
									<span class="italic">*Numeric Only (kg) Ex: <span class="bold">0.1, 0.5, 1, 3</span></span>
								</div>
							</td>
							<td>
								<div style="background-color: #fff; border: 1px solid #ddd; padding-top: 10px; padding-bottom: 10px; margin-left: 2.5px;" class="centerText">
									<div class="bold"><label><input type="radio" name="shipMode" value="volume" /> By Product Volume</label></div>
									<div class="spacer10"></div>
									<input type="text" name="volume" id="volume" value="<?php echo $detailmodeeditRes["$namaTableDatabase".'_shipvolume']; ?>" style="width: 90%;" readonly="readonly" />
									<div class="spacer10"></div>
									<span class="italic">*Length(cm)<span class="bold">x</span>Width(cm)<span class="bold">x</span>Height(cm) Ex: <span class="bold">90x100x200</span></span>
								</div>
							</td>
						</tr>
					</table>
					<script type="text/javascript">						
						checkShipMode('init');
						
						$("input[type='radio'][name='shipMode']").change(function() {
							checkShipMode();
						});
						$('#volume').keyup(function() {
							calcWeight();
						});
					</script>
					<!--
                	<?php echo ueCreateInputText('weight','1',$detailmodeeditRes["$namaTableDatabase".'_shipweight'])?>
					-->
                </td>
            </tr>
        	<tr>
            	<td>
                	<?php echo $pageTitle?> Size
                </td>
                <td align="center">
                	:
                </td>
                <td style="background-image: url(images/transBgBlack60.png);">
                <?php
					$productSizeMultiViewTableName = 'productsize';
				?>
                    <table id="productColorMultiView" class="multiDataViewTable" width="100%">
                        <tr>
                            <td width="10">
                                #
                            </td>
                            <td>
                                Name
                            </td>
                            <td width="50">
                                Add
                            </td>
                            <td width="50">
                                Remove
                            </td>
                            <td width="50">
                                Swap
                            </td>
                            <td width="50">
                                Top
                            </td>
                            <td width="50">
                                Enable
                            </td>
                            <td width="50">
                                Delete
                            </td>
                        </tr>
                        <?php
							if($_GET['detailmode'] == 'edit') {
								$productSizeMultiViewQue = ue_query("SELECT * FROM $productSizeMultiViewTableName WHERE ".$namaTableDatabase."_id = '$id' ORDER BY ".$productSizeMultiViewTableName."_showorder DESC");
								while(@$productSizeMultiViewRes = ue_fetch_array($productSizeMultiViewQue)) {
						?>
                        <tr>
                            <td align="center">
                                <?php echo $productSizeMultiViewRes["$productSizeMultiViewTableName".'_id']?>
                            </td>
                            <td id="inputContainer">
                            	<input type="hidden" name="productsizecurrenteditid[]" value="<?php echo $productSizeMultiViewRes["$productSizeMultiViewTableName".'_id']?>" />
                            	<input name="productsize[]" type="text" value="<?php echo $productSizeMultiViewRes["$productSizeMultiViewTableName".'_name']?>" />
                            </td>
                            <td align="center">
                                <img src="images/icon/plusSmallBw.png" />
                            </td>
                            <td align="center">
                                <img src="images/icon/minusSmallBw.png" />
                            </td>
                            <td align="center">
								<?php
                                    if($_GET['swapperSelf'] != '') {
                                        if($_GET['swapperSelf'] == $productSizeMultiViewRes["$productSizeMultiViewTableName".'_showorder']) {
                                ?>
                                    <a href="<?php echo pageParamsFormat($pageParamsArr,array('swapperSelf' => ''))?>&id=<?php echo $id?>&detailmode=edit" title="Cancel Swap"><img src="images/icon/swapOff.png" /></a>
                                <?php
                                        }
                                        else if($_GET['swapperTable'] == $productSizeMultiViewTableName) {
                                ?>
                                    <a href="action-swapper.php<?php echo $pageParams?>&swapperTarget=<?php echo $productSizeMultiViewRes["$productSizeMultiViewTableName".'_showorder']?>&swapperTable=<?php echo $productSizeMultiViewTableName?>&frompage=<?php echo currentPage()?>&editpageid=<?php echo $id?>" title="Swap With This"><img src="images/icon/swap.png" /></a>
                                <?php
                                        }
										else {
								?>
                                	<img src="images/icon/swapOff.png" />
                                <?php
										}
                                    }
                                    else {
                                ?>
                                    <a href="<?php echo pageParamsFormat($pageParamsArr,array('swapperSelf' => $productSizeMultiViewRes["$productSizeMultiViewTableName".'_showorder']))?>&swapperTable=<?php echo $productSizeMultiViewTableName?>&id=<?php echo $id?>&detailmode=edit" title="Swap This"><img src="images/icon/swapOff.png" /></a>
                                <?php
                                    }
                                ?>
                            </td>
                            <td align="center">
                				<a onclick="return confirmSubmit()" href="action-moveToTop.php<?php echo $pageParams?>&frompage=<?php echo currentPage()?>&fromtable=<?php echo $productSizeMultiViewTableName?>&id=<?php echo $productSizeMultiViewRes["$productSizeMultiViewTableName".'_id']?>&editpageid=<?php echo $id?>" title="Move Item to Top"><img src="images/icon/arrowUp.png" /></a>
                            </td>
                            <td align="center">
								<?php
                                    if($productSizeMultiViewRes["$productSizeMultiViewTableName".'_enabled'] == 'e') {
                                ?>
                                    <a onclick="return confirmSubmit()" href="action-enabledisable.php<?php echo $pageParams?>&frompage=<?php echo currentPage()?>&fromtable=<?php echo $productSizeMultiViewTableName?>&id=<?php echo $productSizeMultiViewRes["$productSizeMultiViewTableName".'_id']?>&action=d&editpageid=<?php echo $id?>" title="Click To Disable This Item"><img src="images/icon/tick.png" /></a>
                                <?php
                                    }
                                    else if($productSizeMultiViewRes["$productSizeMultiViewTableName".'_enabled'] == 'd') {
                                ?>
                                    <a onclick="return confirmSubmit()" href="action-enabledisable.php<?php echo $pageParams?>&frompage=<?php echo currentPage()?>&fromtable=<?php echo $productSizeMultiViewTableName?>&id=<?php echo $productSizeMultiViewRes["$productSizeMultiViewTableName".'_id']?>&action=e&editpageid=<?php echo $id?>" title="Click To Enable This Item"><img src="images/icon/publish_x.png" /></a>
                                <?php
                                    }
                                ?>
                            </td>
                            <td align="center">
                                <a onclick="return confirmSubmit()" href="action-delete.php<?php echo $pageParams?>&frompage=<?php echo currentPage()?>&fromtable=<?php echo $productSizeMultiViewTableName?>&id=<?php echo $productSizeMultiViewRes["$productSizeMultiViewTableName".'_id']?>&editpageid=<?php echo $id?>" title="Click To Delete This Item"><img src="images/icon/trash.png" /></a>
                            </td>
                        </tr>
                        <?php
								}
							}
						?>
                        <tr>
                            <td align="center">
                                #
                            </td>
                            <td id="inputContainer">
                            	<input type="hidden" name="productsizecurrenteditid[]" value="" />
                                <input name="productsize[]" type="text" />
                            </td>
                            <td align="center">
                                <a href="javascript:void(0)" class="addCloneRow"><img src="images/icon/plusSmall.png" /></a>
                            </td>
                            <td align="center">
                                <a href="javascript:void(0)" class="removeCloneRow"><img src="images/icon/minusSmall.png" /></a>
                            </td>
                            <td align="center">
                            	<?php
									if($_GET['swapperSelf'] != '') {
								?>
                                <a href="<?php echo pageParamsFormat($pageParamsArr,array('swapperSelf' => ''))?>&id=<?php echo $id?>&detailmode=edit" title="Cancel Swap"><img src="images/icon/swapOff.png" /></a>
                                <?php
									}
									else {
								?>
                                <img src="images/icon/swapOff.png" />
                                <?php
									}
								?>
                            </td>
                            <td align="center">
                            	<img src="images/icon/arrowUpBw.png" />
                            </td>
                            <td align="center">
                            	<img src="images/icon/tickBw.png" />
                            </td>
                            <td align="center">
                                <img src="images/icon/trashBw.png" />
                            </td>
                        </tr>
                	</table>
                </td>
            </tr>
       		<tr>
            	<td>
                	<?php echo $pageTitle?> Color
                </td>
                <td align="center">
                	:
                </td>
                <td style="background-image: url(images/transBgBlack60.png);">
                <?php
					$productSizeMultiViewTableName = 'productcolor';
				?>
                    <table id="productSizeMultiView" class="multiDataViewTable" width="100%">
                        <tr>
                            <td width="10">
                                #
                            </td>
                            <td width="175">
                                Hex
                            </td>
                            <td>
                                Name
                            </td>
							<td width="50">
                                Add
                            </td>
                            <td width="50">
                                Remove
                            </td>
                            <td width="50">
                                Swap
                            </td>
                            <td width="50">
                                Top
                            </td>
                            <td width="50">
                                Enable
                            </td>
                            <td width="50">
                                Delete
                            </td>
                        </tr>
                        <?php
							if($_GET['detailmode'] == 'edit') {
								$productSizeMultiViewQue = ue_query("SELECT * FROM $productSizeMultiViewTableName WHERE ".$namaTableDatabase."_id = '$id' ORDER BY ".$productSizeMultiViewTableName."_showorder DESC");
								while(@$productSizeMultiViewRes = ue_fetch_array($productSizeMultiViewQue)) {
						?>
                        <tr>
                            <td align="center">
                                <?php echo $productSizeMultiViewRes["$productSizeMultiViewTableName".'_id']?>
                            </td>
                            <td align="center">
                            	<input type="hidden" name="productcolorcurrenteditid[]" value="<?php echo $productSizeMultiViewRes["$productSizeMultiViewTableName".'_id']?>" />
                            	<input name="productcolorhex[]" id="colorpickerField1" class="colorPickerField" type="text" value="<?php echo $productSizeMultiViewRes["$productSizeMultiViewTableName".'_hex']?>" style="background-color: #<?php echo $productSizeMultiViewRes["$productSizeMultiViewTableName".'_hex']?>;" />
                            </td>
                            <td id="inputContainer">
                                <input name="productcolorname[]" type="text" value="<?php echo $productSizeMultiViewRes["$productSizeMultiViewTableName".'_name']?>" />
                            </td>
                            <td align="center">
                                <img src="images/icon/plusSmallBw.png" />
                            </td>
                            <td align="center">
                                <img src="images/icon/minusSmallBw.png" />
                            </td>
                            <td align="center">
								<?php
                                    if($_GET['swapperSelf'] != '') {
                                        if($_GET['swapperSelf'] == $productSizeMultiViewRes["$productSizeMultiViewTableName".'_showorder']) {
                                ?>
                                    <a href="<?php echo pageParamsFormat($pageParamsArr,array('swapperSelf' => ''))?>&id=<?php echo $id?>&detailmode=edit" title="Cancel Swap"><img src="images/icon/swapOff.png" /></a>
                                <?php
                                        }
                                        else if($_GET['swapperTable'] == $productSizeMultiViewTableName) {
                                ?>
                                    <a href="action-swapper.php<?php echo $pageParams?>&swapperTarget=<?php echo $productSizeMultiViewRes["$productSizeMultiViewTableName".'_showorder']?>&swapperTable=<?php echo $productSizeMultiViewTableName?>&frompage=<?php echo currentPage()?>&editpageid=<?php echo $id?>" title="Swap With This"><img src="images/icon/swap.png" /></a>
                                <?php
                                        }
										else {
								?>
                                	<img src="images/icon/swapOff.png" />
                                <?php
										}
                                    }
                                    else {
                                ?>
                                    <a href="<?php echo pageParamsFormat($pageParamsArr,array('swapperSelf' => $productSizeMultiViewRes["$productSizeMultiViewTableName".'_showorder']))?>&swapperTable=<?php echo $productSizeMultiViewTableName?>&id=<?php echo $id?>&detailmode=edit" title="Swap This"><img src="images/icon/swapOff.png" /></a>
                                <?php
                                    }
                                ?>
                            </td>
                            <td align="center">
                				<a onclick="return confirmSubmit()" href="action-moveToTop.php<?php echo $pageParams?>&frompage=<?php echo currentPage()?>&fromtable=<?php echo $productSizeMultiViewTableName?>&id=<?php echo $productSizeMultiViewRes["$productSizeMultiViewTableName".'_id']?>&editpageid=<?php echo $id?>" title="Move Item to Top"><img src="images/icon/arrowUp.png" /></a>
                            </td>
                            <td align="center">
								<?php
                                    if($productSizeMultiViewRes["$productSizeMultiViewTableName".'_enabled'] == 'e') {
                                ?>
                                    <a onclick="return confirmSubmit()" href="action-enabledisable.php<?php echo $pageParams?>&frompage=<?php echo currentPage()?>&fromtable=<?php echo $productSizeMultiViewTableName?>&id=<?php echo $productSizeMultiViewRes["$productSizeMultiViewTableName".'_id']?>&action=d&editpageid=<?php echo $id?>" title="Click To Disable This Item"><img src="images/icon/tick.png" /></a>
                                <?php
                                    }
                                    else if($productSizeMultiViewRes["$productSizeMultiViewTableName".'_enabled'] == 'd') {
                                ?>
                                    <a onclick="return confirmSubmit()" href="action-enabledisable.php<?php echo $pageParams?>&frompage=<?php echo currentPage()?>&fromtable=<?php echo $productSizeMultiViewTableName?>&id=<?php echo $productSizeMultiViewRes["$productSizeMultiViewTableName".'_id']?>&action=e&editpageid=<?php echo $id?>" title="Click To Enable This Item"><img src="images/icon/publish_x.png" /></a>
                                <?php
                                    }
                                ?>
                            </td>
                            <td align="center">
                                <a onclick="return confirmSubmit()" href="action-delete.php<?php echo $pageParams?>&frompage=<?php echo currentPage()?>&fromtable=<?php echo $productSizeMultiViewTableName?>&id=<?php echo $productSizeMultiViewRes["$productSizeMultiViewTableName".'_id']?>&editpageid=<?php echo $id?>" title="Click To Delete This Item"><img src="images/icon/trash.png" /></a>
                            </td>
                        </tr>
                        <?php
								}
							}
						?>
                        <tr>
                            <td align="center">
                                #
                            </td>
                            <td id="inputContainer" align="center">
                            	<input type="hidden" name="productcolorcurrenteditid[]" value="" />
                                <input name="productcolorhex[]" type="text" id="colorpickerField1" class="colorPickerField" />
                            </td>
                            <td id="inputContainer">
                                <input name="productcolorname[]" type="text" />
                            </td>
                            <td align="center">
                                <a href="javascript:void(0)" class="addCloneRow"><img src="images/icon/plusSmall.png" /></a>
                            </td>
                            <td align="center">
                                <a href="javascript:void(0)" class="removeCloneRow"><img src="images/icon/minusSmall.png" /></a>
                            </td>
                            <td align="center">
                            	<?php
									if($_GET['swapperSelf'] != '') {
								?>
                                <a href="<?php echo pageParamsFormat($pageParamsArr,array('swapperSelf' => ''))?>&id=<?php echo $id?>&detailmode=edit" title="Cancel Swap"><img src="images/icon/swapOff.png" /></a>
                                <?php
									}
									else {
								?>
                                <img src="images/icon/swapOff.png" />
                                <?php
									}
								?>
                            </td>
                            <td align="center">
                            	<img src="images/icon/arrowUpBw.png" />
                            </td>
                            <td align="center">
                            	<img src="images/icon/tickBw.png" />
                            </td>
                            <td align="center">
                                <img src="images/icon/trashBw.png" />
                            </td>
                        </tr>
                	</table>
                </td>
            </tr>
            <tr>
            	<td align="right" colspan="3">
					<input name="submitMode" type="submit" value="Save Draft" />
					<input name="submitMode" type="submit" value="Save & Publish" />
                </td>
            </tr>
        </table>
    </form>
    </div>
</div>
<?php
	include('footer.php');
?>