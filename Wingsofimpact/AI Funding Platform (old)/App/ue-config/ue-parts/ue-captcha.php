<?php
	@ session_start();
	include("ue-config/ue-function/ue-captcha/ue-captcha.php");
    $_SESSION['ue-captcha'] = uecaptcha();
?>
<div id="captchaWrapper">
    <div id="captchaImage"><img src="<?php echo $_SESSION['ue-captcha']['image_src']?>" alt="CAPTCHA" /></div>
    <div id="captchaInput"><input type="text" name="uecaptcha" placeholder="Insert text above" /></div>
</div>
    