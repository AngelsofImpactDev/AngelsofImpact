<?php
	include('head.php');
	
	$namaTableDatabase	= 'transactiondetail';
	$namaHalamanEdit	= '';
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
            <td width="10">
				<a href="<?php echo pageParamsFormat($pageParamsArr,array('orderwhat' => $namaTableDatabase.'_entrydate', 'orderby' => ueColumnSort()))?>">
					Repayments Due
				</a>
            </td>
			<td width="10">
				<a href="<?php echo pageParamsFormat($pageParamsArr,array('orderwhat' => $namaTableDatabase.'_name', 'orderby' => ueColumnSort()))?>">
					Confirm Date
				</a>
            </td>
			<td width="10">
				<a href="<?php echo pageParamsFormat($pageParamsArr,array('orderwhat' => $namaTableDatabase.'_editdate', 'orderby' => ueColumnSort()))?>">
					Startup Name
				</a>
            </td>
			<td width="10">
				<a href="<?php echo pageParamsFormat($pageParamsArr,array('orderwhat' => $namaTableDatabase.'_editdate', 'orderby' => ueColumnSort()))?>">
					Angel Name
				</a>
            </td>
            <td width="10">
				<a href="<?php echo pageParamsFormat($pageParamsArr,array('orderwhat' => $namaTableDatabase.'_editdate', 'orderby' => ueColumnSort()))?>">
					Amount
				</a>
            </td>
			<!--
			<td width="75">
				<a href="<?php echo pageParamsFormat($pageParamsArr,array('orderwhat' => $namaTableDatabase.'_editdate', 'orderby' => ueColumnSort()))?>">
					Confirm Date
				</a>
            </td>
			-->
			<td width="10">
				<a href="<?php echo pageParamsFormat($pageParamsArr,array('orderwhat' => $namaTableDatabase.'_name', 'orderby' => ueColumnSort()))?>">
					Status
				</a>
            </td>
            <!--
			<td>
				<a width="50" href="<?php echo pageParamsFormat($pageParamsArr,array('orderwhat' => $namaTableDatabase.'_email', 'orderby' => ueColumnSort()))?>">
					Target
				</a>
            </td>
			<td>
				<a width="50" href="<?php echo pageParamsFormat($pageParamsArr,array('orderwhat' => $namaTableDatabase.'_email', 'orderby' => ueColumnSort()))?>">
					Funds Pledged
				</a>
            </td>
			<td width="30">
                Status
            </td>
			<td width="100">
				Expiry date
            </td>
			
            <td width="50">
                Credit
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
			-->
        </tr>
    <?php
		//MULTI DATA TABLE POPULATE DATA
        $currentRowNumber = 1;
        $search = ue_real_escape_string($_REQUEST['search']);
        $page = $_GET['page'];
        if($page == '' || $page == 0 || $page == NULL) $page = 1;
        
        //$pagePerView = $ue_globVarAdmMultiDataTableRowPerView;
		$pagePerView = $ue_globVarAdmMultiDataTableRowPerView;
		/*
        $mainQueryString = "SELECT a.*, SUM(b.transaction_amount) as fundPledged FROM $namaTableDatabase a LEFT JOIN transaction b ON a.startup_id = b.startup_id";        
        */
		$mainQueryString = "SELECT a.*, c.startup_id, c.user_id, b.startup_name, d.user_name as angelName FROM $namaTableDatabase a LEFT JOIN transaction c ON a.transaction_id = c.transaction_id LEFT JOIN startup b ON c.startup_id = b.startup_id LEFT JOIN user d ON c.user_id = d.user_id WHERE a.transaction_id = '".$_GET['idt']."'";
		//echo $mainQueryString;
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
		//$mainQueryString.= " GROUP BY startup_id";
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
            if($_GET['orderby'] == 'desc') {
				$mainQueryString = $mainQueryString." ORDER BY ".$namaTableDatabase."_repaymentdue DESC";
                
            }
            else {
                $mainQueryString = $mainQueryString." ORDER BY ".$namaTableDatabase."_repaymentdue ASC";
            }
        }
        
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
            <td align="center" <?php echo tooltip('<div id="tooltipdatedetail">'.unixtodatefull($mainQueryRes["$namaTableDatabase".'_repaymentdue'],true).'</div>',200)?>>
                <label for="<?php echo $mainQueryRes["$namaTableDatabase".'_id']?>"><?php echo date("Y-m-d",$mainQueryRes["$namaTableDatabase".'_repaymentdue']);?></label>
            </td>
			<td align="center" <?php echo tooltip('<div id="tooltipdatedetail">'.unixtodatefull($mainQueryRes["$namaTableDatabase".'_editdate'],true).'</div>',200)?>>
                <label for="<?php echo $mainQueryRes["$namaTableDatabase".'_id']?>">
					<?php
						if($mainQueryRes["$namaTableDatabase".'_editdate'] == 0){
							echo "-";
						}else{
							echo date("Y-m-d",$mainQueryRes["$namaTableDatabase".'_editdate']);
						}
					?>
				</label>
            </td>
			<td align="center">
                <label for="<?php echo $mainQueryRes["$namaTableDatabase".'_id']?>"><?php echo wordlimiter(nohtml($mainQueryRes['startup_name']),120)?></label>
            </td>
			<td align="center">
                <label for="<?php echo $mainQueryRes["$namaTableDatabase".'_id']?>"><?php echo $mainQueryRes['angelName']?></label>
            </td>
			<td align="center">
                <label for="<?php echo $mainQueryRes["$namaTableDatabase".'_id']?>"><?php echo $mainQueryRes['transactiondetail_amount']?></label>
            </td>
			<td>
                <label for="<?php echo $mainQueryRes["$namaTableDatabase".'_id']?>">
					<?php
					if($mainQueryRes['transactiondetail_status'] == "paid"){
					?>
						<a class="purchaseStatusEmblem purchaseStatusApproved" onclick="return confirm('Reject this payment ?')" style="font-weight:bold;" href="action-statusswitch.php<?php echo $pageParams?>&targetdatabasename=transactiondetail&targetcolumnname=transactiondetail_status&targetcolumnid=transactiondetail_id&id=<?php echo $mainQueryRes["$namaTableDatabase".'_id']?>&frompage=<?php echo $namaPageUtama?>&idt=<?php echo $mainQueryRes['transaction_id']?>&action=unpaid">
							<?php echo $mainQueryRes['transactiondetail_status'];?>
						</a>
					<?php
					}else{
					?>
						<a class="purchaseStatusEmblem purchaseStatusRejected" onclick="return confirm('Approve this payment ?')" style="font-weight:bold;" href="action-statusswitch.php<?php echo $pageParams?>&targetdatabasename=transactiondetail&targetcolumnname=transactiondetail_status&targetcolumnid=transactiondetail_id&id=<?php echo $mainQueryRes["$namaTableDatabase".'_id']?>&frompage=<?php echo $namaPageUtama?>&idt=<?php echo $mainQueryRes['transaction_id']?>&action=paid">
							<?php echo $mainQueryRes['transactiondetail_status'];?>
						</a>
					<?php
					}
					?>
					
				</label>
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