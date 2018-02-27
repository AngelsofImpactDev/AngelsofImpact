<?php
	include('ue-head.php');
?>
<?php
	include('header.php');
	$memberHdn = $_GET['mid'];
	if(strtolower($_GET['mid']) == "free"){
		$memberHdn = "0";
	}
?>
<div class="container-fluid lightGreyContainer">
	<form class="registrationForm" method="post" enctype="multipart/form-data" action="action-register.php">
	<input type="hidden" name="membership" value="<?php echo $memberHdn; ?>" />
	<input type="hidden" name="frompage" value="<?php echo currentPage(); ?>" />
	<div class="container">
		<div class="row">
			<div class="col-lg-1">
				&nbsp;
			</div>
			<div class="col-lg-11">
				<div class="spacer60"></div>
				<div class="fontsize41 colorBlue bold">
					WELCOME <span class="black">ANGEL INVESTORS!</span>
				</div>
				<div class="fontsize21">
					Register and get access to our online platform and a unique range of opportunities.
				</div>
				<div class="spacer50"></div>
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
			<div class="col-lg-1">
				&nbsp;
			</div>
			<div class="col-lg-11">
				<div class="colorBlue bold">
					PERSONAL DATA
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-1">
				&nbsp;
			</div>
			<div class="col-lg-6">
				Your Membership Type: 
				<?php
				if($_GET['mid'] == "free"){
				?>
					<span style="font-weight:bold;">FREE MEMBER</span>
				<?php
				}else if($_GET['mid'] == "1"){
				?>
					<span style="font-weight:bold; color:#00bff3;">STARTUP ANGELS</span>
				<?php
				}else if($_GET['mid'] == "2"){
				?>
					<span style="font-weight:bold; color:#a186be;">CORPORATE ANGELS</span>
				<?php
				}
				?>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-1">
				&nbsp;
			</div>
			<div class="col-lg-3">
				<div class="inputFormContainer">
					<?php echo ueCreateInputText('name',$_SESSION['currentTmpName'],$detailmodeeditRes["$namaTableDatabase".'_name'],'Name')?>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="inputFormContainer">
					<?php echo ueCreateInputText('email',$_SESSION['currentTmpEmail'],$detailmodeeditRes["$namaTableDatabase".'_email'],'Email Address')?>
				</div>
			</div>
		</div>
	</div>
	<div class="spacer20"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-1">
				&nbsp;
			</div>
			<div class="col-lg-6 fontsize11">
				<label>
					<input type="checkbox" id="allCheck" style="margin-right: 15px;" /> All data submitted are correct . I also have read and agree to the <a href="termsandcondition.php" class="colorBlue bold" target="_blank">Terms and Conditions.</a>
				</label>
				<div class="uespacer30"></div>
				<input type="submit" value="SUBMIT" class="blueBtn" onclick="return checkAgree()" />
			</div>
		</div>
	</div>
	<div class="spacer50"></div>
	</form>
</div>
<script type="text/javascript">
	function checkAgree(){
		if($('#allCheck').is(':checked')){
			return true;
		}else{
			alert("Please tick the agreement box");
			return false;
		}
	}
	
	function checkCompanyCodeDivs() {
		$('.companyCodeDivs').css('display','none');
		if($('#companyCodeTrigger').prop('checked')) {
			$('#companyCodeYes').css('display','block');
		}
		else {
			$('#companyCodeNo').css('display','block');
		}
	}
	
	$('#companyCodeTrigger').change(function() {
		checkCompanyCodeDivs();
	});
	
	checkCompanyCodeDivs();
</script>
<?php
	include('footer.php');
?>
<?php
	include('ue-footer.php');
?>