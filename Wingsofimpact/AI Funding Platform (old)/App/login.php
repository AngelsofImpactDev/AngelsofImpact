<?php
	include('ue-head.php');
?>
<?php
	include('header.php');
?>
<?php
$redirTo = "";
if($_GET['f']=='automail'){
	$redirTo = "accountedit";
}
?>
<div class="container-fluid lightGreyContainer">
	<form class="registrationForm" method="post" enctype="multipart/form-data" action="action-login.php">
	<input type="hidden" name="frompage" value="<?php echo currentPage(); ?>" />
	<input type="hidden" name="redirectTo" value="<?php echo $redirTo ?>" />
	<div class="container">
		<div class="row">
			<div class="col-lg-12" align="center">
				<div class="spacer30"></div>
				<div class="fontsize41 colorBlue bold">
					LOGIN TO YOUR ACCOUNT
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
				Email
			</div>
			<div class="col-lg-3"></div>
		</div>
		<div class="row">
			<div class="col-lg-3"></div>
			<div class="col-lg-6">
				<div class="inputFormContainer">
					<?php echo ueCreateInputText('username','','','')?>
				</div>
			</div>
			<div class="col-lg-3"></div>
		</div>
		<div class="spacer20"></div>
		<div class="row">
			<div class="col-lg-3"></div>
			<div class="col-lg-6">	
				Password
			</div>
			<div class="col-lg-3"></div>
		</div>
		<div class="row">
			<div class="col-lg-3"></div>
			<div class="col-lg-6">
				<div class="inputFormContainer">
					<input style="width:100%;" type="password" placeholder="" name="pass" id="pass" />
				</div>
			</div>
			<div class="col-lg-3"></div>
		</div>
		<div class="spacer20"></div>
		<div class="row">
			<div class="col-lg-3"></div>
			<div class="col-lg-6 fontsize11" align="right">
				<a href="forgotPassword.php">Forgot your password ?</a>
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
	<div class="spacer50"></div>
	</form>
</div>
<?php
	include('footer.php');
?>
<?php
	include('ue-footer.php');
?>