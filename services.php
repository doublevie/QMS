<?php
include 'inc/main.php';
$ini = parse_ini_file("conf/qms.ini");
setcookie("NOM_SOCIETE", $ini["NOM_SOCIETE"], time()+3600*24*7);
setcookie("username", "ADMIN", time()+3600*24*7);
setcookie("userpower", "3", time()+3600*24*7);
setcookie("ADRESSE_SOCIETE", $ini["ADRESSE_SOCIETE"], time()+3600*24*7);
setcookie("PRINTER", $ini["PRINTER"], time()+3600*24*7);

if (isset($_COOKIE['G']) ) header('Location: g.php?g='.$_COOKIE['G']);


 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>PARAM</title>
    <link rel="stylesheet" href="bs5/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">

    <style media="screen">
.bord {background:#EEE}
body {font-family: 'Changa';}
.btnhandler2 {width:500px;margin :30px auto;}
div.big {height:50vh}
div.big h1 {font-size:20vh;line-height:30vh}
.card {margin-top:10px;}
.card-header {text-align:right;}
    </style>
    <script type="text/javascript" src="assets/js/frequency.min.js"></script>
  </head>
  <body style="background:var(--bs-warning)">

<?php include 'inc/nav.php' ?>
<br><br>




<div class="container">
<div class="row">


<?php 
for ($i=1; $i <count($gs) ; $i++) { 
    $service = $services[intval($gs[$i])]['ar'];
?>


<div class="col-4">
<div class="card">
<div class="card-header"><?php print $service;?></div>
<div class="card-body"><a href="g.php?g=<?php print $i;?>&save=1"><h1 align="center"><?php print $i;?></h1></a></div>
</div>
</div>

<?php } ?>

</div>
</div>






<script src="assets/js/frequency.min.js" charset="utf-8"></script>

  </body>
</html>
