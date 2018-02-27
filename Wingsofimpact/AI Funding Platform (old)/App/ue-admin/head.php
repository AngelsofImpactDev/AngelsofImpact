<?php
	include('ue-includes/ue-ses_check.php');
	
	$pageParams = pageParamsFormat($pageParamsArr);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="cache-control" content="max-age=0" />
<meta http-equiv="cache-control" content="no-cache" />
<meta http-equiv="expires" content="0" />
<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
<meta http-equiv="pragma" content="no-cache" />
<meta name="ROBOTS" content="NOARCHIVE" />
<meta name="ROBOTS" content="NOINDEX,FOLLOW" />
<meta name="GOOGLEBOT" content="NOARCHIVE" />
<meta name="AUTHOR" content="Adrian Liunardo" />
<title><?php echo $globvar_sitename?> - Administration Panel :: Powered By UltimaEngine</title>
<link rel="stylesheet" type="text/css" href="style.css" />
<script type="text/javascript" src="../ue-js/jquery.js"></script>
<script type="text/javascript" src="js/admjs.js"></script>
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
<!-- Left Menu JS -->
<script type="text/javascript" src="js/menuAccordion/ddaccordion.js"></script>
<script type="text/javascript" src="js/menuAccordion/ddaccordioninit.js"></script>
<link rel="stylesheet" type="text/css" href="js/menuAccordion/ddaccordionstyle.css" />
<!-- Left Menu JS END -->
<!-- Tooltip -->
<script type="text/javascript" src="js/tooltip/jquery.tooltipster.min.js"></script>
<link rel="stylesheet" type="text/css" href="js/tooltip/tooltipster.css" />
<!-- End Tooltip -->
<!-- Tiny MCE START -->
<script type="text/javascript" src="js/tiny_mce/tinymce.min.js"></script>
<script type="text/javascript" src="js/tiny_mce/tiny_init.js"></script>
<!-- Tiny MCE END -->
<!-- Color Picker -->
<script type="text/javascript" src="js/jscolor/jscolor.js"></script>
<!-- Color Picker END -->
<!-- Modal Popup START -->
<script type="text/javascript" src="js/uepopup/jquery.magnific-popup.min.js"></script>
<link rel="stylesheet" href="js/uepopup/magnific-popup.css" />
<!-- Modal Popup END -->
<!-- Chosen Select START -->
<script type="text/javascript" src="js/chosen/chosen.jquery.min.js"></script>
<link rel="stylesheet" href="js/chosen/chosen.min.css" type="text/css" />
<!-- Chosen Select END -->
<!-- Image Area Select START -->
<script type="text/javascript" src="js/imageareaselect/jquery.imgareaselect.pack.js"></script>
<link rel="stylesheet" type="text/css" href="js/imageareaselect/imgareaselect-animated.css" />
<!-- Image Area Select END -->
</head>