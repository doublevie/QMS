<?php 
include 'inc/main.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="bs5/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/h2.css">
  </head>
  <body>

<div class="containe bg-dark">
<div class="row">

  <div class="col-9">
    
    
    <div class="title  text-light amiri ">
      الجمهورية الجزائرية الديمقراطية الشعبية
      <br>

      الوكالة الوطنية للتشغيل
      </div>
    </div>
          <div class="col-3">
          <img src="assets/logo.png" align="center" id="logo" alt="">
          
          </div>
</div>
</div>

<div class="topInfos">
<div class="row">

<div class="col" align="center">مكتب سطيف</div>
<div class="col" align="center"><span class="fulldate"></span></div>
<div class="col" align="center"><span  clock></span></div>
<div class="col" align="center">العدد المتبقي <span countAll  class="nmb"></span></div>

</div>

</div>


<video src="" class="d-none video"></video>
<div class="rightBar bg-light">




<div class="number s1 nmb">
  <span class="nmb">I000</pan><br><span class="g">  </span>
</div>
<div class="number s2 nmb">
  <span class="nmb">O000</pan><br><span class="g">  </span>
</div>


<div class="number s3 nmb">
  <span class="nmb">E000</pan><br><span class="g">  </span>
</div>
<div class="number s4 nmb">
  <span class="nmb">D000</pan><br><span class="g">  </span>
</div>





</div>

<div class="main"><img class="main" alt=""></div>

<div class="frequency">
    FREQUENCY
</div>

  </body>

<script>
<?php
$jsa = json_encode($services);
echo "var jsServ = ". $jsa . ";\n";
?>


</script>
  <script type="text/javascript" src="assets/js/frequency.min.js"></script>
  <script type="text/javascript" src="app/moment.js"></script>
  <script type="text/javascript" src="app/qms2.js"></script>

  <script type="text/javascript">
 
 qms.fullDate();
qms.clock('[clock]')




  </script>
</html>
