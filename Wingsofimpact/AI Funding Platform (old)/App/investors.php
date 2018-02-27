<?php
	include('ue-head.php');
?>
<?php
	include('header.php');
?>
<div class="container-fluid" style="background-image: url(images/fundSocialEnterpriseTmp.jpg); background-position: center left; background-attachment: scroll;" id="mainBannerIdx">
	<div class="container">
		<div class="col-lg-12">
			<div class="spacer50"></div>
			<div class="visible-lg" style="padding-left: 40%;">
				<h1 class="fontsize44 bold colorBlue">FUND A SOCIAL ENTERPRISE.</h1>
				<div class="fontsize36 colorBlue">Fund and Support Impactful Enterprises</div>
				<div class="uespacer10"></div>
				<div id="indexContentContainer">
					We curate our community of social enterprises to bring you credible businesses that make excellent impact.
				</div>
				<div class="uespacer30"></div>
				<a href="registerinvestor" id="freeTrialBtnIdx" class="ue-fade black">FUND AN ENTERPRISE</a>
			</div>
			<div class="visible-xs visible-sm visible-md">
				<h1 class="fontsize44 bold colorBlue">FUND A SOCIAL ENTERPRISE.</h1>
				<div class="fontsize36 colorBlue">Fund and Support Impactful Enterprises</div>
				<div class="uespacer10"></div>
				<div id="indexContentContainer">
					We curate our community of social enterprises to bring you credible businesses that make excellent impact.
				</div>
				<div class="uespacer30"></div>
				<a href="registerinvestor" id="freeTrialBtnIdx" class="ue-fade black">FUND AN ENTERPRISE</a>
			</div>
			<div class="spacer80"></div>
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div class="spacer40"></div>
			<div class="centerText fontsize30 colorBlue bold">
				4 STEPS TO FUND SOCIAL ENTERPRISE
			</div>
			<div class="centerText fontsize21">
				Transparent, Simple and Impactful
			</div>
			<div class="spacer70"></div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-3">
			<div class="circleBlueBig center-block">1</div>
			<div class="uespacer30"></div>
			<div class="centerText">
				Register as a<br />
				Startup Angel today.
			</div>
		</div>
		<div class="col-lg-3">
			<div class="circleBlueBig center-block">2</div>
			<div class="uespacer30"></div>
			<div class="centerText">
				Choose a social enterprise's<br />
				campaign to fund. 
			</div>
		</div>
		<div class="col-lg-3">
			<div class="circleBlueBig center-block">3</div>
			<div class="uespacer30"></div>
			<div class="centerText">
				Pledge your<br />
				money.
			</div>
		</div>
		<div class="col-lg-3">
			<div class="circleBlueBig center-block">4</div>
			<div class="uespacer30"></div>
			<div class="centerText">
				Follow the campaign, see who else joins and see the impact of your money! 
			</div>
		</div>
	</div>
</div>
<div class="spacer60"></div>
<div class="container-fluid greyContainer">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="spacer40"></div>
				<div class="centerText fontsize41 colorBlue bold">
					MEMBERSHIP
				</div>
				<div class="centerText fontsize21">
					Get access to our online platform and a unique range of opportunities.
				</div>
				<div class="spacer50"></div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-4">	
				<div style="background-color: #fff; border: 1px solid #8c8c8c; padding: 25px;">
					<div class="centerText black" style="font-size: 58px;">FREE</div>
					<div class="centerText">No Payment, Unlimited Time</div>
					<div class="uespacer20"></div>
					<div class="bold">
						Benefits
					</div>
					<div class="fontsize12">
						<ul class="nopaddingList">
							<li>Meet more friends - see Angel Social Enterprises in your network.</li>
							<li>Meet Angel funders who are champions for Social Enterprises.</li>
							<li>Get more done with best practice advice from our knowledge base.</li>
						</ul>
					</div>
					<div class="uespacer30"></div>
					<div>
						<a class="greyBtn" href="registerinvestor.php?mid=free">REGISTER NOW</a>
					</div>
				</div>
			</div>
			<div class="visible-xs visible-md visible-sm spacer40"></div>
			<div class="col-lg-4">	
				<div class="colorWhite black centerText fontsize21" style="background-color: #00bff3; padding: 13px;">
					STARTUP ANGELS
				</div>
				<div style="background-color: #fff; border: 1px solid #00bff3; padding: 25px;">
					<div class="centerText black colorLightBlue" style="font-size: 58px;"><?php echo $aolMembership['investors'][1]['name'] ?></div>
					<div class="centerText colorLightBlue">One Time Payment<br />Pay once a year</div>
					<div class="uespacer20"></div>
					<div class="bold colorLightBlue">
						Benefits
					</div>
					<div class="fontsize12">
						<ul class="nopaddingList">
							<li>Save time searching for credible social enterprises to fund.</li>
							<li>Save money while having a bigger social impact. Unlike with normal charity, your money comes back to you.</li>
							<li>Save 10% on the cost of events and conferences in the region.</li>
							<li>Exclusive access to other members. Connect with potential customers, suppliers and employers.</li>
							<li>Save money on tailor-made eco-tourism trips.</li>
							<li>Clear measures of the impact of your money</li>
							<li>Save time looking for responsibly-produced products.</li>
						</ul>
					</div>
					<div class="uespacer30"></div>
					<div>
						<a class="lightBlueBtn" href="registerinvestor.php?mid=1">REGISTER NOW</a>
					</div>
				</div>
			</div>
			<div class="visible-xs visible-md visible-sm spacer40"></div>
			<div class="col-lg-4">	
				<div class="colorWhite black centerText fontsize21" style="background-color: #a186be; padding: 13px;">
					CORPORATE ANGELS
				</div>
				<div style="background-color: #fff; border: 1px solid #a186be; padding: 25px;">
					<div class="centerText black colorViolet" style="font-size: 58px;"><?php echo $aolMembership['investors'][2]['name'] ?></div>
					<div class="centerText colorViolet">One Time Payment<br />Pay once a year</div>
					<div class="uespacer20"></div>
					<div class="bold colorViolet">
						Benefits
					</div>
					<div class="fontsize12">
						<ul class="nopaddingList">
							<li>Receive up to 3 unique logins for individuals in your organisation.</li>
							<li>Obtain Corporate branding on the Angels of Impact platform.</li>
							<li>Gain access to curated social enterprises that you can fund and support as a Corporate Angel</li>
							<li>Leverage strategic collaboration with fellow Angels &amp; Corporate members.</li>
							<li>Meet and network exclusively with fellow Angels and Corporates who support &amp; fund the social enterprises.</li>
							<li>Support a business with clear measures of benefit of your funding. Keep on funding as an SE repays you</li>
							<li>Purchase responsibly-produced products.</li>
							<li>Receive up to 10% discount on selected items from our responsibly made social enterprise goods. </li>
							<li>Access to events and conferences at a discount on driving impact.</li>
							<li>Book tailor-made travel trips to places where our social enterprises operate and serve. </li>
							<li>Learn from our Angels on the best practices of social impact space</li>
						</ul>
					</div>
					<div class="uespacer30"></div>
					<div>
						<a class="violetBtn" href="registerinvestor.php?mid=2">REGISTER NOW</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="spacer50"></div>
</div>
<?php
	include('footer.php');
?>
<?php
	include('ue-footer.php');
?>