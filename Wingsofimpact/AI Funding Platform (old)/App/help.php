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
			include ('welcome-dashboard.php');
			?>
			<div class="row">
				<div class="col-lg-12">
					<div class="bold fontsize16" style="color:#5b5c5e;">
						Need any help? Feel free to get in touch with us
					</div>
					<div class="spacer30"></div>
					<table width="100%" border="0">
						<tr>
							<td class="fontsize14 colorBlue bold">
								General Inquiries
							</td>
						</tr>
						<tr>
							<td class="fontsize14" style="color:#959595;">
								inquiries@angelofimpact.com
							</td>
						</tr>
						<tr>
							<td style="padding-top:20px;" class="fontsize14 colorBlue bold">
								Membership
							</td>
						</tr>
						<tr>
							<td class="fontsize14" style="color:#959595;">
								member@angelofimpact.com
							</td>
						</tr>
						<tr>
							<td style="padding-top:20px;" class="fontsize14 colorBlue bold">
								Payment
							</td>
						</tr>
						<tr>
							<td class="fontsize14" style="color:#959595;">
								payment@angelofimpact.com
							</td>
						</tr>
					</table>
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