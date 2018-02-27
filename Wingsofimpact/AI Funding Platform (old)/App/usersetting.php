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
						<!--<div style="float:right;" class="colorBlue fontsize12"><a href="#"><img src="images/pencil.png" /> &nbsp; Edit</a></div>-->
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
						<!--<div style="float:right;" class="colorBlue fontsize12"><a href="#"><img src="images/pencil.png" /> &nbsp; Edit</a></div>-->
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
										<a href="action-onoff.php?type=subscribe&pageutama=usersetting&pageedit=usersetting&action=d">Turn Off</a>
									<?php
									}else{
									?>
										<a href="action-onoff.php?type=subscribe&pageutama=usersetting&pageedit=usersetting&action=e">Turn On</a>
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
			<div class="spacer40"></div>
			<div class="spacer40"></div>
		<?php
		//}else{
		/*
		?>
			<div class="row">
			<?php
			for($i=0;$i<8;$i++){
			?>
				<div class="col-lg-3 col-xs-6">
					<div align="center" style="max-width:160px; margin-top:40px; background-color:#fff; border:1px solid #1475c5; padding-top:10px; padding-bottom:10px; padding-right:7px; padding-left:7px;">
						<table width="100%" border="0">
							<tr>
								<td align="center">
									<div style="width:60px; height:60px;"><img src="images/javara.jpg" width="60" /></div>
								</td>
							</tr>
							<tr>
								<td align="center" style="padding-top:20px; vertical-align:top;">
									<div style="font-size:12px;" class="">
										Reviving the prosperity back into the hands of local Indonesian kakao farmers...
									</div>
									<a href="#" style="margin-top:5px; display:block; font-size:14px;" class="colorBlue bold">more</a>
								</td>
							</tr>
						</table>
					</div>
				</div>
			<?php
			}
			?>
			</div>
		<?php
		*/
		//}
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