<?php
	include('ue-head.php');
	
	$fPayment 	= ue_fetch_array(ue_query("SELECT * FROM user WHERE user_id = '".$_SESSION['currentUserId']."'"));
	$amount		= $aolMembership[$fPayment['user_membershiptype']][$fPayment['user_membershipid']]['price'];
	$memberStat = checkMembership($fPayment['user_id']);
	$memberType = "ANGEL";
	if($fPayment['user_membershiptype'] == 'investors'){
		$memberType = "SOCIAL ENTERPRISES";
	}
	
	if(!$_SESSION['currentUserId'] or $fPayment['user_membershiptype'] == "0"){
		header("location:index.php?sta=Page not exists");
	}
?>
<?php
	include('header.php');
	require 'ue-paygate/stripe/Stripe.php';
	require 'ue-paygate/stripe/stripe-config.php';
?>
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div class="spacer40"></div>
			<h1 class="centerText colorBlue fontsize41 bold">PAYMENT INFO</h1>
			<div class="spacer40"></div>
		</div>
	</div>
	<?php
	if($_GET['sta'] == "upgrade"){
	?>
		<div class="row">
			<div class="col-lg-12 centerText">
				<p>You chose to upgrade your membership to:</p>
				<p style="font-weight:bold; text-transform:uppercase; font-size:28px;"><?php echo getMembership($fPayment['user_membershiptype'],$fPayment['user_membershipid']); ?></p>
				Please complete your payment to activate your premium membership
				<div class="spacer40"></div>
			</div>
		</div>
	<?php
	}else{
	?>
		<div class="row">
			<div class="col-lg-12 centerText">
				<p>You've registered as a / an:</p>
				<p style="font-weight:bold; text-transform:uppercase; font-size:28px;"><?php echo $memberStat ?></p>
				Please complete your payment to activate your premium membership
				<div class="spacer40"></div>
			</div>
		</div>
	<?php
	}
	?>
	<?php
	if($fPayment['user_expiry'] < time()){
	?>
		<div class="row">
			<div class="col-lg-2"></div>
			<div class="col-lg-8">
				<div align="center" class="bold fontsize16" style="text-transform:uppercase; color:#5b5c5e;">
					 <form action="action-payment.php" method="POST">
					  <script
						src="https://checkout.stripe.com/checkout.js" class="stripe-button"
						data-key="<?php echo $params['public_test_key']; ?>"
						data-amount="<?php echo $amount*100 ?>"
						data-name="angelsofimpact.com"
						data-description="<?php echo strtoupper($aolMembership[$fPayment['user_membershiptype']][$fPayment['user_membershipid']]['member'])." ".$memberType; ?>"
						data-image="http://103.53.197.234/~geraikom/aoi/images/angelsOfImpactLogo.png"
						data-locale="auto"
						data-zip-code="true">
					  </script>
					</form>
				</div>
			</div>
			<div class="col-lg-2"></div>
		</div>
	<?php
	}
	?>
	<div class="spacer40"></div>
</div>
<?php
	include('footer.php');
?>
<?php
	include('ue-footer.php');
?>