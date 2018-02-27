<?php
	include('ue-head.php');
?>
<?php
	include('header.php');
	$qUser 		= ue_query("SELECT * FROM user WHERE user_id = '".$_SESSION['currentUserId']."'");
	$fetchUser	= ue_fetch_array($qUser);
	$namaTableDatabase	= "transaction";
	$mainQueryString 	= "SELECT a.*, b.*, SUM(a.transaction_amount) as totalPaid FROM ".$namaTableDatabase." a LEFT JOIN startup b ON a.startup_id = b.startup_id WHERE a.user_id = '".$_SESSION['currentUserId']."' GROUP BY a.startup_id";
	//echo $mainQueryString;
	$result 		= ue_query($mainQueryString);
	$totalSe		= ue_num_rows($result);
	$mainQueryRes 	= ue_fetch_array($result);
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
				<?php
				if($fetchUser['user_expiry']!="0" and $fetchUser['user_expiry']>time()){
				?>
					<div class="col-lg-12">
						<div class="bold" style="color:#5b5c5e;">
							You are already a PREMIUM MEMBER
						</div>
					</div>
				<?php
				}else{
				?>
					<div class="col-lg-6">
						<div class="colorWhite black centerText fontsize21" style="background-color: #00bff3; padding: 13px;">
							STARTUP ANGELS
						</div>
						<div style="background-color: #fff; border: 1px solid #00bff3; padding: 25px;">
							<div class="centerText black colorLightBlue" style="font-size: 58px;"><?php echo $aolMembership['investors'][1]['name'] ?></div>
							<div class="centerText colorLightBlue">One Time Payment<br />Pay once a year</div>
							<div class="uespacer20"></div>
							<div class="bold colorLightBlue">
								Benefits
							</div>
							<div class="fontsize12">
								<ul class="nopaddingList">
									<li>Save time searching for credible social enterprises to fund.</li>
									<li>Save money while having a bigger social impact. Unlike with normal charity, your money comes back to you.</li>
									<li>Save 10% on the cost of events and conferences in the region.</li>
									<li>Exclusive access to other members. Connect with potential customers, suppliers and employers.</li>
									<li>Save money on tailor-made eco-tourism trips.</li>
									<li>Clear measures of the impact of your money</li>
									<li>Save time looking for responsibly-produced products.</li>
								</ul>
							</div>
							<div class="uespacer30"></div>
							<div>
								<a class="lightBlueBtn" href="action-upgradepage.php?mid=1">UPGRADE NOW</a>
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="colorWhite black centerText fontsize21" style="background-color: #a186be; padding: 13px;">
							CORPORATE ANGELS
						</div>
						<div style="background-color: #fff; border: 1px solid #a186be; padding: 25px;">
							<div class="centerText black colorViolet" style="font-size: 58px;"><?php echo $aolMembership['investors'][2]['name'] ?></div>
							<div class="centerText colorViolet">One Time Payment<br />Pay once a year</div>
							<div class="uespacer20"></div>
							<div class="bold colorViolet">
								Benefits
							</div>
							<div class="fontsize12">
								<ul class="nopaddingList">
									<li>Receive up to 3 unique logins for individuals in your organisation.</li>
									<li>Obtain Corporate branding on the Angels of Impact platform.</li>
									<li>Gain access to curated social enterprises that you can fund and support as a Corporate Angel</li>
									<li>Leverage strategic collaboration with fellow Angels &amp; Corporate members.</li>
									<li>Meet and network exclusively with fellow Angels and Corporates who support &amp; fund the social enterprises.</li>
									<li>Support a business with clear measures of benefit of your funding. Keep on funding as an SE repays you</li>
									<li>Purchase responsibly-produced products.</li>
									<li>Receive up to 10% discount on selected items from our responsibly made social enterprise goods. </li>
									<li>Access to events and conferences at a discount on driving impact.</li>
									<li>Book tailor-made travel trips to places where our social enterprises operate and serve. </li>
									<li>Learn from our Angels on the best practices of social impact space</li>
								</ul>
							</div>
							<div class="uespacer30"></div>
							<div>
								<a class="violetBtn" href="action-upgradepage.php?mid=2">UPGRADE NOW</a>
							</div>
						</div>
					</div>
				<?php
				}
				?>
			</div>
			<div class="spacer50"></div>
		<?php
		}else{	
		?>
			<?php
			include ('welcome-dashboard.php');
			?>
			<div class="row">
				<?php
				if($fetchUser['user_expiry']!="0"){
				?>
					<div class="col-lg-12">
						<div class="bold" style="color:#5b5c5e;">
							You are already a PREMIUM MEMBER
						</div>
					</div>
				<?php
				}else{
				?>
					<div class="col-lg-6">
						<div class="colorWhite black centerText fontsize21" style="background-color: #00bff3; padding: 13px;">
					SOCIAL ENTERPRISES
						</div>
						<div style="background-color: #fff; border: 1px solid #00bff3; padding: 25px;">
							<div class="centerText black colorLightBlue" style="font-size: 58px;"><?php echo $aolMembership['startup'][1]['name'] ?></div>
							<div class="centerText colorLightBlue">Yearly Membership<br />By Invitation Only</div>
							<div class="uespacer20"></div>
							<div class="bold colorLightBlue">
								Benefits
							</div>
							<div class="fontsize12">
								<ul class="nopaddingList">
									<li>Access to a trusted network of Angels, Corporates and receive 0 to low interest loans and funding</li>
									<li>Innovative way of repaying interest through in-kind goods and services</li>
									<li>Pipeline of customers, both individual and Corporate buyers, of your social enterprise's goods and services</li>
									<li>Access our monthly community gatherings of Angels</li>
								</ul>
							</div>
							<div class="uespacer30"></div>
							<div>
								<a class="lightBlueBtn" href="action-upgradepage.php?mid=1">UPGRADE NOW</a>
							</div>
						</div>
					</div>
				<?php
				}
				?>
			</div>
			<div class="spacer50"></div>
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