<?php

if (isset($_GET['g']) && isset($_GET['save'])) setcookie("G", $_GET['g'], time()+3600*24*7*100);

include 'inc/main.php';





$g = '1';
if (isset($_GET['g'])) $g = $_GET['g'];
$serviceI =  $gs[intval($g)];
if (isset($_REQUEST['service'])) $serviceI = intval($_REQUEST['service']);
$service = $services[$serviceI];


$g = str_pad($g, 2, "0", STR_PAD_LEFT);




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
    </style>
    <script type="text/javascript" src="assets/js/frequency.min.js"></script>
  </head>
  <body style="background:var(--bs-warning)">

<?php include 'inc/nav.php' ?>

<div class="container">
<div class="row">

<div class="col-4 big">
<div align="center"  >
<h4>الشباك</h4>
<h1 ><?php print $g;?></h1>
</div>
</div>


<div class="col-4 big">
<div align="center"  class="text-dark">
<h4>العدد المتبقي</h4>
<h1 count></h1>
</div>
</div>
<div class="col-4 big">

<div align="center"  class="text-white">
<h4>الرقم الحالي</h4>
<h1 echo></h1>
</div>

</div>

<div class="col-3"></div>
<div class="col-6">
<div class="btnhandler gap-2 d-grid">

<button class="btn btn-lg btn-block btn-info" onclick="callNext()" id="next">
<h1>التالي</h1>
</button>

<br>

<h2 align="center" ondblclick="changeService()"><?php print $service['ar'];?></h2>

<select name="" id="changeService" onchange="switchService(this.value)" class="form-control d-none" dir="rtl">
<?php

for ($i=0; $i <count($services) ; $i++) { 
 print '<option value="'.$i.'"   '.($i == $serviceI ? 'selected':'').'>'.$services[$i]['ar'].'</option>';
}

?>

</select>
</div>
</div>
<div class="col-3"></div>

</div>
</div>






<script src="assets/js/frequency.min.js" charset="utf-8"></script>

<script>
const gnumber = '<?php print $g;?>' , gservice = <?php print $serviceI;?>;

function init(ft){
    frequency.getJSON('server/check.php?si='+gservice,function(res){
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
frequency.get('server/callnext.php?g='+gnumber+'&service='+gservice,function(x){
    console.log(x)
   document.title = 'NUMERO '+x ;
 
  window.setTimeout(function(){canCall = true;  _('#next').innerHTML = '<h1>التالي</h1>';},1000);
  init();
});
  }
 }


function changeService(){
  let ch = document.getElementById('changeService');
  ch.classList.toggle('d-none');
}



function switchService(val){
  window.location.href = "g.php?g="+gnumber+"&service="+val;
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
