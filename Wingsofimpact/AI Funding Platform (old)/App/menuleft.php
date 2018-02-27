<div class="leftBlueBarMarginMin visible-lg"></div>
<div class="leftBlueBar" id="dashboardPopup">
	<div class="avatarContainer">
		<div class="spacer50"></div>
		<table cellpadding="0" cellspacing="0" class="marginAuto">
			<tr>
				<td width="1">
					<?php
					if($fetchUser['user_image'] == ""){
						$userImage = "images/dummyAvatar.png";
					}else{
						$userImage = "upload/userImage/".$fetchUser['user_image'];
					}
					?>
					<a href="dashboard.php"><img width="50" height="50" src="<?php echo $userImage ?>" class="img-circle avatarCircle" /></a>
				</td>
				<td>
					<div class="fontsize18 bold"><a href="dashboard.php"><?php echo $fetchUser['user_name'] ?></a></div>
					<div class="fontsize14">
					<?php
					
					$membershipKey = 0;
					if($fetchUser['user_expiry']>time()){
						$membershipKey = $fetchUser['user_membershipid'];
					}
					
					if($fetchUser['user_membershiptype'] == "investors"){
						echo $aolMembership[$fetchUser['user_membershiptype']][$membershipKey]['member']." Angel";
					}else{
						echo $aolMembership[$fetchUser['user_membershiptype']][$membershipKey]['member']." Social Enterprises";
					}
					
					?>
					</div>
				</td>
			</tr>
		</table>
		<div class="uespacer30"></div>
	</div>
	<div class="leftBlueMenuContainer">
	<?php
	if($fetchUser['user_membershiptype'] == "investors"){
	?>
		<?php
		if(currentPage() == 'fundenterprises.php'){
		?>
			<a href="fundenterprises.php" style="background-image: url(images/blueDivIcon-fundasocialBlue.png); background-color: #FFF; color:#1475c5;" class="bold ue-fade">Fund Social Enterprises</a>
		<?php
		}else{
		?>
			<a href="fundenterprises.php" style="background-image: url(images/blueDivIcon-fundasocial.png); background-color: #06487e; color:#ffde00;" class="bold ue-fade">Fund Social Enterprises</a>
		<?php
		}
		?>
	<?php
	}else{
	?>
		<?php
		if(currentPage() == 'seekfunding.php'){
		?>
			<a href="seekfunding.php" style="background-image: url(images/blueDivIcon-fundasocialBlue.png); background-color: #FFF; color:#1475c5;" class="ue-fade">Seek Funding</a>
		<?php
		}else{
		?>
			<a href="seekfunding.php" style="background-image: url(images/blueDivIcon-fundasocial.png); background-color: #06487e; color:#ffde00;" class="bold ue-fade">Seek Funding</a>
		<?php
		}
		?>
	<?php
	}
	?>
	
	<?php
	if(currentPage() == 'enterprises.php'){
	?>
		<a href="enterprises.php" style="background-image: url(images/blueDivIcon-10Blue.png); background-color: #FFF; color:#1475c5;" class="ue-fade">View Social Enterprises</a>
	<?php
	}else{
	?>
		<a href="enterprises.php" style="background-image: url(images/blueDivIcon-10.png);" class="ue-fade">View Social Enterprises</a>
	<?php	
	}
	?>
	
	<?php
	if(currentPage() == 'angel.php'){
	?>
		<a href="angel.php" style="background-image: url(images/blueDivIcon-viewSocialMediaBlue.png); background-color: #FFF; color:#1475c5;" class="ue-fade">View other Angels</a>
	<?php
	}else{
	?>
		<a href="angel.php" style="background-image: url(images/blueDivIcon-viewSocialMedia.png);" class="ue-fade">View other Angels</a>
	<?php
	}
	?>
	
	<?php
	if(currentPage() == 'fundinglist.php'){
	?>
		<a href="fundinglist" style="background-image: url(images/blueDivIcon-3Blue.png); background-color: #FFF; color:#1475c5;" class="ue-fade">Funding History</a>
	<?php
	}else{
	?>
		<a href="fundinglist" style="background-image: url(images/blueDivIcon-3.png);" class="ue-fade">Funding History</a>
	<?php
	}
	?>
	
	<?php
	if(currentPage() == 'accountinfo.php' or currentPage() == 'accountedit.php'){
	?>
		<a href="accountinfo.php" style="background-image: url(images/blueDivIcon-4Blue.png); background-color: #FFF; color:#1475c5;" class="ue-fade">Account Info</a>
	<?php
	}else{
	?>
		<a href="accountinfo.php" style="background-image: url(images/blueDivIcon-4.png);" class="ue-fade">Account Info</a>
	<?php
	}
	?>
	
	<?php
	if(currentPage() == 'inbox.php' or currentPage() == 'detail-inbox.php'){
	?>
		<a href="inbox.php" style="background-image: url(images/blueDivIcon-5Blue.png); background-color: #FFF; color:#1475c5;" class="ue-fade">Inbox</a>
	<?php
	}else{
	?>
		<a href="inbox.php" style="background-image: url(images/blueDivIcon-5.png);" class="ue-fade">Inbox</a>
	<?php
	}
	?>
	
	<?php
	if(currentPage() == 'usersetting.php' or currentPage() == 'usersettingedit.php'){
	?>
		<a href="usersetting.php" style="background-image: url(images/blueDivIcon-6Blue.png); background-color: #FFF; color:#1475c5;" class="ue-fade">Settings</a>
	<?php
	}else{
	?>
		<a href="usersetting.php" style="background-image: url(images/blueDivIcon-6.png);" class="ue-fade">Settings</a>
	<?php
	}
	?>
	
	<?php
	if(currentPage() == 'help.php'){
	?>
		<a href="help.php" style="background-image: url(images/blueDivIcon-7Blue.png); background-color: #FFF; color:#1475c5;" class="ue-fade">Help</a>
	<?php
	}else{
	?>
		<a href="help.php" style="background-image: url(images/blueDivIcon-7.png);" class="ue-fade">Help</a>
	<?php
	}
	?>
		<a href="logout.php" style="background-image: url(images/blueDivIcon-8.png);" class="ue-fade">Log Out</a>
	</div>
</div>