<?php
	include('head.php');
	
	$namaTableDatabase	= ue_real_escape_string($_GET['ovtable']);
	$namaHalamanEdit	= '';
	$namaFolderUpload	= '';
	
	$pageType 			= 'overview';					// list OR detail OR overview
	$pageTitle			= ue_real_escape_string($_GET['ovtitle']);
	$namaPageUtama		= ue_real_escape_string($_GET['ovmainpage']);
?>
<?php
	include('top.php');
?>
<?php
	include('left.php');
?>
<?php
	/* Dummy Data Result
		$chartData['Enabled'] = array(
			'January'	=> 10,
			'February'	=> 15,
			'March'		=> 20,
			'April'		=> 30,
			'May'		=> 50,
			'June'		=> 90,
		);
		$chartData['Disabled'] = array(
			'January'	=> 90,
			'February'	=> 55,
			'March'		=> 30,
			'April'		=> 20,
			'May'		=> 15,
			'June'		=> 10,
		);
	*/
	
	$chartData = array();
	$currentTime = strtotime('last day of this month noon');
	$numberOfDataTotal = 0;
	$numberOfDataTotalEnabled = 0;
	$numberOfDataTotalDisabled = 0;
	//Purchase Vars START
	$numberOfDataTotalRequests = 0;
	$numberOfDataTotalConfirms = 0;
	$numberOfDataTotalApproves = 0;
	$numberOfDataTotalRejects = 0;
	$numberOfDataTotalCancels = 0;
	//Purchase Vars END
	
	if($_GET['ovmonths'] == '') {
		$_GET['ovmonths'] = 6;
	}
	$_GET['ovmonths']--;
	$lastSixMonthsUnix = strtotime('first day of -'.$_GET['ovmonths'].' month midnight');
	
	switch($namaTableDatabase) {
		case 'purchase':
			//Format Result START
			$chartData['All'] = array();
			$chartData['Approved'] = array();
			$chartData['Rejected'] = array();
			$chartData['Canceled'] = array();
			$chartData['Confirmed'] = array();
			$chartData['Requested'] = array();
			
			$lastsixmonths = lastcouplemonths($_GET['ovmonths']);
			foreach($chartData as $chartDataKey => $chartDataVal) {
				foreach($lastsixmonths as $lastsixmonthsKey => $lastsixmonthsVal) {
					$chartData["$chartDataKey"]["$lastsixmonthsVal"] = 0;
				}
			}
			//Format Result END
			
			//Get GENERAL OVERVIEW (ALL) START
			$mainNumQueStr = "SELECT * FROM ".$namaTableDatabase;
			$mainNumQue = ue_query($mainNumQueStr.' GROUP BY purchase_code');
			while($mainNumRes = ue_fetch_array($mainNumQue)) {
				$numberOfDataTotal++;
				switch($mainNumRes["$namaTableDatabase".'_status']) {
					case 'x':
						$numberOfDataTotalCancels++;
					break;
					case 'r':
						$numberOfDataTotalRequests++;
					break;
					case 'c':
						$numberOfDataTotalConfirms++;
					break;
					case 'a':
						$numberOfDataTotalApproves++;
					break;
					case 'z':
						$numberOfDataTotalRejects++;
					break;
				}
			}
			//Get GENERAL OVERVIEW (ALL) END
			
			//Get Monthly OVERVIEW START
			$mainChartQueStr = $mainNumQueStr." WHERE ".$namaTableDatabase."_entrydate > '".$lastSixMonthsUnix."' AND ".$namaTableDatabase."_entrydate <= '".$currentTime."'";
			$mainChartQue = ue_query($mainChartQueStr.' GROUP BY purchase_code');
			while($mainChartRes = ue_fetch_array($mainChartQue)) {
				$currentMonth = date('F',$mainChartRes["$namaTableDatabase"."_entrydate"]);
				switch($mainChartRes["$namaTableDatabase".'_status']) {
					case 'x':
						$chartData['All']["$currentMonth"]++;
						$chartData['Rejected']["$currentMonth"]++;
					break;
					case 'r':
						$chartData['All']["$currentMonth"]++;
						$chartData['Requested']["$currentMonth"]++;
					break;
					case 'c':
						$chartData['All']["$currentMonth"]++;
						$chartData['Confirmed']["$currentMonth"]++;
					break;
					case 'a':
						$chartData['All']["$currentMonth"]++;
						$chartData['Approved']["$currentMonth"]++;
					break;
					case 'z':
						$chartData['All']["$currentMonth"]++;
						$chartData['Canceled']["$currentMonth"]++;
					break;
				}
			}
			//Get Monthly OVERVIEW END
		break;
		default:
			//Format Result START
			$chartData['All'] = array();
			$chartData['Enabled'] = array();
			$chartData['Disabled'] = array();
			
			$lastsixmonths = lastcouplemonths($_GET['ovmonths']);
			foreach($chartData as $chartDataKey => $chartDataVal) {
				foreach($lastsixmonths as $lastsixmonthsKey => $lastsixmonthsVal) {
					$chartData["$chartDataKey"]["$lastsixmonthsVal"] = 0;
				}
			}
			//Format Result END
			
			//Get GENERAL OVERVIEW (ALL) START
			$mainNumQueStr = "SELECT * FROM ".$namaTableDatabase;
			$mainNumQue = ue_query($mainNumQueStr);
			while($mainNumRes = ue_fetch_array($mainNumQue)) {
				$numberOfDataTotal++;
				if($mainNumRes["$namaTableDatabase"."_enabled"] == 'e') {
					$numberOfDataTotalEnabled++;
				}
				else if($mainNumRes["$namaTableDatabase"."_enabled"] == 'd') {
					$numberOfDataTotalDisabled++;
				}
			}
			//Get GENERAL OVERVIEW (ALL) END
			
			//Get Monthly OVERVIEW START
			$mainChartQueStr = $mainNumQueStr." WHERE ".$namaTableDatabase."_entrydate > ".$lastSixMonthsUnix." AND ".$namaTableDatabase."_entrydate <= ".$currentTime;
			$mainChartQue = ue_query($mainChartQueStr);
			while($mainChartRes = ue_fetch_array($mainChartQue)) {
				$currentMonth = date('F',$mainChartRes["$namaTableDatabase"."_entrydate"]);
				if($mainChartRes["$namaTableDatabase"."_enabled"] == 'e') {
					$chartData['All']["$currentMonth"]++;
					$chartData['Enabled']["$currentMonth"]++;
				}
				else if($mainChartRes["$namaTableDatabase"."_enabled"] == 'd') {
					$chartData['All']["$currentMonth"]++;
					$chartData['Disabled']["$currentMonth"]++;
				}
			}
			//Get Monthly OVERVIEW END
		break;
	}
