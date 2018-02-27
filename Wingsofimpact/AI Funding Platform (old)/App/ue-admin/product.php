<?php
	include('head.php');
	
	$namaTableDatabase	= 'product';
	$namaHalamanEdit	= 'detail-product.php';
	$namaFolderUpload	= 'productImageThumb';
	
	$pageType 			= 'list';					// list OR detail OR overview
	$pageTitle			= '';
	$namaPageUtama		= currentPage();
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
            <td width="100">
            <a href="<?php echo pageParamsFormat($pageParamsArr,array('orderwhat' => 'producttype_id', 'orderby' => ueColumnSort()))?>">
                Type
            </a>
            </td>
            <td>
            <a href="<?php echo pageParamsFormat($pageParamsArr,array('orderwhat' => $namaTableDatabase.'_name', 'orderby' => ueColumnSort()))?>">
                Name
            </a>
            </td>
            <td width="50">
            <a href="<?php echo pageParamsFormat($pageParamsArr,array('orderwhat' => $namaTableDatabase.'_featured', 'orderby' => ueColumnSort()))?>">
                Featured
            </a>
            </td>
            <td width="50">
                Sold
            </td>
            <td width="50">
                Swap
            </td>
            <td width="50">
                Top
            </td>
            <td width="50">
                Edit
            </td>
            <td width="50">
                Image
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
        }
        
        //For Search System
		$searchSearched = false;
        if($search) {
            $allowSearchColumnSuffixArr = array(
                $namaTableDatabase.'_name'
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
                $mainQueryString = $mainQueryString." ORDER BY ".$namaTableDatabase."_showorder ASC";
            }
            else {
                $mainQueryString = $mainQueryString." ORDER BY ".$namaTableDatabase."_showorder DESC";
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
            	<label for="<?php echo $mainQueryRes["$namaTableDatabase".'_id']?>">
            	<?php
					$inColumnQue = ue_query("SELECT producttype_name FROM producttype WHERE producttype_id = ".$mainQueryRes['producttype_id']." LIMIT 1");
					$inColumnRes = ue_fetch_array($inColumnQue);
					echo $inColumnRes['producttype_name'];
				?>
                </label>
            </td>
            <td <?php
				$curRowImgPrd = getImageName($mainQueryRes["$namaTableDatabase".'_id']);
				if($curRowImgPrd) {
					echo tooltip('<img src="../upload/productImageThumb/'.$curRowImgPrd.'" width="150" />',150);
				}
            ?>>
                <label for="<?php echo $mainQueryRes["$namaTableDatabase".'_id']?>"><?php echo wordlimiter(nohtml($mainQueryRes["$namaTableDatabase".'_name']),120)?></label>
            </td>
            <td align="center">
            	<?php
					$statusSwitchTableName = 'product';
					$statusSwitchIdColumnName = $statusSwitchTableName.'_id';
					$statusSwitchColumnName = $statusSwitchTableName.'_featured';
					$statusSwitchQue = ue_query("SELECT * FROM $statusSwitchTableName WHERE $statusSwitchIdColumnName = '".$mainQueryRes["$namaTableDatabase".'_id']."' LIMIT 1");
					$statusSwitchRes = ue_fetch_array($statusSwitchQue);
					if($statusSwitchRes["$statusSwitchColumnName"] == 'd') {
				?>
            	<a href="action-statusswitch.php<?php echo $pageParams?>&targetdatabasename=<?php echo $statusSwitchTableName?>&targetcolumnname=<?php echo $statusSwitchColumnName?>&targetcolumnid=<?php echo $statusSwitchIdColumnName?>&id=<?php echo $mainQueryRes["$namaTableDatabase".'_id']?>&frompage=<?php echo $namaPageUtama?>&action=e" title="Click To Enable"><img src="images/icon/starOff.png" /></a>
                <?php
					}
					else if($statusSwitchRes["$statusSwitchColumnName"] == 'e') {
				?>
                <a href="action-statusswitch.php<?php echo $pageParams?>&targetdatabasename=<?php echo $statusSwitchTableName?>&targetcolumnname=<?php echo $statusSwitchColumnName?>&targetcolumnid=<?php echo $statusSwitchIdColumnName?>&id=<?php echo $mainQueryRes["$namaTableDatabase".'_id']?>&frompage=<?php echo $namaPageUtama?>&action=d" title="Click To Disable"><img src="images/icon/starOn.png" /></a>
                <?php
					}
				?>
            </td>
            <td align="center">
			<?php
				$urlSoldEditTrue = '<a href="detail-productsold.php'.$pageParams.'&id='.$mainQueryRes["$namaTableDatabase".'_id'].'">';
				$urlSoldEditFalse = '<a href="'.$namaHalamanEdit.$pageParams.'&id='.$mainQueryRes["$namaTableDatabase".'_id'].'&detailmode=edit">';
				
				$soldStatusEach = checkPrdSold($mainQueryRes["$namaTableDatabase".'_id']);
                if($soldStatusEach == 'a') {
					echo $urlSoldEditTrue.'<span class="purchaseStatusEmblem purchaseStatusApproved">Available</span></a>';
				}
				else if($soldStatusEach == 's') {
					echo $urlSoldEditTrue.'<span class="purchaseStatusEmblem purchaseStatusRejected">Sold</span></a>';
				}
				else if($soldStatusEach == 'p') {
					echo $urlSoldEditTrue.'<span class="purchaseStatusEmblem purchaseStatusConfirmed">Partial</span></a>';
				}
				else if($soldStatusEach == 'i') {
					echo $urlSoldEditFalse.'<span class="purchaseStatusEmblem purchaseStatusCanceled tooltip" title="At least one <span class=\'bold\'>Size</span> &amp; <span class=\'bold\'>Color</span> required">Void</span></a>';
				}
            ?>
            </td>
            <td align="center">
            <?php
	            if($_GET['swapperSelf'] != '') {
					if($_GET['swapperSelf'] == $mainQueryRes["$namaTableDatabase".'_showorder']) {
			?>
            	<a href="<?php echo pageParamsFormat($pageParamsArr,array('swapperSelf' => ''))?>" title="Cancel Swap"><img src="images/icon/swapOff.png" /></a>
            <?php
					}
					else {
			?>
                <a href="action-swapper.php<?php echo $pageParams?>&swapperTarget=<?php echo $mainQueryRes["$namaTableDatabase".'_showorder']?>&swapperTable=<?php echo $namaTableDatabase?>&frompage=<?php echo $namaPageUtama?>" title="Swap With This"><img src="images/icon/swap.png" /></a>
            <?php
					}
				}
				else {
			?>
                <a href="<?php echo pageParamsFormat($pageParamsArr,array('swapperSelf' => $mainQueryRes["$namaTableDatabase".'_showorder']))?>" title="Swap This"><img src="images/icon/swapOff.png" /></a>
            <?php
				}
			?>
            </td>
            <td align="center">
                <a onclick="return confirmSubmit()" href="action-moveToTop.php<?php echo $pageParams?>&frompage=<?php echo $namaPageUtama?>&fromtable=<?php echo $namaTableDatabase?>&id=<?php echo $mainQueryRes["$namaTableDatabase".'_id']?>" title="Move Item to Top"><img src="images/icon/arrowUp.png" /></a>
            </td>
            <td align="center">
            	<a href="<?php echo $namaHalamanEdit?><?php echo $pageParams?>&id=<?php echo $mainQueryRes["$namaTableDatabase".'_id']?>&detailmode=edit"><img src="images/icon/publish_y.png" /></a>
            </td>
            <td align="center">
            	<a href="detail-imagelist.php<?php echo $pageParams?>&id=<?php echo $mainQueryRes["$namaTableDatabase".'_id']?>&imagelisttable=productimage&detailmode=edit"><img src="images/icon/picture.png" /></a>
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