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
		//if($fetchUser['user_membershiptype'] == "investors"){
		?>
			<?php
			include ('welcome-dashboard.php');
			?>
			<?php
			if(strtolower($_GET['edit']) == "personal"){
			?>
				<form class="registrationForm" action="action-usersettingedit.php" method="post">
					<div class="row">
						<div class="col-lg-6">
							<div class="bold fontsize16" style="color:#5b5c5e;">
								Email
								<div style="float:right;" class="colorBlue fontsize12"><a href="usersettingedit.php?edit=personal"><img src="images/pencil.png" /> &nbsp; Edit</a></div>
							</div>
							<div class="clear"></div>
							<div align="center" style="margin-top:10px; background-color:#fff; padding:20px;">
								<table width="100%" border="0">
									<tr>
										<td class="fontsize14 colorBlue bold">
											Email
										</td>
									</tr>
									<tr>
										<td class="fontsize14" style="color:#959595;">
											<?php echo $fetchUser['user_email'] ?>
										</td>
									</tr>
									<tr>
										<td style="padding-top:20px;" class="fontsize14 colorBlue bold">
											Password
										</td>
									</tr>
									<tr>
										<td class="fontsize14" style="color:#959595;">
											<div class="inputFormContainerAuto">
												<input type="password" placeholder="Leave empty if no change" name="password" />
											</div>
										</td>
									</tr>
									<tr>
										<td style="padding-top:20px;" class="fontsize14 colorBlue bold">
											New Password
										</td>
									</tr>
									<tr>
										<td class="fontsize14" style="color:#959595;">
											<div class="inputFormContainerAuto">
												<input type="password" placeholder="Leave empty if no change" name="newpassword" />
											</div>
										</td>
									</tr>
									<tr>
										<td style="padding-top:20px;" class="fontsize14 colorBlue bold">
											Repeat New Password
										</td>
									</tr>
									<tr>
										<td class="fontsize14" style="color:#959595;">
											<div class="inputFormContainerAuto">
												<input type="password" placeholder="Leave empty if no change" name="newrepassword" />
											</div>
										</td>
									</tr>
									<tr>
										<td style="padding-top:20px;" class="fontsize14 colorBlue bold">
											<input type="submit" name="personalBtn" value="UPDATE" class="blueBtn" />
										</td>
									</tr>
								</table>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="bold fontsize16" style="color:#5b5c5e;">
								Membership
							</div>
							<div class="clear"></div>
							<div align="center" style="margin-top:10px; background-color:#fff; padding:20px;">
								<table width="100%" border="0">
									<tr>
										<td class="fontsize14 colorBlue bold">
											Membership Type
										</td>
									</tr>
									<tr>
										<td class="fontsize14" style="color:#959595;">
											<?php echo $fetchUser['user_membershiptype']." - ".$aolMembership[$fetchUser['user_membershiptype']][$fetchUser['user_membershipid']]['name']; ?>
										</td>
									</tr>
									<tr>
										<td style="padding-top:20px;" class="fontsize14 colorBlue bold">
											Membership Period
										</td>
									</tr>
									<tr>
										<td class="fontsize14" style="color:#959595;">
											<?php echo date("F d Y",$fetchUser['user_expiry']) ?>
										</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
					<div class="spacer40"></div>
					<div class="row">
						<div class="col-lg-6">
							<div class="bold fontsize16" style="color:#5b5c5e;">
								Banking Information
								<div style="float:right;" class="colorBlue fontsize12"><a href="usersettingedit.php?edit=bank"><img src="images/pencil.png" /> &nbsp; Edit</a></div>
							</div>
							<div class="clear"></div>
							<div align="center" style="margin-top:10px; background-color:#fff; padding:20px;">
								<table width="100%" border="0">
									<tr>
										<td class="fontsize14 colorBlue bold">
											Bank Name
										</td>
									</tr>
									<tr>
										<td class="fontsize14" style="color:#959595;">
											<?php echo $fetchUser['user_bankname'] ?>
										</td>
									</tr>
									<tr>
										<td style="padding-top:20px;" class="fontsize14 colorBlue bold">
											Account Name
										</td>
									</tr>
									<tr>
										<td class="fontsize14" style="color:#959595;">
											<?php echo $fetchUser['user_bankaccountname'] ?>
										</td>
									</tr>
									<tr>
										<td style="padding-top:20px;" class="fontsize14 colorBlue bold">
											Account Number
										</td>
									</tr>
									<tr>
										<td class="fontsize14" style="color:#959595;">
											<?php echo $fetchUser['user_bankaccountnumber'] ?>
										</td>
									</tr>
								</table>
							</div>
						</div>
						<div class="col-lg-6">	
							<div class="bold fontsize16" style="color:#5b5c5e;">
								Newsletter
							</div>
							<div class="clear"></div>
							<div align="center" style="margin-top:10px; background-color:#fff; padding:20px;">
								<table width="100%" border="0">
									<tr>
										<td colspan="2" class="fontsize14 colorBlue bold">
											Subscription Type
										</td>
									</tr>
									<tr>
										<td class="fontsize14" style="color:#959595;">
											<?php
											if($fetchUser['user_emailnotify'] == "e"){
												echo "Email for every updates";
											}else{
												echo "Off";
											}
											?>
										</td>
										<td align="right" class="fontsize14 colorBlue">
											<?php
											if($fetchUser['user_emailnotify'] == "e"){
											?>
												<a href="action-onoff.php?type=subscribe&pageutama=usersettingedit&pageedit=usersettingedit&action=d">Turn Off</a>
											<?php
											}else{
											?>
												<a href="action-onoff.php?type=subscribe&pageutama=usersettingedit&pageedit=usersettingedit&action=e">Turn On</a>
											<?php
											}
											?>
										</td>
									</tr>
								</table>
							</div>
							<div class="spacer40"></div>
							<div class="spacer40"></div>
							<div class="spacer20"></div>
							<div style=""><a class="colorBlue fontsize16 bold" href="#">Delete Account</a></div>
						</div>
					</div>
				</form>
			<?php
			}else if(strtolower($_GET['edit']) == "bank"){
			?>
				<form class="registrationForm" action="action-usersettingedit.php" method="post">
					<div class="row">
						<div class="col-lg-6">
							<div class="bold fontsize16" style="color:#5b5c5e;">
								Email
								<div style="float:right;" class="colorBlue fontsize12"><a href="usersettingedit.php?edit=personal"><img src="images/pencil.png" /> &nbsp; Edit</a></div>
							</div>
							<div class="clear"></div>
							<div align="center" style="margin-top:10px; background-color:#fff; padding:20px;">
								<table width="100%" border="0">
									<tr>
										<td class="fontsize14 colorBlue bold">
											Email
										</td>
									</tr>
									<tr>
										<td class="fontsize14" style="color:#959595;">
											<?php echo $fetchUser['user_email'] ?>
										</td>
									</tr>
									<tr>
										<td style="padding-top:20px;" class="fontsize14 colorBlue bold">
											Password
										</td>
									</tr>
									<tr>
										<td class="fontsize14" style="color:#959595;">
											[hidden]
										</td>
									</tr>
								</table>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="bold fontsize16" style="color:#5b5c5e;">
								Membership
							</div>
							<div class="clear"></div>
							<div align="center" style="margin-top:10px; background-color:#fff; padding:20px;">
								<table width="100%" border="0">
									<tr>
										<td class="fontsize14 colorBlue bold">
											Membership Type
										</td>
									</tr>
									<tr>
										<td class="fontsize14" style="color:#959595;">
											<?php echo $fetchUser['user_membershiptype']." - ".$aolMembership[$fetchUser['user_membershiptype']][$fetchUser['user_membershipid']]['name']; ?>
										</td>
									</tr>
									<tr>
										<td style="padding-top:20px;" class="fontsize14 colorBlue bold">
											Membership Period
										</td>
									</tr>
									<tr>
										<td class="fontsize14" style="color:#959595;">
											<?php echo date("F d Y",$fetchUser['user_expiry']) ?>
										</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
					<div class="spacer40"></div>
					<div class="row">
						<div class="col-lg-6">
							<div class="bold fontsize16" style="color:#5b5c5e;">
								Banking Information
								<div style="float:right;" class="colorBlue fontsize12"><a href="usersettingedit.php?edit=bank"><img src="images/pencil.png" /> &nbsp; Edit</a></div>
							</div>
							<div class="clear"></div>
							<div align="center" style="margin-top:10px; background-color:#fff; padding:20px;">
								<table width="100%" border="0">
									<tr>
										<td class="fontsize14 colorBlue bold">
											Bank Name
										</td>
									</tr>
									<tr>
										<td class="fontsize14" style="color:#959595;">
											<div class="inputFormContainerAuto">
												<?php echo ueCreateInputText('bankname','',$fetchUser['user_bankname'],'')?>
											</div>
										</td>
									</tr>
									<tr>
										<td style="padding-top:20px;" class="fontsize14 colorBlue bold">
											Account Name
										</td>
									</tr>
									<tr>
										<td class="fontsize14" style="color:#959595;">
											<div class="inputFormContainerAuto">
												<?php echo ueCreateInputText('bankaccountname','',$fetchUser['user_bankaccountname'],'')?>
											</div>
										</td>
									</tr>
									<tr>
										<td style="padding-top:20px;" class="fontsize14 colorBlue bold">
											Account Number
										</td>
									</tr>
									<tr>
										<td class="fontsize14" style="color:#959595;">
											<div class="inputFormContainerAuto">
												<?php echo ueCreateInputText('bankaccountnumber','',$fetchUser['user_bankaccountnumber'],'')?>
											</div>
										</td>
									</tr>
									<tr>
										<td style="padding-top:20px;" class="fontsize14 colorBlue bold">
											<input type="submit" name="bankBtn" value="UPDATE" class="blueBtn" />
										</td>
									</tr>
								</table>
							</div>
						</div>
						<div class="col-lg-6">	
							<div class="bold fontsize16" style="color:#5b5c5e;">
								Newsletter
							</div>
							<div class="clear"></div>
							<div align="center" style="margin-top:10px; background-color:#fff; padding:20px;">
								<table width="100%" border="0">
									<tr>
										<td colspan="2" class="fontsize14 colorBlue bold">
											Subscription Type
										</td>
									</tr>
									<tr>
										<td class="fontsize14" style="color:#959595;">
											<?php
											if($fetchUser['user_emailnotify'] == "e"){
												echo "Email for every updates";
											}else{
												echo "Off";
											}
											?>
										</td>
										<td align="right" class="fontsize14 colorBlue">
											<?php
											if($fetchUser['user_emailnotify'] == "e"){
											?>
												<a href="action-onoff.php?type=subscribe&pageutama=usersettingedit&pageedit=usersettingedit&action=d">Turn Off</a>
											<?php
											}else{
											?>
												<a href="action-onoff.php?type=subscribe&pageutama=usersettingedit&pageedit=usersettingedit&action=e">Turn On</a>
											<?php
											}
											?>
										</td>
									</tr>
								</table>
							</div>
							<div class="spacer40"></div>
							<div class="spacer40"></div>
							<div class="spacer20"></div>
							<div style=""><a class="colorBlue fontsize16 bold" href="#">Delete Account</a></div>
						</div>
					</div>
				</form>
			<?php
			}
			?>
			
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