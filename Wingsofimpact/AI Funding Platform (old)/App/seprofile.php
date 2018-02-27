<?php
	include('ue-head.php');
?>
<?php
	include('header.php');
	$qUser 		= ue_query("SELECT * FROM user WHERE user_id = '".$_SESSION['currentUserId']."'");
	$fetchUser	= ue_fetch_array($qUser);
	
	$id 		= $_GET['id']; 
	$namaTableDatabase	= "startup";
	$currentRowNumber = 1;
	$page = $_GET['page'];
	if($page == '' || $page == 0 || $page == NULL) $page = 1;
	$pagePerView = 8;
	$mainQueryString 	= "SELECT a.*, b.* FROM ".$namaTableDatabase." a LEFT JOIN user b ON a.user_id = b.user_id WHERE ".$namaTableDatabase."_enabled = 'e' AND ".$namaTableDatabase."_id = '$id'";
	//echo $mainQueryString;
	$result = ue_query($mainQueryString);
	@ $jumlahData = ue_num_rows($result);
	$productListNumTotal = $jumlahData;
	$productPerPage = $pagePerView;
	$index = ($page-1)*$pagePerView;
	$mainQueryString = $mainQueryString." ORDER BY ".$namaTableDatabase."_entrydate DESC";
	//echo $mainQueryString;
	$mainQueryQue = ue_query($mainQueryString." LIMIT 1");
	$mainQueryRes = ue_fetch_array($mainQueryQue);
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
			include ('welcome-dashboard.php');
			?>
			<div class="bold" style="font-size:14px; color:#959595;">
				<a href="enterprises.php">< Back</a>
			</div>
			<div class="spacer10"></div>
			<div class="row">
				<div class="col-lg-8">
					<div style="background-color:#FFF; border:1px solid #1475c5;">
						<div style="padding:20px;">
							<div class="row">
								<div style="width:100px; height:100px; vertical-align:bottom;" class="col-lg-12">
									<img src="upload/startupLogo/<?php echo $mainQueryRes[$namaTableDatabase."_logo"] ?>" class="img-responsive" height="100"  />
								</div>
								
							</div>
							<div class="spacer20"></div>
							<div class="row">
								<div class="col-lg-12" style="font-size:14px;">
									<div class="colorBlue bold">About</div>
									<?php echo $mainQueryRes[$namaTableDatabase."_longdesc"] ?>
								</div>
							</div>
							<div class="spacer20"></div>
							<div class="row">
								<div class="col-lg-12">
									<img src="upload/startupCover/<?php echo $mainQueryRes[$namaTableDatabase."_cover"] ?>" width="100%" class="img-responsive center-block" />
								</div>
							</div>
							<div class="spacer20"></div>
							<div class="row">
								<?php
								$userImage = "images/dummyAvatar.png";
								if($mainQueryRes['user_image']!=""){
									$userImage = "upload/userImage/".$mainQueryRes['user_image'];
								}
								?>
								<div class="col-lg-7">
									<div class="visible-md visible-sm visible-xs">
										<div class="centerText bold colorBlue" style="font-size:14px;">FOUNDER</div>
										<img src="<?php echo $userImage ?>" height="60" width="60" class="img-responsive center-block" />
										<div class="centerText bold colorBlue" style="font-size:14px; margin-top:5px;"><?php echo $mainQueryRes['user_name'] ?></div>
										<div class="centerText" style="font-size:14px;">CEO, Founder of <?php echo $mainQueryRes[$namaTableDatabase.'_name'] ?></div>
										<div class="spacer30"></div>
									</div>
									<div style="" class="visible-lg">
										<div class="bold colorBlue" style="font-size:14px;">FOUNDER</div>
										<table width="100%">
											<tr>
												<td rowspan="2">
													<div style="overflow:hidden; display:inline-block; border-radius:50px; width:50px; height:50px;">
														<img src="<?php echo $userImage ?>" height="50" width="50" />
													</div>
												</td>
											</tr>
											<tr>
												<td style="padding-left:10px;">
													<div class="bold colorBlue" style="font-size:12px; margin-top:5px;"><?php echo $mainQueryRes['user_name'] ?></div>
													<div class="" style="font-size:12px;">CEO, Founder of <?php echo $mainQueryRes[$namaTableDatabase.'_name'] ?></div>
												</td>
											</tr>
										</table>
										
									</div>
								</div>
								<div class="col-lg-5">
								<?php
								$qInvestor 		= ue_query("SELECT a.*, b.* FROM transaction a LEFT JOIN user b ON a.user_id = b.user_id WHERE startup_id = '".$mainQueryRes['startup_id']."' GROUP BY a.user_id");
								$qJumInvestor 	= ue_num_rows($qInvestor);
								?>
									<div>
										<div class="bold colorBlue" style="font-size:14px;">FUNDERS <span style="color:#959595;">(<?php echo $qJumInvestor; ?>)</span></div>
										<?php
										while($fetchInv = ue_fetch_array($qInvestor)){
											$userImage = "images/dummyAvatar.png";
											if($fetchInv['user_image']!=""){
												$userImage = "upload/userImage/".$fetchInv['user_image'];
											}
										?>
											<div style="overflow:hidden; display:inline-block; border-radius:50px; width:50px; height:50px;">
												<img style="display:inline-block;" src="<?php echo $userImage ?>" class="" width="50" height="50" />
											</div>
										<?php
										}
										?>
									</div>
								</div>
								<div class="clear"></div>
							</div>
							<div class="row">
								<div class="col-lg-10">
									<div class="spacer20"></div>
									<div class="bold colorBlue" style="font-size:14px;">Purpose of Funding</div>
									<div class="" style="font-size:12px;">
										<?php echo $mainQueryRes[$namaTableDatabase.'_fundingpurpose'] ?>
									</div>
									<div class="spacer20"></div>
									<div class="bold colorBlue" style="font-size:14px;">Social Impact from the Funding</div>
									<div class="" style="font-size:12px;">
										<?php echo $mainQueryRes[$namaTableDatabase.'_fundingimpact'] ?>
									</div>
								</div>
								<div class="col-lg-2"></div>
							</div>
							<div class="spacer10"></div>
							<div class="row">
								<div class="col-lg-4 col-xs-4 col-md-4 col-sm-4">
									<?php
									if($mainQueryRes[$namaTableDatabase.'_image1']!=""){
									?>
										<img class="img-responsive" style="width:100%; max-width:150px; max-height:150px;" src="upload/startupCampaign/<?php echo $mainQueryRes[$namaTableDatabase.'_image1'] ?>" />
									<?php
									}
									?>
								</div>
								<div class="col-lg-4 col-xs-4 col-md-4 col-sm-4">
									<?php
									if($mainQueryRes[$namaTableDatabase.'_image2']!=""){
									?>
										<img class="img-responsive" style="width:100%; max-width:150px; max-height:150px;" src="upload/startupCampaign/<?php echo $mainQueryRes[$namaTableDatabase.'_image2'] ?>" />
									<?php
									}
									?>
								</div>
								<div class="col-lg-4 col-xs-4 col-md-4 col-sm-4">
									<?php
									if($mainQueryRes[$namaTableDatabase.'_image3']!=""){
									?>
										<img class="img-responsive" style="width:100%; max-width:150px; max-height:150px;" src="upload/startupCampaign/<?php echo $mainQueryRes[$namaTableDatabase.'_image3'] ?>" />
									<?php
									}
									?>
								</div>
							</div>
						</div>
						<div style="height:1px; background-color:#ececec;"></div>
						<div style="padding:20px;">
							<div class="bold colorBlue" style="font-size:16px;">Funding Repayment Information</div>
							<div class="spacer20"></div>
							<div class="bold colorBlue" style="font-size:14px;">Repayment Period</div>
							<div class="" style="font-size:12px;">
								<?php 
									if($mainQueryRes[$namaTableDatabase.'_repaymentperiod'] == 1){
										echo "One Time Payment";
									}else{
										echo $mainQueryRes[$namaTableDatabase.'_repaymentperiod']." Months";
									} 
								?>
							</div>
							<div class="spacer20"></div>
							<div class="bold colorBlue" style="font-size:14px;">Repayment Startdate</div>
							<div class="" style="font-size:12px;">
								<?php echo date("Y F d",$mainQueryRes[$namaTableDatabase.'_repaymentstart']); ?>
							</div>
							<div class="spacer20"></div>
							<?php
							if($fetchUser['user_membershiptype'] == "investors" and $mainQueryRes[$namaTableDatabase.'_pdf']!=""){
							?>
								<div class="spacer20"></div>
								<div class="bold colorBlue" style="font-size:14px;">Kindly view our catalogue to choose your repayment gifts</div>
								<div class="spacer10"></div>
								<a class="blueBtn" href="upload/startupGift/<?php echo $mainQueryRes[$namaTableDatabase.'_pdf'] ?>" download="<?php echo $mainQueryRes[$namaTableDatabase.'_name']."_catalogue"; ?>" style="margin:0; padding:7px; font-size:14px; width:100%;">View our catalogue</a>
							<?php
							}
							?>
							<?php
							if($fetchUser['user_membershiptype'] == "investors" and $mainQueryRes[$namaTableDatabase.'_report']!=""){
							?>
								<div class="spacer20"></div>
								<div class="bold colorBlue" style="font-size:14px;">Our Financial Report</div>
								<div class="spacer10"></div>
								<a class="blueBtn" href="upload/startupFinancial/<?php echo $mainQueryRes[$namaTableDatabase.'_report'] ?>" download="<?php echo $mainQueryRes[$namaTableDatabase.'_name']."_report"; ?>" style="margin:0; padding:7px; font-size:14px; width:100%;">View our Report</a>
							<?php
							}
							?>
						</div>
					</div>
				</div>
				<div class="col-lg-4">
					<?php
					if($fetchUser['user_membershiptype'] == "investors" and $fetchUser['user_membershipid'] != 0 and $fetchUser['user_expiry']> time() and $mainQueryRes[$namaTableDatabase.'_deadline'] > time()){
						$totalTrans = 0;
						$getTrans 	= ue_query("SELECT * FROM transaction WHERE startup_id = '".$mainQueryRes[$namaTableDatabase.'_id']."'");
						while($fetchTrans = ue_fetch_array($getTrans)){
							$totalTrans+=(int)$fetchTrans['transaction_amount']; 
						}
						$percentage = round(($totalTrans / $mainQueryRes[$namaTableDatabase."_amount"])*100)."%";
						$dayLeftInt	= $mainQueryRes[$namaTableDatabase.'_deadline'] - time();
						$dayLeft	= ceil($dayLeftInt / (60 * 60 * 24));
					?>
						<div class="spacer30 visible-xs visible-md visible-sm"></div>
						<form method="post" action="fundnow.php">
							<div style="background-color:#fff; border:1px solid #1475c5; padding-left:15px; padding-right:15px;">
								<div class="spacer30"></div>
								<table width="100%" style="border-collapse:collapse;" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td class="colorBlue bold">
											<span style="font-size:32px;">$<?php echo $totalTrans ?></span> &nbsp; USD<br />
											<span style="font-size:14px; color:#959595; font-weight:normal;">Raised since <?php echo date("d F Y",$mainQueryRes[$namaTableDatabase.'_editdate']); ?></span>
										</td>
									</tr>
									<tr>
										<td style="padding-top:30px; border-bottom:1px solid #1475c5;">
											<div style="background-color:#ebebeb; height:30px;">
												<div style="background-color:#1475c5; height:30px; width:<?php echo $percentage; ?>;"></div>
											</div>
											<div class="spacer10"></div>
											<div style="font-size:14px; float:left;"><span class="bold colorBlue"><?php echo $percentage; ?></span> funded</div>
											<div style="font-size:14px; float:right;"><span class="bold colorBlue"><?php echo $dayLeft; ?></span> days left</div>
											<div style="clear:both"></div>
											<div class="spacer30"></div>
										</td>
									</tr>
									<tr>
										<td class="colorBlue" style="padding-top:10px;">
											<div style="font-size:14px; color:#959595;">Pledged of goal</div>
											<span class="bold" style="font-size:20px;">$<?php echo $mainQueryRes[$namaTableDatabase."_amount"]; ?></span> &nbsp; <span class="bold">USD</span>
											<div class="spacer30"></div>
											<div style="font-size:14px; color:#959595;">Your contribution</div>
											<div style="position:relative;">
												<a href="javascript:void(0)" onclick="calcFund('min')" style="color:#959595; float:left; position:absolute; font-size:26px; left:10px; top:5px;" class="bold">-</a>
												<a href="javascript:void(0)" onclick="calcFund('plus')" style="color:#959595; float:right; position:absolute; font-size:26px; right:10px; top:5px;" class="bold">+</a>	
												<label style="color:#959595; position:absolute; font-size:26px; top:5px; left:30%;" class="bold">$</label>
												<input type='text' id='numberinput' name='numberinput' readonly class="bold" style="color:#959595;width:100%; font-size:20px; text-align:center; border:1px solid #1e7bc8;" value='500' />
											</div>
											<div class="clear"></div>
										</td>
									</tr>
									<tr>
										<td style="padding-top:20px;">
											<input type="submit" class="blueBtn bold" style="font-size:14px; display:block; text-align:center; width:100%; max-width:100%;" name="fundnow" id="fundnow" value="FUND NOW" />
											<input type="hidden" name="hdnId" id="hdnId" value="<?php echo $mainQueryRes['startup_id'] ?>" />
											<!--<a href="fundnow.php" class="blueBtn bold" style="font-size:14px; display:block; text-align:center; width:100%; max-width:100%;">FUND NOW</a>-->
										</td>
									</tr>
								</table>
								<div class="spacer30"></div>
							</div>
						</form>
					<?php
					}
					?>
				</div>
			</div>
			<div class="spacer40"></div>
			<script>
			function calcFund(op){
				var numVal = parseInt($("#numberinput").val());
				if(op == "min"){
					var newVal = numVal - 500;
					if(newVal <= 0){
						alert("Minimum fund is $500");
						newVal = 500;
					}
				}
				
				if(op == "plus"){
					var newVal = numVal + 500;
				}
				$("#numberinput").val(newVal);
			}
			</script>
		</div>
	</div>
</div>
<?php
	include('footer.php');
?>
<?php
	include('ue-footer.php');
?>