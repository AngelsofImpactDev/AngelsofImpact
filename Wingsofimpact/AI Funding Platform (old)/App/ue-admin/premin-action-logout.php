<?php
	session_start();
	if($_SESSION['currentUserId'] != '' || $_SESSION['currentUserLvl'] != '') {
		session_destroy();
	}
	if($_GET['why'] == 'idle') {
		header("Location: index.php?err=You are logged out for idling too long");
	}
	else {
		header("Location: index.php");
	}
?>