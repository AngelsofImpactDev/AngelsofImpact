<?php
	include('ue-head.php');
?>
<?php
	include('header.php');
	$qUser 		= ue_query("SELECT * FROM user WHERE user_id = '".$_SESSION['currentUserId']."'");
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
			include ('welcome-dashboard.php');
			?>
			<?php
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
			}else{
			?>
				<form class="registrationForm" enctype="multipart/form-data" action="action-seekfunding.php" method="post">
					<input type="hidden" name="frompage" id="frompage" value=<?php echo currentPage(); ?> />
					<div class="row">
						<div class="col-lg-12">
							<div class="spacer20"></div>
							<div class="fontsize18 bold">Get funding support</div>
							<div class="fontsize16">Pledge your funding for your Social Enterprises and make an impact for the world.</div>
						</div>
					</div>
					<div class="spacer60"></div>
					<div class="row">
						<div class="col-lg-12">
							<div class="colorBlue fontsize16 bold">FUNDING INFORMATION</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-10">
							<div class="inputFormContainer bluePlaceholder">
								<?php echo ueCreateInputText('name','','','Startup Name')?>
							</div>
						</div>
						<div class="col-lg-2"></div>
					</div>
					<div class="row">
						<div class="col-lg-10">
							<div class="inputFormContainer bluePlaceholder">
								<?php echo ueCreateInputText('desc','','','Brief Desc')?>
							</div>
						</div>
						<div class="col-lg-2"></div>
					</div>
					<div class="row">
						<div class="col-lg-10">
							<div class="inputFormContainerAuto bluePlaceholder">
								<textarea rows="4" name="longdesc" placeholder="Long Description"><?php echo $_COOKIE['longdesc'] ?></textarea>
							</div>
						</div>
						<div class="col-lg-2"></div>
					</div>
					<div class="row">
						<div class="col-lg-5">
							<div class="inputFormContainer bluePlaceholder">
								<input type="text" name="fundingdeadline" id="fundingdeadline" class="futuredatepickerstart" placeholder="Funding Deadline" value="<?php echo $_COOKIE['fundingdeadline'] ?>" />
							</div>
						</div>
						<div class="col-lg-5">
							<div class="inputFormContainer bluePlaceholder">
								<?php echo ueCreateInputText('amount','','','Amount needed in $')?>
							</div>
						</div>
						<div class="col-lg-2"></div>
					</div>
					<div class="row">
						<div class="col-lg-10">
							<div class="inputFormContainerAuto bluePlaceholder">
								<textarea rows="4" name="purpose" placeholder="purpose of funding"><?php echo $_COOKIE['purpose'] ?></textarea>
							</div>
						</div>
						<div class="col-lg-2"></div>
					</div>
					<div class="row">
						<div class="col-lg-10">
							<div class="inputFormContainerAuto bluePlaceholder">
								<textarea rows="4" name="impact" placeholder="Social Impact from the funding"><?php echo $_COOKIE['impact'] ?></textarea>
							</div>
						</div>
						<div class="col-lg-2"></div>
					</div>
					<div class="row">
						<div class="col-lg-5">
							<div class="inputFormContainer bluePlaceholder">
							<?php
								$repayment = array("1","2","3","6","12","18","24","30","36","48");
								foreach($repayment as $listVal) {
									if($listVal == "1"){
										$currentListFinal[$listVal] = "One time payment";
									}else{
										$currentListFinal[$listVal] = $listVal." Months";
									}
									
								}
							?>
							<?php					
								$currentSelectArr = array(
									'name' => 'repaymentperiod',
									'list' => $currentListFinal
								);
							?>
							<?php echo ueCreateSelectOption($currentSelectArr,'','','Repayment Period',false)?>
							</div>
						</div>
						<div class="col-lg-5">
							<div class="inputFormContainer bluePlaceholder">
								<input type="text" name="startdate" id="startdate" class="futuredatepickerstart" placeholder="Repayment Start Date" value="<?php echo $_COOKIE['startdate'] ?>" />
							</div>
						</div>
						<div class="col-lg-2"></div>
					</div>
					<div class="spacer50"></div>
					<div style="height:1px; background-color:#dddcdc;"></div>
					<div class="spacer50"></div>
					<div class="row">
						<div class="col-lg-12">
							<div class="colorBlue fontsize16 bold">UPLOAD YOUR SUPPORTED MEDIA FOR YOUR FUNDING</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-5">
							<table width="100%" border="0">
								<tr>
									<td>
										<div class="inputFormContainer bluePlaceholder">
											<div style="padding: 5px;">
												<input type="file" name="campaign1" id="file-1" class="inputfile inputfile-3" />
												<label for="file-1"><img src="js/customInputFile/customInputBtn.png" /> <span>Campaign Images</span></label>
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="inputFormContainer bluePlaceholder">
											<div style="padding: 5px;">
												<input type="file" name="campaign2" id="file-2" class="inputfile inputfile-3" />
												<label for="file-2"><img src="js/customInputFile/customInputBtn.png" /> <span>Campaign Images</span></label>
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="inputFormContainer bluePlaceholder">
											<div style="padding: 5px;">
												<input type="file" name="campaign3" id="file-3" class="inputfile inputfile-3" />
												<label for="file-3"><img src="js/customInputFile/customInputBtn.png" /> <span>Campaign Images</span></label>
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="inputFormContainer bluePlaceholder">
											<div style="padding: 5px;">
												<input type="file" name="logo" id="file-5" class="inputfile inputfile-3" />
												<label for="file-5"><img src="js/customInputFile/customInputBtn.png"/> <span>Startup logo</span></label>
											</div>
										</div>
									</td>
								</tr>
							</table>
						</div>
						<div class="col-lg-5">
							<table width="100%" border="0">
								<tr>
									<td>
										<div class="inputFormContainer bluePlaceholder">
											<div style="padding: 5px;">
												<input type="file" name="cover" id="file-6" class="inputfile inputfile-3" />
												<label for="file-6"><img src="js/customInputFile/customInputBtn.png"/> <span>Startup cover image</span></label>
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="inputFormContainer bluePlaceholder">
											<?php echo ueCreateInputText('youtube','','','Embed your youtube video (Optional)')?>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="inputFormContainer bluePlaceholder">
											<div style="padding: 5px;">
												<input type="file" name="pdfgift" id="file-4" class="inputfile inputfile-3" />
												<label for="file-4"><img src="js/customInputFile/customInputBtn.png" /> <span>PDF Gift Catalogue</span></label>
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="inputFormContainer bluePlaceholder">
											<div style="padding: 5px;">
												<input type="file" name="financial" id="file-7" class="inputfile inputfile-3" />
												<label for="file-7"><img src="js/customInputFile/customInputBtn.png" /> <span>Financial Report</span></label>
											</div>
										</div>
									</td>
								</tr>
							</table>
						</div>
						<div class="col-lg-2"></div>
					</div>
					<div class="spacer50"></div>
					<div class="row">
						<div class="col-lg-12 fontsize11">
							<label>
								<input type="checkbox" id="allCheck" name="allCheck" style="margin-right: 15px;" /> All data submitted are correct . I also have read and agree to the <a href="#" class="colorBlue bold" target="_blank">Terms and Conditions.</a>
							</label>
							<div class="uespacer30"></div>
							<input type="submit" value="SUBMIT" class="blueBtn" onclick="return checkAgree()" />
						</div>
					</div>
					<!--
					<div class="row">
						<div class="col-lg-5">
							<div class="inputFormContainer bluePlaceholder">
								<div style="padding: 5px;">
									<input type="file" name="campaign2" id="file-2" class="inputfile inputfile-3" />
									<label for="file-2"><img src="js/customInputFile/customInputBtn.png" /> <span>Campaign Images</span></label>
								</div>
							</div>
						</div>
						<div class="col-lg-5">
							<div class="inputFormContainer bluePlaceholder">
								<div style="padding: 5px;">
									<input type="file" name="pdfgift" id="file-4" class="inputfile inputfile-3" />
									<label for="file-4"><img src="js/customInputFile/customInputBtn.png" /> <span>PDF Gift Catalogue</span></label>
								</div>
							</div>
						</div>
						<div class="col-lg-2"></div>
					</div>
					<div class="row">
						<div class="col-lg-5">
							<div class="inputFormContainer bluePlaceholder">
								<div style="padding: 5px;">
									<input type="file" name="campaign3" id="file-3" class="inputfile inputfile-3" />
									<label for="file-3"><img src="js/customInputFile/customInputBtn.png" /> <span>Campaign Images</span></label>
								</div>
							</div>
						</div>
						<div class="col-lg-5"></div>
						<div class="col-lg-2"></div>
					</div>
					<div class="spacer50"></div>
					<div class="row">
						<div class="col-lg-12 fontsize11">
							<label>
								<input type="checkbox" id="allCheck" style="margin-right: 15px;" /> All data submitted are correct . I also have read and agree to the <a href="#" class="colorBlue bold" target="_blank">Terms and Conditions.</a>
							</label>
							<div class="uespacer30"></div>
							<input type="submit" value="SUBMIT" class="blueBtn" onclick="return checkAgree()" />
						</div>
					</div>
					-->
					<div class="spacer50"></div>
				</form>
			<?php
			}
			?>
		</div>
	</div>
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