<?php
	include('ue-head.php');
?>
<?php
	include('header.php');
	$qUser 		= ue_query("SELECT a.*, b.* FROM user a LEFT JOIN company b ON a.user_id = b.user_id WHERE a.user_id = '".$_SESSION['currentUserId']."'");
	$fetchUser	= ue_fetch_array($qUser);
	
	$namaTableDatabase	= "inbox";
	$mainQueryString	= "SELECT * FROM inbox WHERE user_id = '".$_SESSION['currentUserId']."' AND inbox_id = '".$_GET['id']."'";
	$mainQueryQue 		= ue_query($mainQueryString);
	$mainQueryRes		= ue_fetch_array($mainQueryQue);
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
					<a class="bold fontsize14" href="inbox.php">< Back</a>
					<div align="center" style="margin-top:10px; background-color:#fff; padding:20px;">
						<table width="100%" border="0">
							<tr>
								<td class="fontsize14 colorBlue bold">
									From
								</td>
							</tr>
							<tr>
								<td class="fontsize14" style="color:#959595;">
									Admin
								</td>
							</tr>
							<tr>
								<td style="padding-top:20px;" class="fontsize14 colorBlue bold">
									Date
								</td>
							</tr>
							<tr>
								<td class="fontsize14" style="color:#959595;">
									<?php echo date("Y, F d",$mainQueryRes["inbox_entrydate"]); ?>
								</td>
							</tr>
							<tr>
								<td style="padding-top:20px;" class="fontsize14 colorBlue bold">
									Subject
								</td>
							</tr>
							<tr>
								<td class="fontsize14" style="color:#959595;">
									<?php echo $mainQueryRes["inbox_name"]; ?>
								</td>
							</tr>
							<tr>
								<td style="padding-top:20px;" class="fontsize14 colorBlue bold">
									Message
								</td>
							</tr>
							<tr>
								<td class="fontsize14" style="color:#959595;">
									<?php echo $mainQueryRes["inbox_desc"]; ?>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
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