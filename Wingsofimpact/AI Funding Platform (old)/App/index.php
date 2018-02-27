<?php
	include('ue-head.php');
?>
<?php
	include('header.php');
?>
<div class="container-fluid" style="background-image: url(images/idxTmp.jpg); background-size:cover;" id="mainBannerIdx">
	<div class="container">
		<div class="col-lg-12">
			<div class="spacer50"></div>
			<h1 class="fontvh fontsize48 bold colorBlue">BE PART OF<br />OUR MOVEMENT!</h1>
			<div id="indexContentContainer">
Are you a social enterprise seeking funding or bigger sales? Or an individual who would like to make more effective use of your money? Perhaps you are a philanthropist who yearns to aid the growth of life-changing social enterprises? Or a corporate member/ corporation who wants to practise shared values?
			</div>
			<div class="uespacer30"></div>
			<form action="action-register.php" method="post" id="formIndex" class="visible-lg">
				<input type="hidden" name="frompage" value="<?php echo currentPage(); ?>" />
				<div id="idxRegisterForm">
					<div>
						<select data-chosen="disabled" name="usertype" id="usertype" onchange="actionRedir(this.value)">
							<option <?php if($_COOKIE['usertype']==""){echo "selected='selected'";} ?> value="">I am a.....</option>
							<option <?php if($_COOKIE['usertype']=="1"){echo "selected='selected'";} ?> value="1">Social Entrepreneur</option>
							<option <?php if($_COOKIE['usertype']=="2"){echo "selected='selected'";} ?> value="2">Investor</option>
						</select>
					</div>
					<div class="leftBorder">
						<?php echo ueCreateInputText('name','','','Full Name')?>
					</div>
					<div class="leftBorder">
						<?php echo ueCreateInputText('email','','','Email')?>
					</div>
				</div>
				<div class="uespacer30"></div>
				<input type="submit" value="START FREE TRIAL NOW" id="freeTrialBtnIdx" name="freeBtn" class="ue-fade black fontsize20" > 
				<input type="submit" value="JOIN PREMIUM NOW" id="premiumBtnIdx" name="premiumBtn" class="ue-fade black fontsize20" style="margin-left:30px;" />
				<div class="spacer80"></div>
			</form>
			<form action="action-register.php" method="post" class="visible-sm visible-md visible-xs">
				<input type="hidden" name="frompage" value="<?php echo currentPage(); ?>" />
				<div id="idxRegisterFormMobile">
					<div>
						<select data-chosen="disabled" name="usertype" id="usertype" onchange="actionRedir(this.value)">
							<option <?php if($_COOKIE['usertype']==""){echo "selected='selected'";} ?> value="">I am a.....</option>
							<option <?php if($_COOKIE['usertype']=="1"){echo "selected='selected'";} ?> value="1">Funding Seeker</option>
							<option <?php if($_COOKIE['usertype']=="2"){echo "selected='selected'";} ?> value="2">Investor</option>
						</select>
					</div>
					<div>
						<input type="text" name="name" placeholder="Full Name" value="<?php echo $_COOKIE['name'] ?>" />
					</div>
					<div>
						<input type="text" name="email" placeholder="Email" value="<?php echo $_COOKIE['email'] ?>" />
					</div>
				</div>
				<div class="uespacer30"></div>
				<input type="submit" value="START FREE TRIAL NOW" id="freeTrialBtnIdx" name="freeBtn" class="ue-fade black fontsize16" />
				<input type="submit" value="JOIN PREMIUM NOW" id="premiumBtnIdx" name="premiumBtn" class="ue-fade black fontsize20" />
				<div class="spacer80"></div>
			</form>
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-lg-5">
			<div class="spacer110"></div>
			<div id="whyAoIdx" class="colorBlue bold">
				WHY<br />
				ANGELS<br />
				OF IMPACT
			</div>
			<div class="spacer40"></div>
		</div>
		<div class="col-lg-7">
			<div class="spacer70"></div>
			<table width="100%" id="blueCircleContainer">
				<tr>
					<td>
						<div class="blueCircleIdx">1</div>
					</td>
					<td>
						Together we champion UN SDG #1: No Poverty, #5 Gender Equality and #12 Responsible Production & Consumption for an inclusive and prosperous world for all
					</td>
				</tr>
				<tr>
					<td>
						<div class="blueCircleIdx">2</div>
					</td>
					<td>
						Meet authentic funders and social enterprises that are trustworthy and credible 
					</td>
				</tr>
				<tr>
					<td>
						<div class="blueCircleIdx">3</div>
					</td>
					<td>
						Funders: Get discounts to curated goods created created responsibly by select social enterprises 
					</td>
				</tr>
				<tr>
					<td>
						<div class="blueCircleIdx">4</div>
					</td>
					<td>
						Social Enterprises: Receive funding and gain entry to corporate buyers for your goods and services 
					</td>
				</tr>
			</table>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<a href="about" id="freeTrialBtnIdx" class="ue-fade black center-block">LEARN MORE</a>
			<div class="spacer80"></div>
		</div>
	</div>
</div>
<div class="container-fluid blueContainer colorWhite">
	<div class="container">
		<div class="row">
			<div class="col-lg-5">
				<div class="spacer70"></div>
				<div class="capitalize bold fontsize48">
					Join the Angels<br />
					of Impact<br />
					community.
				</div>
				<div class="uespacer20"></div>
				<div class="fontsize26">
					Get access to our online platform and a unique range of opportunities.
				</div>
				<div class="spacer40"></div>
				<a href="registerinvestor.php?mid=2" class="whiteBorderBox ue-fade">JOIN PREMIUM</a>
			</div>
			<div class="col-lg-7">
				<div class="uespacer20"></div>
				<img src="images/idxImac.png" class="img-responsive center-block" />
				<div class="spacer50"></div>
			</div>
		</div>
	</div>
</div>
<script>
function actionRedir(userType){
	if(userType == "" || userType == "2"){
		$("#formIndex").attr("action", "action-register.php");
	}else{
		$("#formIndex").attr("action", "registerfunding.php");
	}
}
</script>
<?php
	include('footer.php');
?>
<?php
	include('ue-footer.php');
?>