<?php
	include('head.php');
	
	$namaTableDatabase	= 'campaign';
	$namaPageUtama		= 'campaign.php';
	$namaFolderUpload	= 'campaign';				// If any
	$maxFilePxUpload	= '';			// If any
	
	$pageType 			= 'detail';					// list OR detail OR overview
	$id					= ue_real_escape_string($_GET['id']);
	$pageTitle			= 'Campaign';
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
    <form enctype="multipart/form-data" method="post" action="action-campaign.php">
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
                	# of <?php echo $pageTitle?> Tracking Days*
                </td>
                <td align="center">
                	:
                </td>
                <td <?php echo tooltip('<div id="tooltipdatedetail"># of days of user will still be tracked since campaign triggered.<br /><b>A tracked user won&lsquo;t be counted on other campaign.</b></div>',200)?>>
                	<?php echo ueCreateInputText('maxtrackdate','365',$detailmodeeditRes["$namaTableDatabase".'_maxtrackdate'])?>
                </td>
            </tr>
            <tr>
            	<td align="right" colspan="3">
					<input name="submitMode" type="submit" value="Submit" />
                </td>
            </tr>
        </table>
    </form>
    </div>
</div>
<?php
	include('footer.php');
?>