<?php
	include('head.php');
	
	$namaTableDatabase	= 'transaction';
	$namaHalamanEdit	= 'detail-transactionlist.php';
	$namaFolderUpload	= '';
	
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
			<td width="75">
				<a href="<?php echo pageParamsFormat($pageParamsArr,array('orderwhat' => $namaTableDatabase.'_editdate', 'orderby' => ueColumnSort()))?>">
					Confirm Date
				</a>
            </td>
            <td width="100">
				<a href="<?php echo pageParamsFormat($pageParamsArr,array('orderwhat' => $namaTableDatabase.'_name', 'orderby' => ueColumnSort()))?>">
					Startup Name
				</a>
            </td>
			<td width="100">
				<a href="<?php echo pageParamsFormat($pageParamsArr,array('orderwhat' => $namaTableDatabase.'_name', 'orderby' => ueColumnSort()))?>">
					Angel Name
				</a>
            </td>
			<td>
				<a width="50" href="<?php echo pageParamsFormat($pageParamsArr,array('orderwhat' => $namaTableDatabase.'_email', 'orderby' => ueColumnSort()))?>">
					Amount
				</a>
            </td>
            <td>
				<a width="50" href="<?php echo pageParamsFormat($pageParamsArr,array('orderwhat' => $namaTableDatabase.'_email', 'orderby' => ueColumnSort()))?>">
					Funds needed
				</a>
            </td>
			<td width="100">
                Gift
            </td>
			<td width="100">
                Status
            </td>
			<!--
			<td width="100">
				Expiry date
            </td>
			
            <td width="50">
                Credit
            </td>
			-->
            <td width="50">
                Edit
            </td>
            <!--
			<td width="50">
            <a href="<?php echo pageParamsFormat($pageParamsArr,array('orderwhat' => $namaTableDatabase.'_enabled', 'orderby' => ueColumnSort()))?>">
                Enable
            </a>
            </td>
			-->
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
    
        $mainQueryString = "SELECT a.*, b.startup_name, b.startup_amount, c.user_name, (SELECT SUM(transaction_amount) FROM transaction WHERE startup_id = '".$_GET['id']."' AND transaction_status = 'paid') as totalPledged FROM $namaTableDatabase a LEFT JOIN startup b ON a.startup_id = b.startup_id LEFT JOIN user c ON a.user_id = c.user_id WHERE a.startup_id = '".$_GET['id']."'";        
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
                $namaTableDatabase.'_name',
				$namaTableDatabase.'_email'
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
		$mainQueryString.= " GROUP BY transaction_id";
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
			<td align="center" <?php echo tooltip('<div id="tooltipdatedetail">'.unixtodatefull($mainQueryRes["$namaTableDatabase".'_confirmdate'],true).'</div>',200)?>>
                <label for="<?php echo $mainQueryRes["$namaTableDatabase".'_id']?>"><?php echo unixtodate($mainQueryRes["$namaTableDatabase".'_confirmdate'],true)?></label>
            </td>
            <td>
                <label for="<?php echo $mainQueryRes["$namaTableDatabase".'_id']?>"><?php echo wordlimiter(nohtml($mainQueryRes['startup_name']),120)?></label>
            </td>
			<td>
                <label for="<?php echo $mainQueryRes["$namaTableDatabase".'_id']?>"><?php echo wordlimiter(nohtml($mainQueryRes['user_name']),120)?></label>
            </td>
			<td align="center">
                <label for="<?php echo $mainQueryRes["$namaTableDatabase".'_id']?>"><?php echo "$ ".$mainQueryRes["$namaTableDatabase".'_amount']?></label>
            </td>
			<td align="center">
                <label for="<?php echo $mainQueryRes["$namaTableDatabase".'_id']?>">
				<?php 
				$needAmount = $mainQueryRes['startup_amount'] - $mainQueryRes['totalPledged'];
				echo "$ ".$needAmount;
				?>
				</label>
            </td>
			<td align="center">
                <label for="<?php echo $mainQueryRes["$namaTableDatabase".'_id']?>"><?php echo $mainQueryRes["$namaTableDatabase".'_gift']?></label>
            </td>
			<td align="center">
                <label for="<?php echo $mainQueryRes["$namaTableDatabase".'_id']?>">
				<?php 
					if(strtolower($mainQueryRes["$namaTableDatabase".'_status']) == "paid"){
						echo "<span class='purchaseStatusEmblem purchaseStatusApproved'>".ucfirst($mainQueryRes["$namaTableDatabase".'_status'])."</span>";
					}else{
						echo "<span class='purchaseStatusEmblem purchaseStatusRejected'>".ucfirst($mainQueryRes["$namaTableDatabase".'_status'])."</span>";
					}
				?>	
				</label>
            </td>
			<!--
			<td>
                <label for="<?php echo $mainQueryRes["$namaTableDatabase".'_id']?>"><?php echo date("Y-m-d",$mainQueryRes["$namaTableDatabase".'_expirydate'])?></label>
            </td>
			-->
			<!--
            <td align="center">
            	<a href="creditHistory.php?id=<?php echo $mainQueryRes["$namaTableDatabase".'_id']?>" title="View Credit History"><img src="images/icon/money.png" /></a>
            </td>
			-->
            <td align="center">
            	<a href="<?php echo $namaHalamanEdit?>?tid=<?php echo $mainQueryRes["$namaTableDatabase".'_id']?>&detailmode=edit"><img src="images/icon/publish_y.png" /></a>
            </td>
			<!--
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
			-->
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