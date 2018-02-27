<?php
	include('head.php');
	
	$namaTableDatabase	= 'purchase';
	$namaHalamanEdit	= 'detail-purchase.php';
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
    <a href="<?php echo $namaPageUtama?><?php echo pageParamsFormat($pageParamsArr,array('mode' => 'r'))?>" style="background-image: url(images/icon/requested.png);">VIEW REQUESTS</a>
    <a href="<?php echo $namaPageUtama?><?php echo pageParamsFormat($pageParamsArr,array('mode' => 'c'))?>" style="background-image: url(images/icon/confirmed.png);">VIEW CONFIRMED</a>
    <a href="<?php echo $namaPageUtama?><?php echo pageParamsFormat($pageParamsArr,array('mode' => 'a'))?>" style="background-image: url(images/icon/approved.png);">VIEW APPROVED</a>
    <a href="<?php echo $namaPageUtama?><?php echo pageParamsFormat($pageParamsArr,array('mode' => 's'))?>" style="background-image: url(images/icon/shippedIcon.png);">VIEW SHIPPED</a>
    <a href="<?php echo $namaPageUtama?><?php echo pageParamsFormat($pageParamsArr,array('mode' => 'x'))?>" style="background-image: url(images/icon/rejected.png);">VIEW REJECTED</a>
    <a href="<?php echo $namaPageUtama?><?php echo pageParamsFormat($pageParamsArr,array('mode' => 'z'))?>" style="background-image: url(images/icon/canceled.png);">VIEW CANCELED</a>
    <a href="overview.php?ovtable=<?php echo $namaTableDatabase?>&ovtitle=<?php echo $currentCheckAccessRes['adminsitepages_mainmenuname']?>&ovmainpage=<?php echo currentpage()?>" style="background-image: url(images/icon/stat1.png);">OVERVIEW</a>
    <a href="action-truncate.php" style="background-image: url(images/icon/destroy.png);" <?php echo tooltip('Deletes purchase <span class="bold">Requests</span> older than 30 days',275)?> onclick="return confirmSubmit()">TRUNCATE</a>
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
            <a href="<?php echo pageParamsFormat($pageParamsArr,array('orderwhat' => $namaTableDatabase.'_id', 'orderby' => ueColumnSort()))?>">
                #
            </a>
            </td>
            <td width="75">
            <a href="<?php echo pageParamsFormat($pageParamsArr,array('orderwhat' => $namaTableDatabase.'_entrydate', 'orderby' => ueColumnSort()))?>">
                Purchase Date
            </a>
            </td>
            <td width="75">
            <a href="<?php echo pageParamsFormat($pageParamsArr,array('orderwhat' => $namaTableDatabase.'_editdate', 'orderby' => ueColumnSort()))?>">
                Confirm Date
            </a>
            </td>
            <td width="200">
            <a href="<?php echo pageParamsFormat($pageParamsArr,array('orderwhat' => $namaTableDatabase.'_code', 'orderby' => ueColumnSort()))?>">
                Purchase Code
            </a>
            </td>
            <td>
            <a href="<?php echo pageParamsFormat($pageParamsArr,array('orderwhat' => $namaTableDatabase.'_email', 'orderby' => ueColumnSort()))?>">
                Email
            </a>
            </td>
            <td width="100">
                Total
            </td>
            <td width="50">
            <a href="<?php echo pageParamsFormat($pageParamsArr,array('orderwhat' => $namaTableDatabase.'_status', 'orderby' => ueColumnSort()))?>">
                Status
            </a>
            </td>
            <td width="50">
                Edit
            </td>
            <td width="50">
                Process
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
    
        $mainQueryString = "SELECT * FROM $namaTableDatabase
		";
        
        //For Mode System
        $modeSearched = false;
        switch($_GET['mode']) {
            case 'r':
                $mainQueryString .= " WHERE ".$namaTableDatabase."_status = '".$_GET['mode']."'";
                $modeSearched = true;
            break;
            case 'c':
                $mainQueryString .= " WHERE ".$namaTableDatabase."_status = '".$_GET['mode']."'";
                $modeSearched = true;
            break;
            case 'a':
                $mainQueryString .= " WHERE ".$namaTableDatabase."_status = '".$_GET['mode']."' AND ".$namaTableDatabase."_trackingcode = ''";
                $modeSearched = true;
            break;
            case 's':
                $mainQueryString .= " WHERE ".$namaTableDatabase."_status = 'a' AND ".$namaTableDatabase."_trackingcode != ''";
                $modeSearched = true;
            break;
            case 'x':
                $mainQueryString .= " WHERE ".$namaTableDatabase."_status = '".$_GET['mode']."'";
                $modeSearched = true;
            break;
			case 'z':
                $mainQueryString .= " WHERE ".$namaTableDatabase."_status = '".$_GET['mode']."'";
                $modeSearched = true;
            break;
        }
        
        //For Search System
		$searchSearched = false;
        if($search) {
            $allowSearchColumnSuffixArr = array(
                $namaTableDatabase.'_name',
				$namaTableDatabase.'_code',
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
		
		$mainQueryString .= ' GROUP BY purchase_code';
        
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
                <?php echo $mainQueryRes["$namaTableDatabase".'_id']?>
            </td>
            <td align="center" <?php echo tooltip('<div id="tooltipdatedetail">'.unixtodatefull($mainQueryRes["$namaTableDatabase".'_entrydate'],true).'</div>',200)?>>
                <?php echo unixtodate($mainQueryRes["$namaTableDatabase".'_entrydate'],true)?>
            </td>
            <td align="center" <?php echo tooltip('<div id="tooltipdatedetail">'.unixtodatefull($mainQueryRes["$namaTableDatabase".'_editdate'],true).'</div>',200)?>>
                <?php echo unixtodate($mainQueryRes["$namaTableDatabase".'_editdate'],true)?>
            </td>
            <td align="center">
                <?php echo $mainQueryRes["$namaTableDatabase".'_code']?>
            </td>
            <td align="center">
				<?php
					$pageParamsArrNoPage = array_filter($pageParamsArr, function($v) { return $v != "page"; });
				?>
                <a href="<?php echo $namaPageUtama?><?php echo pageParamsFormat($pageParamsArrNoPage,array('search' => $mainQueryRes["$namaTableDatabase".'_email']))?>" title="Click to Search All Purchases By This Email"><?php echo $mainQueryRes["$namaTableDatabase".'_email']?></a>
            </td>
            <td align="center">
                <?php echo moneyFormat(getPurchaseGrandTotal($mainQueryRes["$namaTableDatabase".'_code']),$ue_globvar_currency)?>
            </td>
            <td align="center">
            	<?php
					switch($mainQueryRes["$namaTableDatabase".'_status']) {
						case 'x':
							echo '<span class="purchaseStatusEmblem purchaseStatusRejected">Rejected</span>';
						break;
						case 'r':
							echo '<span class="purchaseStatusEmblem purchaseStatusRequest">Request</span>';
						break;
						case 'c':
							echo '<span class="purchaseStatusEmblem purchaseStatusConfirmed">Confirmed</span>';
						break;
						case 'a':
							if($mainQueryRes["$namaTableDatabase".'_trackingcode'] != '') {
								echo '<span class="purchaseStatusEmblem purchaseStatusShipped">Shipped</span>';
							}
							else {
								echo '<span class="purchaseStatusEmblem purchaseStatusApproved">Approved</span>';
							}
						break;
						case 'z':
							echo '<span class="purchaseStatusEmblem purchaseStatusCanceled">Canceled</span>';
						break;
					}
				?>
            </td>
            <td align="center">
            	<a href="<?php echo $namaHalamanEdit?><?php echo $pageParams?>&id=<?php echo $mainQueryRes["$namaTableDatabase".'_id']?>&detailmode=edit&purchasecode=<?php echo $mainQueryRes["$namaTableDatabase".'_code']?>"><img src="images/icon/publish_y.png" /></a>
            </td>
            <td align="center">
            	<a href="<?php echo $namaHalamanEdit?><?php echo $pageParams?>&id=<?php echo $mainQueryRes["$namaTableDatabase".'_id']?>&detailmode=edit"><img src="images/icon/process.png" /></a>
            </td>
            <td align="center">
                <a onclick="return confirmSubmit()" href="action-delete.php<?php echo $pageParams?>&frompage=<?php echo $namaPageUtama?>&fromtable=<?php echo $namaTableDatabase?>&id=<?php echo $mainQueryRes["$namaTableDatabase".'_id']?>&purchasecode=<?php echo $mainQueryRes["$namaTableDatabase".'_code']?>" title="Click To Delete This Item"><img src="images/icon/trash.png" /></a>
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