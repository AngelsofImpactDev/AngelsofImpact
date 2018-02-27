<?php
	session_start();
	if($_SESSION['currentUserId']) {
		header("Location: dashboard.php");
	}
	include('ue-head.php');
?>
<?php
	include('header.php');
?>
<div class="container-fluid lightGreyContainer">
	<form class="registrationForm" action="action-forgotPassword.php" method="post">
		<div class="container">
			<div class="row">
				<div class="col-lg-12" align="center">
				<div class="spacer30"></div>
					<div class="fontsize41 colorBlue bold">
						<h1 id="indexRestTitle">FORGOT YOUR PASSWORD ?</h1>
					</div>
					<div class="fontsize14">
						We will send you a reset password link to your email, please check in the spam folder if you haven't got your mail in 1 hour.
					</div>
					<div class="spacer30"></div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="customMsg" style="position:relative;">
						<?php echo callPart('ue-messageShow')?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-3"></div>
				<div class="col-lg-6">
					Enter your e-mail
				</div>
				<div class="col-lg-3"></div>
			</div>
			<div class="row">
				<div class="col-lg-3"></div>
				<div class="col-lg-6">
					<div class="inputFormContainer">
						<?php echo ueCreateInputText('email','','')?>
					</div>
					<?php //echo callPart('ue-captcha')?>
				</div>
				<div class="col-lg-3"></div>
			</div>
			<div class="spacer20"></div>
			<div class="row">
				<div class="col-lg-3"></div>
				<div class="col-lg-6 fontsize11" align="right">
					<input type="submit" value="SUBMIT" class="blueBtn" />
				</div>
				<div class="col-lg-3"></div>
			</div>
		</div>
		<div class="spacer30"></div>
		<div class="spacer30"></div>
	</form>
</div>
<?php
	include('footer.php');
?>
<?php
	include('ue-footer.php');
?>