<?php

$inifile = "qms.ini";
$ini = parse_ini_file($inifile);
$json = json_encode( $ini);
header("Content-type: application/json");
exit(  $json  );


 ?>
