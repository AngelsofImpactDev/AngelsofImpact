<?php
	session_start();
	$sessionLoginCountLimit = 3;
	if($_SESSION['currentUserIdAdm'] != '' && $_SESSION['currentUserLvl'] != '') {
		header("Location: panel.php");
	}
	else {
		include('../ue-config/ue-globalconfig.php');
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="CACHE-CONTROL" content="NO-CACHE" />
<meta http-equiv="PRAGMA" content="NO-CACHE" />
<meta name="ROBOTS" content="NOARCHIVE" />
<meta name="ROBOTS" content="NOINDEX,FOLLOW" />
<meta name="GOOGLEBOT" content="NOARCHIVE" />
<meta name="AUTHOR" content="Adrian Liunardo" />
<title><?php echo $globvar_sitename?> - Administration Panel :: Powered By UltimaEngine</title>
<script type="text/javascript" src="../ue-js/jquery.js"></script>
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="shortcut icon" type="image/x-icon" href="../favicon.ico" />
</head>

<body>
	<div id="logIndex" class="dropShadow1">
    	<table width="100%" cellpadding="0" cellspacing="0">
        	<tr>
            	<td width="1">
                	<a href="index.php"><img src="images/ue-logo.gif" alt="UltimaEngine Logo" title="Powered By Ultima Engine" /></a>
                </td>
                <td style="text-align: center; background-color: #2d3945;">
                	Administration Panel
                </td>
            </tr>
        </table>
		<?php
            include('ue-includes/ue-messageShow.php');
        ?>
    	<img src="images/noUserImage.gif" id="userAvatar" style="margin-top: 20px; margin-bottom: 25px;" />
		<?php
            if($_SESSION['loginCount'] <= $sessionLoginCountLimit) {
        ?>
        <form action="action-index.php" method="post">
        <?php
            }
        ?>
            <div>
				<?php
                    if($_SESSION['loginCount'] > $sessionLoginCountLimit) {
                ?>
                    <input type="password" class="admInputLogin" placeholder="username" style="width: 70%; margin-bottom: 20px;" disabled="disabled" readonly="readonly" />
                <?php
                    }
                    else {
                ?>
                    <input name="un" type="password" class="admInputLogin" placeholder="username" style="width: 70%; margin-bottom: 20px;" />
                <?php
                    }
                ?>
            </div>
            <div>
				<?php
                    if($_SESSION['loginCount'] > $sessionLoginCountLimit) {
                ?>
                    <input type="password" class="admInputLogin" placeholder="password" style="width: 70%; margin-bottom: 20px;" disabled="disabled" readonly="readonly" />
                <?php
                    }
                    else {
                ?>
                    <input name="ps" type="password" class="admInputLogin" placeholder="password" style="width: 70%; margin-bottom: 20px;" />
                <?php
                    }
                ?>
            </div>
            <div style="text-align: right; padding-right: 70px;"><input type="submit" class="admButton" value="Sign In" /></div>
		<?php
            if($_SESSION['loginCount'] <= $sessionLoginCountLimit) {
        ?>
        </form>
        <?php
            }
        ?>
        <div id="footerIdxLogin">
            <a href="http://<?php echo $globvar_address?>">
                <?php echo $globvar_address?>
            </a>
        </div>
    </div>
</body>
</html>