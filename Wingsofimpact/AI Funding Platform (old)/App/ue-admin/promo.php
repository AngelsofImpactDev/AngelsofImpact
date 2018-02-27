<?php
	include('head.php');
	
	$namaTableDatabase	= 'promo';
	$namaHalamanEdit	= 'detail-promo.php';
	$namaFolderUpload	= '';
	
	$pageType 			= 'list';					// list OR detail OR overview
	$pageTitle			= '';
	$namaPageUtama		= currentPage();
	
	$currentTime 		= time();
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
<form id="multiCheckAllForm" method="post" action="action-multicheck.php">
<?php
	include('ue-includes/ue-multiCheckBar.php');
?>
<div class="wrapper">
<table class="multiDataViewTable" width="100%">
        <tr>
            <td width="10">
            	<a href="javascript:void(0)" id="multiCheckAllToggler">&radic;</a>
            </td>
            <td width="10">
            <a href="<?php echo pageParamsFormat($pageParamsArr,array('orderwhat' => $namaTableDatabase.'_id', 'orderby' => ueColumnSort()))?>">
                #
            </a>
            </td>
            <td width="75">
            <a href="<?php echo pageParamsFormat($pageParamsArr,array('orderwhat' => $namaTableDatabase.'_entrydate', 'orderby' => ueColumnSort()))?>">
                Entry Date
            </a>
            </td>
            <td width="75">
            <a href="<?php echo pageParamsFormat($pageParamsArr,array('orderwhat' => $namaTableDatabase.'_editdate', 'orderby' => ueColumnSort()))?>">
                Edit Date
            </a>
            </td>
            <td width="75">
            <a href="<?php echo pageParamsFormat($pageParamsArr,array('orderwhat' => $namaTableDatabase.'_type', 'orderby' => ueColumnSort()))?>">
                Promo Type
            </a>
            </td>
            <td width="200">
            <a href="<?php echo pageParamsFormat($pageParamsArr,array('orderwhat' => $namaTableDatabase.'_code', 'orderby' => ueColumnSort()))?>">
                Code
            </a>
            </td>
            <td>
            <a href="<?php echo pageParamsFormat($pageParamsArr,array('orderwhat' => $namaTableDatabase.'_name', 'orderby' => ueColumnSort()))?>">
                Name
            </a>
            </td>
            <td width="75">
            <a href="<?php echo pageParamsFormat($pageParamsArr,array('orderwhat' => $namaTableDatabase.'_used', 'orderby' => ueColumnSort()))?>">
                Times Used
            </a>
            </td>
            <td width="50">
            <a href="<?php echo pageParamsFormat($pageParamsArr,array('orderwhat' => $namaTableDatabase.'_expiry', 'orderby' => ueColumnSort()))?>">
                Expiry
            </a>
            </td>
            <td width="50">
                Edit
            </td>
            <td width="50">
            <a href="<?php echo pageParamsFormat($pageParamsArr,array('orderwhat' => $namaTableDatabase.'_enabled', 'orderby' => ueColumnSort()))?>">
                Enable
            </a>
            </td>
            <td width="50">
                Delete
            </td>
        </tr>
    <?php
		//MULTI DATA TABLE POPULATE DATA
        $currentRowNumber = 1;
        $search = ue_real_escape_string($_REQUEST['search']);
        $page = $_GET['page'];
        if($page == '' || $page == 0 || $page == NULL) $page = 1;
        
        $pagePerView = $ue_globVarAdmMultiDataTableRowPerView;
    
        $mainQueryString = "SELECT * FROM $namaTableDatabase";
        
        //For Mode System
        $modeSearched = false;
        switch($_GET['mode']) {
            case 'e':
                $mainQueryString .= " WHERE ".$namaTableDatabase."_enabled = 'e'";
                $modeSearched = true;
            break;
            case 'd':
                $mainQueryString .= " WHERE ".$namaTableDatabase."_enabled = 'd'";
                $modeSearched = true;
            break;
            case 'x':
                $mainQueryString .= " WHERE ".$namaTableDatabase."_expiry < $currentTime";
                $modeSearched = true;
            break;
            case 'a':
                $mainQueryString .= " WHERE ".$namaTableDatabase."_expiry > $currentTime";
                $modeSearched = true;
            break;
        }
        
        //For Search System
		$searchSearched = false;
        if($search) {
            $allowSearchColumnSuffixArr = array(
                $namaTableDatabase.'_name',
                $namaTableDatabase.'_code'
            );
            foreach($allowSearchColumnSuffixArr as $allowSearchColumnSuffixArrKey => $allowSearchColumnSuffixArrVal) {
                if($modeSearched == true) {
                    $searchQueryPrefix = ' AND';
                }
                else {
                    $searchQueryPrefix = ' WHERE';
                }
				if($searchSearched == true) {
					$searchQueryPrefix = ' OR';
				}
                $mainQueryString .= " ".$searchQueryPrefix." ".$allowSearchColumnSuffixArrVal." LIKE '%$search%'";
				$searchSearched = true;
            }
        }
        
        //For Page System
        $result = ue_query($mainQueryString);
        @ $jumlahData = ue_num_rows($result);
        
        $index = ($page-1)*$pagePerView;
        
        //For Order System
        if($_GET['orderwhat'] != '') {
            if($_GET['orderby'] == 'asc') {
                $mainQueryString = $mainQueryString." ORDER BY ".$_GET['orderwhat']." ASC";
            }
            else {
                $mainQueryString = $mainQueryString." ORDER BY ".$_GET['orderwhat']." DESC";
            }
        }
        else {
            if($_GET['orderby'] == 'asc') {
                $mainQueryString = $mainQueryString." ORDER BY ".$namaTableDatabase."_id ASC";
            }
            else {
                $mainQueryString = $mainQueryString." ORDER BY ".$namaTableDatabase."_id DESC";
            }
        }
        
        //echo $mainQueryString;
        
        $mainQueryQue = ue_query($mainQueryString." LIMIT $index,$pagePerView");
        while($mainQueryRes = ue_fetch_array($mainQueryQue)) {
    ?>
        <tr<?php $rowMode = $currentRowNumber % 2; if($rowMode != 1) { echo ' class="even"'; } else { echo ' class="odd"'; } ?>>
            <td align="center">
                <input type="checkbox" name="multiCheckInput[]" class="multiCheckInput" value="<?php echo $mainQueryRes["$namaTableDatabase".'_id']?>" id="<?php echo $mainQueryRes["$namaTableDatabase".'_id']?>" />
            </td>
            <td align="center">
                <label for="<?php echo $mainQueryRes["$namaTableDatabase".'_id']?>"><?php echo $mainQueryRes["$namaTableDatabase".'_id']?></label>
            </td>
            <td align="center" <?php echo tooltip('<div id="tooltipdatedetail">'.unixtodatefull($mainQueryRes["$namaTableDatabase".'_entrydate'],true).'</div>',200)?>>
                <label for="<?php echo $mainQueryRes["$namaTableDatabase".'_id']?>"><?php echo unixtodate($mainQueryRes["$namaTableDatabase".'_entrydate'],true)?></label>
            </td>
            <td align="center" <?php echo tooltip('<div id="tooltipdatedetail">'.unixtodatefull($mainQueryRes["$namaTableDatabase".'_editdate'],true).'</div>',200)?>>
                <label for="<?php echo $mainQueryRes["$namaTableDatabase".'_id']?>"><?php echo unixtodate($mainQueryRes["$namaTableDatabase".'_editdate'],true)?></label>
            </td>
			<td align="center">
            	<?php
					$promoTypeArr = array(
						'1' => 'One Time',
						'2' => 'Multiple' 
					)
				?>
                <label for="<?php echo $mainQueryRes["$namaTableDatabase".'_id']?>"><?php echo $promoTypeArr[$mainQueryRes["$namaTableDatabase".'_type']]?></label>
            </td>
            <td align="center">
                <label for="<?php echo $mainQueryRes["$namaTableDatabase".'_id']?>"><?php echo $mainQueryRes["$namaTableDatabase".'_code']?></label>
            </td>
            <td <?php
				if($mainQueryRes["$namaTableDatabase".'_image']) {
            		echo tooltip('<img src="../upload/'.$namaFolderUpload.'/'.$mainQueryRes["$namaTableDatabase".'_image'].'" class="tooltipImage" />');
				}
			?>>
                <label for="<?php echo $mainQueryRes["$namaTableDatabase".'_id']?>"><?php echo wordlimiter(nohtml($mainQueryRes["$namaTableDatabase".'_name']),120)?></label>
            </td>
            <td align="center">
            	<?php
					echo $mainQueryRes["$namaTableDatabase".'_used'];
				?>
            </td>
            <td align="center" <?php echo tooltip('<div id="tooltipdatedetail"><span class="bold">Expiry date:</span> '.unixtodatefull($mainQueryRes["$namaTableDatabase".'_expiry'],true).'</div>',200)?>>
            	<label for="<?php echo $mainQueryRes["$namaTableDatabase".'_id']?>">
            	<?php
					if($mainQueryRes["$namaTableDatabase".'_expiry'] > $currentTime) {
				?>
                <span class="purchaseStatusEmblem purchaseStatusConfirmed">Active</span>
                <?php
					}
					else {
				?>
            	<span class="purchaseStatusEmblem purchaseStatusCanceled">Expired</span>
                <?php
					}
				?>
                </label>
            </td>
            <td align="center">
            	<a href="<?php echo $namaHalamanEdit?><?php echo $pageParams?>&id=<?php echo $mainQueryRes["$namaTableDatabase".'_id']?>&detailmode=edit"><img src="images/icon/publish_y.png" /></a>
            </td>
            <td align="center">
            <?php
                if($mainQueryRes["$namaTableDatabase".'_enabled'] == 'e') {
            ?>
                <a onclick="return confirmSubmit()" href="action-enabledisable.php<?php echo $pageParams?>&frompage=<?php echo $namaPageUtama?>&fromtable=<?php echo $namaTableDatabase?>&id=<?php echo $mainQueryRes["$namaTableDatabase".'_id']?>&action=d" title="Click To Disable This Item"><img src="images/icon/tick.png" /></a>
            <?php
                }
                else if($mainQueryRes["$namaTableDatabase".'_enabled'] == 'd') {
            ?>
                <a onclick="return confirmSubmit()" href="action-enabledisable.php<?php echo $pageParams?>&frompage=<?php echo $namaPageUtama?>&fromtable=<?php echo $namaTableDatabase?>&id=<?php echo $mainQueryRes["$namaTableDatabase".'_id']?>&action=e" title="Click To Enable This Item"><img src="images/icon/publish_x.png" /></a>
            <?php
                }
            ?>
            </td>
            <td align="center">
                <a onclick="return confirmSubmit()" href="action-delete.php<?php echo $pageParams?>&frompage=<?php echo $namaPageUtama?>&fromtable=<?php echo $namaTableDatabase?>&id=<?php echo $mainQueryRes["$namaTableDatabase".'_id']?>" title="Click To Delete This Item"><img src="images/icon/trash.png" /></a>
            </td>
        </tr>
    <?php
            $currentRowNumber++;
        }
    ?>
    </table>
    <?php
        include('ue-includes/ue-pgSel.php');
    ?>
</div>
</form>
<?php
	include('footer.php');
?>