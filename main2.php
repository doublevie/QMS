<?php
$ini = parse_ini_file("conf/qms.ini");

setcookie("NOM_SOCIETE", $ini["NOM_SOCIETE"], time()+3600*24*7);
setcookie("username", "ADMIN", time()+3600*24*7);
setcookie("userpower", "3", time()+3600*24*7);
setcookie("ADRESSE_SOCIETE", $ini["ADRESSE_SOCIETE"], time()+3600*24*7);
setcookie("PRINTER", $ini["PRINTER"], time()+3600*24*7);
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>PARAM</title>
    <link rel="stylesheet" href="bs5/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">

    <style media="screen">
.bord {background:#EEE}
.btnhandler2 {width:500px;margin :30px auto;}
div.big {height:50vh}
div.big h1 {font-size:20vh;line-height:30vh}
    </style>
    <script type="text/javascript" src="assets/js/frequency.min.js"></script>
  </head>
  <body>

<?php include 'inc/nav.php' ?>

<div class="container">
<div class="row">
<div class="col-2 big"></div>
<div class="col-4 big">
<div align="center"  class="text-success">
<h4>TOTAL</h4>
<h1 count></h1>
</div>
</div>
<div class="col-4 big">

<div align="center"  class="text-primary">
<h4>NUMERO</h4>
<h1 echo></h1>
</div>

</div>
 <div class="col-2 big"></div>
<div class="col-3"></div>
<div class="col-6">
<div class="btnhandler">
<button class="btn btn-lg btn-block btn-secondary" onclick="callNext()" id="next">
<h1>SUIVANT</h1>
</button>
</div>
</div>
<div class="col-3"></div>

</div>
</div>






<script src="assets/js/frequency.min.js" charset="utf-8"></script>

<script>


function init(ft){
    frequency.getJSON('server/check.php',function(res){
        console.log(res)
_('[count]').innerText  = res.COUNT;
_('[echo]').innerText  = res.echo;

    });
  if (ft)  window.setTimeout(()=>{init(true)},6000);
}

var canCall = true , canAdd = true;
 function callNext() {
    if (canCall) {
        _('#next').innerHTML = '  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';
canCall = false;
frequency.get('server/callnext.php',function(x){
    console.log(x)
   document.title = 'NUMERO '+x ;
 
  window.setTimeout(function(){canCall = true;  _('#next').innerHTML = '<h1>SUIVANT</h1>';},1000);
  init();
});
  }
 }




init(true);




function addTicket(ss) {
  if (canAdd) {
  //  p1 = performance.now();
    canAdd = false;
    frequency.get('server/new.php?print=1',function(x){


      window.setTimeout(function(){canAdd = true;},1000);
init();      
    });
  }

}


</script>

  </body>
</html>
