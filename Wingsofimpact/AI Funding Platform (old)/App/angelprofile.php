<?php
	include('ue-head.php');
?>
<?php
	include('header.php');
	$qUser 		= ue_query("SELECT * FROM user WHERE user_id = '".$_SESSION['currentUserId']."'");
	$fetchUser	= ue_fetch_array($qUser);
	
	$namaTableDatabase	= "user";
	$mainQueryString 	= "SELECT a.*, b.* FROM ".$namaTableDatabase." a LEFT JOIN company b ON a.company_id = b.company_id WHERE a.".$namaTableDatabase."_enabled = 'e' AND a.".$namaTableDatabase."_membershiptype = 'investors' AND a.".$namaTableDatabase."_publicprofile = 'e' AND a.user_id = '".$_GET['id']."'";
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
			<div class="row">
				<div class="col-lg-6">
					<div class="bold fontsize18 colorDarkGrey">
						<a href="angel.php">&lt; back to angels page</a>
					</div>
					<div class="spacer20"></div>
					<div class="clear"></div>
					<div class="blueContainer">
						<div style="padding:20px; padding-left:40px;">
							<table width="100%" border="0">
								<tr>
									<td width="35%">
										<?php
										$userImage = "images/dummyAvatar.png";
										if($mainQueryRes['user_image']!=""){
											$userImage = "upload/userImage/".$mainQueryRes['user_image'];
										}
	
										?>
										<div style="width:80px; height:80px; border:1px solid #fff; border-radius:50px; overflow:hidden;">
											<img src="<?php echo $userImage ?>" style="width:100%; height:100%;" />
										</div>
									</td>
									<td>
										<div style="font-size:14px;" class="colorWhite bold"><?php echo $mainQueryRes['user_name'] ?></div>
										<div style="font-size:12px;" class="colorWhite"><?php echo $mainQueryRes['user_country'] ?></div>
										<div style="font-size:12px;" class="colorWhite bold"><?php echo $mainQueryRes['company_name'] ?></div>
									</td>
								</tr>
							</table>
						</div>
					</div>
					<div align="center" style="background-color:#fff; padding:20px; padding-left:40px; border:1px solid #1475c4;">
						<table width="100%" border="0">
							<tr>
								<td class="fontsize14 colorBlue bold">
									Industry
								</td>
							</tr>
							<tr>
								<td class="fontsize14 colorDarkGrey">
									<?php echo $mainQueryRes['company_industry'] ?>
								</td>
							</tr>
							<tr>
								<td style="padding-top:20px;" class="fontsize14 colorBlue bold">
									Area of interest
								</td>
							</tr>
							<tr>
								<td class="fontsize14 colorDarkGrey">
									<?php echo $mainQueryRes['company_interest'] ?>
								</td>
							</tr>
							<tr>
								<td style="padding-top:20px;" class="fontsize14 colorBlue bold">
									Misson that i care about
								</td>
							</tr>
							<tr>
								<td class="fontsize14 colorDarkGrey">
									<?php echo $mainQueryRes['company_mission'] ?>
								</td>
							</tr>
							<tr>
								<td style="padding-top:20px;" class="fontsize14 colorBlue bold">
									Pro bono skills
								</td>
							</tr>
							<tr>
								<td class="fontsize14 colorDarkGrey">
									<?php echo $mainQueryRes['company_probono'] ?>
								</td>
							</tr>
							<tr>
								<td style="padding-top:20px;" class="fontsize14 colorBlue bold">
									New Market Opportunity
								</td>
							</tr>
							<tr>
								<td class="fontsize14 colorDarkGrey">
									<?php echo $mainQueryRes['company_newmarket'] ?>
								</td>
							</tr>
							<tr>
								<td style="padding-top:20px;" class="fontsize14 colorBlue bold">
									Partnership
								</td>
							</tr>
							<tr>
								<td class="fontsize14 colorDarkGrey">
									<?php echo $mainQueryRes['company_connection'] ?>
								</td>
							</tr>
							<tr>
								<td style="padding-top:20px;" class="fontsize14 colorBlue bold">
									Social Enterprises
								</td>
							</tr>
							<tr>
								<td style="padding-top:10px;" class="fontsize14 colorDarkGrey">
									<?php 
									$qStartup = ue_query("SELECT a.*, b.* FROM transaction a INNER JOIN startup b ON a.startup_id = b.startup_id WHERE a.user_id = '".$mainQueryRes['user_id']."' GROUP BY a.user_id, a.startup_id");
									while($fetchSt = ue_fetch_array($qStartup)){
									?>
										<img width="50" style="margin-right:10px;" src="upload/startupLogo/<?php echo $fetchSt['startup_logo'] ?>" />
									<?php
									}
									?>
								</td>
							</tr>
						</table>
					</div>
				</div>
				<div class="col-lg-6">
					&nbsp;
				</div>
			</div>
			<div class="spacer40"></div>
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