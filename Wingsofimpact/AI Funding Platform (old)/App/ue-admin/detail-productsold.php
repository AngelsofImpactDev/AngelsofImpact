<?php
	include('head.php');
	
	$namaTableDatabase	= 'productsold';
	$namaHalamanEdit	= currentPage();
	$namaFolderUpload	= '';
	
	$pageType 			= 'list';					// list OR detail OR overview
	$pageTitle			= '';
	$namaPageUtama		= 'product.php';
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
    <a href="overview.php?ovtable=product&ovtitle=Product&ovmainpage=product.php" style="background-image: url(images/icon/stat1.png);">OVERVIEW</a>
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
                #
            </td>
            <td width="75">
                Edit Date
            </td>
            <td>
                Name
            </td>
            <td width="100">
                Color
            </td>
            <td width="100">
                Size
            </td>
            <td width="50">
                Sold
            </td>
        </tr>
    <?php
		//MULTI DATA TABLE POPULATE DATA
        $currentRowNumber = 1;
        $search = ue_real_escape_string($_REQUEST['search']);
        $page = $_GET['page'];
        if($page == '' || $page == 0 || $page == NULL) $page = 1;
        
        $pagePerView = $ue_globVarAdmMultiDataTableRowPerView;
    
        $mainQueryString = "SELECT * FROM productcolor
		INNER JOIN
			product ON productcolor.product_id = product.product_id
		WHERE
			productcolor.product_id = '".$_GET['id']."' AND
			productcolor_enabled = 'e'
		";
        
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
                $mainQueryString = $mainQueryString." ORDER BY productcolor_id ASC";
            }
            else {
                $mainQueryString = $mainQueryString." ORDER BY productcolor_id DESC";
            }
        }
        
        //echo $mainQueryString;
		
		//Product Size START
		$psizeArr = array();
		$psizeArrQue = ue_query("SELECT * FROM productsize WHERE product_id = '".$_GET['id']."' AND productsize_enabled = 'e'");
		while($psizeArrRes = ue_fetch_array($psizeArrQue)) {
			$psizeArr[$psizeArrRes['productsize_id']] = $psizeArrRes['productsize_name'];
		}
		//Product Size END
        
        $mainQueryQue = ue_query($mainQueryString);
        while($mainQueryRes = ue_fetch_array($mainQueryQue)) {
			foreach($psizeArr as $psizeArrKey => $psizeArrVal) {
    ?>
		<?php
            $soldStatusEach = checkPrdSold($mainQueryRes['product_id'],$mainQueryRes['productcolor_id'],$psizeArrKey);
            if($soldStatusEach == 's') {
                $checkPrdSoldQue = ue_query("SELECT productsold_id,productsold_entrydate FROM productsold WHERE
                    product_id = '".$mainQueryRes['product_id']."' AND
                    productcolor_id = '".$mainQueryRes['productcolor_id']."' AND
                    productsize_id = '".$psizeArrKey."'
                LIMIT 0,1
                ");
                
                $checkPrdSoldResRes = ue_fetch_array($checkPrdSoldQue);
				$currentSoldId = $checkPrdSoldResRes['productsold_id'];
                $currentSoldDate = $checkPrdSoldResRes['productsold_entrydate'];
            }
            else {
				$currentSoldId = '-';
                $currentSoldDate = 0;
            }
        ?>
        <tr<?php $rowMode = $currentRowNumber % 2; if($rowMode != 1) { echo ' class="even"'; } else { echo ' class="odd"'; } ?>>
            <td align="center">
                <input type="checkbox" name="multiCheckInput[]" class="multiCheckInput" value="<?php echo $mainQueryRes['product_id']?>|<?php echo $mainQueryRes['productcolor_id']?>|<?php echo $psizeArrKey?>" id="<?php echo $mainQueryRes['product_id']?>|<?php echo $mainQueryRes['productcolor_id']?>|<?php echo $psizeArrKey?>" />
            </td>
            <td align="center">
                <label for="<?php echo $mainQueryRes['product_id']?>|<?php echo $mainQueryRes['productcolor_id']?>|<?php echo $psizeArrKey?>"><?php echo $currentSoldId?></label>
            </td>
            <td align="center" <?php echo tooltip('<div id="tooltipdatedetail">'.unixtodatefull($currentSoldDate,true).'</div>',200)?>>
                <label for="<?php echo $mainQueryRes['product_id']?>|<?php echo $mainQueryRes['productcolor_id']?>|<?php echo $psizeArrKey?>"><?php echo unixtodate($currentSoldDate,true)?></label>
            </td>
            <td>
                <label for="<?php echo $mainQueryRes['product_id']?>|<?php echo $mainQueryRes['productcolor_id']?>|<?php echo $psizeArrKey?>"><?php echo $mainQueryRes['product_name']?></label>
            </td>
            <td align="center">
                <label for="<?php echo $mainQueryRes['product_id']?>|<?php echo $mainQueryRes['productcolor_id']?>|<?php echo $psizeArrKey?>"><?php echo $mainQueryRes['productcolor_name']?></label>
            </td>
            <td align="center">
            	<label for="<?php echo $mainQueryRes['product_id']?>|<?php echo $mainQueryRes['productcolor_id']?>|<?php echo $psizeArrKey?>">
            	<?php echo $psizeArrVal?>
                </label>
            </td>
            <td align="center">
	            <a href="action-productsold.php?id=<?php echo $mainQueryRes['product_id']?>&pclr=<?php echo $mainQueryRes['productcolor_id']?>&psize=<?php echo $psizeArrKey?>">
				<?php
                    if($soldStatusEach == 'a') {
                        echo '<span class="purchaseStatusEmblem purchaseStatusApproved">Available</span>';
                    }
                    else if($soldStatusEach == 's') {
                        echo '<span class="purchaseStatusEmblem purchaseStatusRejected">Sold</span>';
                    }
                ?>
                </a>
            	<!--<a href="detail-productsold.php<?php echo $pageParams?>&id=<?php echo $mainQueryRes["$namaTableDatabase".'_id']?>"><img src="images/icon/available.png" /></a>-->
            </td>
        </tr>
    <?php
            $currentRowNumber++;
			}
        }
    ?>
    </table>
</div>
</form>
<?php
	include('footer.php');
?>