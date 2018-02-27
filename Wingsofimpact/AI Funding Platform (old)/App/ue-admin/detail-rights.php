<?php
	include('head.php');
	
	$namaTableDatabase	= 'adminsitepages';
	$namaHalamanEdit	= 'detail-rightspages.php';
	$namaFolderUpload	= '';
	
	$pageType 			= 'list';					// list OR detail OR overview
	$pageTitle			= '';
	$namaPageUtama		= 'rights.php';
	$pageParams			= '?';
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
    <a href="overview.php?ovtable=adminuserlevel&ovtitle=Administrator&ovmainpage=rights.php" style="background-image: url(images/icon/stat1.png);">OVERVIEW</a>
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
            <td>
            <a href="<?php echo pageParamsFormat($pageParamsArr,array('orderwhat' => $namaTableDatabase.'_name', 'orderby' => ueColumnSort()))?>">
                Name
            </a>
            </td>
            <td width="50">
                Edit
            </td>
        </tr>
    <?php
		//MULTI DATA TABLE POPULATE DATA
        $currentRowNumber = 1;
        $search = ue_real_escape_string($_REQUEST['search']);
        $page = $_GET['page'];
        if($page == '' || $page == 0 || $page == NULL) $page = 1;
        
        $pagePerView = $ue_globVarAdmMultiDataTableRowPerView;
    
        $mainQueryString = "SELECT * FROM $namaTableDatabase WHERE ".$namaTableDatabase."_enabled = 'e'";
        
        //For Search System
		$modeSearched = true;
        if($search) {
            $allowSearchColumnSuffixArr = array(
                'mainmenuname'
            );
            foreach($allowSearchColumnSuffixArr as $allowSearchColumnSuffixArrKey => $allowSearchColumnSuffixArrVal) {
                if($modeSearched == true) {
                    $searchQueryPrefix = ' AND';
                }
                else {
                    $searchQueryPrefix = ' WHERE';
                }
                $mainQueryString .= " ".$searchQueryPrefix." ".$namaTableDatabase."_".$allowSearchColumnSuffixArrVal." LIKE '%$search%'";
            }
        }
		
		$mainQueryString .= ' GROUP BY '.$namaTableDatabase.'_mainmenuname';
        
        //For Page System
        $result = ue_query($mainQueryString);
        @ $jumlahData = ue_num_rows($result);
        
        $index = ($page-1)*$pagePerView;
        
        //For Order System
        if($_GET['orderwhat'] != '') {
            if($_GET['orderby'] == 'desc') {
                $mainQueryString = $mainQueryString." ORDER BY ".$_GET['orderwhat']." DESC";
            }
            else {
                $mainQueryString = $mainQueryString." ORDER BY ".$_GET['orderwhat']." ASC";
            }
        }
        else {
            if($_GET['orderby'] == 'desc') {
                $mainQueryString = $mainQueryString." ORDER BY adminsitepages_name DESC";
            }
            else {
                $mainQueryString = $mainQueryString." ORDER BY adminsitepages_name ASC";
            }
        }
        
        //echo $mainQueryString;
        
        $mainQueryQue = ue_query($mainQueryString);
        while($mainQueryRes = ue_fetch_array($mainQueryQue)) {
    ?>
        <tr<?php $rowMode = $currentRowNumber % 2; if($rowMode != 1) { echo ' class="even"'; } else { echo ' class="odd"'; } ?>>
            <td align="center">
                <label for="<?php echo $mainQueryRes["$namaTableDatabase".'_id']?>"><?php echo $mainQueryRes["$namaTableDatabase".'_id']?></label>
            </td>
            <td>
                <label for="<?php echo $mainQueryRes["$namaTableDatabase".'_id']?>"><?php echo wordlimiter(nohtml($mainQueryRes['adminsitepages_mainmenuname']),120)?> Rights</label>
            </td>
            <td align="center">
            	<a href="<?php echo $namaHalamanEdit?><?php echo $pageParams?>&id=<?php echo $_GET['id']?>&idmenu=<?php echo $mainQueryRes["$namaTableDatabase".'_mainmenuname']?>&detailmode=edit"><img src="images/icon/publish_y.png" /></a>
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