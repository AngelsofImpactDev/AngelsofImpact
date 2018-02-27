<?php
	include('head.php');
	
	$namaTableDatabase	= 'analytics';
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
	$mainQueryString = "SELECT * FROM $namaTableDatabase";
	switch($analyticsMode) {
		default:
			//Overview Mode
			$headingTitle = 'Overview Analytics';
		break;
	}

	//Check if searched by Campaign ID
	if($id > 0) {
		$mainQueryString .= " WHERE campaign_id = 'adminnewscontent'";
	}
	
	//Check Date
	if($startdate > 0 && $enddate > 0) {
		$enddate = (int)$enddate;
		$startdate = (int)$startdate;
	}
	else {
		$enddate = strtotime(date('d F Y').' 23:59');
		$startdate = strtotime(date('d F Y').' -4 months');
	}
	$mainQueryString .= " WHERE campaign_entrydate >= '$startdate' AND campaign_entrydate <= '$enddate'";

	
	//echo $mainQueryString;
	$mainQueryQue = ue_query($mainQueryString);
	$mainQueryRes = ue_fetch_array($mainQueryQue);
?>
<h1 id="adminTitle"><?php echo $headingTitle; ?></h1>
<table width="100%" cellpadding="0" cellspacing="0" style="background-color: #333333; color: #fff;" class="bold">
	<tr>
		<td width="44%" class="centerText" style="padding-bottom: 12px; padding-top: 5px;">
			From
			<div class="spacer5"></div>
			<div class="smallSelect">
                <input type='hidden' name='ovtable' id='ovtable' value='<?php echo $namaTableDatabase; ?>' />
                <input type='hidden' name='ovtitle' id='ovtitle' value='<?php echo $_GET['ovtitle']; ?>' />
                <input type='hidden' name='ovmainpage' id='ovmainpage' value='<?php echo $_GET['ovmainpage']; ?>' />
                <?php
					$defaultDate = strtotime('first day of -5 month midnight');
                    
                    $currentDate = date('j',$defaultDate);
                    $currentMonth = date('F',$defaultDate);
                    $currentYear = date('Y',$defaultDate);
                ?>
                <?php					
                    $currentSelectArr = array(
                        'name' => 'startdate',
                        'list' => array()
                    );
                ?>
                <?php
                    for($i=1;$i<=31;$i++) {
                        $currentSelectArr['list']["$i"] = $i;
                    }
                ?>
                <?php echo ueCreateSelectOption($currentSelectArr,$currentDate,'')?>
                
                <?php					
                    $currentSelectArr = array(
                        'name' => 'startmon',
                        'list' => array()
                    );
                ?>
                <?php
                    $months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
                    for($i=0;$i<count($months);$i++) {
                        $currentSelectArr['list'][$months["$i"]] = $months["$i"];
                    }
                ?>
                <?php echo ueCreateSelectOption($currentSelectArr,$currentMonth,'')?>
                
                <?php					
                    $currentSelectArr = array(
                        'name' => 'startyear',
                        'list' => array()
                    );
                ?>
                <?php
                    for($i=(date("Y")-10);$i<(date("Y")+1);$i++) {
                        $currentSelectArr['list']["$i"] = $i;
                    }
					
					$currentSelectArr['list'] = array_reverse($currentSelectArr['list'],true);
                ?>
                <?php echo ueCreateSelectOption($currentSelectArr,$currentYear,'')?>
			</div>
		</td>
		<td width="44%" class="centerText" style="padding-bottom: 12px; padding-top: 5px;">
			To
			<div class="spacer5"></div>
			<div class="smallSelect">
				<?php
                    $defaultDate = time();
                    
                    $currentDate = date('j',$defaultDate);
                    $currentMonth = date('F',$defaultDate);
                    $currentYear = date('Y',$defaultDate);
                ?>
                <?php					
                    $currentSelectArr = array(
                        'name' => 'enddate',
                        'list' => array()
                    );
                ?>
                <?php
                    for($i=1;$i<=31;$i++) {
                        $currentSelectArr['list']["$i"] = $i;
                    }
                ?>
                <?php echo ueCreateSelectOption($currentSelectArr,$currentDate,'')?>
                
                <?php					
                    $currentSelectArr = array(
                        'name' => 'endmon',
                        'list' => array()
                    );
                ?>
                <?php
                    $months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
                    for($i=0;$i<count($months);$i++) {
                        $currentSelectArr['list'][$months["$i"]] = $months["$i"];
                    }
                ?>
                <?php echo ueCreateSelectOption($currentSelectArr,$currentMonth,'')?>
                
                <?php					
                    $currentSelectArr = array(
                        'name' => 'endyear',
                        'list' => array()
                    );
                ?>
                <?php
                    for($i=(date("Y")-10);$i<(date("Y")+1);$i++) {
                        $currentSelectArr['list']["$i"] = $i;
                    }
					
					$currentSelectArr['list'] = array_reverse($currentSelectArr['list'],true);
                ?>
                <?php echo ueCreateSelectOption($currentSelectArr,$currentYear,'')?>
			</div>
		</td>
		<td class="centerText">
			<input type="submit" value="SUBMIT" style="margin-right: 10%; background-color: #2eb1cf;" />
		</td>
	</tr>
