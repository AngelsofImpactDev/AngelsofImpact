<?php
	include('ue-head.php');
?>
<?php
	include('header.php');
	$defMembership = $_GET['mid'];
	if(isset($_POST['premiumBtn'])){
		$defMembership = "1";
	}
?>
<div class="container-fluid lightGreyContainer">
	<form class="registrationForm" method="post" enctype="multipart/form-data" action="action-register.php">
	<input type="hidden" name="frompage" value="<?php echo currentPage(); ?>" />
	<div class="container">
		<div class="row">
			<div class="col-lg-1">
				&nbsp;
			</div>
			<div class="col-lg-11">
				<div class="spacer60"></div>
				<div class="fontsize41 colorBlue bold">
					WELCOME <span class="black">ANGEL SOCIAL ENTREPRENEURS!</span>
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
			<div class="col-lg-3">
				<div class="inputFormContainer">
					<?php echo ueCreateInputText('name',$_POST['name'],$detailmodeeditRes["$namaTableDatabase".'_name'],'Name')?>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="inputFormContainer">
					<?php echo ueCreateInputText('email',$_POST['email'],$detailmodeeditRes["$namaTableDatabase".'_email'],'Email Address')?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-1">
				&nbsp;
			</div>
			<div class="col-lg-3">
				<div class="inputFormContainer">
					<input type="password" placeholder="Password" name="password" />
				</div>
			</div>
			<div class="col-lg-3">
				<div class="inputFormContainer">
					<input type="password" placeholder="Re-Password" name="repass" />
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-1">
				&nbsp;
			</div>
			<div class="col-lg-3">
				<div class="inputFormContainer">
				<?php
					foreach($countries as $countriesKey => $countriesVal) {
						$currentCountryFinal[$countriesVal] = $countriesVal;
					}
				
					$currentSelectArr = array(
						'name' => 'country',
						'list' => $currentCountryFinal
					);
				?>
               	<?php echo ueCreateSelectOption($currentSelectArr,'',$detailmodeeditRes["$namaTableDatabase".'_country'],'Country',false)?>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="inputFormContainer">
					<div style="padding: 5px;">
						<input type="file" name="photo" id="file-3" class="inputfile inputfile-3" />
						<label for="file-3"><img src="js/customInputFile/customInputBtn.png" /> <span>Profile Picture</span></label>
					</div>
				</div>
			</div>
		</div>	
		<div class="row">
			<div class="col-lg-1">
				&nbsp;
			</div>
			<div class="col-lg-3">
				<div class="inputFormContainer">
					<?php echo ueCreateInputText('telp','',$detailmodeeditRes["$namaTableDatabase".'_telp'],'Mobile')?>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="inputFormContainer">
					<?php					
						$currentMembershipListFinal = array();
						$currentMembershipList = $aolMembership['startup'];
						foreach($currentMembershipList as $currentMembershipListKey => $currentMembershipListVal) {
							$currentMembershipListFinal[$currentMembershipListKey] = $currentMembershipListVal['name'];
						}
					
						$currentSelectArr = array(
							'name' => 'membership',
							'list' => $currentMembershipListFinal
						);
					?>
					<?php echo ueCreateSelectOption($currentSelectArr,$defMembership,$detailmodeeditRes["$namaTableDatabase".'_membershipid'],'Membership',false)?>
				</div>
			</div>
		</div>
		<!--
		<div class="row">
			<div class="col-lg-1">
				&nbsp;
			</div>
			<div class="col-lg-3">
				<div class="inputFormContainerAuto">
					<?php echo ueCreateInputText('passport','',$detailmodeeditRes["$namaTableDatabase".'_passport'],'Passport / ID Number')?>
				</div>
			</div>
			<div class="col-lg-3">
				&nbsp;
			</div>
		</div>
		-->
	</div>
	<div class="spacer50"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-1">
				&nbsp;
			</div>
			<div class="col-lg-11">
				<div class="colorBlue bold">
					ABOUT YOUR COMPANY
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-1">
				&nbsp;
			</div>
			<div class="col-lg-3">
				<div class="inputFormContainer">
					<?php echo ueCreateInputText('companyname','',$detailmodeeditRes["$namaTableDatabase".'_companyname'],'Company Name')?>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="inputFormContainer">
					<?php echo ueCreateInputText('website','',$detailmodeeditRes["$namaTableDatabase".'_website'],'Website')?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-1">
				&nbsp;
			</div>
			<div class="col-lg-3">
				<div class="inputFormContainer">
					<input type="text" name="yearstart" id="yearstart" class="datepicker" placeholder="Incorporation Year" value="<?php echo $_COOKIE['yearstart'] ?>" />
                	<?php //echo ueCreateInputText('yearstart','',$detailmodeeditRes["$namaTableDatabase".'_yearstart'],'Incorporation Year')?>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="inputFormContainer">
                <?php					
					$currentSelectArr = array(
						'name' => 'companyindustry',
						'list' => array('Food and Agriculture','Fashion, Arts and Handicraft','Finance and Technology','Education and Skills training','Clean energy','Others')
					);
				?>
               	<?php //echo ueCreateSelectOption($currentSelectArr,'',$detailmodeeditRes["$namaTableDatabase".'_companyindustry'],'Industry',false)?>
					<select name="companyindustry" data-chosen="disabled" style="border: none;">
						<option value="">Industry</option>
						<?php
						foreach($currentSelectArr['list'] as $value){
							if($value == $_COOKIE['companyindustry']){
						?>
								<option selected='selected' value="<?php echo $value ?>"><?php echo $value ?></option>
						<?php
							}else{
						?>
								<option value="<?php echo $value ?>"><?php echo $value ?></option>
						<?php
							}
						}
						?>
					</select>
				</div>
			</div>
		</div>	
		<div class="row">
			<div class="col-lg-1">
				&nbsp;
			</div>
			<div class="col-lg-3">
				<div class="inputFormContainer">
					<?php					
						$currentSelectArr = array(
							'name' => 'revenue',
							'list' => array('No revenue','US$50,000','US$50,001 - US$100,000','US$100,001 - US$250,000','US$250,001 - US$500,000','US$500,001 - US$1,000,000','> US$1M')
						);
					?>
					<?php //echo ueCreateSelectOption($currentSelectArr,'',$detailmodeeditRes["$namaTableDatabase".'_revenue'],'Annual Revenue',false)?>
					<select name="revenue" data-chosen="disabled" style="border: none;">
						<option value="">Annual Revenue</option>
						<?php
						foreach($currentSelectArr['list'] as $value){
							if($value == $_COOKIE['revenue']){
							?>
								<option selected="selected" value="<?php echo $value ?>"><?php echo $value ?></option>
							<?php
							}else{
							?>
								<option value="<?php echo $value ?>"><?php echo $value ?></option>
							<?php	
							}
						}
						?>
					</select>
				</div>
			</div>
			<div class="col-lg-3 colorBlue fontsize11">
				<div class="inputFormContainerAuto">
				<?php echo ueCreateInputText('companyimpact','',$detailmodeeditRes["$namaTableDatabase".'_companyimpact'],'How many people are you currently impacting')?>
				</div>
			</div>
		</div>		
	</div>
	<div class="spacer50"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-1">
				&nbsp;
			</div>
			<div class="col-lg-6 fontsize11">
				<label><input type="checkbox" style="margin-right: 15px;" id="allCheck" name="agreeTerms" value="agree" /> All data submitted are correct . I also have read and agree to the <a href="#" class="colorBlue bold" target="_blank">Terms and Conditions.</a></label>
				<div class="uespacer30"></div>
				<input type="submit" value="SUBMIT" onclick="return checkAgree()" class="blueBtn" />
			</div>
		</div>
	</div>
	<div class="spacer50"></div>
	</form>
</div>
<script>
function checkAgree(){
	if($('#allCheck').is(':checked')){
		return true;
	}else{
		alert("Please tick the agreement box");
		return false;
	}
}
</script>
<?php
	include('footer.php');
?>
<?php
	include('ue-footer.php');
?>