<?php

$ip = $_SERVER['REMOTE_ADDR'];
$last = explode('.';$ip)[3];



$rep = array();
$rep['status'] = 'ok';
$rep['link'] = 'v.php';

$json = json_encode( $rep);

header("Content-type: application/json");
exit(  $json );
 ?>
