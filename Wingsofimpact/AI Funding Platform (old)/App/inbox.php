<?php
	include('ue-head.php');
?>
<?php
	include('header.php');
	
	$qUser 		= ue_query("SELECT a.*, b.* FROM user a LEFT JOIN company b ON a.user_id = b.user_id WHERE a.user_id = '".$_SESSION['currentUserId']."'");
	$fetchUser	= ue_fetch_array($qUser);
	
	$namaTableDatabase	= "inbox";
	$currentRowNumber = 1;
	$page = $_GET['page'];
	if($page == '' || $page == 0 || $page == NULL) $page = 1;
	$pagePerView 		= 10;
	$mainQueryString	= "SELECT * FROM inbox WHERE user_id = '".$_SESSION['currentUserId']."'";
	
	$result 			= ue_query($mainQueryString);
	@ $jumlahData 		= ue_num_rows($result);
	$productListNumTotal= $jumlahData;
	$productPerPage 	= $pagePerView;
	$index 				= ($page-1)*$pagePerView;
	$mainQueryQue 		= ue_query($mainQueryString." LIMIT $index,$pagePerView");
	//echo $mainQueryString;
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
					<span class="bold fontsize14 colorBlue">Inbox</span>
					<div style="margin-top:10px; padding:10px; padding-left:20px;  background-color:#FFF; color:#5b5c5e;">
						<table class="fontsize12" width="100%" border="0" style="border-collapse:collapse;">
							<tr>
								<td style="padding-top:5px; padding-bottom:20px; border-bottom:1px solid #ececec;" class="fontsize14 colorBlue bold" width="30%">From</td>
								<td style="padding-top:5px; padding-bottom:20px; border-bottom:1px solid #ececec;" class="fontsize14 colorBlue bold" width="50%">Subject</td>
								<td style="padding-top:5px; padding-bottom:20px; border-bottom:1px solid #ececec;" class="fontsize14 colorBlue bold" width="20%">Date</td>
							</tr>
							<?php
							while($mainQueryRes = ue_fetch_array($mainQueryQue)){
							?>
								<tr class="hoverBlue">
									<td style="padding-top:10px; padding-bottom:10px; border-bottom:1px solid #ececec;">
										<a href="detail-inbox.php?id=<?php echo $mainQueryRes['inbox_id'] ?>">Admin</a>
									</td>
									<td style="padding-top:10px; padding-bottom:10px; border-bottom:1px solid #ececec;">
										<a href="detail-inbox.php?id=<?php echo $mainQueryRes['inbox_id'] ?>">
											<?php echo $mainQueryRes['inbox_name'] ?>
										</a>
									</td>
									<td style="padding-top:10px; padding-bottom:10px; border-bottom:1px solid #ececec;">
										<a href="detail-inbox.php?id=<?php echo $mainQueryRes['inbox_id'] ?>"><?php echo date("Y F d",$mainQueryRes['inbox_entrydate']); ?></a>
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
		</div>
	</div>
</div>
<?php
	include('footer.php');
?>
<?php
	include('ue-footer.php');
?>