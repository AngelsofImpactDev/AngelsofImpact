<?php
	session_start();
	include('../confinc/connect.php');
	include('../confinc/globVar.php');
	
	header("Location: http://www.".$globvar_address);
?>