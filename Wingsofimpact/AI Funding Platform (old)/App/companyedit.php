<?php
	include('ue-head.php');
?>
<?php
	include('header.php');
	if($_SESSION['currentUserType'] == 'startup'){
		$qUser 		= ue_query("SELECT a.*, b.* FROM user a LEFT JOIN company b ON a.user_id = b.user_id WHERE a.user_id = '".$_SESSION['currentUserId']."'");
	}else{
		$qUser 		= ue_query("SELECT a.*, b.* FROM user a LEFT JOIN company b ON a.company_id = b.company_id WHERE a.user_id = '".$_SESSION['currentUserId']."'");
	}
	$fetchUser	= ue_fetch_array($qUser);
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
				<div class="col-lg-6">
					<div class="bold fontsize16" style="color:#5b5c5e;">
						Personal Data
						<div style="float:right;" class="colorBlue fontsize12"><a href="accountedit"><img src="images/pencil.png" /> &nbsp; Edit</a></div>
					</div>
					<div class="clear"></div>
					<div align="center" style="margin-top:10px; background-color:#fff; padding:20px;">	
						<table width="100%" border="0">
							<tr>
								<td class="fontsize14 colorBlue bold">
									Email
								</td>
							</tr>
							<tr>
								<td class="fontsize14" style="color:#959595;">
									<?php echo $fetchUser['user_email'] ?>
								</td>
							</tr>
							<tr>
								<td style="padding-top:20px;" class="fontsize14 colorBlue bold">
									ID/Passport Number
								</td>
							</tr>
							<tr>
								<td class="fontsize14" style="color:#959595;">		
									<?php echo $fetchUser['user_passport'] ?>
								</td>
							</tr>
							<tr>
								<td style="padding-top:20px;" class="fontsize14 colorBlue bold">
									Mobile
								</td>
							</tr>
							<tr>
								<td class="fontsize14" style="color:#959595;">
									<?php echo $fetchUser['user_telp'] ?>
								</td>
							</tr>
							<tr>
								<td style="padding-top:20px;" class="fontsize14 colorBlue bold">
									Country
								</td>
							</tr>
							<tr>
								<td class="fontsize14" style="color:#959595;">
									<?php echo $fetchUser['user_country'] ?>
								</td>
							</tr>
							<tr>
								<td style="padding-top:20px;" class="fontsize14 colorBlue bold">
									Address
								</td>
							</tr>
							<tr>
								<td class="fontsize14" style="color:#959595;">
									<?php echo $fetchUser['user_address'] ?>
								</td>
							</tr>
							<!--
							<tr>
								<td>										
									<div style="padding: 5px;">
										<input type="file" name="photo" id="file-3" class="inputfile inputfile-3" />
										<label for="file-3"><img src="js/customInputFile/customInputBtn.png" /> <span>Profile Picture</span></label>
									</div>
								</td>
							</tr>
							-->
						</table>
					</div>
				</div>
				<div class="spacer40 visible-xs visible-md visible-sm"></div>
				<div class="col-lg-6">
					<div id="companyCodeNo" class="companyCodeDivs">
						<div class="bold fontsize16" style="color:#5b5c5e;">
							Company Details
							<!--<div style="float:right;" class="colorBlue fontsize12"><a href="#"><img src="images/pencil.png" /> &nbsp; Edit</a></div>-->
						</div>
						<div class="clear"></div>
						<div align="center" style="margin-top:10px; background-color:#fff; padding:20px;">
							<form class="registrationForm" enctype="multipart/form-data" action="action-companyedit.php" method="post">
								<input type="hidden" name="cid" id="cid" value="<?php echo $fetchUser['company_id']; ?>" />
								<table width="100%" border="0">
									<?php
									if($fetchUser['company_id'] == ""){
									?>
										<tr>
											<td class="fontsize14 colorBlue bold">
												<label><input type="radio" name="radioCode" id="radioCode1" class="radioCode" value="1" /> &nbsp I HAVE COMPANY CODE</label>
											</td>
										</tr>
										<tr>
											<td class="fontsize14" style="padding-bottom:30px; color:#959595;">
												<div class="inputFormContainer companyCodeClass">
													<?php echo ueCreateInputText('companycode','',$fetchUser['company_code'],'Enter your company code here')?>
												</div>
											</td>
										</tr>
										<tr>
											<td style="padding-bottom:30px;" class="fontsize14 colorBlue bold">
												<label><input type="radio" name="radioCode" id="radioCode2" class="radioCode" value="2" checked /> &nbsp INPUT NEW COMPANY</label>
											</td>
										</tr>
									<?php
									}
									?>
									<tr class="companyClass">
										<td class="fontsize14 colorBlue bold">
											Company Name
										</td>
									</tr>
									<tr class="companyClass">
										<td class="fontsize14" style="color:#959595;">
											<div class="inputFormContainerAuto">
												<?php echo ueCreateInputText('companyname','',$fetchUser['company_name'],'Company Name')?>
											</div>
										</td>
									</tr>
									<tr class="companyClass">
										<td style="padding-top:20px;" class="fontsize14 colorBlue bold">
											Website
										</td>
									</tr>
									<tr class="companyClass">
										<td class="fontsize14" style="color:#959595;">
											<div class="inputFormContainerAuto">
												<?php echo ueCreateInputText('website','',$fetchUser['company_website'],'Website')?>
											</div>
										</td>
									</tr>
									<tr class="companyClass">
										<td style="padding-top:20px;" class="fontsize14 colorBlue bold">
											Industry
										</td>
									</tr>
									<tr class="companyClass">
										<td class="fontsize14" style="color:#959595;">
											<div class="inputFormContainer">
												<?php					
												$currentSelectArr = array(
													'name' => 'companyindustry',
													'list' => array('Food and Agriculture','Fashion, Arts and Handicraft','Finance and Technology','Education and Skills training','Clean energy','Others')
												);
												?>
												<select name="companyindustry" data-chosen="disabled" style="border: none;">
													<option value="">Industry</option>
													<?php
													foreach($currentSelectArr['list'] as $value){
														if($value == $fetchUser['company_industry']){
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
										</td>
									</tr>
									<tr class="companyClass">
										<td style="padding-top:20px;" class="fontsize14 colorBlue bold">
											Area of Interest
										</td>
									</tr>
									<tr class="companyClass">
										<td class="fontsize14" style="color:#959595;">
											<div class="inputFormContainerAuto companyClass">
											<?php					
												$currentSelectArr = array(
													'name' => 'companyareaofinterest',
													'list' => array('Food and Agriculture','Fashion, Arts and Handicraft','Finance and Technology','Education and Skills training','Clean energy','Others')
												);
											?>
												<select name="companyareaofinterest" data-chosen="disabled" style="border: none;">
													<option value="">Area Of Interest</option>
													<?php
													foreach($currentSelectArr['list'] as $value){
														if($value == $fetchUser['company_interest']){
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
										</td>
									</tr>
									<tr class="companyClass">
										<td style="padding-top:20px;" class="fontsize14 colorBlue bold">
											Mission that you care about
										</td>
									</tr>
									<tr class="companyClass">
										<td class="fontsize14" style="color:#959595;">
											<div class="inputFormContainerAuto companyClass">
												<?php
													$currentSelectArr = array(
														'name' => 'mission',
														'list' => array('No poverty','Gender equality','Accessible and affordable health care','Responsible production and consumption','Reducing climate change','Education','Skills mastery','Social justice','Innovation and infrastructure development','Others')
													);
													$arrCookie = explode(",",$fetchUser['company_mission']);
												?>
											  <select data-placeholder="Missions that you care about" multiple name="prdlimit[]" data-chosen="multiselect" style="border: none;">
												<?php
													foreach($currentSelectArr['list'] as $currentSelectArrKey => $currentSelectArrVal) {
														if(in_array($currentSelectArrVal,$arrCookie)){
															?>
																<option selected='selected' value="<?php echo $currentSelectArrVal; ?>"><?php echo $currentSelectArrVal; ?></option>
															<?php
														}else{
															?>
																<option value="<?php echo $currentSelectArrVal; ?>"><?php echo $currentSelectArrVal; ?></option>
															<?php
														}
													}
												?>
											  </select>
											</div>
										</td>
									</tr>
									<tr class="companyClass">
										<td style="padding-top:20px;" class="fontsize14 colorBlue bold">
											Resources that you can give to Social Enterprises
										</td>
									</tr>
									<tr class="companyClass">
										<td class="fontsize14" style="color:#959595;">
											<div class="inputFormContainerAuto companyClass">
												<?php echo ueCreateInputText('probono','',$fetchUser['company_probono'],'Pro Bono Skills (eg: finance, marketing, storytelling, business development, etc)')?>
											</div>
										</td>
									</tr>
									<tr class="companyClass">
										<td class="fontsize14" style="color:#959595;">
											<div class="inputFormContainerAuto companyClass">
												<?php echo ueCreateInputText('market','',$fetchUser['company_newmarket'],'New Market Opportunity (eg: Tokyo network for retail stores, distributor, etc)')?>
											</div>
										</td>
									</tr>
									<tr class="companyClass">
										<td class="fontsize14" style="color:#959595;">
											<div class="inputFormContainerAuto companyClass">
												<?php echo ueCreateInputText('connection','',$fetchUser['company_connection'],'Partnership Connection')?>
											</div>
										</td>
									</tr>
									<tr>
										<td style="padding-top:20px;" class="fontsize14 colorBlue bold">
											<input type="submit" value="SUBMIT" class="blueBtn" />
										</td>
									</tr>
								</table>
								<div class="spacer50"></div>
								<div class="spacer50"></div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="spacer40"></div>
			<div class="spacer40"></div>
		<?php
		}else{
		?>
			<?php
			include ('welcome-dashboard.php');
			?>
			<div class="row">
				<div class="col-lg-6">
					<div class="bold fontsize16" style="color:#5b5c5e;">
						Personal Data
						<div style="float:right;" class="colorBlue fontsize12"><a href="accountedit"><img src="images/pencil.png" /> &nbsp; Edit</a></div>
					</div>
					<div class="clear"></div>
					<div align="center" style="margin-top:10px; background-color:#fff; padding:20px;">
						<form class="registrationForm" enctype="multipart/form-data" action="action-accountedit.php" method="post">
							<table width="100%" border="0">
								<tr>
									<td class="fontsize14 colorBlue bold">
										Email
									</td>
								</tr>
								<tr>
									<td class="fontsize14" style="color:#959595;">
										<?php echo $fetchUser['user_email'] ?>
									</td>
								</tr>
								<tr>
									<td style="padding-top:20px;" class="fontsize14 colorBlue bold">
										Mobile
									</td>
								</tr>
								<tr>
									<td class="fontsize14" style="color:#959595;">
										<?php echo $fetchUser['user_telp'] ?>
									</td>
								</tr>
								<tr>
									<td style="padding-top:20px;" class="fontsize14 colorBlue bold">
										Country
									</td>
								</tr>
								<tr>
									<td class="fontsize14" style="color:#959595;">
										<?php echo $fetchUser['user_country'] ?>
									</td>
								</tr>
								<!--
								<tr>
									<td>										
										<div style="padding: 5px;">
											<input type="file" name="photo" id="file-3" class="inputfile inputfile-3" />
											<label for="file-3"><img src="js/customInputFile/customInputBtn.png" /> <span>Profile Picture</span></label>
										</div>
									</td>
								</tr>
								-->
								
							</table>
						</form>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="bold fontsize16" style="color:#5b5c5e;">
						Company Details
						<!--<div style="float:right;" class="colorBlue fontsize12"><a href="#"><img src="images/pencil.png" /> &nbsp; Edit</a></div>-->
					</div>
					<div class="clear"></div>
					<div align="center" style="margin-top:10px; background-color:#fff; padding:20px;">
						<form class="registrationForm" enctype="multipart/form-data" action="action-companyedit.php" method="post">
							<input type="hidden" name="cid" id="cid" value="<?php echo $fetchUser['company_id']; ?>" />
							<table width="100%" border="0">
								<tr>
									<td class="fontsize14 colorBlue bold">
										Company Name
									</td>
								</tr>
								<tr>
									<td class="fontsize14" style="color:#959595;">
										<div class="inputFormContainerAuto">
											<?php echo ueCreateInputText('companyname','',$fetchUser['company_name'],'Company Name')?>
										</div>
									</td>
								</tr>
								<tr>
									<td style="padding-top:20px;" class="fontsize14 colorBlue bold">
										Website
									</td>
								</tr>
								<tr>
									<td class="fontsize14" style="color:#959595;">
										<div class="inputFormContainerAuto">
											<?php echo ueCreateInputText('website','',$fetchUser['company_website'],'Website')?>
										</div>
									</td>
								</tr>
								<tr>
									<td style="padding-top:20px;" class="fontsize14 colorBlue bold">
										Industry
									</td>
								</tr>
								<tr>
									<td class="fontsize14" style="color:#959595;">
										<div class="inputFormContainer">
											<?php					
											$currentSelectArr = array(
												'name' => 'companyindustry',
												'list' => array('Food and Agriculture','Fashion, Arts and Handicraft','Finance and Technology','Education and Skills training','Clean energy','Others')
											);
											?>
											<select name="companyindustry" data-chosen="disabled" style="border: none;">
												<option value="">Industry</option>
												<?php
												foreach($currentSelectArr['list'] as $value){
													if($value == $fetchUser['company_industry']){
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
									</td>
								</tr>
								<tr>
									<td style="padding-top:20px;" class="fontsize14 colorBlue bold">
										Revenue
									</td>
								</tr>
								<tr>
									<td>
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
													if($value == $fetchUser['company_revenue']){
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
									</td>
								</tr>
								<tr>
									<td style="padding-top:20px;" class="fontsize14 colorBlue bold">
										Company Impact
									</td>
								</tr>
								<tr>
									<td>
										<div class="inputFormContainerAuto">
											<?php echo ueCreateInputText('companyimpact','',$fetchUser['company_impact'],'How many people are you currently impacting')?>
										</div>
									</td>
								</tr>
								<tr>
									<td style="padding-top:20px;" class="fontsize14 colorBlue bold">
										<input type="submit" value="SUBMIT" class="blueBtn" />
									</td>
								</tr>
							</table>
						</form>
						<div class="spacer40"></div>
					</div>
				</div>
			</div>
			<div class="spacer40"></div>
			<div class="spacer40"></div>
		<?php
		}
		?>
		</div>
	</div>
</div>
<script>
$("#radioCode1").click(function(){
	$(".companyClass").hide();
	$(".companyCodeClass").show();
});

$("#radioCode2").click(function(){
	$(".companyCodeClass").hide();
	$(".companyClass").show();
});

$(".companyCodeClass").hide();

</script>
<?php
	include('footer.php');
?>
<?php
	include('ue-footer.php');
?>