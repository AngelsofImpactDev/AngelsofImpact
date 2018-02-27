<?php
	include('ue-head.php');
?>
<?php
	include('header.php');
	$qUser 		= ue_query("SELECT a.*, b.* FROM user a LEFT JOIN company b ON a.company_id = b.company_id WHERE a.user_id = '".$_SESSION['currentUserId']."'");
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
		?>
			<?php
			include ('welcome-dashboard.php');
			?>
			<div class="row">
				<div class="col-lg-6">
					<div class="bold fontsize16" style="color:#5b5c5e;">
						Personal Data
						<div style="float:right;" class="colorBlue fontsize12"><a href="accountedit.php"><img src="images/pencil.png" /> &nbsp; Edit</a></div>
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
									ID/Passport Number
								</td>
							</tr>
							<tr>
								<td class="fontsize14" style="color:#959595;">
									<?php echo $fetchUser['user_passport'] ?>
								</td>
							</tr>
							<tr>
								<td style="padding-top:20px;" class="fontsize14 colorBlue bold">
									Mobile
								</td>
							</tr>
							<tr>
								<td class="fontsize14" style="color:#959595;">
									<?php echo $fetchUser['user_telp'] ?>
								</td>
							</tr>
							<tr>
								<td style="padding-top:20px;" class="fontsize14 colorBlue bold">
									Country
								</td>
							</tr>
							<tr>
								<td class="fontsize14" style="color:#959595;">
									<?php echo $fetchUser['user_country'] ?>
								</td>
							</tr>
							<tr>
								<td style="padding-top:20px;" class="fontsize14 colorBlue bold">
									Address
								</td>
							</tr>
							<tr>
								<td class="fontsize14" style="color:#959595;">
									<?php echo $fetchUser['user_address'] ?>
								</td>
							</tr>
						</table>
						<div class="spacer50"></div>
						<div class="spacer50"></div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="bold fontsize16" style="color:#5b5c5e;">
						Company Details
						<div style="float:right;" class="colorBlue fontsize12"><a href="companyedit.php"><img src="images/pencil.png" /> &nbsp; Edit</a></div>
					</div>
					<div class="clear"></div>
					<div align="center" style="margin-top:10px; background-color:#fff; padding:20px;">
						<table width="100%" border="0">
							<tr>
								<td class="fontsize14 colorBlue bold">
									Company Name
								</td>
							</tr>
							<tr>
								<td class="fontsize14" style="color:#959595;">
									<?php echo $fetchUser['company_name'] ?>
								</td>
							</tr>
							<tr>
								<td style="padding-top:20px;" class="fontsize14 colorBlue bold">
									Company Code
								</td>
							</tr>
							<tr>
								<td class="fontsize14" style="color:#959595;">
									<?php echo $fetchUser['company_code'] ?>
								</td>
							</tr>
							<tr>
								<td style="padding-top:20px;" class="fontsize14 colorBlue bold">
									Website
								</td>
							</tr>
							<tr>
								<td class="fontsize14" style="color:#959595;">
									<?php echo $fetchUser['company_website'] ?>
								</td>
							</tr>
							<!--
							<tr>
								<td style="padding-top:20px;" class="fontsize14 colorBlue bold">
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
									Country
								</td>
							</tr>
							<tr>
								<td class="fontsize14" style="color:#959595;">
									<?php echo $fetchUser['user_country'] ?>
								</td>
							</tr>
							-->
							<tr>
								<td style="padding-top:20px;" class="fontsize14 colorBlue bold">
									Industry
								</td>
							</tr>
							<tr>
								<td class="fontsize14" style="color:#959595;">
									<?php echo $fetchUser['company_industry'] ?>
								</td>
							</tr>
							<tr>
								<td style="padding-top:20px;" class="fontsize14 colorBlue bold">
									Area of Interest
								</td>
							</tr>
							<tr>
								<td class="fontsize14" style="color:#959595;">
									<?php echo $fetchUser['company_interest'] ?>
								</td>
							</tr>
							<tr>
								<td style="padding-top:20px;" class="fontsize14 colorBlue bold">
									Mission that you care about
								</td>
							</tr>
							<tr>
								<td class="fontsize14" style="color:#959595;">
									<?php echo $fetchUser['company_mission'] ?>
								</td>
							</tr>
							<tr>
								<td style="padding-top:20px;" class="fontsize14 colorBlue bold">
									Resources that you can give to Social Enterprises
								</td>
							</tr>
							<tr>
								<td class="fontsize14" style="color:#959595;">
									<?php echo $fetchUser['company_probono'] ?>
								</td>
							</tr>
							<tr>
								<td class="fontsize14" style="color:#959595;">
									<?php echo $fetchUser['company_newmarket'] ?>
								</td>
							</tr>
							<tr>
								<td class="fontsize14" style="color:#959595;">
									<?php echo $fetchUser['company_connection'] ?>
								</td>
							</tr>
						</table>
						<div class="spacer50"></div>
						<div class="spacer50"></div>
					</div>
				</div>
			</div>
			<div class="spacer40"></div>
			<div class="spacer40"></div>
		<?php
		}else{
		?>
			<?php
			include ('welcome-dashboard.php');
			?>
			<div class="row">
				<div class="col-lg-6">
					<div class="bold fontsize16" style="color:#5b5c5e;">
						Personal Data
						<div style="float:right;" class="colorBlue fontsize12"><a href="accountedit.php"><img src="images/pencil.png" /> &nbsp; Edit</a></div>
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
									Mobile
								</td>
							</tr>
							<tr>
								<td class="fontsize14" style="color:#959595;">
									<?php echo $fetchUser['user_telp'] ?>
								</td>
							</tr>
							<tr>
								<td style="padding-top:20px;" class="fontsize14 colorBlue bold">
									Country
								</td>
							</tr>
							<tr>
								<td class="fontsize14" style="color:#959595;">
									<?php echo $fetchUser['user_country'] ?>
								</td>
							</tr>
						</table>
						<div class="spacer50"></div>
						<div class="spacer50"></div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="bold fontsize16" style="color:#5b5c5e;">
						Company Details					
						<div style="float:right;" class="colorBlue fontsize12"><a href="companyedit"><img src="images/pencil.png" /> &nbsp; Edit</a></div>
					</div>
					<div class="clear"></div>
					<div align="center" style="margin-top:10px; background-color:#fff; padding:20px;">
						<table width="100%" border="0">
							<tr>
								<td class="fontsize14 colorBlue bold">
									Company Name
								</td>
							</tr>
							<tr>
								<td class="fontsize14" style="color:#959595;">
									<?php echo $fetchUser['company_name'] ?>
								</td>
							</tr>
							<tr>
								<td style="padding-top:20px;" class="fontsize14 colorBlue bold">
									Website
								</td>
							</tr>
							<tr>
								<td class="fontsize14" style="color:#959595;">
									<?php echo $fetchUser['company_website'] ?>
								</td>
							</tr>
							<tr>
								<td style="padding-top:20px;" class="fontsize14 colorBlue bold">
									Industry
								</td>
							</tr>
							<tr>
								<td class="fontsize14" style="color:#959595;">
									<?php echo $fetchUser['company_industry'] ?>
								</td>
							</tr>
							<tr>
								<td style="padding-top:20px;" class="fontsize14 colorBlue bold">
									Revenue
								</td>
							</tr>
							<tr>
								<td class="fontsize14" style="color:#959595;">
									<?php echo $fetchUser['company_revenue'] ?>
								</td>
							</tr>
							<tr>
								<td style="padding-top:20px;" class="fontsize14 colorBlue bold">
									Company Impact
								</td>
							</tr>
							<tr>
								<td class="fontsize14" style="color:#959595;">
									<?php echo $fetchUser['company_impact'] ?>
								</td>
							</tr>
						</table>
						<div class="spacer40"></div>
					</div>
				</div>
			</div>
			<div class="spacer40"></div>
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