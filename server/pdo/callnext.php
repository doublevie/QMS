<?php
error_reporting(E_ALL);

$live = new PDO('sqlite:data/queue.sqlite');
$live->exec("pragma synchronous = off;");

$live->beginTransaction();
$result_one = $live->query("SELECT * FROM MAIN WHERE DONE='0' ORDER BY ID ASC LIMIT 1");
foreach($result_one as $row) {
  $ID = $row['ID'];
  $live->exec("UPDATE MAIN SET DONE='1' WHERE ID='$ID' ");
  print $row['ECHO'];
}

$live->commit();
 ?>
