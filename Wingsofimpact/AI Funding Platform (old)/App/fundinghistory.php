<?php
	include('ue-head.php');
?>
<?php
	include('header.php');
	$qUser 		= ue_query("SELECT * FROM user WHERE user_id = '".$_SESSION['currentUserId']."'");
	$fetchUser	= ue_fetch_array($qUser);
	$namaTableDatabase	= "transactiondetail";
	$currentRowNumber = 1;
	$page = $_GET['page'];
	if($page == '' || $page == 0 || $page == NULL) $page = 1;
	$pagePerView 		= 8;
	if($fetchUser['user_membershiptype'] == "investors"){
		$mainQueryString 	= "SELECT a.*, b.transaction_amount, b.user_id, c.startup_name FROM transactiondetail a LEFT JOIN transaction b ON a.transaction_id = b.transaction_id LEFT JOIN startup c ON b.startup_id = c.startup_id WHERE b.user_id = '".$_SESSION['currentUserId']."' AND b.startup_id = '".$_GET['id']."'";
	}else{
		$mainQueryString 	= "SELECT a.*, b.transaction_amount, b.user_id, c.startup_name FROM transactiondetail a LEFT JOIN transaction b ON a.transaction_id = b.transaction_id LEFT JOIN startup c ON b.startup_id = c.startup_id WHERE b.startup_id = '".$_GET['id']."'";
	}
	
	$result 			= ue_query($mainQueryString);
	@ $jumlahData 		= ue_num_rows($result);
	$productListNumTotal= $jumlahData;
	$productPerPage 	= $pagePerView;
	$index 				= ($page-1)*$pagePerView;
	$mainQueryString 	= $mainQueryString." ORDER BY ".$namaTableDatabase."_repaymentdue ASC";
	//echo $mainQueryString;
	$mainQueryQue 		= ue_query($mainQueryString);
	//$mainQueryQue 		= ue_query($mainQueryString." LIMIT $index,$pagePerView");
	$arrFinal		= array();
	$arrDue			= array();
	$total 			= 0;
	$detailAmount	= 0;
	
	while($mainQueryRes = ue_fetch_array($mainQueryQue)){
		$arrFinal["startupname"] = $mainQueryRes['startup_name'];
		$detailAmount+= $mainQueryRes['transactiondetail_amount'];
		/*
		$arrFinal["data"][] = array("repay"=>$mainQueryRes['transactiondetail_repaymentdue'],
									"amount"=>$mainQueryRes['transactiondetail_amount'],
									"confirmdate"=>$mainQueryRes['transactiondetail_confirmdate'],
									"status"=>$mainQueryRes['transactiondetail_status']
									);
		*/
		if($mainQueryRes['transactiondetail_status'] == "paid"){
			$total+= $mainQueryRes['transactiondetail_amount'];
		}else{
			$arrDue[] = $mainQueryRes['transactiondetail_repaymentdue'];
		}
	}
	$arrFinal["amount"] = round($detailAmount,0);
	$mainQueryQue 		= ue_query($mainQueryString." LIMIT $index,$pagePerView");
	/*
	echo "<pre>";
	print_r($arrFinal);
	echo "</pre>";
	*/
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
								<img width="35" src="images/heartBlue.png" />
							</td>
							<td class="fontsize14 bold colorBlue">Social Enterprises</td>
						</tr>
						<tr>
							<td class="fontsize18 bold"><?php echo $arrFinal['startupname'] ?></td>
						</tr>
					</table>
				</div>
				<div class="spacer30 visible-xs visible-sm visible-md"></div>
				<div class="col-lg-3">
					<table width="100%" border="0" style="border-collapse:collapse;">
						<tr>
							<td width="50" rowspan="2">
								<img width="35" src="images/dollar.png" />
							</td>
							<td class="fontsize14 bold colorBlue">Total Funding</td>
						</tr>
						<tr>
							<td class="fontsize18 bold">$ <?php echo $arrFinal['amount'] ?></td>
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
							<td class="fontsize18 bold">$ <?php echo $total ?></td>
						</tr>
					</table>
				</div>
				<div class="spacer30 visible-xs visible-sm visible-md"></div>
				<div class="col-lg-3">
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
				</div>
			</div>
			<div class="spacer40"></div>
			<div class="row">
				<div class="col-lg-12">
					<span class="bold fontsize14">Payment History</span>
					<div style="margin-top:10px; padding:10px; padding-left:20px;  background-color:#FFF; color:#5b5c5e;">
						<table class="fontsize12" width="100%" border="0" style="border-collapse:collapse;">
							<tr>
								<td style="padding-top:5px; padding-bottom:20px; border-bottom:1px solid #ececec;" class="fontsize14 colorBlue bold" width="25%">Repayments Due</td>
								<td style="padding-top:5px; padding-bottom:20px; border-bottom:1px solid #ececec;" class="fontsize14 colorBlue bold" width="25%">Amount</td>
								<td style="padding-top:5px; padding-bottom:20px; border-bottom:1px solid #ececec;" class="fontsize14 colorBlue bold" width="25%">Confirm Date</td>
								<td style="padding-top:5px; padding-bottom:20px; border-bottom:1px solid #ececec;" class="fontsize14 colorBlue bold" width="25%">Status</td>
							</tr>
							<?php
							while($fetchRes = ue_fetch_array($mainQueryQue)){
								$colorRed = "";
								if($fetchRes['transactiondetail_status'] == "unpaid"){
									$colorRed = "color:red;";
								}
							?>
								<tr>
									<td style="<?php echo $colorRed ?> padding-top:10px; padding-bottom:10px; border-bottom:1px solid #ececec;"><?php echo date("M d, Y",$fetchRes['transactiondetail_repaymentdue']) ?></td>
									<td style="<?php echo $colorRed ?> padding-top:10px; padding-bottom:10px; border-bottom:1px solid #ececec;">$ <?php echo $fetchRes['transactiondetail_amount'] ?></td>
									<td style="<?php echo $colorRed ?> padding-top:10px; padding-bottom:10px; border-bottom:1px solid #ececec;">
									<?php 
									if($fetchRes['transactiondetail_confirmdate'] == 0){
										echo "-";
									}else{
										echo date("M-d-y",$fetchRes['transactiondetail_confirmdate']);
									}
									 ?>
									</td>
									<td class="colorBlue bold" style="<?php echo $colorRed ?> padding-top:10px; padding-bottom:10px; border-bottom:1px solid #ececec;">
										<?php
											echo $fetchRes['transactiondetail_status'];
										?>
									</td>
								</tr>
							<?php
							}
							?>
							<?php
							/*
							foreach($arrFinal["data"] as $valData){
								$colorRed = "";
								if($valData['status'] == "unpaid"){
									$colorRed = "color:red;";
								}
							?>
								<tr>
									<td style="<?php echo $colorRed ?> padding-top:10px; padding-bottom:10px; border-bottom:1px solid #ececec;"><?php echo date("M d, Y",$valData['repay']) ?></td>
									<td style="<?php echo $colorRed ?> padding-top:10px; padding-bottom:10px; border-bottom:1px solid #ececec;">$ <?php echo $valData['amount'] ?></td>
									<td style="<?php echo $colorRed ?> padding-top:10px; padding-bottom:10px; border-bottom:1px solid #ececec;">
									<?php 
									if($valData['confirmdate'] == 0){
										echo "-";
									}else{
										echo date("M-d-y",$valData['confirmdate']);
									}
									 ?>
									</td>
									<td class="colorBlue bold" style="<?php echo $colorRed ?> padding-top:10px; padding-bottom:10px; border-bottom:1px solid #ececec;">
										<?php
											echo $valData['status'];
										?>
									</td>
								</tr>
							<?php
							}
							*/
							?>
						</table>
						<div class="spacer50"></div>
					</div>
				</div>
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
		?>
			<?php
			include ("welcome-dashboard.php");
			?>
			<div class="row">
				<div class="col-lg-12">
					<span class="bold fontsize14">Payment History</span>
					<div style="margin-top:10px; padding:10px; padding-left:20px;  background-color:#FFF; color:#5b5c5e;">
						<table class="fontsize12" width="100%" border="0" style="border-collapse:collapse;">
							<tr>
								<td style="padding-top:5px; padding-bottom:20px; border-bottom:1px solid #ececec;" class="fontsize14 colorBlue bold" width="20%">Repayments Due</td>
								<td style="padding-top:5px; padding-bottom:20px; border-bottom:1px solid #ececec;" class="fontsize14 colorBlue bold" width="20%">Amount</td>
								<td style="padding-top:5px; padding-bottom:20px; border-bottom:1px solid #ececec;" class="fontsize14 colorBlue bold" width="20%">Confirm Date</td>
								<td style="padding-top:5px; padding-bottom:20px; border-bottom:1px solid #ececec;" class="fontsize14 colorBlue bold" width="20%">Startup</td>
								<td style="padding-top:5px; padding-bottom:20px; border-bottom:1px solid #ececec;" class="fontsize14 colorBlue bold" width="20%">Status</td>
							</tr>
							<?php
							while($fetchRes = ue_fetch_array($mainQueryQue)){
								$colorRed = "";
								if($fetchRes['transactiondetail_status'] == "unpaid"){
									$colorRed = "color:red;";
								}
							?>
								<tr>
									<td style="<?php echo $colorRed ?> padding-top:10px; padding-bottom:10px; border-bottom:1px solid #ececec;"><?php echo date("M d, Y",$fetchRes['transactiondetail_repaymentdue']) ?></td>
									<td style="<?php echo $colorRed ?> padding-top:10px; padding-bottom:10px; border-bottom:1px solid #ececec;">$ <?php echo $fetchRes['transactiondetail_amount'] ?></td>
									<td style="<?php echo $colorRed ?> padding-top:10px; padding-bottom:10px; border-bottom:1px solid #ececec;">
									<?php 
									if($fetchRes['transactiondetail_confirmdate'] == 0){
										echo "-";
									}else{
										echo date("M-d-y",$fetchRes['transactiondetail_confirmdate']);
									}
									 ?>
									</td>
									<td class="colorBlue bold" style="<?php echo $colorRed ?> padding-top:10px; padding-bottom:10px; border-bottom:1px solid #ececec;">
										<?php
											echo $fetchRes['startup_name'];
										?>
									</td>
									<td class="colorBlue bold" style="<?php echo $colorRed ?> padding-top:10px; padding-bottom:10px; border-bottom:1px solid #ececec;">
										<?php
											if($fetchRes['transactiondetail_status'] == "paid"){
										?>
												<div class="visible-lg visible-md">
													<a class="slimgreyBtn" href="javascript:void(0)" style="margin:0; padding:7px; font-size:12px;width:100%; border-radius:10px; ">PAID</a>
												</div>
												<div class="visible-sm visible-xs">
													<a class="slimgreyBtn" href="javascript:void(0)" style="margin:0; padding:7px; font-size:12px;width:100%; border-radius:10px; ">PAID</a>
												</div>
										<?php
											}else{
										?>
												<div class="visible-lg visible-md">
													<a class="slimblueBtn" href="action-fundinghistory.php?tid=<?php echo $_GET['id'] ?>&id=<?php echo $fetchRes['transactiondetail_id'] ?>&page=<?php echo $_GET['page'] ?>" style="margin:0; padding:7px; font-size:12px; width:100%; border-radius:10px;">UNPAID</a>
												</div>
												<div class="visible-sm visible-xs">
													<a class="slimblueBtn" href="action-fundinghistory.php?tid=<?php echo $_GET['id'] ?>&id=<?php echo $fetchRes['transactiondetail_id'] ?>&page=<?php echo $_GET['page'] ?>" style="margin:0; padding:7px; font-size:12px; width:100%; border-radius:10px;">UNPAID</a>
												</div>
										<?php
											}
										?>
									</td>
								</tr>
							<?php
							}
							?>
						</table>
						<div class="spacer50"></div>
					</div>
				</div>
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