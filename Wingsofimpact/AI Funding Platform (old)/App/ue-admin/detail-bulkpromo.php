<?php
	include('head.php');
	
	$namaTableDatabase	= 'promo';
	$namaPageUtama		= 'promo.php';
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
    <a href="<?php echo $namaPageUtama?><?php echo pageParamsFormat($pageParamsArr,array('mode' => 'd'))?>" style="background-image: url(images/icon/disabled.png);">VIEW DISABLED</a>
    <a href="<?php echo $namaPageUtama?><?php echo pageParamsFormat($pageParamsArr,array('mode' => 'e'))?>" style="background-image: url(images/icon/enable.png);">VIEW ENABLED</a>
    <a href="<?php echo $namaPageUtama?><?php echo pageParamsFormat($pageParamsArr,array('mode' => 'x'))?>" style="background-image: url(images/icon/expired.png);">VIEW EXPIRED</a>
    <a href="<?php echo $namaPageUtama?><?php echo pageParamsFormat($pageParamsArr,array('mode' => 'a'))?>" style="background-image: url(images/icon/active.png);">VIEW ACTIVE</a>
    <a href="overview.php?ovtable=<?php echo $namaTableDatabase?>&ovtitle=<?php echo $currentCheckAccessRes['adminsitepages_mainmenuname']?>&ovmainpage=<?php echo currentpage()?>" style="background-image: url(images/icon/stat1.png);">OVERVIEW</a>
    <div class="clear"></div>
</div>
<?php
	include('ue-includes/ue-currentPageInfo.php');
