<?php
error_reporting(E_ALL);
$b = $_GET['b'];
$e = $_GET['e'];
$data = array();
$db = new SQLite3('data/queue.sqlite');
$results = $db->query("SELECT DATE,DONE,ECHO,SERVICE,GUI FROM MAIN WHERE (DONE<>'0') AND (DATE BETWEEN '$b' AND '$e') ");
while ($row = $results->fetchArray()) {
$data[] = $row;
}

$json = json_encode( $data);
header("Content-type: application/json");
exit(  $json  );


 ?>
