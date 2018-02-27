<?php
	if($_GET['err'] != '') {
?>
    	<div id="writeError">
        	<div>
	        	<?php echo ueWritePage($_GET['err'])?>
            </div>
        </div>
<?php
	}
	else if($_GET['sta'] != '') {
?>
    	<div id="writeOk">
        	<div>
	        	<?php echo ueWritePage($_GET['sta'])?>
            </div>
        </div>
<?php
	}
	else if($_GET['mes'] != '') {
?>
    	<div id="writeInfo">
        	<div>
	        	<?php echo ueWritePage($_GET['mes'])?>
            </div>
        </div>
<?php
	}
?>