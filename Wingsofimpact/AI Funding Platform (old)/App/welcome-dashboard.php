<div class="visible-lg">
<?php
$customMsg = array("login.php","registerfunding.php","registerinvestor.php","forgotPassword.php");
if(!in_array(currentPage(),$customMsg)){
	echo callPart('ue-messageShow');
}
?>
</div>
<?php
if($fetchUser['user_membershiptype'] == "investors"){
?>
	<div class="spacer60"></div>
	<div class="colorBlue fontsize18 bold">Welcome Dearest Angel, <?php echo $fetchUser['user_name'] ?></div>
	<div class="fontsize14">Learn about the social enterprises' financing needs and progress.</div>
	<div class="uespacer10"></div>
	<div class="hr3"></div>
	<div class="spacer30"></div>
<?php
}else{
?>
	<div class="spacer60"></div>
	<div class="colorBlue fontsize18 bold">Welcome Dearest Angel, <?php echo $fetchUser['user_name'] ?></div>
	<div class="fontsize14">See your funding, repayment progress and the angels who are rallying behind your mission.</div>
	<div class="uespacer10"></div>
	<div class="hr3"></div>
	<div class="spacer30"></div>
<?php	
}
?>