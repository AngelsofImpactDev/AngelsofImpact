<?php
	include('head.php');
	
	$namaTableDatabase	= 'transaction';
	$namaPageUtama		= 'transactionlist.php';
	$namaFolderUpload	= '';				// If any
	$maxFilePxUpload	= '';				// If any
	
	$pageType 			= 'detail';					// list OR detail OR overview
	$id					= ue_real_escape_string($_GET['tid']);
	$pageTitle			= $currentCheckAccessRes['adminsitepages_mainmenuname'];
	$namaHalamanEdit	= currentPage();
	
	if($_GET['detailmode'] == 'edit') {
		$detailmodeeditQue = ue_query("SELECT a.*, b.user_name, c.startup_name FROM ".$namaTableDatabase." a 
										LEFT JOIN user b ON a.user_id = b.user_id 
										LEFT JOIN startup c ON a.startup_id = c.startup_id
										WHERE a.".$namaTableDatabase."_id = '".$id."' LIMIT 1");
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
    <form enctype="multipart/form-data" method="post" action="action-transactionlist.php">
        <input type="hidden" name="id" value="<?php echo $id?>" />
        <input type="hidden" name="detailmode" value="<?php echo $_GET['detailmode']?>" />
        <input type="hidden" name="mainpage" value="<?php echo $namaPageUtama?>" />
        <input type="hidden" name="frompage" value="<?php echo currentPage()?>" />
        <input type="hidden" name="pageparam" value="<?php echo pageParamsFormat($pageParamsArr)?>" />
    	<table id="detailPageTable" width="100%">
        	<tr>
            	<td width="150">
                	Angel Name*
                </td>
                <td width="10" align="center">
                	:
                </td>
                <td>
					<?php echo $detailmodeeditRes['user_name'] ?>
                </td>
            </tr>
        	<tr>
            	<td width="150">
                	Startup Name*
                </td>
                <td width="10" align="center">
                	:
                </td>
                <td>
                    <?php echo $detailmodeeditRes['startup_name'] ?>
                </td>
            </tr>
        	<tr>
            	<td>
                	Gift*
                </td>
                <td align="center">
                	:
                </td>
                <td>
					<?php echo ueCreateInputTextarea('gift','',$detailmodeeditRes['transaction_gift'])?>
                </td>
            </tr>
			<tr>
				<td width="150">
                	<?php echo $pageTitle?> Amount ($) *
                </td>
                <td width="10" align="center">
                	:
                </td>
                <td class="smallSelect">
					<?php echo ueCreateInputText('amount','',$detailmodeeditRes["$namaTableDatabase".'_amount'])?>
                </td>
            </tr>
        	<tr>
            	<td>
                	<?php echo $pageTitle?> Status*
                </td>
                <td align="center">
                	:
                </td>
                <td>
					<?php
                        $currentRadioArr = array(
                            'name' => 'status',
                            'list' => array(
                                'Unpaid' => 'unpaid',
                                'Paid' => 'paid'
                            )
                        );
                    ?>
                    <?php echo ueCreateInputRadio($currentRadioArr,'unpaid',$detailmodeeditRes["$namaTableDatabase".'_status'])?>
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