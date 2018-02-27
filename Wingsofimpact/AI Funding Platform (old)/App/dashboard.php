<?php
	include('ue-head.php');
?>
<?php
	include('header.php');
	$qUser 		= ue_query("SELECT * FROM user WHERE user_id = '".$_SESSION['currentUserId']."'");
	$fetchUser	= ue_fetch_array($qUser);
	$namaTableDatabase	= "transaction";
	$mainQueryString 	= "SELECT a.*, b.*, SUM(a.transaction_amount) as totalPaid FROM ".$namaTableDatabase." a LEFT JOIN startup b ON a.startup_id = b.startup_id WHERE a.user_id = '".$_SESSION['currentUserId']."' GROUP BY a.startup_id";
	//echo $mainQueryString;
	$result 		= ue_query($mainQueryString);
	$totalSe		= ue_num_rows($result);
	$mainQueryRes 	= ue_fetch_array($result);
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
			include ('welcome-dashboard.php');
			?>
			<div class="row">
				<div class="col-lg-4">
					<table width="90%" class="colorBlue" border="0" style="border-collapse:collapse;">
						<tr>
							<td width="60" rowspan="2">
								<img width="45" src="images/dollar.png" />
							</td>
							<td>Total Funding</td>
						</tr>
						<tr>
							<td class="bold">$ <?php echo ($mainQueryRes['totalPaid']!="" ? $mainQueryRes['totalPaid'] : 0); ?></td>
						</tr>
					</table>
				</div>
				<div class="spacer30 visible-xs visible-sm visible-md"></div>
				<div class="col-lg-4">
					<table width="100%" class="colorBlue" border="0" style="border-collapse:collapse;">
						<tr>
							<td width="65" rowspan="2">
								<img width="45" src="images/heartBlue.png" />
							</td>
							<td>Social Enterprises</td>
						</tr>
						<tr>
							<td class="bold"><?php echo $totalSe ?></td>
						</tr>
					</table>
				</div>
				<div class="spacer30 visible-xs visible-sm visible-md"></div>
				<div class="col-lg-4">
					<table width="100%" class="colorBlue" border="0" style="border-collapse:collapse;">
						<?php
						if($fetchUser["user_membershipid"] != 0){
							$heartImg = "images/angelBlue.png";
							$fontClass = "";
							if($membershipKey == "2"){
								$heartImg = "images/angelPurple.png";
								$fontClass = "colorViolet";
							}
						?>
							<tr>
								<td width="60" rowspan="2">
									<img width="55" src="<?php echo $heartImg; ?>" />
								</td>
								<td valign="top" class="<?php echo $fontClass; ?>" >Member:<span class="bold">
									<?php echo $aolMembership[$fetchUser['user_membershiptype']][$membershipKey]['member'] ?></span>
								</td>
							</tr>
							<tr>
								<td>
									<span class="fontsize12 bold <?php echo $fontClass; ?>">
									<?php
										if($fetchUser['user_expiry'] == "0"){
											echo "Your application is being reviewed ";	
										}else if($fetchUser['user_expiry'] < time()){
											echo "Status: <span class='bold'>Expired</span> ";
										}else{
											echo "Until <span class=\"bold\">".date("d M Y",$fetchUser['user_expiry'])."</span>";
											//echo "<a href='upgradepage.php'>UPGRADE TO PRO</a>";
										}
									?>
									</span>
								</td>
							</tr>
						<?php
						}else{
						?>
							<tr>
								<td width="60" rowspan="2">
									<img width="45" src="images/angelBlue.png" />
								</td>
								<td valign="top" >Member:<span class="bold">
									<?php echo $aolMembership[$fetchUser['user_membershiptype']][$membershipKey]['member'] ?></span>
								</td>
							</tr>
							<tr>
								<td>
									<a href='upgradepage.php'>UPGRADE TO PRO</a>
								</td>
							</tr>
						<?php
						}
						?>
					</table>
				</div>
			</div>
			<div class="spacer60"></div>
			<div class="row">
				<div class="col-lg-6 bold colorGrey" style="font-size:16px;">
					Your Social Enterprises
					<div class="inputFormContainer" style="min-height:120px; height:auto; font-size:9px; padding:20px;">
						<?php
						$qStartup 	= ue_query("SELECT a.*, b.startup_id, b.startup_logo, b.startup_name FROM transaction a INNER JOIN startup b ON a.startup_id = b.startup_id WHERE a.user_id = '".$_SESSION['currentUserId']."' GROUP BY a.startup_id");
						$arrStartup = array();
						if(ue_num_rows($qStartup)>0){
							while($fetchStartup = ue_fetch_array($qStartup)){
								if($fetchStartup['startup_name']!=""){
									$arrStartup[] = $fetchStartup['startup_id'];
							?>
									<div style="display:inline-block; margin-right:15px;">
										<table>
											<tr>
												<td>
													<div style="max-width:60px; max-height:60px;">
														<img height="60" src="upload/startupLogo/<?php echo $fetchStartup['startup_logo'] ?>" />
													</div>
												</td>
											</tr>
											<tr>
												<td style="padding-top:5px;" align="center"><?php echo $fetchStartup['startup_name'] ?></td>
											</tr>
										</table>
									</div>
							<?php
								}
							}
							?>
						<?php
						}else{
						?>	
							<div style="display:inline-block; margin-right:15px;" class="fontsize16">
								No Social Enterprises at the moment...
							</div>
						<?php
						}
						?>
					</div>
					<div class="spacer10"></div>
					<a href="fundenterprises.php" class="colorBlue">
						Fund Social Enterprises
					</a>
				</div>
				<div class="spacer30 visible-xs visible-sm visible-md"></div>
				<div class="col-lg-6 bold colorGrey" style="font-size:16px;">
					Your Co-Funders
					<div class="inputFormContainer" style="min-height:120px; height:auto; font-size:9px; padding:20px;">
					<?php
					$implodeStartup = implode(",",$arrStartup);
					$qCoinv = ue_query("SELECT a.*, b.user_image, b.user_id, b.user_name FROM transaction a INNER JOIN user b ON a.user_id = b.user_id WHERE a.startup_id IN (".$implodeStartup.") AND a.user_id != '".$_SESSION['currentUserId']."' GROUP BY b.user_id");
					if(ue_num_rows($qCoinv)>0){
						while($fetchInv = ue_fetch_array($qCoinv)){
							if($fetchInv['user_name']!=""){
						?>
								<div style="display:inline-block; margin-right:15px;">
									<table>
										<tr>
											<td><img class="img-circle" style="overflow:hidden;" width="60" src="upload/userImage/<?php echo $fetchInv['user_image'] ?>" /></td>
										</tr>
										<tr>
											<td style="padding-top:5px;" align="center"><?php echo $fetchInv['user_name'] ?></td>
										</tr>
									</table>
								</div>
						<?php
							}
						}
						?>					
					<?php
					}else{
					?>
						<div style="display:inline-block; margin-right:15px;" class="fontsize16">
							No Co-Funders at the moment...
						</div>
					<?php
					}
					?>
					</div>
					<div class="spacer10"></div>
					<a href="angel.php" class="colorBlue">
						See other Funders
					</a>
				</div>
			</div>
			<div class="spacer50"></div>
		<?php
		}else{
			$namaTableDatabase	= "transactiondetail";
			$mainQueryString 	= "SELECT a.*, b.transaction_amount, b.user_id as investor_id, c.startup_id, c.startup_name, c.user_id
									FROM transactiondetail a 
									LEFT JOIN transaction b ON a.transaction_id = b.transaction_id 
									LEFT JOIN startup c ON b.startup_id = c.startup_id 
									WHERE c.user_id = '".$_SESSION['currentUserId']."' AND c.startup_enabled = 'e'";
			//echo $mainQueryString;
			$result 			= ue_query($mainQueryString);
			$mainQueryString 	= $mainQueryString." ORDER BY ".$namaTableDatabase."_repaymentdue DESC";
			$mainQueryQue 		= ue_query($mainQueryString);			
			$arrFinal		= array();
			$arrDue			= array();
			$arrInv			= array();
			$total 			= 0;
			$detailAmount	= 0;
			
			while($mainQueryRes = ue_fetch_array($mainQueryQue)){
				$arrFinal["startupid"] 		= $mainQueryRes['startup_id'];
				$arrFinal["startupname"] 	= $mainQueryRes['startup_name'];
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
				
				if(!in_array($mainQueryRes['investor_id'],$arrInv)){
					$arrInv[] = $mainQueryRes['investor_id'];
				}
			}
			$arrFinal["amount"] = $detailAmount;
			/*
			echo "<pre>";
			print_r($arrFinal);
			echo "</pre>";
			*/
		?>
			<?php
			include ('welcome-dashboard.php');
			?>
			<div class="row">
				<div class="col-lg-4">
					<table width="90%" class="colorBlue" border="0" style="border-collapse:collapse;">
						<tr>
							<td width="60" rowspan="2">
								<img src="images/dollar.png" />
							</td>
							<td class="fontsize18">Total Funded</td>
						</tr>
						<tr>
							<td class="bold fontsize24">$ <?php echo round($arrFinal["amount"],0); ?></td>
						</tr>
					</table>
				</div>
				<div class="spacer30 visible-xs visible-sm visible-md"></div>
				<div class="col-lg-4">
					<table width="90%" class="colorBlue" border="0" style="border-collapse:collapse;">
						<tr>
							<td width="80" rowspan="2">
								<img src="images/angelBlue.png" />
							</td>
							<td class="fontsize18">Angel Funders</td>
						</tr>
						<tr>
							<td class="bold fontsize24"><?php echo count($arrInv); ?></td>
						</tr>
					</table>
				</div>
				<div class="spacer30 visible-xs visible-sm visible-md"></div>
				<div class="col-lg-4">
					<?php
					if($fetchUser["user_membershipid"] != 0){
					?>
						<table width="100%" class="colorBlue" border="0" style="border-collapse:collapse;">
							<tr>
								<td width="60" rowspan="2">
									<img src="images/heartBlue.png" />
								</td>
								<td class="colorBlue fontsize18">Membership: <span class="bold"><?php echo $aolMembership['startup'][$membershipKey]['member']?></span></td>
							</tr>
							<tr>
								<td class="colorBlue fontsize12" style="text-decoration:underline;">
									<?php
										if($fetchUser['user_expiry'] == "0"){
											echo "Your application is being reviewed ";	
										}else if($fetchUser['user_expiry'] < time()){
											echo "Status: <span class='bold'>Expired</span> ";
										}else{
											echo "Until <span class=\"bold\">".date("d M Y",$fetchUser['user_expiry'])."</span>";
											//echo "<a href='upgradepage.php'>UPGRADE TO PRO</a>";
										}
									?>
								</td>
							</tr>
						</table>
					<?php
					}else{
					?>
						<table width="100%" class="colorBlue" border="0" style="border-collapse:collapse;">
							<tr>
								<td width="60" rowspan="2">
									<img src="images/heartBlue.png" />
								</td>
								<td class="fontsize18 colorBlue">Membership: 
									<span class="bold"><?php echo $aolMembership['startup'][$fetchUser["user_membershipid"]]['member']?></span>
								</td>
							</tr>
							<tr>
								<td>
									<a href='upgradepage.php'>UPGRADE TO PRO</a>
								</td>
							</tr>
						</table>
					<?php
					}
					?>
				</div>
			</div>
			<div class="spacer60"></div>
			<div class="row">
				<div class="col-lg-6 bold colorGrey" style="font-size:16px;">
					<span class="colorDarkGrey">Your Funders</span>
					<div class="inputFormContainer" style="height:auto; font-size:9px; padding:20px;">
						<?php
						$qCoinv = ue_query("SELECT a.*, b.user_image, b.user_id, b.user_name FROM transaction a INNER JOIN user b ON a.user_id = b.user_id WHERE a.startup_id = '".$arrFinal['startupid']."' GROUP BY a.user_id");
						if(ue_num_rows($qCoinv)>0){
							while($fetchInv = ue_fetch_array($qCoinv)){
								if($fetchInv['user_name']!=""){
						?>
									<div style="display:inline-block; margin-right:15px;">
										<table>
											<tr>
												<td><img class="img-circle" style="overflow:hidden;" width="60" height="60" src="upload/userImage/<?php echo $fetchInv['user_image'] ?>" /></td>
											</tr>
											<tr>
												<td style="padding-top:5px;" align="center"><?php echo $fetchInv['user_name'] ?></td>
											</tr>
										</table>
									</div>
							<?php
								}
							}
							?>
						<?php
						}else{
						?>
							<div style="display:inline-block; margin-right:15px;" class="fontsize16">
								You have no Funders at the moment
							</div>
						<?php
						}
						?>
					</div>
				</div>
				<div class="col-lg-6"></div>
			</div>
			<div class="spacer10"></div>
			<div class="row">
				<div class="col-lg-12">
					<a class="fontsize16 colorBlue bold" href="angel.php">See other Angel</a>
				</div>
			</div>
			<div class="spacer50"></div>
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