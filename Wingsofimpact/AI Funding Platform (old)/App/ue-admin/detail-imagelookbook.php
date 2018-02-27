<?php
	include('head.php');
	
	$namaTableDatabase	= 'lookbook';
	$namaPageUtama		= 'lookbook.php';
	$namaFolderUpload	= 'lookbookslider';			// If any
	$maxFilePxUpload	= '500x281';				// If any
	
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
    <a href="overview.php?ovtable=<?php echo $namaTableDatabase?>&ovtitle=<?php echo $currentCheckAccessRes['adminsitepages_mainmenuname']?>&ovmainpage=<?php echo $namaPageUtama?>" style="background-image: url(images/icon/stat1.png);">OVERVIEW</a>
    <div class="clear"></div>
</div>
<?php
	include('ue-includes/ue-currentPageInfo.php');
?>
<div class="transFullWidthWrapper" id="ueFormContainer">
    <div class="tableDetailContainer">
    <form enctype="multipart/form-data" method="post" action="action-imagelookbook.php">
        <input type="hidden" name="id" value="<?php echo $id?>" />
        <input type="hidden" name="detailmode" value="<?php echo $_GET['detailmode']?>" />
        <input type="hidden" name="mainpage" value="<?php echo $namaPageUtama?>" />
        <input type="hidden" name="frompage" value="<?php echo currentPage()?>" />
        <input type="hidden" name="pageparam" value="<?php echo pageParamsFormat($pageParamsArr)?>" />
    	<table id="detailPageTable" width="100%">         
            <tr>
            	<td>
                	Product Images
                </td>
                <td>
                	:
                </td>
                <td>
