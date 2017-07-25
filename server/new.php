<?php
$max = 200;
$today = date ('Y-m-d H:i:s');
$now =  $today.'.'. rand(1, 100);
$fatoday = date ('Ymd');
$db = new SQLite3('data/queue.sqlite');
// $db->query("PRAGMA synchronous = ON");
$db->exec('BEGIN;');
$results = $db->query("SELECT COUNT(DISTINCT date) AS numb FROM MAIN WHERE FADATE='$fatoday'");
while ($row = $results->fetchArray()) {
    // var_dump($row);
    $number = $row['numb'];
}
$number++;
$number = ($number % $max);
if ($number == 0) {
  $number = $max;
}

$db->exec("INSERT INTO MAIN (ECHO,GUI,DATE,DONE,FADATE)  VALUES ('$number', '1', '$now', '0', '$fatoday')");

echo $number;
$db->exec('COMMIT;');
// include 'ethernet.php';



 ?>
