<?php
	include('head.php');
	
	$namaTableDatabase	= 'sitedata';
	$namaPageUtama		= 'panel.php';
	$namaHalamanEdit	= '';
?>
<?php
	include('top.php');
?>
<?php
	include('left.php');
?>
<?php
	$mainQueryString = "SELECT * FROM $namaTableDatabase
						WHERE ".$namaTableDatabase."_title = 'adminnewscontent'
	";
	
	//echo $mainQueryString;
	$mainQueryQue = ue_query($mainQueryString." LIMIT 1");
	$mainQueryRes = ue_fetch_array($mainQueryQue);
?>
<h1 id="adminTitle"><?php echo ueWritePage(ueGetSiteData('adminnewstitle'),true)?></h1>
<div class="transFullWidthWrapper">
    <div id="adminNewsDate" class="bold clockContainer"><?php echo date("j F Y, g:ia",$mainQueryRes["$namaTableDatabase".'_editdate'])?></div>
    <?php echo ueWritePage($mainQueryRes["$namaTableDatabase".'_content'],true)?>
</div>
<div class="wrapper">
    <table id="dashboardTable" width="100%">
        <tr>
            <td width="50%" valign="top">
                <div class="adminSubTitle"><a href="user.php">Recent Users</a></div>
                <table class="multiDataViewTable" width="100%">
                    <tr>
                        <td width="10">
                            #
                        </td>
                        <td width="75">
                            Date
                        </td>
                        <td>
                            Email
                        </td>
                        <td width="50">
                            Edit
                        </td>
                    </tr>
					<?php
                        //MULTI DATA TABLE POPULATE DATA
                        $currentRowNumber = 1;
						$namaTableDatabase = 'user';
						
						$namaHalamanEdit = 'detail-user.php';
						$page = 1;
                        
                        $pagePerView = 10;
                    
                        $mainQueryString = "SELECT * FROM $namaTableDatabase";
                        
                        //For Page System
                        $result = ue_query($mainQueryString);
                        @ $jumlahData = ue_num_rows($result);
                        
                        $index = ($page-1)*$pagePerView;
                        
                        //For Order System
                        $mainQueryString = $mainQueryString." ORDER BY ".$namaTableDatabase."_id DESC";
                        
                        //echo $mainQueryString;
                        
                        $mainQueryQue = ue_query($mainQueryString." LIMIT $index,$pagePerView");
                        while($mainQueryRes = ue_fetch_array($mainQueryQue)) {
                    ?>
                    <tr<?php $rowMode = $currentRowNumber % 2; if($rowMode != 1) { echo ' class="even"'; } else { echo ' class="odd"'; } ?>>
                        <td align="center">
                            <?php echo $mainQueryRes["$namaTableDatabase".'_id']?>
                        </td>
                        <td align="center" class="tooltip" <?php echo tooltip('<div id="tooltipdatedetail">'.unixtodatefull($mainQueryRes["$namaTableDatabase".'_entrydate'],true).'</div>',200)?>>
                            <?php echo unixtodate($mainQueryRes["$namaTableDatabase".'_entrydate'],true)?>
                        </td>
                        <td align="center">
                            <?php echo wordlimiter(nohtml($mainQueryRes["$namaTableDatabase".'_email']),120)?>
                        </td>
                        <td align="center">
                            <a href="<?php echo $namaHalamanEdit?><?php echo $pageParams?>&id=<?php echo $mainQueryRes["$namaTableDatabase".'_id']?>&detailmode=edit"><img src="images/icon/publish_y.png" /></a>
                        </td>
                    </tr>
					<?php
                            $currentRowNumber++;
                        }
                    ?>
                </table>
            </td>
            <td valign="top">
                <div class="adminSubTitle"><a href="purchase.php">Recent Purchases</a></div>
                <table class="multiDataViewTable" width="100%">
                    <tr>
                        <td width="10">
                            #
                        </td>
                        <td width="75">
                            Date
                        </td>
                        <td>
                            Email
                        </td>
                        <td width="50">
                            Status
                        </td>
                        <td width="50">
                            Process
                        </td>
                    </tr>
					<?php
                        //MULTI DATA TABLE POPULATE DATA
                        $currentRowNumber = 1;
						$namaTableDatabase = 'purchase';
						
						$namaHalamanEdit = 'detail-purchase.php';
						$page = 1;
                        
                        $pagePerView = 10;
                    
                        $mainQueryString = "SELECT * FROM $namaTableDatabase";
                        
						$mainQueryString .= ' GROUP BY purchase_code';
						
                        //For Page System
                        $result = ue_query($mainQueryString);
                        @ $jumlahData = ue_num_rows($result);
                        
                        $index = ($page-1)*$pagePerView;
                        
                        //For Order System
                        $mainQueryString = $mainQueryString." ORDER BY ".$namaTableDatabase."_id DESC";
                        
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
                            <a href="purchase.php<?php echo pageParamsFormat($pageParamsArr,array('search' => $mainQueryRes["$namaTableDatabase".'_email']))?>" title="Click to Search All Purchases By This Email"><?php echo $mainQueryRes["$namaTableDatabase".'_email']?></a>
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
                            <a href="<?php echo $namaHalamanEdit?><?php echo $pageParams?>&id=<?php echo $mainQueryRes["$namaTableDatabase".'_id']?>&detailmode=edit"><img src="images/icon/process.png" /></a>
                        </td>
                    </tr>
					<?php
                            $currentRowNumber++;
                        }
                    ?>
                </table>
            </td>
        </tr>
    </table>
