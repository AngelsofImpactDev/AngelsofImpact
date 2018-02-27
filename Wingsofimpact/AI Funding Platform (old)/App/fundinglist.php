<?php
	include('ue-head.php');
?>
<?php
	include('header.php');
	$qUser 		= ue_query("SELECT * FROM user WHERE user_id = '".$_SESSION['currentUserId']."'");
	$fetchUser	= ue_fetch_array($qUser);
?>
<div class="container">
	<div class="row">
		<div class="col-lg-3 visible-lg">
			<?php
			include ('menuleft.php');
			?>
		</div>
		<div class="col-lg-1 visible-lg">
			&nbsp;
		</div>
		<div class="col-lg-8">
		<?php
		if($fetchUser['user_membershiptype'] == "investors"){
			$namaTableDatabase	= "transaction";
			$currentRowNumber = 1;
			$page = $_GET['page'];
			if($page == '' || $page == 0 || $page == NULL) $page = 1;
			//$pagePerView = 8;
			$mainQueryString 	= "SELECT a.*, b.*, SUM(a.transaction_amount) as totalPaid FROM ".$namaTableDatabase." a INNER JOIN startup b ON a.startup_id = b.startup_id WHERE a.user_id = '".$_SESSION['currentUserId']."' GROUP BY a.startup_id";
			$result = ue_query($mainQueryString);
			@ $jumlahData = ue_num_rows($result);
			$productListNumTotal = $jumlahData;
			$productPerPage = $pagePerView;
			$index = ($page-1)*$pagePerView;
			$mainQueryString = $mainQueryString." ORDER BY ".$namaTableDatabase."_entrydate DESC";
			$mainQueryQue 	= ue_query($mainQueryString);
			
			$arrFinal		= array();
			$total 			= 0;
			
			while($mainQueryRes = ue_fetch_array($mainQueryQue)){
				$arrFinal[$mainQueryRes['startup_id']] = $mainQueryRes['startup_logo'];
				$total+= $mainQueryRes['totalPaid'];
			}
		?>
			<?php
			include ("welcome-dashboard.php");
			?>
			<div class="row">
				<div class="col-lg-3">
					<table width="100%" border="0" style="border-collapse:collapse;">
						<tr>
							<td width="60" rowspan="2">
								<img width="50" src="images/dollar.png" />
							</td>
							<td class="fontsize14 bold colorBlue">Total Funding</td>
						</tr>
						<tr>
							<td class="fontsize18 bold">$ <?php echo $total ?></td>
						</tr>
					</table>
				</div>
				<div class="spacer30 visible-xs visible-sm visible-md"></div>
				<div class="col-lg-4">
					<table width="100%" border="0" style="border-collapse:collapse;">
						<tr>
							<td width="60" rowspan="2">
								<img width="50" src="images/heartBlue.png" />
							</td>
							<td class="fontsize14 bold colorBlue">Social Enterprises</td>
						</tr>
						<tr>
							<td class="fontsize18 bold"><?php echo $jumlahData ?></td>
						</tr>
					</table>
				</div>
			</div>
			<div class="spacer40"></div>
			<div class="row">
				<div class="col-lg-12">
					<div class="bold" style="color:#5b5c5e; font-size:14px;">
						My Project
					</div>
				</div>
			</div>
			<div class="row">
			<?php
			foreach($arrFinal as $idSt=>$imageLogo){
			?>
				<div class="col-lg-3 col-xs-6">
					<div align="center" style="max-width:160px; margin-top:20px; background-color:#fff; border:1px solid #1475c5; padding-top:10px; padding-bottom:10px; padding-right:7px; padding-left:7px;">
						<table width="100%" border="0">
							<tr>
								<td align="center">
									<a href="seprofile.php?id=<?php echo $idSt ?>">
										<div style="width:60px; height:60px;">
											<img src="upload/startupLogo/<?php echo $imageLogo ?>" width="" height="60" />
										</div>
									</a>
								</td>
							</tr>
							<tr>
								<td align="left" style="padding-left:10px; padding-top:20px; vertical-align:top;">
									<a href="fundinghistory.php?id=<?php echo $idSt ?>" style="margin-top:5px; display:block; font-size:10px;" class="colorBlue bold">View Payment History</a>
								</td>
							</tr>
							<tr>
								<td align="left" style="padding-left:10px;vertical-align:top;">
									<a href="terms.php" style="margin-top:5px; display:block; font-size:10px;" class="colorBlue bold">View Agreement</a>
								</td>
							</tr>
						</table>
					</div>
				</div>
			<?php
			}
			?>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div align="center">
						<?php
						include('ue-config/ue-parts/ue-pageSelector.php');
						?>
					</div>	
				</div>
			</div>
			<div class="spacer40"></div>
		<?php
		}else{
			$namaTableDatabase	= "transactiondetail";
			$mainQueryString 	= "SELECT a.*, b.transaction_amount, b.user_id, c.startup_id, c.startup_name, c.user_id FROM transactiondetail a LEFT JOIN transaction b ON a.transaction_id = b.transaction_id LEFT JOIN startup c ON b.startup_id = c.startup_id WHERE c.user_id = '".$_SESSION['currentUserId']."' AND c.startup_enabled = 'e'";
			$result 			= ue_query($mainQueryString);
			$mainQueryString 	= $mainQueryString." ORDER BY ".$namaTableDatabase."_repaymentdue DESC";
			$mainQueryQue 		= ue_query($mainQueryString);			
			$arrFinal		= array();
			$arrDue			= array();
			$total 			= 0;
			$detailAmount	= 0;
			
			while($mainQueryRes = ue_fetch_array($mainQueryQue)){
				$arrFinal["startupid"] = $mainQueryRes['startup_id'];
				$arrFinal["startupname"] = $mainQueryRes['startup_name'];
				$detailAmount+= $mainQueryRes['transactiondetail_amount'];
				$arrFinal["data"][] = array("repay"=>$mainQueryRes['transactiondetail_repaymentdue'],
											"amount"=>$mainQueryRes['transactiondetail_amount'],
											"confirmdate"=>$mainQueryRes['transactiondetail_confirmdate'],
											"status"=>$mainQueryRes['transactiondetail_status']
											);
				if($mainQueryRes['transactiondetail_status'] == "paid"){
					$total+= $mainQueryRes['transactiondetail_amount'];
				}else{
					$arrDue[] = $mainQueryRes['transactiondetail_repaymentdue'];
				}
			}
			$arrFinal["amount"] = $detailAmount;
		?>
			<?php
			include ("welcome-dashboard.php");
			?>
			<div class="bold" style="color:#5b5c5e; font-size:14px;">
				Payment Overview<br />
			</div>
			<div class="spacer20"></div>
			<div class="row">
				<div class="col-lg-3">
					<table width="100%" border="0" style="border-collapse:collapse;">
						<tr>
							<td width="50" rowspan="2">
								<img width="35" src="images/dollar.png" />
							</td>
							<td class="fontsize14 bold colorBlue">Total Funded</td>
						</tr>
						<tr>
							<td class="fontsize18 bold">$ <?php echo round($arrFinal['amount'],0) ?></td>
						</tr>
					</table>
				</div>
				<div class="spacer30 visible-xs visible-sm visible-md"></div>
				<div class="col-lg-3">
					<table width="100%" border="0" style="border-collapse:collapse;">
						<tr>
							<td width="50" rowspan="2">
								<img width="35" src="images/cc.png" />
							</td>
							<td class="fontsize14 bold colorBlue">Total Repayments</td>
						</tr>
						<tr>
							<td class="fontsize18 bold">$ <?php echo $total; ?></td>
						</tr>
					</table>
				</div>
				<div class="spacer30 visible-xs visible-sm visible-md"></div>
				<div class="col-lg-3">
					<table width="100%" border="0" style="border-collapse:collapse;">
						<tr>
							<td width="50" rowspan="2">
								<img width="35" src="images/graph.png" />
							</td>
							<td class="fontsize14 bold colorBlue">Out Balance</td>
						</tr>
						<tr>
							<td class="fontsize18 bold">$ <?php echo round($arrFinal['amount'],0) - $total; ?></td>
						</tr>
					</table>
				</div>
				<div class="spacer30 visible-xs visible-sm visible-md"></div>
				<div class="col-lg-3">
				<?php
				if(count($arrDue)>0){
				?>
					<table width="100%" border="0" style="border-collapse:collapse;">
						<tr>
							<td width="45" rowspan="2">
								<img width="35" src="images/calendar.png" />
							</td>
							<td class="fontsize14 bold colorBlue">Next Payment Due</td>
						</tr>
						<tr>
							<td class="fontsize18 bold" style="color:red;"><?php echo date("M d Y",min($arrDue)); ?></td>
						</tr>
					</table>
				<?php
				}
				?>
				</div>
			</div>
			<div class="spacer40"></div>
			<div class="row">
				<div class="col-lg-12">
					<a href="fundinghistory.php?id=<?php echo $arrFinal['startupid'] ?>" style="display:block;" class="fontsize16 colorBlue bold">View Payment History</a>
					<div class="spacer10"></div>
					<a href="terms.php" style="display:block;" class="fontsize16 colorBlue bold">View Agreement</a>
					<div class="spacer10"></div>
					<a href="angel.php" style="display:block;" class="fontsize16 colorBlue bold">View Angels</a>
				</div>
			</div>
			<div class="spacer40"></div>
		<?php
		}
		?>
		</div>
	</div>
</div>
<?php
	include('footer.php');
?>
<?php
	include('ue-footer.php');
?>