?>
<div class="transFullWidthWrapper" id="ueFormContainer">
    <div class="tableDetailContainer">
    <form enctype="multipart/form-data" method="post" action="action-bulkpromo.php">
        <input type="hidden" name="id" value="<?php echo $id?>" />
        <input type="hidden" name="detailmode" value="<?php echo $_GET['detailmode']?>" />
        <input type="hidden" name="mainpage" value="<?php echo $namaPageUtama?>" />
        <input type="hidden" name="frompage" value="<?php echo currentPage()?>" />
        <input type="hidden" name="pageparam" value="<?php echo pageParamsFormat($pageParamsArr)?>" />
    	<table id="detailPageTable" width="100%">
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
            <tr class="smallSelect">
				<td width="150">
                	<?php echo $pageTitle?> End Date*
                </td>
                <td width="10" align="center">
                	:
                </td>
                <td>
                <?php
					if($_GET['detailmode'] == 'edit') {
						$defaultDate = $detailmodeeditRes["$namaTableDatabase".'_expiry'];
					}
					else {
						$defaultDate = time();
					}
					
					$currentDate = date('j',$defaultDate);
					$currentMonth = date('F',$defaultDate);
					$currentYear = date('Y',$defaultDate);
				?>
                <?php					
					$currentSelectArr = array(
						'name' => 'enddate',
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
						'name' => 'endmon',
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
						'name' => 'endyear',
						'list' => array()
					);
				?>
				<?php
					for($i=(date("Y")-4);$i<(date("Y")+5);$i++) {
                        $currentSelectArr['list']["$i"] = $i;
                    }
                ?>
               	<?php echo ueCreateSelectOption($currentSelectArr,$currentYear,'')?>
                &nbsp;&nbsp;&nbsp;
                <?php
					if($_GET['detailmode'] == 'edit') {
						$currentHour = date('H',$defaultDate);
					}
					else {
						$currentHour = 23;
					}
										
					$currentSelectArr = array(
						'name' => 'endhour',
						'list' => array()
					);
				?>
				<?php
					for($i=0;$i<=23;$i++) {
						if($i < 10) {
                        	$currentSelectArr['list']['0'."$i"] = '0'.$i;
						}
						else {
                        	$currentSelectArr['list']["$i"] = $i;
						}
                    }
                ?>
               	<?php echo ueCreateSelectOption($currentSelectArr,$currentHour,'')?>
                :
                <?php
					if($_GET['detailmode'] == 'edit') {
						$currentMinute = date('i',$defaultDate);
					}
					else {
						$currentMinute = 59;
					}
										
					$currentSelectArr = array(
						'name' => 'endminute',
						'list' => array()
					);
				?>
				<?php
					for($i=0;$i<=59;$i++) {
						if($i < 10) {
                        	$currentSelectArr['list']['0'."$i"] = '0'.$i;
						}
						else {
                        	$currentSelectArr['list']["$i"] = $i;
						}
                    }
                ?>
               	<?php echo ueCreateSelectOption($currentSelectArr,$currentMinute,'')?>
                </td>
            </tr>
        	<tr>
            	<td>
                	<?php echo $pageTitle?> Prefix
                </td>
                <td align="center">
                	:
                </td>
                <td>
                	<?php echo ueCreateInputText('prefix','',$detailmodeeditRes["$namaTableDatabase".'_prefix'])?>
                </td>
            </tr>
        	<tr>
            	<td>
                	<?php echo $pageTitle?> Qty*
                </td>
                <td align="center">
                	:
                </td>
                <td>
                	<?php echo ueCreateInputText('qty','1',$detailmodeeditRes["$namaTableDatabase".'_qty'])?>
                </td>
            </tr>
        	<tr>
            	<td>
                	<?php echo $pageTitle?> Type*
                </td>
                <td align="center">
                	:
                </td>
                <td>
                	<?php
						$currentRadioArr = array(
							'name' => 'type',
							'list' => array(
								'One Time' => '1',
								'Multiple' => '2'
							)
						);
					?>
                	<?php echo ueCreateInputRadio($currentRadioArr,'1',$detailmodeeditRes["$namaTableDatabase".'_type'])?>
                </td>
            </tr>
        	<tr>
            	<td>
                	<?php echo $pageTitle?> Mode*
                </td>
                <td align="center">
                	:
                </td>
                <td>
                <?php					
					$currentSelectArr = array(
						'name' => 'mode',
						'list' => array(
							'1' => 'Free Shipping',
							'2' => 'Price Cut',
							'3' => 'Discount %'
						)
					);
				?>
               	<?php echo ueCreateSelectOption($currentSelectArr,'',$detailmodeeditRes["$namaTableDatabase".'_mode'])?>
                </td>
            </tr>
        	<tr class="promoLimits freeShipOff">
            	<td>
                	<?php echo $pageTitle?> Value*
                </td>
                <td align="center">
                	:
                </td>
                <td>
                	<?php echo ueCreateInputText('value','0',$detailmodeeditRes["$namaTableDatabase".'_value'])?>
                </td>
            </tr>
            <tr class="promoLimits">
            	<td>
                	<?php echo $pageTitle?> Limits*
                </td>
                <td align="center">
                	:
                </td>
                <td>
                	<?php
						$currentRadioArr = array(
							'name' => 'promolimit',
							'list' => array(
								'No Limits' => 'nl',
								'By Minimum Purchase' => 'mp',
								'By Product' => 'bp'
							)
						);
						
						if($detailmodeeditRes["$namaTableDatabase".'_minpurchase'] > 0) {
							$curDefSelLimit = 'mp';
						}
						else if($detailmodeeditRes["$namaTableDatabase".'_productallow'] != '') {
							$curDefSelLimit = 'bp';
						}
						else {
							$curDefSelLimit = 'nl';
						}
					?>
                	<?php echo ueCreateInputRadio($currentRadioArr,'bp',$curDefSelLimit)?>
                  <div style="float: right;">
                  	<label style="margin-right: 10px;">
                  		<input type="checkbox" name="banklimittrigger" id="banklimittrigger" value="banklimityes"<?
							if($detailmodeeditRes["$namaTableDatabase".'_bankallow'] != '') {
								echo ' checked="checked"';
							}
						?> /> Limit by Bank
                    </label>
                  	<label>
                  		<input type="checkbox" name="userlimittrigger" id="userlimittrigger" value="userlimityes"<?
							if($detailmodeeditRes["$namaTableDatabase".'_userallow'] != '') {
								echo ' checked="checked"';
							}
						?> /> Limit by User
                    </label>
                  </div>
                </td>
            </tr>
        	<tr class="promoLimits byProductOff">
            	<td>
                	<?php echo $pageTitle?> Minimum Purchase
                </td>
                <td align="center">
                	:
                </td>
                <td>
                	<?php echo ueCreateInputText('minpurchase','0',$detailmodeeditRes["$namaTableDatabase".'_minpurchase'])?>
                </td>
            </tr>
        	<tr class="promoLimits byMinPurchaseOff">
            	<td>
                	<?php echo $pageTitle?> Limit By Product
                </td>
                <td align="center">
                	:
                </td>
                <td>
                  <select data-placeholder="Choose a Product..." multiple name="prdlimit[]" data-chosen="multiselect">
                    <?php
                        $namaTableDatabaseSel = 'product';
                        $promotypeQue = ue_query("SELECT * FROM $namaTableDatabaseSel
                        WHERE ".$namaTableDatabaseSel."_enabled = 'e' ORDER BY ".$namaTableDatabaseSel."_showorder DESC");
                        $preSelArr = explode(',',$detailmodeeditRes["$namaTableDatabase".'_productallow']);
                        while($promotypeRes = ue_fetch_array($promotypeQue)) {
                    ?>
                    <option value="<?php echo $promotypeRes["$namaTableDatabaseSel"."_id"]?>" <?php
                        if(in_array($promotypeRes["$namaTableDatabaseSel"."_id"],$preSelArr)) {
                            echo 'selected="selected"';
                        }
                    ?>><?php echo $promotypeRes["$namaTableDatabaseSel"."_name"]?> - <?php echo $promotypeRes["$namaTableDatabaseSel"."_id"]?></option>
                    <?php
                        }
                    ?>
                  </select>
                </td>
            </tr>
        	<tr id="limitbankrow">
            	<td>
                	<?php echo $pageTitle?> Limit By Bank
                </td>
                <td align="center">
                	:
                </td>
                <td>
                  <select data-placeholder="Choose a Bank..." multiple name="banklimit[]" data-chosen="multiselect">
                    <?php
                        $namaTableDatabaseSel = 'bank';
                        $promotypeQue = ue_query("SELECT * FROM $namaTableDatabaseSel
                        WHERE ".$namaTableDatabaseSel."_enabled = 'e' ORDER BY ".$namaTableDatabaseSel."_showorder DESC");
                        $preSelArr = explode(',',$detailmodeeditRes["$namaTableDatabase".'_bankallow']);
                        while($promotypeRes = ue_fetch_array($promotypeQue)) {
                    ?>
                    <option value="<?php echo $promotypeRes["$namaTableDatabaseSel"."_id"]?>" <?php
                        if(in_array($promotypeRes["$namaTableDatabaseSel"."_id"],$preSelArr)) {
                            echo 'selected="selected"';
                        }
                    ?>><?php echo $promotypeRes["$namaTableDatabaseSel"."_name"]?> - <?php echo $promotypeRes["$namaTableDatabaseSel"."_id"]?></option>
                    <?php
                        }
                    ?>
                  </select>
                </td>
            </tr>
        	<tr id="limituserrow">
            	<td>
                	<?php echo $pageTitle?> Limit By User
                </td>
                <td align="center">
                	:
                </td>
                <td>
                  <select data-placeholder="Choose a User..." multiple name="userlimit[]" data-chosen="multiselect">
                    <?php
                        $namaTableDatabaseSel = 'user';
                        $promotypeQue = ue_query("SELECT * FROM $namaTableDatabaseSel
                        WHERE ".$namaTableDatabaseSel."_enabled = 'e' ORDER BY ".$namaTableDatabaseSel."_entrydate DESC");
                        $preSelArr = explode(',',$detailmodeeditRes["$namaTableDatabase".'_userallow']);
                        while($promotypeRes = ue_fetch_array($promotypeQue)) {
                    ?>
                    <option value="<?php echo $promotypeRes["$namaTableDatabaseSel"."_id"]?>" <?php
                        if(in_array($promotypeRes["$namaTableDatabaseSel"."_id"],$preSelArr)) {
                            echo 'selected="selected"';
                        }
                    ?>><?php echo $promotypeRes["$namaTableDatabaseSel"."_email"]?> - <?php echo $promotypeRes["$namaTableDatabaseSel"."_name"]?> - <?php echo $promotypeRes["$namaTableDatabaseSel"."_id"]?></option>
                    <?php
                        }
                    ?>
                  </select>
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
<script type="text/javascript">
	function checkType() {
		curModeSel = $('select[name="mode"]').val();
		curLimitSel = $('input[name="promolimit"]:checked').val();
		
		$('.promoLimits').css('display','table-row');
		$('input[value="bp"]').prop('disabled',false);
		
		if(curModeSel == 1) {
			if(curLimitSel == 'bp') {
				$('input[value="nl"]').prop('checked', true);
			}
			$('.freeShipOff').css('display','none');
			$('input[value="bp"]').prop('disabled',true);
		}
	}

	function checkLimit() {
		$('.byProductOff').css('display','table-row');
		$('.byMinPurchaseOff').css('display','table-row');
		
		curLimitSel = $('input[name="promolimit"]:checked').val();
		switch(curLimitSel) {
			case 'mp':
				$('.byMinPurchaseOff').css('display','none');
			break;
			case 'bp':
				$('.byProductOff').css('display','none');
			break;
			case 'nl':
				$('.byProductOff').css('display','none');
				$('.byMinPurchaseOff').css('display','none');
			break;
		}
	}
	
	function checkBankChecked() {
		bankLimitChecked = $('input[name="banklimittrigger"]:checked').val();
		if(bankLimitChecked == 'banklimityes') {
			$('#limitbankrow').css('display','table-row');
		}
		else {
			$('#limitbankrow').css('display','none');
		}
	}
	
	function checkUserChecked() {
		userLimitChecked = $('input[name="userlimittrigger"]:checked').val();
		if(userLimitChecked == 'userlimityes') {
			$('#limituserrow').css('display','table-row');
		}
		else {
			$('#limituserrow').css('display','none');
		}
	}
	
	$('#banklimittrigger').change(function() {
		checkBankChecked();
	});
	
	$('#userlimittrigger').change(function() {
		checkUserChecked();
	});

	$('select[name="mode"]').change(function() {
		checkType();
		checkLimit();
	});
	
	$('input[name="promolimit"]').change(function() {
		checkLimit();
	});
	
	checkType();
	checkLimit();
	checkBankChecked();
	checkUserChecked();
</script>
<?php
	include('footer.php');
?>