</table>
<table width="100%" cellpadding="0" cellspacing="0" id="eachOverviewHeadPanelContainer">
	<tr>
		<td width="20%">
			<div class="eachOverviewHeadPanel" style="background-color: #3f85f2; background-image: url(images/icon/analyticsIcon1.png);">
				<div class="overviewPanelNumber">918.000</div>
				<div class="overviewPanelText">Visits</div>
				<a href="#">In-depth Analysis</a>
			</div>
		</td>
		<td width="20%">
			<div class="eachOverviewHeadPanel" style="background-color: #db4437; background-image: url(images/icon/analyticsIcon2.png);">
				<div class="overviewPanelNumber">918.000</div>
				<div class="overviewPanelText">User Registrations</div>
				<a href="#">In-depth Analysis</a>
			</div>
		</td>
		<td width="20%">
			<div class="eachOverviewHeadPanel" style="background-color: #6a4a3c; background-image: url(images/icon/analyticsIcon4.png);">
				<div class="overviewPanelNumber">918.000</div>
				<div class="overviewPanelText">User Logins</div>
				<a href="#">In-depth Analysis</a>
			</div>
		</td>
		<td width="20%">
			<div class="eachOverviewHeadPanel" style="background-color: #f4b400; background-image: url(images/icon/analyticsIcon3.png);">
				<div class="overviewPanelNumber">918.000</div>
				<div class="overviewPanelText">Guest Logins</div>
				<a href="#">In-depth Analysis</a>
			</div>
		</td>
		<td width="20%">
			<div class="eachOverviewHeadPanel" style="background-color: #9fbeee; background-image: url(images/icon/analyticsIcon5.png);">
				<div class="overviewPanelNumber">918.000</div>
				<div class="overviewPanelText">Subscribers</div>
				<a href="#">In-depth Analysis</a>
			</div>
		</td>
	</tr>
	<tr>
		<td>
			<div class="eachOverviewHeadPanel" style="background-color: #669721; background-image: url(images/icon/analyticsIcon7.png);">
				<div class="overviewPanelNumber">918.000</div>
				<div class="overviewPanelText">Purchases</div>
				<a href="#">In-depth Analysis</a>
			</div>
		</td>
		<td>
			<div class="eachOverviewHeadPanel" style="background-color: #f86b23; background-image: url(images/icon/analyticsIcon6.png);">
				<div class="overviewPanelNumber">918.000</div>
				<div class="overviewPanelText">Product Views</div>
				<a href="#">In-depth Analysis</a>
			</div>
		</td>
		<td>
			<div class="eachOverviewHeadPanel" style="background-color: #7e3794; background-image: url(images/icon/analyticsIcon9.png);">
				<div class="overviewPanelNumber">918.000</div>
				<div class="overviewPanelText">Local Searches</div>
				<a href="#">In-depth Analysis</a>
			</div>
		</td>
		<td>
			<div class="eachOverviewHeadPanel" style="background-color: #2eb1cf; background-image: url(images/icon/analyticsIcon8.png);">
				<div class="overviewPanelNumber">918.000</div>
				<div class="overviewPanelText">News Reads</div>
				<a href="#">In-depth Analysis</a>
			</div>
		</td>
		<td>
			<div class="eachOverviewHeadPanel" style="background-color: #248298; background-image: url(images/icon/analyticsIcon10.png);">
				<div class="overviewPanelNumber">918.000</div>
				<div class="overviewPanelText">Contact Form Submissions</div>
				<a href="#">In-depth Analysis</a>
			</div>
		</td>
	</tr>
