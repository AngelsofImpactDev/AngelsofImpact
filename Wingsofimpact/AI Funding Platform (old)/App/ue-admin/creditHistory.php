<?php
	include('head.php');
	
	$namaTableDatabase	= 'usercredithistory';
	$namaHalamanEdit	= '';
	$namaFolderUpload	= '';
	
	$pageType 			= 'list';					// list OR detail OR overview
	$pageTitle			= '';
	$namaPageUtama		= 'user.php';
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
            <a href="<?php echo pageParamsFormat($pageParamsArr,array('orderwhat' => $namaTableDatabase.'_id', 'orderby' => ueColumnSort()))?>">
                #
            </a>
            </td>
            <td width="75">
            <a href="<?php echo pageParamsFormat($pageParamsArr,array('orderwhat' => $namaTableDatabase.'_entrydate', 'orderby' => ueColumnSort()))?>">
                Entry Date
            </a>
            </td>
            <td width="100">
            <a href="<?php echo pageParamsFormat($pageParamsArr,array('orderwhat' => 'adminuserlogin_id', 'orderby' => ueColumnSort()))?>">
                Admin
            </a>
            </td>
            <td>
            <a href="<?php echo pageParamsFormat($pageParamsArr,array('orderwhat' => $namaTableDatabase.'_desc', 'orderby' => ueColumnSort()))?>">
                Desc
            </a>
            </td>
            <td width="125">
            <a href="<?php echo pageParamsFormat($pageParamsArr,array('orderwhat' => $namaTableDatabase.'_before', 'orderby' => ueColumnSort()))?>">
                Balance Before
            </a>            
            </td>
            <td width="50">
            <a href="<?php echo pageParamsFormat($pageParamsArr,array('orderwhat' => $namaTableDatabase.'_type', 'orderby' => ueColumnSort()))?>">
                DB/CR
            </a>
            </td>
            <td width="125">
            <a href="<?php echo pageParamsFormat($pageParamsArr,array('orderwhat' => $namaTableDatabase.'_mutasi', 'orderby' => ueColumnSort()))?>">
                Mutasi
            </a>
            </td>
            <td width="125">
                Balance Result
            </td>
        </tr>
    <?php
		//MULTI DATA TABLE POPULATE DATA
        $currentRowNumber = 1;
        $search = ue_real_escape_string($_REQUEST['search']);
        $page = $_GET['page'];
        if($page == '' || $page == 0 || $page == NULL) $page = 1;
        
        $pagePerView = $ue_globVarAdmMultiDataTableRowPerView;
    
        $mainQueryString = "SELECT * FROM $namaTableDatabase WHERE user_id = '".$_GET['id']."'";
        
        //For Mode System
		/*
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
		*/
        
        //For Search System
		$searchSearched = false;
        if($search) {
            $allowSearchColumnSuffixArr = array(
                $namaTableDatabase.'_mutasi',
				$namaTableDatabase.'_before',
				$namaTableDatabase.'_type'
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
                <?php echo $mainQueryRes["$namaTableDatabase".'_id']?>
            </td>
            <td align="center" <?php echo tooltip('<div id="tooltipdatedetail">'.unixtodatefull($mainQueryRes["$namaTableDatabase".'_entrydate'],true).'</div>',200)?>>
                <?php echo unixtodate($mainQueryRes["$namaTableDatabase".'_entrydate'],true)?>
            </td>
            <td align="center">
                <?php
					$adminQue = ue_query("SELECT adminuserlogin_username FROM adminuserlogin WHERE adminuserlogin_id = '".$mainQueryRes['adminuserlogin_id']."' LIMIT 1");
					if(@$adminRes = ue_fetch_array($adminQue)) {
						echo $adminRes['adminuserlogin_username'];
					}
					else {
						echo '<span style="color: #209acd; font-weight: bold;">SYSTEM</span>';
					}
				?>
            </td>
            <td>
				<?php
					if($mainQueryRes['purchase_id'] > 0) {
						$pQue = ue_query("SELECT purchase_code FROM purchase WHERE purchase_id = '".$mainQueryRes['purchase_id']."' LIMIT 1");
						if(@$pRes = ue_fetch_array($pQue)) {
							echo '<a href="detail-purchase.php?&id='.$mainQueryRes['purchase_id'].'&detailmode=edit&purchasecode='.$pRes['purchase_code'].'" class="tooltip" title="Click to view purchase details">'.$mainQueryRes["$namaTableDatabase".'_desc'].'</a>';
						}
					}
					else {
							echo $mainQueryRes["$namaTableDatabase".'_desc'];
					}
				?>
            </td>
            <td align="center">
                <?php echo moneyFormat($mainQueryRes["$namaTableDatabase".'_before'],$ue_globvar_currency)?>
            </td>
            <td align="center">
            	<?php echo $mainQueryRes["$namaTableDatabase".'_type']?>
            </td>
            <td align="center">
            	<?php echo moneyFormat($mainQueryRes["$namaTableDatabase".'_mutasi'],$ue_globvar_currency)?>
            </td>
            <td align="center">
            	<?php
					if($mainQueryRes["$namaTableDatabase".'_type'] == 'DB') {
						$balanceResult = ($mainQueryRes["$namaTableDatabase".'_before'] - $mainQueryRes["$namaTableDatabase".'_mutasi']);
					}
					else if($mainQueryRes["$namaTableDatabase".'_type'] == 'CR') {
						$balanceResult = ($mainQueryRes["$namaTableDatabase".'_before'] + $mainQueryRes["$namaTableDatabase".'_mutasi']);
					}
					echo moneyFormat($balanceResult,$ue_globvar_currency);
                ?>
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