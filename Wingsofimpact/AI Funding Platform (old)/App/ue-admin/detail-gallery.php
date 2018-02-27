<?php
	include('head.php');
	
	$namaTableDatabase	= 'gallery';
	$namaPageUtama		= 'gallery.php';
	$namaFolderUpload	= 'gallery';			// If any
	$maxFilePxUpload	= '717x478';			// If any
	
	$pageType 			= 'detail';				// list OR detail OR overview
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
    <form enctype="multipart/form-data" method="post" action="action-gallery.php">
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
                <td align="center">
                	:
                </td>
                <td>
                	<?php echo ueCreateInputText('name','',$detailmodeeditRes["$namaTableDatabase".'_name'])?>
                </td>
            </tr>
        	<tr>
            	<td width="150">
                	<?php echo $pageTitle?> Image
                </td>
                <td width="10" align="center">
                	:
                </td>
                <td>
					<?php
						$imageUploadFolder = '../upload/'.$namaFolderUpload.'/';
					?>
                	<?php
						if($detailmodeeditRes["$namaTableDatabase".'_image']) {
					?>
						<table width="90%" id="eachMultiImageTable" class="eachMultiImageTableClass">
                        	<tr>
                            	<td width="1" rowspan="3" valign="top">
                                	<div id="multiImagePreview">
                                    <a id="slimboxTarget" class="ue-zoombox" href="<?php echo $imageUploadFolder?><?php echo $detailmodeeditRes["$namaTableDatabase".'_image']?>" title="<?php echo $detailmodeeditRes["$namaTableDatabase".'_name']?>">
                                    	<img class="ueImagePreview-objek" src="<?php echo $imageUploadFolder?><?php echo $detailmodeeditRes["$namaTableDatabase".'_image']?>" />
                                    </a>
                                    </div>
                                </td>                                <td style="font-weight: bold;">
                                	<a id="slimboxTarget" class="ue-lightbox" href="<?php echo $imageUploadFolder?><?php echo $detailmodeeditRes["$namaTableDatabase".'_image']?>" title="<?php echo $detailmodeeditRes["$namaTableDatabase".'_name']?>">
                                    <?php echo $detailmodeeditRes["$namaTableDatabase".'_image']?>
                                    </a>
                                </td>
                                <td width="75" align="right" valign="top">
									<?php
										$currentImageEditRealSize = getimagesize($imageUploadFolder.$detailmodeeditRes["$namaTableDatabase".'_image']);
										$currentImageFileSize = filesize($imageUploadFolder.$detailmodeeditRes["$namaTableDatabase".'_image']);
										$currentImageExifData = imageEXIF($imageUploadFolder.$detailmodeeditRes["$namaTableDatabase".'_image']);
										
										//Generate EXIF Data
										$exifSeperator = '|';
										$currentCompleteExif = str_replace('..',$globvar_address,$imageUploadFolder.$detailmodeeditRes["$namaTableDatabase".'_image']).$exifSeperator;
										$currentCompleteExif .= $currentImageEditRealSize['mime'].' - '.$currentImageEditRealSize['bits'].'-Bits, '.$currentImageEditRealSize['channels'].' Channels'.$exifSeperator;
										$currentCompleteExif .= $currentImageEditRealSize[0].'x'.$currentImageEditRealSize[1].' Pixels - '.human_filesize($currentImageFileSize).$exifSeperator;
										
										foreach($currentImageExifData as $currentImageExifDataKey => $currentImageExifDataVal) {
											$currentCompleteExif .= $currentImageExifDataVal.$exifSeperator;
										}
									?>
									<a href="#imageEditBox" class="ue-popbtn imageEditInit" title="Edit Image"
										data-imageedit-table="<?php echo $namaTableDatabase ?>"
										data-imageedit-column="<?php echo $namaTableDatabase.'_image' ?>"
										data-imageedit-id="<?php echo $detailmodeeditRes["$namaTableDatabase".'_id'] ?>"
										data-imageedit-src="<?php echo $detailmodeeditRes["$namaTableDatabase".'_image'] ?>"
										data-imageedit-folder="<?php echo $imageUploadFolder ?>"
										data-imageedit-width="<?php echo $currentImageEditRealSize[0] ?>"
										data-imageedit-height="<?php echo $currentImageEditRealSize[1] ?>"
										data-imageedit-exif="<?php echo $currentCompleteExif ?>"
									><img src="images/icon/imageedit.png" alt="Edit Image" /></a>
                                </td>
                            </tr>
                            <tr>
                            	<td>&nbsp;
                                	
                                </td>
                            </tr>
                            <tr>
                            	<td>
                                	<?php echo ueCreateInputFile('objek','image')?>
                                    <i>*<?php echo $maxFilePxUpload?> Pixels Recommended</i>
                                </td>
                                <td align="right" valign="bottom">
                                	<a onclick="return confirmSubmit()" href="action-removeimage.php<?php echo $pageParams?>&frompage=<?php echo currentPage()?>&fromtable=<?php echo $namaTableDatabase?>&id=<?php echo $detailmodeeditRes["$namaTableDatabase".'_id']?>&trgtFldr=<?php echo $imageUploadFolder?>&trgtFile=<?php echo $detailmodeeditRes["$namaTableDatabase".'_image']?>" title="Click To Remove Image"><img src="images/icon/trash.png" /></a>
                                </td>
                            </tr>
                        </table>
                     <?php
						}
						else {
					 ?>
						<table width="90%" id="eachMultiImageTable" class="eachMultiImageTableClass">
                        	<tr>
                            	<td width="1" rowspan="3" valign="top">
                                	<div id="multiImagePreview">
                                    	<img class="ueImagePreview-objek" />
                                    </div>
                                </td>
                                <td style="font-weight: bold;">
                                    Select An Image
                                </td>
                                <td width="75" align="right" valign="top">
									<div id="addWatermarkEditContainer" <?php echo tooltip('<div class="watermakPrevBg"><img src="upload/watermark/'.ueGetSiteData('watermark').'" /></div><div class="addWatermarkCheckWarning">Check this to add watermark<br /><span class="bold">NOT REVERSIBLE</span></div>'); ?>>
										<label><input type="checkbox" name="watermarkFlag" id="watermarkFlag" value="watermarkOn" <?php if($ue_globvar_watermarkdefaultchecked) {
											echo 'checked="checked"';
										}
										?> /><span class="addWatermarkText">Add Watermark </span></label>
									</div>
                                </td>
                            </tr>
                            <tr>
                            	<td>&nbsp;
                                	
                                </td>
                            	<td>&nbsp;
                                	
                                </td>
                            </tr>
                            <tr>
                            	<td valign="bottom">
                                	<?php echo ueCreateInputFile('objek','image')?>
                                    <i>*<?php echo $maxFilePxUpload?> Pixels Recommended</i>
                                </td>
                                <td align="right" valign="bottom">&nbsp;
                                	
                                </td>
                            </tr>
                        </table>
                     <?php
						}
					 ?>
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