<?php
require "user.php";
$ini = parse_ini_file("conf/qms.ini");

setcookie("NOM_SOCIETE", $ini["NOM_SOCIETE"], time()+3600*24*7);
setcookie("ADRESSE_SOCIETE", $ini["ADRESSE_SOCIETE"], time()+3600*24*7);
// setcookie("TEL_SOCIETE ", $ini["TEL_SOCIETE"], time()+3600*24*7);
setcookie("PRINTER", $ini["PRINTER"], time()+3600*24*7);
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>PARAM</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <style media="screen">
.bord {border:1px solid rgba(0,0,0,0.1);min-height:80vh;padding:15px;}
    </style>
    <script type="text/javascript" src="assets/js/frequency.min.js"></script>
  </head>
  <body>

<?php include 'inc/menu.php' ?>

<div class="container">
<div class="col-sm-4 bord">
<p>ETAT DE SERVEUR :<span class="status"></span></p>
<!-- <p>NOMBRE DES GUICHETS : 6</p> -->
<p>NUMERO : <span class="now"></span></p>
<p>DERNIER TICKET : <span class="tickets"></span></p>
<p>ERREURS : 0</p>


<!-- <a href="#" class="btn btn-block btn-danger btn-lg tickets" onclick="addTicket('.tickets')">ADD</a> -->

</div>

<div class="col-sm-8 bord" style="border-left:none;">
  <a href="#" class="btn btn-block btn-info btn-big1 btn-lg tickets" >-</a>
  <a href="#" class="btn btn-block btn-success btn-big1 btn-lg now" onclick="callNext('.now')">CALL</a>
</div>


</div>




<script src="assets/js/frequency.min.js" charset="utf-8"></script>

<script type="text/javascript">
var canAdd = true , canCall = true;
var p1 , p2 , time;
function addTicket(ss) {
  if (canAdd) {
  //  p1 = performance.now();
    canAdd = false;
    frequency.get('server/new.php',function(x){
      var sel = document.querySelectorAll(ss);
      for (var i = 0; i < sel.length; i++) {
        sel[i].innerText = x;
      }
      // p2 = performance.now();
      // time = Math.round(p2 - p1);
      //   console.log(time);
      window.setTimeout(function(){canAdd = true;},1000);
    });
  }

}
function callNext(ss) {
  if (canCall) {
canCall = false;
frequency.get('server/callnext.php',function(x){
   document.title = 'NUMERO '+x ;
   var sel = document.querySelectorAll(ss);
   if (x && x.length) {

   for (var i = 0; i < sel.length; i++) {
     sel[i].innerText = x;
   }
 }

  window.setTimeout(function(){canCall = true;},100);
});
  }
}


function init(){
    p1 = performance.now();
  frequency.getJSON('server/check.php',function(res){
console.log(res);
 var lasEcho =  res.last ;
 var echo =  res.echo ;
 var status =  res.status ;


document.querySelectorAll('.tickets')[0].innerText = lasEcho;
document.querySelectorAll('.tickets')[1].innerText = lasEcho;
document.querySelectorAll('.now')[0].innerText = echo;
document.querySelectorAll('.now')[1].innerText = echo;

_('.status').innerText = status;

p2 = performance.now();
time = Math.round(p2 - p1);
  console.log(time);
  });
  window.setTimeout(function(){
init();
  },20000);
}


init();



</script>
  </body>
</html>
