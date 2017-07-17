<?php
$data = Array();
$live = new PDO('sqlite:data/queue.sqlite');
$live->exec("pragma synchronous = off;");

$result_one = $live->query("SELECT COUNT(ID) AS CID FROM MAIN WHERE DONE='0' OR DONE ='1' ");
foreach($result_one as $row) {
  $data['COUNT'] = $row['CID'];
}
$data['ECHO'] = "-";

$result_one = $live->query("SELECT *  FROM MAIN WHERE DONE='2' ORDER BY ID DESC LIMIT 1");
foreach($result_one as $row) {
  $data['ECHO'] = $row['ECHO'];
}


$json = json_encode( $data);

header("Content-type: application/json");
exit( $json );


 ?>
