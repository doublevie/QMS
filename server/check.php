<?php
$data = Array();
$live = new PDO('sqlite:data/queue.sqlite');
$live->exec("pragma synchronous = off;");

$errors = 0;
$result_one = $live->query("SELECT COUNT(ID) AS CID FROM MAIN WHERE DONE='0' OR DONE ='1' ") OR $errors++;
foreach($result_one as $row) {
  $data['COUNT'] = $row['CID'];
}
$data['echo'] = "-";
$data['last'] = "-";

$result_one = $live->query("SELECT *  FROM MAIN WHERE DONE='2' ORDER BY ID DESC LIMIT 1") OR $errors++;
foreach($result_one as $row) {
  $data['echo'] = $row['ECHO'];
}
$result_one = $live->query("SELECT *  FROM MAIN WHERE DONE='0' ORDER BY ID DESC LIMIT 1") OR $errors++;
foreach($result_one as $row) {
  $data['last'] = $row['ECHO'];
}


if ($errors == 0) {
  $data['status'] = 'OK';
} else {

  $data['status'] = 'ERREURS  :'.$errors ;
}



$json = json_encode( $data);

header("Content-type: application/json");
exit( $json );


 ?>