</table>
<div class="spacer20"></div>
<div class="transFullWidthWrapper">
	<div id="adminNewsDate" class="bold clockContainer">
    	<table width="100%" cellpadding="0" cellspacing="0">
        	<tr>
            	<td>
                	Goals Overview
                </td>
                <td class="smallSelect" width="1">
					&nbsp;
					<!--
                	<form method="get" id="ovform">
						<?php					
                            $currentSelectArr = array(
                                'name' => 'ovmonths',
                                'list' => array(
									'd' => 'Daily View',
									'w' => 'Weekly View',
									'm' => 'Monthly View',
									'y' => 'Yearly View'
								)
                            );
                        ?>
                        <?php echo ueCreateSelectOption($currentSelectArr,'d','')?>
                        <input type="hidden" name="ovtable" value="<?php echo $_GET['ovtable']?>" />
                        <input type="hidden" name="ovtitle" value="<?php echo $_GET['ovtitle']?>" />
                        <input type="hidden" name="ovmainpage" value="<?php echo $_GET['ovmainpage']?>" />
                    </form>
                    <script type="text/javascript">
						$('select[name="ovmonths"]').change(function() {
							$('#ovform').submit();
						});
					</script>
					-->
                </td>
            </tr>
        </table>
    </div>
	<?php
		$chartData = array(
			'Visit' => array(
				'Jan' => '1',
				'Feb' => '2',
				'Mar' => '3'
			),
			'Purchase' => array(
				'Jan' => '1',
				'Feb' => '2',
				'Mar' => '3'
			),
			'Register' => array(
				'Jan' => '1',
				'Feb' => '2',
				'Mar' => '3'
			),
			'Search' => array(
				'Jan' => '1',
				'Feb' => '2',
				'Mar' => '3'
			),
			'User Login' => array(
				'Jan' => '1',
				'Feb' => '2',
				'Mar' => '3'
			),
			'Guest Login' => array(
				'Jan' => '1',
				'Feb' => '2',
				'Mar' => '3'
			),
			'Subscribe' => array(
				'Jan' => '1',
				'Feb' => '2',
				'Mar' => '3'
			),
			'View Product' => array(
				'Jan' => '1',
				'Feb' => '2',
				'Mar' => '3'
			),
			'Read News' => array(
				'Jan' => '1',
				'Feb' => '2',
				'Mar' => '3'
			),
			'Contact Form' => array(
				'Jan' => '1',
				'Feb' => '2',
				'Mar' => '3'
			)
		);
	?>
    <?php echo generateChart($chartData)?>
