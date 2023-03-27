<?php
session_start();
unset($_SESSION['username']);
unset($_SESSION['ID']);
unset($_SESSION['token']);
setcookie("identifiant","");
setcookie("motdepasse","");
session_destroy();
header('refresh: 0; url=../');
?>