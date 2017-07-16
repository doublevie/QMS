<?php

$data = Array();


// $data[]  = array('nmb' => 1 , 'g' => 1  );
// $data[]  = array('nmb' => 2 , 'g' => 1  );
// $data[]  = array('nmb' => 3 , 'g' => 1  );
// $data[]  = array('nmb' => 4 , 'g' => 1  );
// $data[]  = array('nmb' => 5 , 'g' => 1  );
// $data[]  = array('nmb' => 6 , 'g' => 1  );
// $data[]  = array('nmb' => 7 , 'g' => 1  );





$json = json_encode( $data);

header("Content-type: application/json");
exit(  $json );


 ?>