<div id="multiImageUpload">
                    <?php
						$namaFolderUpload = '../upload/'.$namaFolderUpload.'/';
						
						$multiImageEditPreviewTableName = 'lookbookimage';
						$multiImageEditPreviewQue = ue_query("SELECT * FROM $multiImageEditPreviewTableName WHERE ".$namaTableDatabase."_id = '$id' ORDER BY ".$multiImageEditPreviewTableName."_showorder DESC");
						while($multiImageEditPreviewRes = ue_fetch_array($multiImageEditPreviewQue)) {
					?>
                    	<table width="90%" id="eachMultiImageTable" class="eachMultiImageTableClass">
                        	<tr>
                            	<td width="1" rowspan="3" valign="top">
                                	<div id="multiImagePreview">
                                    <a id="slimboxTarget" class="ue-gallery" href="<?php echo $namaFolderUpload?><?php echo $multiImageEditPreviewRes["$multiImageEditPreviewTableName".'_image']?>" title="<?php echo $detailmodeeditRes["$namaTableDatabase".'_name']?>">
                                    	<img class="ueImagePreview-productimage" src="<?php echo $namaFolderUpload?><?php echo $multiImageEditPreviewRes["$multiImageEditPreviewTableName".'_image']?>" />
                                    </a>
                                    </div>
                                </td>
                                <td style="font-weight: bold;">
                                	<input type="hidden" name="productimagedetaileditid[]" value="<?php echo $multiImageEditPreviewRes["$multiImageEditPreviewTableName".'_id']?>" />
                                    <a id="slimboxTarget" class="ue-lightbox" href="<?php echo $namaFolderUpload?><?php echo $multiImageEditPreviewRes["$multiImageEditPreviewTableName".'_image']?>" title="<?php echo $detailmodeeditRes["$namaTableDatabase".'_name']?>">
                                    <?php echo $multiImageEditPreviewRes["$multiImageEditPreviewTableName".'_image']?>
                                    </a>
                                    </td>
                                <td width="75" align="right" valign="top">
                <a onclick="return confirmSubmit()" href="action-moveToTop.php<?php echo $pageParams?>&frompage=<?php echo currentPage()?>&fromtable=<?php echo $multiImageEditPreviewTableName?>&id=<?php echo $multiImageEditPreviewRes["$multiImageEditPreviewTableName".'_id']?>&editpageid=<?php echo $id?>" title="Move Item to Top"><img src="images/icon/arrowUp.png" /></a>
                
            <?php
	            if($_GET['swapperSelf'] != '') {
					if($_GET['swapperSelf'] == $multiImageEditPreviewRes["$multiImageEditPreviewTableName".'_showorder']) {
			?>
            	<a href="<?php echo pageParamsFormat($pageParamsArr,array('swapperSelf' => ''))?>&id=<?php echo $id?>&detailmode=edit" title="Cancel Swap"><img src="images/icon/swapOff.png" /></a>
            <?php
					}
					else {
			?>
                <a href="action-swapper.php<?php echo $pageParams?>&swapperTarget=<?php echo $multiImageEditPreviewRes["$multiImageEditPreviewTableName".'_showorder']?>&swapperTable=<?php echo $multiImageEditPreviewTableName?>&frompage=<?php echo currentPage()?>&editpageid=<?php echo $id?>" title="Swap With This"><img src="images/icon/swap.png" /></a>
            <?php
					}
				}
				else {
			?>
                <a href="<?php echo pageParamsFormat($pageParamsArr,array('swapperSelf' => $multiImageEditPreviewRes["$multiImageEditPreviewTableName".'_showorder']))?>&id=<?php echo $id?>&detailmode=edit" title="Swap This"><img src="images/icon/swapOff.png" /></a>
            <?php
				}
			?>
									<?php
										$currentImageEditRealSize = getimagesize($namaFolderUpload.$multiImageEditPreviewRes["$multiImageEditPreviewTableName".'_image']);
										$currentImageFileSize = filesize($namaFolderUpload.$multiImageEditPreviewRes["$multiImageEditPreviewTableName".'_image']);
										$currentImageExifData = imageEXIF($namaFolderUpload.$multiImageEditPreviewRes["$multiImageEditPreviewTableName".'_image']);
										
										//Generate EXIF Data
										$exifSeperator = '|';
										$currentCompleteExif = str_replace('..',$globvar_address,$namaFolderUpload.$multiImageEditPreviewRes["$multiImageEditPreviewTableName".'_image']).$exifSeperator;
										$currentCompleteExif .= $currentImageEditRealSize['mime'].' - '.$currentImageEditRealSize['bits'].'-Bits, '.$currentImageEditRealSize['channels'].' Channels'.$exifSeperator;
										$currentCompleteExif .= $currentImageEditRealSize[0].'x'.$currentImageEditRealSize[1].' Pixels - '.human_filesize($currentImageFileSize).$exifSeperator;
										
										foreach($currentImageExifData as $currentImageExifDataKey => $currentImageExifDataVal) {
											$currentCompleteExif .= $currentImageExifDataVal.$exifSeperator;
										}
									?>
									<a href="#imageEditBox" class="ue-popbtn imageEditInit" title="Edit Image"
										data-imageedit-table="<?php echo $namaTableDatabase.'image' ?>"
										data-imageedit-column="<?php echo $namaTableDatabase.'image_image' ?>"
										data-imageedit-id="<?php echo $multiImageEditPreviewRes["$multiImageEditPreviewTableName".'_id'] ?>"
										data-imageedit-src="<?php echo $multiImageEditPreviewRes["$multiImageEditPreviewTableName".'_image'] ?>"
										data-imageedit-folder="<?php echo $namaFolderUpload ?>"
										data-imageedit-width="<?php echo $currentImageEditRealSize[0] ?>"
										data-imageedit-height="<?php echo $currentImageEditRealSize[1] ?>"
										data-imageedit-exif="<?php echo $currentCompleteExif ?>"
									><img src="images/icon/imageedit.png" alt="Edit Image" /></a>
                                </td>
                            </tr>
                            <tr>
                            	<td>&nbsp;
                                	
                                </td>
                                <td align="right" valign="top">
								<?php
                                    if($multiImageEditPreviewRes["$multiImageEditPreviewTableName".'_enabled'] == 'e') {
                                ?>
                                    <a onclick="return confirmSubmit()" href="action-enabledisable.php<?php echo $pageParams?>&frompage=<?php echo currentPage()?>&fromtable=<?php echo $multiImageEditPreviewTableName?>&id=<?php echo $multiImageEditPreviewRes["$multiImageEditPreviewTableName".'_id']?>&action=d&editpageid=<?php echo $id?>" title="Click To Disable This Item"><img src="images/icon/tick.png" /></a>
                                <?php
                                    }
                                    else if($multiImageEditPreviewRes["$multiImageEditPreviewTableName".'_enabled'] == 'd') {
                                ?>
                                    <a onclick="return confirmSubmit()" href="action-enabledisable.php<?php echo $pageParams?>&frompage=<?php echo currentPage()?>&fromtable=<?php echo $multiImageEditPreviewTableName?>&id=<?php echo $multiImageEditPreviewRes["$multiImageEditPreviewTableName".'_id']?>&action=e&editpageid=<?php echo $id?>" title="Click To Enable This Item"><img src="images/icon/publish_x.png" /></a>
                                <?php
                                    }
                                ?>
									<input type="hidden" name="watermarkFlag[]" value="" />
                                </td>
                            </tr>
                            <tr>
                            	<td>
                                	<?php echo ueCreateInputFile('productimage[]','image')?>
                                    <i>*<?php echo $maxFilePxUpload?> Pixels Recommended</i>
                                </td>
                                <td align="right" valign="bottom">
                                	<a onclick="return confirmSubmit()" href="action-delete.php<?php echo $pageParams?>&frompage=<?php echo currentPage()?>&fromtable=<?php echo $multiImageEditPreviewTableName?>&id=<?php echo $multiImageEditPreviewRes["$multiImageEditPreviewTableName".'_id']?>&action=e&editpageid=<?php echo $id?>" title="Click To Delete This Item"><img src="images/icon/trash.png" /></a>
                                </td>
                            </tr>
                        </table>
                    <?php
						}
					?>
                    	<table width="90%" id="eachMultiImageTable" class="eachMultiImageTableClass">
                        	<tr>
                            	<td width="1" rowspan="3" valign="top">
                                	<div id="multiImagePreview">
                                    	<img class="ueImagePreview-productimage" />
                                    </div>
                                </td>
                                <td style="font-weight: bold;">
                                	<input type="hidden" name="productimagedetaileditid[]" value="" />Select An Image
                                </td>
                                <td width="75" align="right" valign="top">
                                	<a href="javascript:void(0)" class="removeClone"><img src="images/icon/minusSmall.png" /></a>
                                	<a href="javascript:void(0)" class="addClone"><img src="images/icon/plusSmall.png" /></a>
                                </td>
                            </tr>
                            <tr>
                            	<td>&nbsp;
                                </td>
                                <td align="right" valign="top">
									<div id="addWatermarkEditContainer" <?php echo tooltip('<div class="watermakPrevBg"><img src="upload/watermark/'.ueGetSiteData('watermark').'" /></div><div class="addWatermarkCheckWarning">Check this to add watermark<br /><span class="bold">NOT REVERSIBLE</span></div>'); ?>>
										<label><input type="hidden" name="watermarkFlag[]" value="<?php if($ue_globvar_watermarkdefaultchecked) {
											echo 'watermarkOn';
										}
										?>" /></label>
										<label><input type="checkbox" name="watermarkFlagMulti[]" id="watermarkFlag" data-watermarkflag-value="watermarkOn" class="watermarkFlagMulti" <?php if($ue_globvar_watermarkdefaultchecked) {
											echo 'checked="checked"';
										}
										?> /><span class="addWatermarkText">Add Watermark </span></label>
									</div>
                                </td>
                            </tr>
                            <tr>
                            	<td>
                                	<?php echo ueCreateInputFile('productimage[]','image')?>
                                    <i>*<?php echo $maxFilePxUpload?> Pixels Recommended</i>
                                </td>
                                <td align="right" valign="bottom">
                                <!--
                                	<img src="images/icon/trash.png" />
                                -->
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
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