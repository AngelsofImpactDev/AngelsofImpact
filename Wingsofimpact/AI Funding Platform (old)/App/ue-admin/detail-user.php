<?php
	include('head.php');
	
	$namaTableDatabase	= 'user';
	$namaPageUtama		= 'user.php';
	$namaFolderUpload	= '';				// If any
	$maxFilePxUpload	= '';				// If any
	
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
    <form enctype="multipart/form-data" method="post" action="action-user.php">
        <input type="hidden" name="id" value="<?php echo $id?>" />
        <input type="hidden" name="detailmode" value="<?php echo $_GET['detailmode']?>" />
        <input type="hidden" name="mainpage" value="<?php echo $namaPageUtama?>" />
        <input type="hidden" name="frompage" value="<?php echo currentPage()?>" />
        <input type="hidden" name="pageparam" value="<?php echo pageParamsFormat($pageParamsArr)?>" />
    	<table id="detailPageTable" width="100%">
        	<tr>
            	<td>
                	<?php echo $pageTitle?> Membership Type*
                </td>
                <td align="center">
                	:
                </td>
                <td>
                	<?php echo $detailmodeeditRes["$namaTableDatabase".'_membershiptype']; ?>
                </td>
            </tr>
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
                	<?php echo $pageTitle?> Email*
                </td>
                <td width="10" align="center">
                	:
                </td>
                <td>
                    <?php echo ueCreateInputText('email','',$detailmodeeditRes["$namaTableDatabase".'_email'])?>
                </td>
            </tr>
        	<tr>
            	<td>
                	<?php echo $pageTitle?> Password*
                </td>
                <td align="center">
                	:
                </td>
                <td>
					<input name="password" id="password" placeholder="[Hidden]" class="ueInputText" type="text" value="">
                </td>
            </tr>
			<!--
			<tr>
				<td width="150">
                	<?php echo $pageTitle?> Birthdate*
                </td>
                <td width="10" align="center">
                	:
                </td>
                <td class="smallSelect">
                <?php
					if($_GET['detailmode'] == 'edit') {
						$defaultDate = $detailmodeeditRes["$namaTableDatabase".'_dob'];
					}
					else {
						$defaultDate = 0;
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
					for($i=1;$i<=31;$i++) {
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
					for($i=(date("Y")-100);$i<(date("Y"));$i++) {
                        $currentSelectArr['list']["$i"] = $i;
                    }
                ?>
               	<?php echo ueCreateSelectOption($currentSelectArr,$currentYear,'')?>
                </td>
            </tr>
            <?php
				$shippingEditQue = ue_query("SELECT * FROM shipping WHERE shipping_id = '".$detailmodeeditRes['shipping_id']."' LIMIT 1");
				$shippingEditRes = ue_fetch_array($shippingEditQue);
			?>
        	<tr>
            	<td>
                	Shipping Province*
                </td>
                <td align="center">
                	:
                </td>
                <td>
                <?php
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
                </td>
            </tr>
        	<tr>
            	<td>
                	Shipping City*
                </td>
                <td align="center">
                	:
                </td>
                <td>
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
                            $(currentTargetId).attr('style','display: block;');
                        });
                    </script>
                </td>
            </tr>
			-->
        	<tr>
            	<td>
                	<?php echo $pageTitle?> Address*
                </td>
                <td align="center">
                	:
                </td>
                <td>
                	<?php echo ueCreateInputTextarea('address','',$detailmodeeditRes["$namaTableDatabase".'_address'])?>
                </td>
            </tr>
        	<tr>
            	<td>
                	<?php echo $pageTitle?> Telp*
                </td>
                <td align="center">
                	:
                </td>
                <td>
                	<?php echo ueCreateInputText('telp','',$detailmodeeditRes["$namaTableDatabase".'_telp'])?>
                </td>
            </tr>
			<tr>
            	<td>
                	<?php echo $pageTitle?> Membership Paid*
                </td>
                <td align="center">
                	:
                </td>
                <td>
					<?php					
						$currentMembershipListFinal = array();
						$currentMembershipList = $aolMembership[$detailmodeeditRes["$namaTableDatabase".'_membershiptype']];
						foreach($currentMembershipList as $currentMembershipListKey => $currentMembershipListVal) {
							$currentMembershipListFinal[$currentMembershipListKey] = $currentMembershipListVal['name'];
						}
					
						$currentSelectArr = array(
							'name' => 'membership',
							'list' => $currentMembershipListFinal
						);
					?>
					<?php echo ueCreateSelectOption($currentSelectArr,'',$detailmodeeditRes["$namaTableDatabase".'_membershipid'],'Membership',true)?>
                </td>
            </tr>
			<tr>
            	<td>
                	<?php echo $pageTitle?> Membership Expiry*
                </td>
                <td align="center">
                	:
                </td>
                <td>
					<?php
					if($detailmodeeditRes["$namaTableDatabase".'_expiry'] == "0"){
						$defVal = "";
					}else{
						$defVal = date("Y-m-d",$detailmodeeditRes["$namaTableDatabase".'_expiry']);
					}
					?>
					<input type="text" name="membershipex" id="membershipex" class="datepicker" placeholder="Expired date" value="<?php echo $defVal ?>" />
                </td>
            </tr>
			<!--
        	<tr>
            	<td>
                	<?php echo $pageTitle?> Gender*
                </td>
                <td align="center">
                	:
                </td>
                <td>
					<?php
                        $currentRadioArr = array(
                            'name' => 'gender',
                            'list' => array(
                                'Female' => 'f',
                                'Male' => 'm'
                            )
                        );
                    ?>
                    <?php echo ueCreateInputRadio($currentRadioArr,'f',$detailmodeeditRes["$namaTableDatabase".'_gender'])?>
                </td>
            </tr>
        	<tr>
            	<td>
                	<?php echo $pageTitle?> Postal*
                </td>
                <td align="center">
                	:
                </td>
                <td>
                	<?php echo ueCreateInputText('postal','',$detailmodeeditRes["$namaTableDatabase".'_postal'])?>
                </td>
            </tr>
        	<tr>
            	<td>
                	<?php echo $pageTitle?> Credit
                </td>
                <td align="center">
                	:
                </td>
                <td <?php echo tooltip('<b>No Formatting Needed</b> (No . , -)')?>>
                	<?php echo ueCreateInputText('credit','0',$detailmodeeditRes["$namaTableDatabase".'_credit'])?>
                </td>
            </tr>
            <?php
				if($ue_globvar_remember_me_toggle == true) {
			?>
        	<tr>
            	<td>
                	<?php echo $pageTitle?> Auto-Login
                </td>
                <td align="center">
                	:
                </td>
                <td>
                	<label>
	                	<input type="checkbox" name="rememberMe" value="<?php echo $detailmodeeditRes["$namaTableDatabase".'_rememberkey'] ?>" <?php
							if($detailmodeeditRes["$namaTableDatabase".'_rememberkey'] != '') {
								echo 'checked="checked"';
							}
						?> /> Auto-Login Status
                    </label>
                </td>
            </tr>
            <?php
				}
			?>
			-->
            <tr>
            	<td align="right" colspan="3">
                	<input type="submit" value="Submit" />
                </td>
            </tr>
        </table>
    </form>
    </div>
</div>
<?php
	include('footer.php');
?>