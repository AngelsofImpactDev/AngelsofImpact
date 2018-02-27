<?php
	include('ue-head.php');
	if($_POST['hdnId'] == ""){
		header("location:enterprises.php?err=Invalid startup ID");
	}
?>
<?php
	include('header.php');
	$qUser 		= ue_query("SELECT * FROM user WHERE user_id = '".$_SESSION['currentUserId']."'");
	$fetchUser	= ue_fetch_array($qUser);
	
	foreach($_POST as $postedElementsKey => $postedElementsVal) {
		$auPostedElements["$postedElementsKey"] = ueReceiveInput($postedElementsKey,$postedElementsVal,false);
		if(in_array($postedElementsKey,$auCookiesAllow)) {
			setcookie($postedElementsKey,$postedElementsVal,time()+5);
		}
		else if($postedElementsKey == $auPostedElements['province']){
			setcookie('shipping_id',$postedElementsVal,time()+5);
		}
	}
	
	$inComplete = false;
	if($fetchUser['user_passport'] == "" or $fetchUser['user_telp'] == "" or $fetchUser['user_country'] == ""  or $fetchUser['user_address'] == ""){
		$inComplete = true;
	}
	
	$namaTableDatabase	= "startup";
	$mainQueryString 	= "SELECT a.*, b.* FROM ".$namaTableDatabase." a LEFT JOIN user b ON a.user_id = b.user_id WHERE ".$namaTableDatabase."_enabled = 'e' AND ".$namaTableDatabase."_id = '".$auPostedElements['hdnId']."'";
	//echo $mainQueryString;
	$result = ue_query($mainQueryString);
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
			<?php
			if($fetchUser['user_membershiptype'] == "investors" and $fetchUser['user_membershipid'] != 0 and $fetchUser['user_expiry']> time() and $inComplete == false){
			?>
				<div class="row">
					<div class="col-lg-10">
						<div style="background-color:#FFF; border:1px solid #1475c5; color:#5b5c5e;">
							<div class="bold" style="padding:20px; padding-left:30px;">
								Your Funding Review<br />
								<span style="font-weight:normal; font-size:16px;">Below is your funding review</span>
							</div>
							<div style="height:1px; background-color:#eae7e7;"></div>
							<div class="bold" style="padding:20px; padding-left:30px; font-size:16px;">
								<div class="row">
									<div class="col-lg-4">
										<table border="0">
											<tr>
												<td>Funding Amount</td>
											</tr>
											<tr>
												<td class="colorBlue bold" style="font-size:30px;">$ <?php echo $auPostedElements["numberinput"] ?></td>
											</tr>
											<tr>
												<td style="padding-top:10px;">Social Enterprise</td>
											</tr>
											<tr>
												<td class="colorBlue bold"><?php echo $mainQueryRes[$namaTableDatabase."_name"] ?></td>
											</tr>
										</table>
									</div>
									<div class="col-lg-8">
										<table border="0">
											<tr>
												<td style="padding-top:5px;">Funding Deadline</td>
												<td style="padding-top:5px; padding-left:20px;" class="colorBlue"><?php echo date("F d Y",$mainQueryRes[$namaTableDatabase."_deadline"]) ?></td>
											</tr>
											<tr>
												<td style="padding-top:20px;">Repayment Period</td>
												<td style="padding-top:20px; padding-left:20px;" class="colorBlue"><?php echo $mainQueryRes[$namaTableDatabase."_repaymentperiod"] ?> Months</td>
											</tr>
											<tr>
												<td style="padding-top:20px;">Repayment Start Date</td>
												<td style="padding-top:20px; padding-left:20px;" class="colorBlue"><?php echo date("F d Y",$mainQueryRes[$namaTableDatabase."_repaymentstart"]) ?></td>
											</tr>
										</table>
									</div>
								</div>
							</div>
							<div class="spacer10"></div>
						</div>
					</div>
					<div class="col-lg-2">&nbsp;</div>
				</div>
				<div class="spacer30"></div>
				<form method="post" action="action-fundnow.php">
					<div class="row">
						<div class="col-lg-12">
							<div style="color:#5b5c5e;" class="bold">
								<?php
								/*
								Gift Catalogue<br />
								<span style="font-weight:normal; font-size:16px;">Choose your repayments gifts</span>
								<div class="spacer20"></div>
								<div style="height:2px; background-color:#eae7e7;"></div>
								<div class="spacer20"></div>
								<span style="font-weight:normal; font-size:14px;">As added value of repayment method, Angels of Impact allows Angels Investor to choose their repayment gift from their Social Enterprises. Kindly view the catalogue to choose your repayment gifts.</span>
								<div class="spacer30"></div>
								<?php
								if($mainQueryRes[$namaTableDatabase.'_pdf']!=""){
								?>
									<a class="blueBtn"href="upload/startupGift/<?php echo $mainQueryRes[$namaTableDatabase.'_pdf'] ?>" download="<?php echo $mainQueryRes[$namaTableDatabase.'_name']."_catalogue"; ?>" style="margin:0; padding:10px; font-size:14px;">VIEW CATALOGUE</a>
								<?php
								}
								?>
								<div class="spacer30"></div>
								<textarea name="gift" rows="5" style="width:100%; max-width:500px;" placeholder="Write your repayment gift"></textarea>
								<div class="spacer20"></div>
								*/
								?>
								<div style="height:2px; background-color:#eae7e7;"></div>
								<div class="spacer20"></div>
								Terms and Condition<br />
								<span style="font-weight:normal; font-size:16px;">Below is your funding terms and condition. Read carefully before making a funding.</span>
								<div class="spacer20"></div>
								<table border="0" width="100%">
									<tr>
										<td class="colorBlue fontsize12 bold">Terms of loan</td>
									</tr>
									<tr>
										<td style="padding-top:10px;" class="fontsize11">
											This is a non-recourse loan, I fully understand the risks involved in pledging the amount of money committed to the social enterprise and the service provider site Angels of Impact and Exponential Transformations Pte. Ltd. will not be held liable for any failure in the social enterprises being unable to repay the in part or full loan amount. <br /><br />
											The social enterprise shall commit to a repayment schedule of $ <?php echo $auPostedElements["numberinput"] ?> beginning from the <?php echo date("F d Y",$mainQueryRes[$namaTableDatabase."_repaymentstart"]) ?>, and the $ <?php echo $auPostedElements["numberinput"] ?> will be repaid as credits in the system on Angels of Impact. <br /><br />
											The repayment schedule of your social enterprise is as follows:<br />
											<div style="margin-top:10px; padding:10px; padding-left:20px; padding-bottom:20px; background-color:#FFF; color:#5b5c5e;">
												<table class="fontsize12" width="100%" border="0" style="border-collapse:collapse;">
													<tr>
														<td style="padding-top:5px; padding-bottom:20px; border-bottom:1px solid #ececec;" class="fontsize14 colorBlue bold" width="50%">Repayments due</td>
														<td style="padding-top:5px; padding-bottom:20px; border-bottom:1px solid #ececec;" class="fontsize14 colorBlue bold" width="50%">Amount</td>
													</tr>
													<?php
													$totalAmount 	= round($auPostedElements["numberinput"] / $mainQueryRes[$namaTableDatabase.'_repaymentperiod'],2);
													$repayStart 	= $mainQueryRes[$namaTableDatabase.'_repaymentstart'];
													for($a=0;$a<$mainQueryRes[$namaTableDatabase.'_repaymentperiod'];$a++){
													?>
													<tr>
														<td style="padding-top:10px; padding-bottom:10px; border-bottom:1px solid #ececec;"><?php echo date("M d, Y",$repayStart) ?></td>
														<td style="padding-top:10px; padding-bottom:10px; border-bottom:1px solid #ececec;"><?php echo "$ ". $totalAmount ?></td>
													</tr>
													<?php
														$realDate = date("Y-m-d",$repayStart);
														$repayStart = strtotime(date("Y-m-d",strtotime($realDate."+ 1 Month")));
													}
													?>
												</table>
											</div>
										</td>
									</tr>
									<!--
									<tr>
										<td style="padding-top:30px;" class="colorBlue fontsize12 bold">PUT YOUR TITLE HERE</td>
									</tr>
									<tr>
										<td style="padding-top:10px;" class="fontsize11">
											Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
										</td>
									</tr>
									<tr>
										<td style="padding-top:30px;" class="colorBlue fontsize12 bold">PUT YOUR TITLE HERE</td>
									</tr>
									<tr>
										<td style="padding-top:10px;" class="fontsize11">
											Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
										</td>
									</tr>
									-->
								</table>
								<div class="spacer20"></div>
								<div style="height:2px; background-color:#eae7e7;"></div>
								<div class="spacer20"></div>
								<div align="center">
									<a href="seprofile.php" style="display:inline-block; font-size:16px;" class="darkgreyBtn">BACK</a>
									<div class="spacer30 visible-xs visible-md visible-sm"></div>
									<input class="blueBtn" style="display:inline-block; font-size:16px;" type="submit" value="I AGREE" />
									<?php
									$arrInput = array("startupId"=>$mainQueryRes[$namaTableDatabase."_id"],"fundingAmount"=>$auPostedElements['numberinput']);
									$_SESSION["fundingSession"] = json_encode($arrInput);
									?>
									<!--
									<input type="hidden" name="hdnAmount" id="hdnAmount" value="<?php echo $auPostedElements["numberinput"] ?>" />
									<input type="hidden" name="hdnId" id="hdnId" value="<?php echo $mainQueryRes[$namaTableDatabase."_id"] ?>" />
									-->
								</div>
							</div>
						</div>
					</div>
				</form>
			<?php
			}else if($mainQueryRes[$namaTableDatabase."_deadline"] < time()){
			?>
				<div class="row">
					<div class="col-lg-10">
						<div class="bold">
							This startup already passed the funding deadline <br />
							<span style="font-size:16px; font-weight:normal; text-transform:uppercase;" class="colorBlue">
								<a href="fundenterprises">View other startup</a>
							</span>
						</div>
					</div>
					<div class="col-lg-2">&nbsp;</div>
				</div>
			<?php
			}else if($inComplete == true){
			?>
				<div class="row">
					<div class="col-lg-10">
						<div class="bold">
							You need to complete your registration before start funding <br />
							<span style="font-size:16px; font-weight:normal; text-transform:uppercase;" class="colorBlue">
								<a href="accountedit">Complete your registration</a>
							</span>
						</div>
					</div>
					<div class="col-lg-2">&nbsp;</div>
				</div>
			<?php
			}else{
			?>
				<div class="row">
					<div class="col-lg-10">
						<div class="bold">
							Only pro member allowed to fund a social enterprises <br />
							<span style="font-size:16px; font-weight:normal; text-transform:uppercase;" class="colorBlue">
								<a href="upgradepage.php">Upgrade to pro ?</a>
							</span>
						</div>
					</div>
					<div class="col-lg-2">&nbsp;</div>
				</div>
			<?php
			}
			?>
			<div class="spacer40"></div>
		</div>
	</div>
</div>
<?php
	include('footer.php');
?>
<?php
	include('ue-footer.php');
?>