</div>
<table width="100%" class="twinTableContainer">
	<tr>
		<td width="50%" valign="top">
			<div class="analyticsTableContainer">
				<div id="analyticsHead" style="background-image: url(images/analyticsBg1.gif);">
					<div class="adminSubTitle">Best Seller Items</div>
					<div class="analyticsSubtitle">Number of item quantities sold</div>
				</div>
				<div>
					<table width="100%" class="analyticsTopListTable">
						<tr>
							<td width="1">
								<div id="multiImagePreview">
									<a id="slimboxTarget" class="ue-zoombox" href="../upload/productImage/product-test-1-7521c.jpg" title="LUPZUM">
										<img src="../upload/productImage/product-test-1-7521c.jpg" />
									</a>
								</div>
							</td>
							<td>
								<div class="analyticsTopListTableContent">
									<a href="#" class="bold">Bola Gabus Kasar</a>
									<a href="#">IDR 80.000</a>
								</div>
							</td>
							<td class="centerText fontsize30 bold" width="80">
								5
							</td>
						</tr>
						<tr class="analyticsEvenRow">
							<td colspan="2">
								<div class="analyticsTopListTableContent">
									<a href="#" class="bold">Bola Gabus Kasar</a>
									<a href="#">IDR 80.000</a>
								</div>
							</td>
							<td class="centerText fontsize30 bold">
								<div class="fontsize30 bold">5</div>
							</td>
						</tr>
						<tr class="analyticsOddRow">
							<td colspan="2">
								<div class="analyticsTopListTableContent">
									<a href="#" class="bold">Bola Gabus Kasar</a>
									<a href="#">IDR 80.000</a>
								</div>
							</td>
							<td class="centerText fontsize30 bold">
								<div class="fontsize30 bold">5</div>
							</td>
						</tr>
						<tr class="analyticsEvenRow">
							<td colspan="2">
								<div class="analyticsTopListTableContent">
									<a href="#" class="bold">Bola Gabus Kasar</a>
									<a href="#">IDR 80.000</a>
								</div>
							</td>
							<td class="centerText fontsize30 bold">
								<div class="fontsize30 bold">5</div>
							</td>
						</tr>
						<tr class="analyticsOddRow">
							<td colspan="2">
								<div class="analyticsTopListTableContent">
									<a href="#" class="bold">Bola Gabus Kasar</a>
									<a href="#">IDR 80.000</a>
								</div>
							</td>
							<td class="centerText fontsize30 bold">
								<div class="fontsize30 bold">5</div>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</td>
		<td valign="top">
			<div class="analyticsTableContainer">
				<div id="analyticsHead" style="background-image: url(images/analyticsBg2.gif);">
					<div class="adminSubTitle">Most Viewed Items</div>
					<div class="analyticsSubtitle">Number of visits to product details page</div>
				</div>
				<div>
					<table width="100%" class="analyticsTopListTable">
						<tr>
							<td width="1">
								<div id="multiImagePreview">
									<a id="slimboxTarget" class="ue-zoombox" href="../upload/productImage/product-test-1-7521c.jpg" title="LUPZUM">
										<img src="../upload/productImage/product-test-1-7521c.jpg" />
									</a>
								</div>
							</td>
							<td>
								<div class="analyticsTopListTableContent">
									<a href="#" class="bold">Bola Gabus Kasar</a>
									<a href="#">IDR 80.000</a>
								</div>
							</td>
							<td class="centerText fontsize30 bold" width="80">
								5
							</td>
						</tr>
						<tr class="analyticsEvenRow">
							<td colspan="2">
								<div class="analyticsTopListTableContent">
									<a href="#" class="bold">Bola Gabus Kasar</a>
									<a href="#">IDR 80.000</a>
								</div>
							</td>
							<td class="centerText fontsize30 bold">
								<div class="fontsize30 bold">5</div>
							</td>
						</tr>
						<tr class="analyticsOddRow">
							<td colspan="2">
								<div class="analyticsTopListTableContent">
									<a href="#" class="bold">Bola Gabus Kasar</a>
									<a href="#">IDR 80.000</a>
								</div>
							</td>
							<td class="centerText fontsize30 bold">
								<div class="fontsize30 bold">5</div>
							</td>
						</tr>
						<tr class="analyticsEvenRow">
							<td colspan="2">
								<div class="analyticsTopListTableContent">
									<a href="#" class="bold">Bola Gabus Kasar</a>
									<a href="#">IDR 80.000</a>
								</div>
							</td>
							<td class="centerText fontsize30 bold">
								<div class="fontsize30 bold">5</div>
							</td>
						</tr>
						<tr class="analyticsOddRow">
							<td colspan="2">
								<div class="analyticsTopListTableContent">
									<a href="#" class="bold">Bola Gabus Kasar</a>
									<a href="#">IDR 80.000</a>
								</div>
							</td>
							<td class="centerText fontsize30 bold">
								<div class="fontsize30 bold">5</div>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</td>
	</tr>
