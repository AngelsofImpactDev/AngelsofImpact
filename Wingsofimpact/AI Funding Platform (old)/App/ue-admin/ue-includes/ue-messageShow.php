<?php
	if($_GET['err'] != '') {
?>
<div id="ueShowError">
    <div class="messageBox">
        <?php echo $_GET['err']?>
    </div>
</div>
<?php
	}
	else if($_GET['sta'] != '') {
?>
<div id="ueShowStatus">
    <div class="messageBox">
    <?php
		if($_GET['sta'] == 'ok') {
	?>
    	Action Complete
    <?php
		}
		else {
	?>
        <?php echo $_GET['sta']?>
    <?php
		}
	?>
    </div>
</div>
<?php
	}
?>