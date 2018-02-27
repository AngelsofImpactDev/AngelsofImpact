<?php
	if(!in_array(currentPage(),$arrMenuLeft)){
		$fetchUser = ue_fetch_array(ue_query("SELECT * FROM user WHERE user_id = '".$_SESSION['currentUserId']."' LIMIT 1"));
		if($fetchUser['user_image'] == ""){
			$userImage = "images/dummyAvatar.png";
		}else{
			$userImage = "upload/userImage/".$fetchUser['user_image'];
		}	
?>
<body>
<div class="container visible-sm visible-xs visible-md" id="mobileHead">
	<div class="row">
		<div class="col-lg-12">
			<div id="nav-icon1">
			  <span></span>
			  <span></span>
			  <span></span>
			</div>
			<script type="text/javascript">
				$('#nav-icon1').click(function(){
					$.magnificPopup.open({
						items: {
							src: '#mobileMenuPopup'
						},
						type: 'inline',
						closeBtnInside: false,
						showCloseBtn: false,
						fixedContentPos: true,
						overflowY: 'auto',
						callbacks: {
							open: function() {
								$('#nav-icon1').toggleClass('open');
								setTimeout(function() {
									$('#nav-icon1').addClass('nav-icon3close');
								},100);
								
								//Animate
								$('#nav-icon1').css('display','fixed');
								$('html, body').css({
									'overflow': 'hidden',
									'height': '100%'
								});
								$(".eachMobileMenuBtn").each(function(index) {
									$(this).delay(200*index).animate({
										width:'100%',
										opacity: 1
									},200);
								});
							},
							close: function() {
								$('#nav-icon1').toggleClass('open');
								setTimeout(function() {
									$('#nav-icon1').removeClass('nav-icon3close');
								},100);
								
								//Reset
								$('#nav-icon1').css('display','absolute');
								$('html, body').css({
									'overflow': 'auto',
									'height': 'auto'
								});
								$(".eachMobileMenuBtn").each(function(index) {
									$(this).css('width','0');
									$(this).css('opacity','0');
								});
							}
						}
					}); //Open Popup
				});
				$(document).on("click",".nav-icon3close", function() {
					$.magnificPopup.close();
				});
			</script>
			<a href="index"><img id="floatingLogoMobile" src="images/angelsOfImpactLogo.png" style="width:80px;" class="img-responsive center-block" /></a>
		</div>
	</div>
	<!--
	<div class="row">
		<div class="col-lg-12">
			<a href="index"><img id="floatingLogoMobile" src="images/angelsOfImpactLogo.png" style="width:25%;" class="img-responsive center-block" /></a>
		</div>
	</div>
	-->
</div>
<div class="container-fluid whiteBg visible-lg" id="topHead">
	<div class="container">
		<div class="row">
			<div class="col-lg-3">
				<div id="floatingLogoContainer">
					<a href="index" id="floatingLogo"><img src="images/angelsOfImpactLogo.png" class="img-responsive center-block" /></a>
				</div>
			</div>
			<div class="col-lg-6">
				<div id="topCenterMenu">
					<a href="funding" class="ue-fade">SEEK FUNDING</a>
					<a href="investors" class="ue-fade">FUND A SOCIAL ENTERPRISE</a>
				</div>
			</div>
			<div class="col-lg-3">
				<div id="topLeftMenu" class="colorBlue">
				<?php
				if($_SESSION['currentUserId']==""){
				?>
					<a href="joinus" class="ue-fade">JOIN US</a>
					<a href="login" class="ue-fade">LOGIN</a>
				<?php
				}else{
				?>	
					<!--
					<span id="floatingPhoto" href="dashboard" class="ue-fade" style="padding:0px; padding-top:33px;"><img width="35" height="35" src="<?php echo $userImage ?>" class="img-circle" /></span>
					-->
					<a href="dashboard" class="ue-fade" style="padding-left:5px;">Hello, <?php echo $_SESSION['currentUserName'] ?></a>
				<?php
				}
				?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
	}
	else {
?>
<body style="background-color: #f4f2f2;"> <!--  stickyMobileDashboard -->
<div class="container-fluid whiteBg" id="mobileHeaderDashboard">
	<div class="container">
		<div class="row visible-xs visible-sm visible-md">
			<div class="col-xs-4 col-sm-4 col-md-4">
				<div id="nav-icon1">
				  <span></span>
				  <span></span>
				  <span></span>
				</div>
				<script type="text/javascript">
					$('#nav-icon1').click(function(){
						$.magnificPopup.open({
							items: {
								src: '#dashboardPopup'
							},
							type: 'inline',
							closeBtnInside: false,
							showCloseBtn: false,
							fixedContentPos: true,
							alignTop: true,
							overflowY: 'auto',
							callbacks: {
								open: function() {
									$('#nav-icon1').toggleClass('open');
									$("#mobileHeaderDashboard").addClass('changeColor');
									$("#dashboardLogo").css("display","none");
									setTimeout(function() {
										$('#nav-icon1').addClass('nav-icon3close');
									},100);
									
								},
								close: function() {
									$('#nav-icon1').toggleClass('open');
									$("#mobileHeaderDashboard").removeClass('changeColor');
									$("#dashboardLogo").css("display","");
									setTimeout(function() {
										$('#nav-icon1').removeClass('nav-icon3close');
									},100);
									
								}
							}
						}); //Open Popup
					});
					$(document).on("click",".nav-icon3close", function() {
						$.magnificPopup.close();
					});
				</script>
			</div>
			<div class="col-xs-8 col-sm-8 col-md-8">
				<div class="uespacer10"></div>
				<div class="spacer5"></div>
				<a href="index"><img id="dashboardLogo" src="images/angelsOfImpactLogo.png" style="width:80px;" /></a>
				<div class="uespacer10"></div>
			</div>
		</div>
		<div class="row visible-lg">
			<div class="col-lg-10">
				&nbsp;
			</div>
			<div class="col-lg-2">
				<div class="uespacer20"></div>
				<a href="index"><img src="images/angelsOfImpactLogo.png" width="50%" class="img-responsive center-block" /></a>
				<div class="uespacer10"></div>
			</div>
		</div>
	</div>
</div>
<?php
	}
?>
<div>
<?php
//$customMsg = array("login.php","registerfunding.php","registerinvestor.php","forgotPassword.php");
$customMsg = array("index.php");
if(in_array(currentPage(),$customMsg)){
	echo callPart('ue-messageShow');
}
?>
</div>