</table>
<table width="100%" class="twinTableContainer">
	<tr>
		<td width="50%" valign="top">
			<div class="analyticsTableContainer">
				<div id="analyticsHead" style="background-image: url(images/analyticsBg3.gif);">
					<div class="adminSubTitle">Top Page Views</div>
					<div class="analyticsSubtitle">Top visited pages</div>
				</div>
				<div>
					<table width="100%" class="analyticsTopListTable">
						<tr class="analyticsOddRow">
							<td colspan="2">
								<div class="analyticsTopListTableContent">
									<a href="#" class="bold">Bola Gabus Kasar</a>
									<a href="#">IDR 80.000</a>
								</div>
							</td>
							<td class="centerText fontsize30 bold" width="80">
								5
							</td>
						</tr>
						<tr class="analyticsEvenRow">
							<td colspan="2">
								<div class="analyticsTopListTableContent">
									<a href="#" class="bold">Bola Gabus Kasar</a>
									<a href="#">IDR 80.000</a>
								</div>
							</td>
							<td class="centerText fontsize30 bold">
								<div class="fontsize30 bold">5</div>
							</td>
						</tr>
						<tr class="analyticsOddRow">
							<td colspan="2">
								<div class="analyticsTopListTableContent">
									<a href="#" class="bold">Bola Gabus Kasar</a>
									<a href="#">IDR 80.000</a>
								</div>
							</td>
							<td class="centerText fontsize30 bold">
								<div class="fontsize30 bold">5</div>
							</td>
						</tr>
						<tr class="analyticsEvenRow">
							<td colspan="2">
								<div class="analyticsTopListTableContent">
									<a href="#" class="bold">Bola Gabus Kasar</a>
									<a href="#">IDR 80.000</a>
								</div>
							</td>
							<td class="centerText fontsize30 bold">
								<div class="fontsize30 bold">5</div>
							</td>
						</tr>
						<tr class="analyticsOddRow">
							<td colspan="2">
								<div class="analyticsTopListTableContent">
									<a href="#" class="bold">Bola Gabus Kasar</a>
									<a href="#">IDR 80.000</a>
								</div>
							</td>
							<td class="centerText fontsize30 bold">
								<div class="fontsize30 bold">5</div>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</td>
		<td valign="top">
			<div class="analyticsTableContainer">
				<div id="analyticsHead" style="background-image: url(images/analyticsBg4.gif);">
					<div class="adminSubTitle">Top Search</div>
					<div class="analyticsSubtitle">Top user searched words</div>
				</div>
				<div>
					<table width="100%" class="analyticsTopListTable">
						<tr class="analyticsOddRow">
							<td colspan="2">
								<div class="analyticsTopListTableContent">
									<a href="#" class="bold">Bola Gabus Kasar</a>
									<a href="#">IDR 80.000</a>
								</div>
							</td>
							<td class="centerText fontsize30 bold" width="80">
								5
							</td>
						</tr>
						<tr class="analyticsEvenRow">
							<td colspan="2">
								<div class="analyticsTopListTableContent">
									<a href="#" class="bold">Bola Gabus Kasar</a>
									<a href="#">IDR 80.000</a>
								</div>
							</td>
							<td class="centerText fontsize30 bold">
								<div class="fontsize30 bold">5</div>
							</td>
						</tr>
						<tr class="analyticsOddRow">
							<td colspan="2">
								<div class="analyticsTopListTableContent">
									<a href="#" class="bold">Bola Gabus Kasar</a>
									<a href="#">IDR 80.000</a>
								</div>
							</td>
							<td class="centerText fontsize30 bold">
								<div class="fontsize30 bold">5</div>
							</td>
						</tr>
						<tr class="analyticsEvenRow">
							<td colspan="2">
								<div class="analyticsTopListTableContent">
									<a href="#" class="bold">Bola Gabus Kasar</a>
									<a href="#">IDR 80.000</a>
								</div>
							</td>
							<td class="centerText fontsize30 bold">
								<div class="fontsize30 bold">5</div>
							</td>
						</tr>
						<tr class="analyticsOddRow">
							<td colspan="2">
								<div class="analyticsTopListTableContent">
									<a href="#" class="bold">Bola Gabus Kasar</a>
									<a href="#">IDR 80.000</a>
								</div>
							</td>
							<td class="centerText fontsize30 bold">
								<div class="fontsize30 bold">5</div>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</td>
	</tr>