</div>
<div class="wrapper">
    <table id="dashboardTable" width="100%">
        <tr>
            <td width="50%" valign="top">
                <div class="adminSubTitle"><a href="subscriber.php">Recent Subscriber</a></div>
                <table class="multiDataViewTable" width="100%">
                    <tr>
                        <td width="10">
                            #
                        </td>
                        <td width="75">
                            Date
                        </td>
                        <td>
                            Email
                        </td>
                        <td width="50">
                            Edit
                        </td>
                    </tr>
					<?php
                        //MULTI DATA TABLE POPULATE DATA
                        $currentRowNumber = 1;
						$namaTableDatabase = 'subscriber';
						
						$namaHalamanEdit = 'detail-subscriber.php';
						$page = 1;
                        
                        $pagePerView = 10;
                    
                        $mainQueryString = "SELECT * FROM $namaTableDatabase";
                        
                        //For Page System
                        $result = ue_query($mainQueryString);
                        @ $jumlahData = ue_num_rows($result);
                        
                        $index = ($page-1)*$pagePerView;
                        
                        //For Order System
                        $mainQueryString = $mainQueryString." ORDER BY ".$namaTableDatabase."_id DESC";
                        
                        //echo $mainQueryString;
                        
                        $mainQueryQue = ue_query($mainQueryString." LIMIT $index,$pagePerView");
                        while($mainQueryRes = ue_fetch_array($mainQueryQue)) {
                    ?>
                    <tr<?php $rowMode = $currentRowNumber % 2; if($rowMode != 1) { echo ' class="even"'; } else { echo ' class="odd"'; } ?>>
                        <td align="center">
                            <?php echo $mainQueryRes["$namaTableDatabase".'_id']?>
                        </td>
                        <td align="center" class="tooltip" <?php echo tooltip('<div id="tooltipdatedetail">'.unixtodatefull($mainQueryRes["$namaTableDatabase".'_entrydate'],true).'</div>',200)?>>
                            <?php echo unixtodate($mainQueryRes["$namaTableDatabase".'_entrydate'],true)?>
                        </td>
                        <td align="center">
                            <?php echo wordlimiter(nohtml($mainQueryRes["$namaTableDatabase".'_name']),120)?>
                        </td>
                        <td align="center">
                            <a href="<?php echo $namaHalamanEdit?><?php echo $pageParams?>&id=<?php echo $mainQueryRes["$namaTableDatabase".'_id']?>&detailmode=edit"><img src="images/icon/publish_y.png" /></a>
                        </td>
                    </tr>
					<?php
                            $currentRowNumber++;
                        }
                    ?>
                </table>
            </td>
            <td valign="top">
                <div class="adminSubTitle"><a href="promo.php">Active Promotions</a></div>
                <table class="multiDataViewTable" width="100%">
                    <tr>
                        <td width="10">
                            #
                        </td>
                        <td width="75">
                            Date
                        </td>
                        <td>
                            Name
                        </td>
                        <td width="75">
                            Type
                        </td>
                        <td width="50">
                            Edit
                        </td>
                    </tr>
					<?php
						$currentTime 		= time();
						
                        //MULTI DATA TABLE POPULATE DATA
                        $currentRowNumber = 1;
						$namaTableDatabase = 'promo';
						
						$namaHalamanEdit = 'detail-promo.php';
						$page = 1;
                        
                        $pagePerView = 10;
                    
                        $mainQueryString = "SELECT * FROM $namaTableDatabase";
						
						$mainQueryString .= " WHERE ".$namaTableDatabase."_expiry > $currentTime";
						
                        //For Page System
                        $result = ue_query($mainQueryString);
                        @ $jumlahData = ue_num_rows($result);
                        
                        $index = ($page-1)*$pagePerView;
                        
                        //For Order System
                        $mainQueryString = $mainQueryString." ORDER BY ".$namaTableDatabase."_id DESC";
                        
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
                            <?php echo $mainQueryRes["$namaTableDatabase".'_name']?>
                        </td>
                        <td align="center">
							<?php
                                $promoTypeArr = array(
                                    '1' => 'One Time',
                                    '2' => 'Multiple' 
                                )
                            ?>
                            <?php echo $promoTypeArr[$mainQueryRes["$namaTableDatabase".'_type']]?>
                        </td>
                        <td align="center">
            				<a href="<?php echo $namaHalamanEdit?><?php echo $pageParams?>&id=<?php echo $mainQueryRes["$namaTableDatabase".'_id']?>&detailmode=edit"><img src="images/icon/publish_y.png" /></a>
                        </td>
                    </tr>
					<?php
                            $currentRowNumber++;
                        }
                    ?>
                </table>
            </td>
        </tr>
    </table>
</div>
<div class="spacer20"></div>
<div class="spacer20"></div>
<?php
	include('footer.php');
?>