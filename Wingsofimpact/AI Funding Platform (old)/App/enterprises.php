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
	$pagePerView = 8;
	$mainQueryString 	= "SELECT * FROM ".$namaTableDatabase." WHERE ".$namaTableDatabase."_enabled = 'e'";
	$result = ue_query($mainQueryString);
	@ $jumlahData = ue_num_rows($result);
	$productListNumTotal = $jumlahData;
	$productPerPage = $pagePerView;
	$index = ($page-1)*$pagePerView;
	$mainQueryString = $mainQueryString." ORDER BY ".$namaTableDatabase."_entrydate DESC";
	//echo $mainQueryString;
	$mainQueryQue = ue_query($mainQueryString." LIMIT $index,$pagePerView");
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
		if($fetchUser['user_membershiptype'] == "investors"){
		?>
			<?php
			include ('welcome-dashboard.php');
			?>
			<div class="bold" style="color:#5b5c5e;">
				Discover Our Community of Angel Social Enterprises. <br />
				<span style="font-size:16px; font-weight:normal; color:#959595;">Find out which Angels have already supported them and their progress in paying back their loans.</span>
			</div>
			<div class="row">
			<?php
			$i=0;
			while($mainQueryRes = ue_fetch_array($mainQueryQue)) {
				$i++;
			?>
				<div align="center" class="col-lg-3 col-sm-4 col-md-4 col-xs-6">
					<div align="center" style="min-height:160px; max-height:160px; max-width:160px; margin-top:40px; background-color:#fff; border:1px solid #1475c5; padding-top:10px; padding-bottom:10px; padding-right:2px; padding-left:2px;">
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
								<td align="center" style="padding-top:10px;  vertical-align:top;">
									<div style="font-size:10px;  min-height:25px; max-height:25px;" class="">
										<?php echo $mainQueryRes[$namaTableDatabase.'_desc'] ?>
									</div>
								</td>
							</tr>
							<tr>
								<td align="center" style="padding-top:10px; vertical-align:top;">
									<a href="seprofile.php?id=<?php echo $mainQueryRes[$namaTableDatabase.'_id'] ?>" style="margin-top:5px; display:block; font-size:14px;" class="colorBlue bold">more</a>
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
			<div class="spacer40"></div>
		<?php
		}else{
		?>
			<?php
			include ('welcome-dashboard.php');
			?>
			<div class="bold colorDarkGrey fontsize18">
				Angel Social Enterprises in Angels of Impact Community<br />
			</div>
			<div class="row">
			<?php
			while($mainQueryRes = ue_fetch_array($mainQueryQue)) {
			?>
				<div align="center" class="col-lg-3 col-sm-4 col-md-4 col-xs-6">
					<div align="center" style="min-height:160px; max-height:160px; max-width:160px; margin-top:40px; background-color:#fff; border:1px solid #1475c5; padding-top:10px; padding-bottom:10px; padding-right:2px; padding-left:2px;">
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
								<td align="center" style="vertical-align:top;">
									<div style="font-size:10px; min-height:25px;" class="">
										<?php echo $mainQueryRes[$namaTableDatabase.'_desc'] ?>
									</div>
								</td>
							</tr>
							<tr>
								<td align="center" style="padding-top:10px; vertical-align:top;">
									<a href="seprofile.php?id=<?php echo $mainQueryRes[$namaTableDatabase.'_id'] ?>" style="margin-top:5px; display:block; font-size:14px;" class="colorBlue bold">more</a>
								</td>
							</tr>
						</table>
					</div>
				</div>
			<?php
			}
			?>
			
			<?php
			/*
			for($i=0;$i<8;$i++){
			?>
				<div class="col-lg-3 col-xs-6">
					<div align="center" style="max-width:160px; margin-top:40px; background-color:#fff; border:1px solid #1475c5; padding-top:10px; padding-bottom:10px; padding-right:7px; padding-left:7px;">
						<table width="100%" border="0">
							<tr>
								<td align="center">
									<a href="seprofile.php"><div style="width:60px; height:60px;"><img src="images/javara.jpg" width="60" /></div></a>
								</td>
							</tr>
							<tr>
								<td align="center" style="padding-top:20px; vertical-align:top;">
									<div style="font-size:10px;" class="">
										Reviving the prosperity back into the hands of local Indonesian kakao farmers...
									</div>
									<a href="seprofile.php" style="margin-top:5px; display:block; font-size:14px;" class="colorBlue bold">more</a>
								</td>
							</tr>
						</table>
					</div>
				</div>
			<?php
			}
			*/
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