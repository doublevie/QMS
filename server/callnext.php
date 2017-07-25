<?php
error_reporting(E_ALL);
$db = new SQLite3('data/queue.sqlite');
$db->exec('BEGIN;');
$results = $db->query("SELECT * FROM MAIN WHERE DONE='0' ORDER BY ID ASC LIMIT 1");
while ($row = $results->fetchArray()) {
  $ID = $row['ID'];
  $db->exec("UPDATE MAIN SET DONE='1' WHERE ID='$ID' ");
  print $row['ECHO'];
}
$db->exec('COMMIT;');





 ?>
