<?php
include '../inc/main.php';
$max = $maximumNumber;
$service = $_GET['s'];
$srv = $services[intval($service)]['code'];
$b = $services[intval($service)]['b'];
$e = $services[intval($service)]['e'];
$today = date ('Y-m-d H:i:s');
$now =  $today.'.'. rand(1, 100);
$fatoday = date ('Ymd');
$db = new SQLite3('data/queue.sqlite');
// $db->query("PRAGMA synchronous = ON");
$db->exec('BEGIN;');
$results = $db->query("SELECT COUNT(DISTINCT date) AS numb FROM MAIN WHERE FADATE='$fatoday' AND SERVICE LIKE '$service' ");
while ($row = $results->fetchArray()) {
    // var_dump($row);
    $number = $row['numb'];
}
$number++;
$number = getNumber($number,$b,$e);

$db->exec("INSERT INTO MAIN (ECHO,GUI,SERVICE,DATE,DONE,FADATE)  VALUES ('$number', '0','$service', '$now', '0', '$fatoday')");
$number = str_pad($number, 3, "0", STR_PAD_LEFT);

echo ';;'.$srv.'-'.$number.';;';
$db->exec('COMMIT;');


function getNumber ($t,$b,$e){
  $dif = $e - $b;
  $x = $t % $dif;
  $x += $b;
  if ($x == 0) $x = $e;
  return $x;
}



if (isset($_GET['print'])) include 'receipt.php';



 ?>
