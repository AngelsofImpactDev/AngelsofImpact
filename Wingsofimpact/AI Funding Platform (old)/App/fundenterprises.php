<?php
	include('ue-head.php');
?>
<?php
	include('header.php');
	$qUser 		= ue_query("SELECT * FROM user WHERE user_id = '".$_SESSION['currentUserId']."'");
	$fetchUser	= ue_fetch_array($qUser);
	
	$namaTableDatabase	= "startup";
	$currentRowNumber = 1;
	$page = $_GET['page'];
	if($page == '' || $page == 0 || $page == NULL) $page = 1;
	$pagePerView 		= 8;
	$mainQueryString 	= "SELECT * FROM ".$namaTableDatabase." WHERE ".$namaTableDatabase."_enabled = 'e' AND ".$namaTableDatabase."_deadline > '".time()."'";
	$result 			= ue_query($mainQueryString);
	@ $jumlahData 		= ue_num_rows($result);
	$productListNumTotal = $jumlahData;
	$productPerPage 	= $pagePerView;
	$index = ($page-1)*$pagePerView;
	$mainQueryString = $mainQueryString." ORDER BY ".$namaTableDatabase."_entrydate DESC";
	//echo $mainQueryString;
	$mainQueryQue = ue_query($mainQueryString." LIMIT $index,$pagePerView");
	$inComplete = false;
	if($fetchUser['user_passport'] == "" or $fetchUser['user_telp'] == "" or $fetchUser['user_country'] == ""  or $fetchUser['user_address'] == ""){
		$inComplete = true;
	}
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
		<div class="col-lg-8 col-xs-12 col-sm-12 col-md-12">
			<?php
			include ('welcome-dashboard.php');
			
			if($fetchUser['user_expiry']==0 or $fetchUser['user_expiry']<time()){
			?>
				<div class="bold">
					Only pro member allowed to fund a social enterprises <br />
					<span style="font-size:16px; font-weight:normal; text-transform:uppercase;" class="colorBlue">
						<?php
						if($fetchUser['user_membershipid']!=0){
							if($fetchUser['user_expiry']==0){
						?>
								<a href="javascript:void(0)">Your application is being reviewed</a>
						<?php
							}else{
						?>
								<a href="upgradepage.php">Your premium membership period has expired, please contact member@angelsofimpact.com</a>
						<?php
							}
						}else{
						?>
							<a href="upgradepage.php">Upgrade to pro ?</a>
						<?php
						}
						?>
					</span>
				</div>
			<?php
			}else if($inComplete == true){
			?>
				<div class="bold">
					You need to complete your registration before start funding <br />
					<span style="font-size:16px; font-weight:normal; text-transform:uppercase;" class="colorBlue">
						<a href="accountedit">Complete your registration</a>
					</span>
				</div>
			<?php	
			}else{
			?>
				<div class="bold">
					Fund Social Enterprises <br />
					<span style="font-size:16px; font-weight:normal;">Take action with funding and create an impact in the world</span>
				</div>
				<div class="row">
				<?php
				while($mainQueryRes = ue_fetch_array($mainQueryQue)) {
				?>
					<div align="center" class="col-lg-3 col-md-4 col-sm-4 col-xs-6">
						<div align="center" style="max-width:160px; margin-top:40px; background-color:#fff; border:1px solid #1475c5; padding-top:10px; padding-bottom:10px; padding-right:7px; padding-left:7px;">
							<table width="100%" border="0">
								<tr>
									<td align="center">
										<a href="seprofile.php?id=<?php echo $mainQueryRes[$namaTableDatabase.'_id'] ?>">
											<div style="width:60px; height:60px;">
												<img src="upload/startupLogo/<?php echo $mainQueryRes[$namaTableDatabase.'_logo'] ?>" width="" height="60" />
											</div>
										</a>
									</td>
								</tr>
								<tr>
									<td align="center" style="padding-top:20px; vertical-align:top;">
										<div style="font-size:10px; min-height:25px; max-height:25px;" class="">
											<?php echo $mainQueryRes[$namaTableDatabase.'_desc'] ?>
										</div>
										<div class="spacer10"></div>
										<div style="font-size:12px;" class="bold">
											Funding Goal <br />
											<span class="colorBlue" style="font-size:18px;">$ <?php echo $mainQueryRes[$namaTableDatabase.'_amount'] ?></span>
										</div>
										<div class="spacer10"></div>
										<a href="seprofile.php?id=<?php echo $mainQueryRes[$namaTableDatabase.'_id'] ?>" style="margin-top:5px; display:block; font-size:14px;" class="slimblueBtn bold">FUND NOW</a>
									</td>
								</tr>
							</table>
						</div>
					</div>
				<?php
				}
				?>
				</div>
				<div class="spacer40"></div>
				<div class="row">
					<div class="col-lg-12">
						<div align="center">
							<?php
							include('ue-config/ue-parts/ue-pageSelector.php');
							?>
						</div>	
					</div>
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