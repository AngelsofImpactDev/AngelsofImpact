<?php
	include('head.php');
	
	$namaTableDatabase	= 'sitedata';
	$namaPageUtama		= 'sitedata.php';
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
	
	$allowImageUploadModeArr = array(
		'4'
	);
	$disallowSiteDataRTFArr = array(
		'3'
	);
?>
<?php
	include('top.php');
?>
<?php
	include('left.php');
?>
<div class="transFullWidthWrapper" id="topMenu">
    <a href="<?php echo $namaPageUtama?>" style="background-image: url(images/icon/viewall.png);">VIEW ALL</a>
    <!--
    <a href="<?php echo $namaPageUtama?><?php echo pageParamsFormat($pageParamsArr,array('mode' => 'd'))?>" style="background-image: url(images/icon/disabled.png);">VIEW DISABLED</a>
    <a href="<?php echo $namaPageUtama?><?php echo pageParamsFormat($pageParamsArr,array('mode' => 'e'))?>" style="background-image: url(images/icon/enable.png);">VIEW ENABLED</a>
    <a href="overview.php?ovtable=<?php echo $namaTableDatabase?>&ovtitle=<?php echo $currentCheckAccessRes['adminsitepages_mainmenuname']?>&ovmainpage=<?php echo currentpage()?>" style="background-image: url(images/icon/stat1.png);">OVERVIEW</a>
    -->
    <div class="clear"></div>
</div>
<?php
	include('ue-includes/ue-currentPageInfo.php');
?>
<div class="transFullWidthWrapper" id="ueFormContainer">
    <div class="tableDetailContainer">
    <form enctype="multipart/form-data" method="post" action="action-sitedata.php">
        <input type="hidden" name="id" value="<?php echo $id?>" />
        <input type="hidden" name="detailmode" value="<?php echo $_GET['detailmode']?>" />
        <input type="hidden" name="mainpage" value="<?php echo $namaPageUtama?>" />
        <input type="hidden" name="frompage" value="<?php echo currentPage()?>" />
        <input type="hidden" name="pageparam" value="<?php echo pageParamsFormat($pageParamsArr)?>" />
    	<table id="detailPageTable" width="100%">
        	<tr>
            	<td width="150">
                	<?php echo $pageTitle?> Title</td>
                <td width="10" align="center">
                	:
                </td>
                <td>
                    <?php echo $detailmodeeditRes["$namaTableDatabase"."_title"]?>
                </td>
            </tr>
        	<tr>
            	<td>
                	<?php echo $pageTitle?> Content
                </td>
                <td align="center">
                	:
                </td>
                <td>
                	<?php
						if(in_array($id,$allowImageUploadModeArr)) {
						$imageUploadFolder = 'upload/watermark/';
						$maxFilePxUpload = '90x59';
					?>
						<table width="90%" id="eachMultiImageTable" class="eachMultiImageTableClass">
                        	<tr>
                            	<td width="1" rowspan="3" valign="top">
                                	<div id="multiImagePreview">
                                    <a id="slimboxTarget" class="ue-zoombox" href="<?php echo $imageUploadFolder?><?php echo $detailmodeeditRes["$namaTableDatabase".'_content']?>" title="<?php echo $detailmodeeditRes["$namaTableDatabase".'_content']?>">
                                    	<img class="ueImagePreview-objek" src="<?php echo $imageUploadFolder?><?php echo $detailmodeeditRes["$namaTableDatabase".'_content']?>" />
                                    </a>
                                    </div>
                                </td>
								<td style="font-weight: bold;">
                                	<a id="slimboxTarget" class="ue-lightbox" href="<?php echo $imageUploadFolder?><?php echo $detailmodeeditRes["$namaTableDatabase".'_content']?>" title="<?php echo $detailmodeeditRes["$namaTableDatabase".'_content']?>">
                                    <?php echo $detailmodeeditRes["$namaTableDatabase".'_content']?>
                                    </a>
                                </td>
                                <td width="75" align="right" valign="top">&nbsp;
									
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
                                <td align="right" valign="bottom">&nbsp;
									
                                </td>
                            </tr>
                        </table>
					<?php
						}
						else if(in_array($id,$disallowSiteDataRTFArr)) {
							echo ueCreateInputTextarea('content','',$detailmodeeditRes["$namaTableDatabase".'_content']);
						}
						else {
							echo ueCreateInputTextareaRTF('content','',$detailmodeeditRes["$namaTableDatabase".'_content']);
						}
					?>
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