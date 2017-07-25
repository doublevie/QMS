<?php
$data = Array();
$db = new SQLite3('data/queue.sqlite',SQLITE3_OPEN_READONLY);

$errors = 0;

$results = $db->query("SELECT COUNT(ID) AS CID FROM MAIN WHERE DONE='0' OR DONE ='1' ");
while ($row = $results->fetchArray()) {
$data['COUNT'] = $row['CID'];
}
$data['echo'] = "-";
$data['last'] = "-";


$results = $db->query("SELECT *  FROM MAIN WHERE DONE<>'1' AND  DONE<>'0' ORDER BY DONE DESC LIMIT 1");
while ($row = $results->fetchArray()) {
  $data['echo'] = $row['ECHO'];
}


$results = $db->query("SELECT *  FROM MAIN WHERE DONE='0' ORDER BY ID DESC LIMIT 1");
while ($row = $results->fetchArray()) {
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
