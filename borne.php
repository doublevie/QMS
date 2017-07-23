<?php
$ini = parse_ini_file("conf/qms.ini");
$header  = $ini["NOM_SOCIETE"];
$Adresse = $ini["ADRESSE_SOCIETE"];
$printer = $ini["PRINTER"];


setcookie("NOM_SOCIETE", $ini["NOM_SOCIETE"], time()+3600*24*7);
setcookie("ADRESSE_SOCIETE", $ini["ADRESSE_SOCIETE"], time()+3600*24*7);
 setcookie("PRINTER", $ini["PRINTER"], time()+3600*24*7);

 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>
    </title>


    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/borne.css">

<div class="headerDiv">
<div class="infos">

</div>

<div class="clock">

</div>

<div class="last">

</div>

</div>


<div class="buttonDiv">
<button type="button" name="button" class="btn btn-info btn-lg btn-block">Demande ticket</button>
</div>
  </head>
  <body>




  </body>
</html>
