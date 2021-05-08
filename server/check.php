<?php
$data = Array();
$db = new SQLite3('data/queue.sqlite',SQLITE3_OPEN_READONLY);
$si = $_GET['si'];
$errors = 0;

$results = $db->query("SELECT COUNT(ID) AS CID FROM MAIN WHERE DONE='0' AND SERVICE ='$si' ");
while ($row = $results->fetchArray()) {
$data['COUNT'] = $row['CID'];
}
$data['echo'] = "-";
$data['last'] = "-";


$results = $db->query("SELECT *  FROM MAIN WHERE DONE<>'1' AND  DONE<>'0' AND SERVICE ='$si'  ORDER BY ID DESC LIMIT 1");
while ($row = $results->fetchArray()) {
  $data['echo'] = str_pad($row['ECHO'], 3, "0", STR_PAD_LEFT);
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
