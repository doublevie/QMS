<?php

$data = Array('call' => Array());
 $data['count'] = '0';
// $data = Array();
$live = new PDO('sqlite:data/queue.sqlite');
$now = $now = date ('Y-m-d H:i:s');
$live->beginTransaction();
$result_one = $live->query("SELECT ECHO,GUI,ID,SERVICE FROM MAIN WHERE DONE='1' ");
foreach($result_one as $row) {
  $id = $row['ID'];
 $data['call'][]  = array('nmb' => $row['ECHO'] , 'g' => $row['GUI'] ,'si'=>$row['SERVICE']  );
  $live->exec("UPDATE MAIN SET DONE='$now' WHERE ID='$id'");
}

$result_one = $live->query("SELECT COUNT(ID) AS CID FROM MAIN WHERE DONE='1' OR DONE='0' ");
foreach($result_one as $row) {
 $data['count']  = $row['CID'];
}

$live->commit();
 
$json = json_encode( $data);

header("Content-type: application/json");
exit(  $json );


 ?>
