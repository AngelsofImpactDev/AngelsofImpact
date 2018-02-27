<div class="container-fluid whiteBg">
	<div class="spacer40"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-2">
				&nbsp;
			</div>
			<div class="col-lg-2">
				<a href="index" class="visible-lg"><img src="images/angelsOfImpactLogo.png" class="img-responsive center-block" width="70%" /></a>
				<a href="index" class="visible-xs visible-md visible-sm"><img src="images/angelsOfImpactLogo.png" class="img-responsive center-block" width="30%" /></a>
			</div> 
			<div class="uespacer30 visible-xs visible-sm visible-md"></div>
			<div class="col-lg-2 fontsize16">
				<div class="colorBlue bold">COMPANY</div>
				<a href="about">ABOUT</a><br />
				<a href="http://www.angelsofimpact.com/careers.html">CAREERS</a><br />
				<a href="http://www.angelsofimpact.com/news--events">PRESS</a><br />
			</div>
			<div class="uespacer30 visible-xs visible-sm visible-md"></div>
			<div class="col-lg-2 fontsize16">
				<div class="colorBlue bold">GET IN TOUCH</div>
				<!--
				<a href="#">CONTACT</a><br />
				<a href="#">HELP CENTER</a><br />
				-->
				<a href="termsandcondition">LEGAL</a>
			</div>
			<div class="uespacer30 visible-xs visible-sm visible-md"></div>
			<div class="col-lg-3 fontsize16">
				<div class="colorBlue bold">CONNECT</div>
				<div class="uespacer10"></div>
				<!--<a href="#"><img src="images/soc-gplus.gif" /></a>-->
				<a href="https://www.linkedin.com/company-beta/12954072/"><img src="images/soc-linked.gif" /></a>
				<a href="https://twitter.com/angelsofimpact"><img src="images/soc-twitter.gif" /></a>
				<a href="https://www.instagram.com/angelsofimpact/"><img src="images/soc-insta.gif" /></a>
				<a href="https://www.facebook.com/angelsofimpact/?fref=ts"><img src="images/soc-fb.gif" /></a>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 fontsize12 rightText">
				<div class="spacer60"></div>
				&copy; 2016 Angels of Impact. All Rights Reserved.
				<div class="uespacer20"></div>
			</div>
		</div>
		<div id="mobileMenuPopup" class="ue-modal mfp-hide">
			<?php
			if($_SESSION['currentUserId'] == ""){
			?>
				<a href="login" class="ue-fade">LOGIN</a>
				<a href="joinus" class="ue-fade">JOIN US</a>
			<?php
			}else{				
			?>
				<a href="dashboard" style="border:none;"><img width="50" height="50" src="<?php echo $userImage ?>" class="img-circle avatarCircle" /></a>
				<a href="dashboard">Hello, <?php echo $_SESSION['currentUserName'] ?></a>
			<?php
			}
			?>
			<a href="funding" class="ue-fade">SEEK FUNDING</a>
			<a href="investors" class="ue-fade">FUND A SOCIAL ENTERPRISE</a>
		</div>
	</div>
</div>