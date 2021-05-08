<?php
error_reporting(E_ALL);
$gui = '';
if (isset($_GET['g'])) $gui = $_GET['g'];
$srv = $_GET['service'];
$db = new SQLite3('data/queue.sqlite');
$db->exec('BEGIN;');
$results = $db->query("SELECT * FROM MAIN WHERE (DONE='0' AND SERVICE='$srv') ORDER BY ID ASC LIMIT 1");
while ($row = $results->fetchArray()) {
  $ID = $row['ID'];
  $db->exec("UPDATE MAIN SET DONE='1',GUI='$gui' WHERE ID='$ID' ");
  print $row['ECHO'];
}
$db->exec('COMMIT;');





 ?>
