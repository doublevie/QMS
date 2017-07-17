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
<p>SERVER STATUS : OK</p>
<p>NOMBRE DES GUICHETS : 6</p>
<p>DERNIER TICKET : <span class="tickets"></span></p>
<p>ERREURS : 0</p>


<a href="#" class="btn btn-block btn-danger btn-lg tickets" onclick="addTicket('.tickets')">ADD</a>






</div>

<div class="col-sm-8 bord" style="border-left:none;">

  <a href="#" class="btn btn-block btn-success btn-big1 btn-lg" onclick="callNext(this)">CALL</a>

</div>





</div>




<script src="assets/js/frequency.min.js" charset="utf-8"></script>

<script type="text/javascript">
var canAdd = true , canCall = true;
function addTicket(ss) {
  if (canAdd) {
    canAdd = false;
    frequency.get('server/new.php',function(x){
      var sel = document.querySelectorAll(ss);
      for (var i = 0; i < sel.length; i++) {
        sel[i].innerText = x;
      }

      window.setTimeout(function(){canAdd = true;},1000);
    });
  }

}
function callNext(sel) {
  if (canCall) {
canCall = false;
frequency.get('server/callnext.php',function(x){
  sel.innerText = x;
  console.log(x);
  window.setTimeout(function(){canCall = true;},100);
});
  }
}


function init(){
  frequency.get('server/check.php',function(z){
console.log(z.ECHO);
 // var lasEcho = (z.ECHO !== null ? z.ECHO : 0);
 var lasEcho =  z.ECHO ;
_('.tickets').innerText = lasEcho;
console.log(lasEcho);



  });
  window.setTimeout(function(){
init();
  },20000);
}


init();



</script>
  </body>
</html>
