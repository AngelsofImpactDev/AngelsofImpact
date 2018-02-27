<?php
	include('ue-head.php');
?>
<?php
	include('header.php');
	$qUser 		= ue_query("SELECT * FROM user WHERE user_id = '".$_SESSION['currentUserId']."'");
	$fetchUser	= ue_fetch_array($qUser);
	
	$namaTableDatabase	= "user";
	$currentRowNumber = 1;
	$page = $_GET['page'];
	if($page == '' || $page == 0 || $page == NULL) $page = 1;
	$pagePerView = 8;
	$mainQueryString 	= "SELECT a.*, b.company_name FROM ".$namaTableDatabase." a LEFT JOIN company b ON a.company_id = b.company_id WHERE a.".$namaTableDatabase."_enabled = 'e' AND a.".$namaTableDatabase."_membershiptype = 'investors' AND a.".$namaTableDatabase."_publicprofile = 'e'";
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
		<div class="col-lg-8">
			<?php
			include ('welcome-dashboard.php');
			?>
			<div class="bold">
				Angel Funders in Angels of Impact Network. 
			</div>
			<div class="row">
			<?php
			while($mainQueryRes = ue_fetch_array($mainQueryQue)) {
				$userImage = "images/dummyAvatar.png";
				if($mainQueryRes['user_image']!=""){
					$userImage = "upload/userImage/".$mainQueryRes['user_image'];
				}
			?>
				<div class="col-lg-6">
					<div align="center" style="margin-top:40px; background-color:#fff; border:1px solid #1475c5; padding-top:20px; padding-bottom:20px; padding-right:10px; padding-left:10px; min-height:125px;">
						<table width="80%" border="0">
							<tr>
								<td width="40%">
									<div style="width:80px; height:80px; border:2px solid #fff; border-radius:50px; overflow:hidden;">
										<img src="<?php echo $userImage ?>" width="80" />
									</div>
								</td>
								<td style="vertical-align:top;">
									<div style="font-size:14px;" class="colorBlue bold"><?php echo $mainQueryRes['user_name'] ?></div>
									<div style="font-size:12px;" class=""><?php echo $mainQueryRes['user_country'] ?></div>
									<div style="font-size:12px;" class="colorBlue bold"><?php echo $mainQueryRes['company_name'] ?></div>
									<a href="angelprofile.php?id=<?php echo $mainQueryRes['user_id'] ?>" style="margin-top:10px; display:block; font-size:12px;" class="">See More</a>
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
		</div>
	</div>
</div>
<?php
	include('footer.php');
?>
<?php
	include('ue-footer.php');
?>