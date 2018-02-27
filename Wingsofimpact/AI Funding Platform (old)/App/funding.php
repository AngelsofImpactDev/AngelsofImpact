<?php
	include('ue-head.php');
?>
<?php
	include('header.php');
?>
<div class="container-fluid" style="background-image: url(images/seekFundingTmp.jpg); background-position: bottom right; background-attachment: scroll;" id="mainBannerIdx">
	<div class="container" style="text-shadow: 0px 0px 6px rgba(255,255,255,0.9);">
		<div class="col-lg-12">
			<div class="spacer50"></div>
			<h1 class="fontsize44 bold colorBlue">GET FUNDING SUPPORT.</h1>
			<div class="fontsize36 colorBlue">Get Funded for Your Social Enterprises.</div>
			<div class="uespacer10"></div>
			<div id="indexContentContainer">
				Obtain prepaid credits and funding to pay for the supplies, ingredients and people to bring your responsibly made products to your customers.
			</div>
			<div class="uespacer30"></div>
			<a href="registerfunding" id="freeTrialBtnIdx" class="ue-fade black">GET FUNDED</a>
			<div class="spacer80"></div>
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div class="spacer40"></div>
			<div class="centerText fontsize30 colorBlue bold">
				4 STEPS TO GET FUNDED
			</div>
			<div class="centerText fontsize21">
				Simple, automated and hassle free
			</div>
			<div class="spacer70"></div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-3">
			<div class="circleBlueBig center-block">1</div>
			<div class="uespacer30"></div>
			<div class="centerText fontsize14">
				Register with us, tell us your funding needs and set up your campaign.
			</div>
		</div>
		<div class="col-lg-3">
			<div class="circleBlueBig center-block">2</div>
			<div class="uespacer30"></div>
			<div class="centerText fontsize14">
				We'll circulate your funding campaign through our community of Angels.
			</div>
		</div>
		<div class="col-lg-3">
			<div class="circleBlueBig center-block">3</div>
			<div class="uespacer30"></div>
			<div class="centerText fontsize14">
				We'll tell you which Angels would like to fund you.
			</div>
		</div>
		<div class="col-lg-3">
			<div class="circleBlueBig center-block">4</div>
			<div class="uespacer30"></div>
			<div class="centerText fontsize14">
				Follow your funding campaign to see who has funded you - and receive the money! 
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
			<div class="col-lg-2">	
				&nbsp;
			</div>
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
						<a class="greyBtn" href="registerfunding.php?mid=free">REGISTER NOW</a>
					</div>
				</div>
			</div>
			<div class="col-lg-4">	
				<div class="colorWhite black centerText fontsize21" style="background-color: #00bff3; padding: 13px;">
					SOCIAL ENTERPRISES
				</div>
				<div style="background-color: #fff; border: 1px solid #00bff3; padding: 25px;">
					<div class="centerText black colorLightBlue" style="font-size: 58px;"><?php echo $aolMembership['startup'][1]['name'] ?></div>
					<div class="centerText colorLightBlue">Yearly Membership<br />By Invitation Only</div>
					<div class="uespacer20"></div>
					<div class="bold colorLightBlue">
						Benefits
					</div>
					<div class="fontsize12">
						<ul class="nopaddingList">
							<li>Interactions with mentors, networks and strategic advisors, wherever relevant, to enable development of strategic and organisational goals of the social enterprises. </li>
							<li>Access to a trusted network of Angels and Corporates for advice, connections and funds whenever possible  </li>
							<li>Innovative way of repaying interest through in-kind goods and services</li>
							<li>Exclusive access to our FinTech payment partner Coinpip, that provides low-cost overseas remittance at a 1% transaction fee - a rate much lower than bank transfer rates</li>
							<li>Pipeline of customers, both individuals and corporate buyers, for your social enterprise's products and services</li>
							<li>Introductions to new social enterprises for potential collaborations across the social entrepreneurship sector.
							Access to our community gatherings of social enterprises and angels to learn and find ways of scaling and growing your social enterprise collectively with the community</li>
						</ul>
					</div>
					<div class="uespacer30"></div>
					<div>
						<a class="lightBlueBtn" href="registerfunding.php?mid=1">REGISTER NOW</a>
					</div>
				</div>
			</div>
			<div class="col-lg-2">	
				&nbsp;
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