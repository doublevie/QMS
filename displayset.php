<?php
include 'inc/main.php';
if (isset($_GET['logout']) && $_GET['logout'] == '1') {
    setcookie("password", '', time()-(3600*24*7));
    header("Location: statistics.php");
    }
if (isset($_POST['pass']) && $_POST['pass'] == $adminpass) {
setcookie("password", $_POST['pass'], time()+3600*24*7);
}

if (!isset($_COOKIE['password']) || $_COOKIE['password'] !== $adminpass) {
    include 'login.php';
    die();
}
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Statistiques</title>
    <link rel="stylesheet" href="bs5/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <style media="screen">
.rightPan {
    position:fixed;
    right:0;top:56px;
    bottom:0;
    width:270px;
    border-right:1px solid rgba(0,0,0,0.15);
    background:#fff;
    box-shadow: -4px 2px 31px -9px rgba(0,0,0,0.75);
    z-index:9;
}
.rightPan .inner {
    padding:10px;
}
.mainPan {
    position:fixed;
    left:0;right:0;
    top:56px;
    padding-right:280px;
    height:calc(100vh - 56px);
    overflow-y:scroll;
}
.card{margin-top:8px;margin-bottom:8px}
.dimage {width:100%}

.selectedCard .dimage {filter: grayscale(100%);}

    </style>
    <script type="text/javascript" src="assets/js/frequency.min.js"></script>
  </head>
  <body style="background:var(--bs-light)">

<?php include 'inc/nav.php' ?>

<div class="rightPan">

<div class="inner">


<div class="d-grid gap-2">
<button class = "btn btn-block btn-success">ADD</button>
 
</div>

<hr>

<div class="d-grid gap-2">
<button class = "btn btn-block btn-danger">DELETE</button> 
</div>






<br>
 
</div>
</div>


</div>


<div class="mainPan">



<div class="row">

<div class="col col-4">
<div class="card">
<div class="card-body " onclick="selectDiv(this)" data-filename="">
<img src="ad/2.jpg" class="rounded mx-auto d-block dimage" alt="" >
</div>
</div>
</div>



</div>





 
</div>

 
    </div>
</div>

 


</div>

</div>



<script src="assets/js/frequency.min.js" charset="utf-8"></script>


<script>


function selectDiv(el){
let prev = _('.selectedCard');
if (prev) prev.classList.remove('selectedCard');
el.classList.add('selectedCard');
}



function deleteImage() {
    let prev = _('.selectedCard');

}



</script>
  </body>
</html>
