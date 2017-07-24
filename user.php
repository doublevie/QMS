<?php

if (!isset($_COOKIE["username"])) die('<script type="text/javascript">window.location.href="login.php";</script>');
$USER = $_COOKIE["username"];
$POWER = $_COOKIE["userpower"];


 ?>
