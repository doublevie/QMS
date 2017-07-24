<?php

setcookie("username", $_GET['user'], time()+3600*24);
setcookie("userpower", $_GET['power'], time()+3600*24);

sleep(2);
print 'ok';
 ?>
