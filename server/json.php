<?php

$data = Array('call' => Array());
 $data['count'] = '0';
// $data = Array();
$live = new PDO('sqlite:data/queue.sqlite');

$live->beginTransaction();
$result_one = $live->query("SELECT ECHO,GUI,ID FROM MAIN WHERE DONE='1' ");
foreach($result_one as $row) {
  $id = $row['ID'];
 $data['call'][]  = array('nmb' => $row['ECHO'] , 'g' => $row['GUI']  );
  $live->exec("UPDATE MAIN SET DONE='2' WHERE ID='$id'");
}

$result_one = $live->query("SELECT COUNT(ID) AS CID FROM MAIN WHERE DONE='1' OR DONE='0' ");
foreach($result_one as $row) {
 $data['count']  = $row['CID'];
}

$live->commit();





// $data['call'][]  = array('nmb' => 1 , 'g' => 1  );
// $data['call'][]  = array('nmb' => 2 , 'g' => 1  );
// $data['call'][]  = array('nmb' => 3 , 'g' => 1  );
// $data['call'][]  = array('nmb' => 4 , 'g' => 1  );
// $data['call'][]  = array('nmb' => 5 , 'g' => 1  );
// $data['call'][]  = array('nmb' => 6 , 'g' => 1  );
// $data['call'][]  = array('nmb' => 7 , 'g' => 1  );





$json = json_encode( $data);

header("Content-type: application/json");
exit(  $json );


 ?>
