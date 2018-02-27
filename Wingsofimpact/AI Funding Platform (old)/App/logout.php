<?php
session_start();
session_destroy();
unset($_COOKIE);
setcookie('loginUser', '', time() - 3600);
header("location:index.php");
?>