?>
<div class="transFullWidthWrapper" id="topMenu">
    <a href="<?php echo $_GET['ovmainpage']?>" style="background-image: url(images/icon/viewall.png);">VIEW ALL</a>
    <div class="clear"></div>
</div>
<?php
	include('ue-includes/ue-currentPageInfo.php');
?>
<div class="spacer10"></div>
<?php
	if($namaTableDatabase == 'purchase') {
?>
<div class="transFullWidthWrapper">
	<div id="adminNewsDate" class="bold clockContainer">All Time Overview</div>
    <table cellpadding="0" cellspacing="0" style="margin-top: 10px;">
    	<tr>
        	<td width="150">
            	Number of Purchase
            </td>
            <td width="10">
            	:
            </td>
            <td>
            	<?php echo $numberOfDataTotal?>
            </td>
        </tr>
    	<tr>
        	<td>
            	Number of Approved
            </td>
            <td>
            	:
            </td>
            <td>
            	<?php echo $numberOfDataTotalApproves?>
            </td>
        </tr>
    	<tr>
        	<td>
            	Number of Rejected
            </td>
            <td>
            	:
            </td>
            <td>
            	<?php echo $numberOfDataTotalRejects?>
            </td>
        </tr>
    	<tr>
        	<td>
            	Number of Requests
            </td>
            <td>
            	:
            </td>
            <td>
            	<?php echo $numberOfDataTotalRequests?>
            </td>
        </tr>
    	<tr>
        	<td>
            	Number of Confirmed
            </td>
            <td>
            	:
            </td>
            <td>
            	<?php echo $numberOfDataTotalConfirms?>
            </td>
        </tr>
    	<tr>
        	<td>
            	Number of Canceled
            </td>
            <td>
            	:
            </td>
            <td>
            	<?php echo $numberOfDataTotalCancels?>
            </td>
        </tr>
    </table>
</div>
<div class="spacer10"></div>
<div class="transFullWidthWrapper">
	<div id="adminNewsDate" class="bold clockContainer">
    	<table width="100%" cellpadding="0" cellspacing="0">
        	<tr>
            	<td>
                	Monthly Overview
                </td>
                <td class="smallSelect" width="1">
                	<form method="get" id="ovform">
						<?php					
                            $currentSelectArr = array(
                                'name' => 'ovmonths',
                                'list' => array(
									'2' => '2 Months',
									'3' => '3 Months',
									'4' => '4 Months',
									'5' => '5 Months',
									'6' => '6 Months',
									'7' => '7 Months',
									'8' => '8 Months',
									'9' => '9 Months',
									'10' => '10 Months',
									'11' => '11 Months',
									'12' => '12 Months'
								)
                            );
                        ?>
                        <?php echo ueCreateSelectOption($currentSelectArr,'',($_GET['ovmonths']+1))?>
                        <input type="hidden" name="ovtable" value="<?php echo $_GET['ovtable']?>" />
                        <input type="hidden" name="ovtitle" value="<?php echo $_GET['ovtitle']?>" />
                        <input type="hidden" name="ovmainpage" value="<?php echo $_GET['ovmainpage']?>" />
                    </form>
                    <script type="text/javascript">
						$('select[name="ovmonths"]').change(function() {
							$('#ovform').submit();
						});
					</script>
                </td>
            </tr>
        </table>
    </div>
    <?php echo generateChart($chartData)?>
</div>
<?php
	}
	else {
?>
<div class="transFullWidthWrapper">
	<div id="adminNewsDate" class="bold clockContainer">All Time Overview</div>
    <table cellpadding="0" cellspacing="0" style="margin-top: 10px;">
    	<tr>
        	<td width="150">
            	Number of Data
            </td>
            <td width="10">
            	:
            </td>
            <td>
            	<?php echo $numberOfDataTotal?>
            </td>
        </tr>
    	<tr>
        	<td>
            	Number of Enabled
            </td>
            <td>
            	:
            </td>
            <td>
            	<?php echo $numberOfDataTotalEnabled?>
            </td>
        </tr>
    	<tr>
        	<td>
            	Number of Disabled
            </td>
            <td>
            	:
            </td>
            <td>
            	<?php echo $numberOfDataTotalDisabled?>
            </td>
        </tr>
    </table>
</div>
<div class="spacer10"></div>
<div class="transFullWidthWrapper">
	<div id="adminNewsDate" class="bold clockContainer">
    	<table width="100%" cellpadding="0" cellspacing="0">
        	<tr>
            	<td>
                	Monthly Overview
                </td>
                <td class="smallSelect" width="1">
                	<form method="get" id="ovform">
						<?php					
                            $currentSelectArr = array(
                                'name' => 'ovmonths',
                                'list' => array(
									'2' => '2 Months',
									'3' => '3 Months',
									'4' => '4 Months',
									'5' => '5 Months',
									'6' => '6 Months',
									'7' => '7 Months',
									'8' => '8 Months',
									'9' => '9 Months',
									'10' => '10 Months',
									'11' => '11 Months',
									'12' => '12 Months'
								)
                            );
                        ?>
                        <?php echo ueCreateSelectOption($currentSelectArr,'',($_GET['ovmonths']+1))?>
                        <input type="hidden" name="ovtable" value="<?php echo $_GET['ovtable']?>" />
                        <input type="hidden" name="ovtitle" value="<?php echo $_GET['ovtitle']?>" />
                        <input type="hidden" name="ovmainpage" value="<?php echo $_GET['ovmainpage']?>" />
                    </form>
                    <script type="text/javascript">
						$('select[name="ovmonths"]').change(function() {
							$('#ovform').submit();
						});
					</script>
                </td>
            </tr>
        </table>
    </div>
    <?php echo generateChart($chartData)?>
</div>
<?php
	}
