<?php
session_start();
$_SESSION = [];
session_destroy();
session_unset();

setcookie('id', '', time() - 3600);
setcookie('key', '', time() - 3600);

header("Location: login.php");
