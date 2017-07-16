<?php
error_reporting(E_ALL);
$now = date ('Y-m-d H:i:s') .'.'. rand(1, 100);
$fatoday = date ('Ymd');
$live = new PDO('sqlite:data/queue.sqlite');
$live->exec("pragma synchronous = off;");

$live->beginTransaction();
$result_one = $live->query("SELECT COUNT(DISTINCT date) AS numb FROM MAIN WHERE FADATE='$fatoday'");
foreach($result_one as $row) {
  $number = $row['numb'];
}
$number++;
  print $number;
$live->exec("INSERT INTO MAIN (ECHO,GUI,DATE,DONE,FADATE)  VALUES ('$number', '1', '$now', '0', '$fatoday')");


$live->commit();
 ?>