</table>
<div class="analyticsTableContainer">
	<div id="analyticsHead" style="background-image: url(images/analyticsBg5.gif);">
		<div class="adminSubTitle">Purchases</div>
		<div class="analyticsSubtitle">All purchases data breakdown</div>
	</div>
	<div>
		<table width="100%" cellpadding="0" cellspacing="0" id="triTableAnalytics">
			<tr>
				<td width="33%" valign="top">
					<div class="spacer20"></div>
					<div style="width: 150px; margin: auto;">
						<?php
							$generateCircleChartData = array(
								'All' => 300,
								'Approved' => 300,
								'Rejected' => 300,
								'Canceled' => 300,
								'Confirmed' => 300,
								'Requested ' => 300
							);
						?>
						<?php echo generateCircleChart($generateCircleChartData) ?>
					</div>
					<div class="borderedAnalyticsTitle">
						Purchase Status
					</div>
					<table width="100%" class="analyticsTopListTable">
						<tr class="analyticsOddRow">
							<td colspan="2">
								<div class="analyticsTopListTableContent">
									<a href="#">All Purchases</a>
								</div>
							</td>
							<td class="centerText bold" width="50%">
								5
							</td>
						</tr>
						<tr class="analyticsEvenRow">
							<td colspan="2">
								<div class="analyticsTopListTableContent">
									<a href="#">Requests</a>
								</div>
							</td>
							<td class="centerText bold">
								5
							</td>
						</tr>
						<tr class="analyticsOddRow">
							<td colspan="2">
								<div class="analyticsTopListTableContent">
									<a href="#">Confirms</a>
								</div>
							</td>
							<td class="centerText bold">
								5
							</td>
						</tr>
						<tr class="analyticsEvenRow">
							<td colspan="2">
								<div class="analyticsTopListTableContent">
									<a href="#">Approves</a>
								</div>
							</td>
							<td class="centerText bold">
								5
							</td>
						</tr>
						<tr class="analyticsOddRow">
							<td colspan="2">
								<div class="analyticsTopListTableContent">
									<a href="#">Rejects</a>
								</div>
							</td>
							<td class="centerText bold">
								5
							</td>
						</tr>
						<tr class="analyticsEvenRow">
							<td colspan="2">
								<div class="analyticsTopListTableContent">
									<a href="#">Cancels</a>
								</div>
							</td>
							<td class="centerText bold">
								5
							</td>
						</tr>
					</table>
				</td>
				<td width="33%" valign="top">
					<div class="spacer20"></div>
					<div style="width: 150px; margin: auto;">
						<?php
							$generateCircleChartData = array(
								'Purchase' => 3000000,
								'Shipping' => 1000000
							);
						?>
						<?php echo generateCircleChart($generateCircleChartData,'incomeChart') ?>
					</div>
					<div class="borderedAnalyticsTitle">
						Income Breakdown
					</div>
					<table width="100%" class="analyticsTopListTable">
						<tr class="analyticsOddRow">
							<td colspan="2">
								<div class="analyticsTopListTableContent">
									<a href="#">Total Income</a>
								</div>
							</td>
							<td class="centerText bold" width="50%">
								IDR 50.000.000
							</td>
						</tr>
						<tr class="analyticsEvenRow">
							<td colspan="2">
								<div class="analyticsTopListTableContent">
									<a href="#">Purchase</a>
								</div>
							</td>
							<td class="centerText bold">
								IDR 50.000.000
							</td>
						</tr>
						<tr class="analyticsOddRow">
							<td colspan="2">
								<div class="analyticsTopListTableContent">
									<a href="#">Shipping</a>
								</div>
							</td>
							<td class="centerText bold">
								IDR 50.000.000
							</td>
						</tr>
						<tr class="analyticsEvenRow">
							<td colspan="2">
								<div class="analyticsTopListTableContent">
									<a href="#">Purchase Code</a>
								</div>
							</td>
							<td class="centerText bold">
								IDR 50.000.000
							</td>
						</tr>
						<tr class="analyticsOddRow">
							<td colspan="2">
								<div class="analyticsTopListTableContent">
									<a href="#">Vouchers</a>
								</div>
							</td>
							<td class="centerText bold">
								IDR 50.000.000
							</td>
						</tr>
						<tr class="analyticsEvenRow">
							<td colspan="2">
								<div class="analyticsTopListTableContent">
									<a href="#">Credits Used</a>
								</div>
							</td>
							<td class="centerText bold">
								IDR 50.000.000
							</td>
						</tr>
					</table>
				</td>
				<td width="33%" valign="top">
					<div class="spacer20"></div>
					<div style="width: 150px; margin: auto;">
						<?php
							$generateCircleChartData = array(
								'Male' => 300,
								'Female' => 300,
								'Others' => 300
							);
						?>
						<?php echo generateCircleChart($generateCircleChartData,'genderChart') ?>
					</div>
					<div class="borderedAnalyticsTitle">
						Gender Profile
					</div>
					<table width="100%" class="analyticsTopListTable">
						<tr class="analyticsOddRow">
							<td colspan="2">
								<div class="analyticsTopListTableContent">
									<a href="#">Male</a>
								</div>
							</td>
							<td class="centerText bold" width="50%">
								500
							</td>
						</tr>
						<tr class="analyticsEvenRow">
							<td colspan="2">
								<div class="analyticsTopListTableContent">
									<a href="#">Female</a>
								</div>
							</td>
							<td class="centerText bold">
								500
							</td>
						</tr>
						<tr class="analyticsOddRow">
							<td colspan="2">
								<div class="analyticsTopListTableContent">
									<a href="#">Unknown</a>
								</div>
							</td>
							<td class="centerText bold">
								500
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</div>
</div>
<div class="spacer20"></div>
<?php
	include('footer.php');
?>