?>
<div class="spacer10"></div>
<div class="transFullWidthWrapper">
	<div id="adminNewsDate" class="bold clockContainer">Report Generation</div>
    <form action='action-overview-csv.php' method='POST'>
    <table cellpadding="0" cellspacing="0" width="100%">
		<?php
            if($namaTableDatabase == 'purchase') {
        ?>
        <tr>
            <td width="150">
                Report Type
                <div class="spacer10"></div>
            </td>
            <td width="10">
                :
                <div class="spacer10"></div>
            </td>
            <td>
                <select id='reportType' name='reportType'>
                    <option value='typeB'>Purchases Report</option>
                    <option value='typeA'>Product Class, Category and Type Sales Report</option>
                    <option value='typeC'>Sold Items Report</option>
                </select>
                <div class="spacer10"></div>
            </td>
        </tr>
        <?php
            }
			else {
        ?>
        <tr>
            <td width="150">
                Report Type
                <div class="spacer10"></div>
            </td>
            <td width="10">
                :
                <div class="spacer10"></div>
            </td>
            <td>
                <select id='reportType' name='reportType'>
                    <option value=''>Regular Report</option>
                    <option value='typeD'>Raw Data Export</option>
                </select>
                <div class="spacer10"></div>
            </td>
        </tr>
		<?php
			}
		?>
    	<tr>
        	<td width="150">
            	Start Date
            </td>
            <td width="10">
            	:
            </td>
			<td class="smallSelect">
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
                    for($i=(date("Y")-4);$i<(date("Y")+1);$i++) {
                        $currentSelectArr['list']["$i"] = $i;
                    }
                ?>
                <?php echo ueCreateSelectOption($currentSelectArr,$currentYear,'')?>
            </td>
        </tr>
    	<tr>
        	<td>
            	<div class="spacer10"></div>
            	End Date
            </td>
            <td>
            	<div class="spacer10"></div>
            	:
            </td>
			<td class="smallSelect">
            	<div class="spacer10"></div>
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
                    for($i=(date("Y")-4);$i<(date("Y")+1);$i++) {
                        $currentSelectArr['list']["$i"] = $i;
                    }
                ?>
                <?php echo ueCreateSelectOption($currentSelectArr,$currentYear,'')?>
            </td>
        </tr>
        <tr>
        	<td colspan="3" align="right">
            	<input type='submit' name='btnsubmit' value='Download' />
            </td>
        </tr>
    </table>
    </form>
</div>
<?php
	include('footer.php');
?>