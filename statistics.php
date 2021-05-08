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


    </style>
    <script type="text/javascript" src="assets/js/frequency.min.js"></script>
  </head>
  <body style="background:var(--bs-light)">

<?php include 'inc/nav.php' ?>

<div class="rightPan">

<div class="inner">

<select name="" id="byService" class="form-select" onchange="s.buildres()">
    <option value="-1">كل الفروع</option>
<?php
for ($i=0; $i < count($services) ; $i++) { 
  print '<option value="'.$i.'">'.$services[$i]['ar'].'</option>';
}
?>

</select>
<br>
<select name="" id="byGui" class="form-select" onchange="s.buildres()">
    <option value="-1"> كل الشبابيك</option>
<?php
for ($i=1; $i < count($gs) ; $i++) { 
  print '<option value="'.$i.'">شباك  '.$i.'</option>';
}
?>

</select>


<hr>
<br>
<input type="date" onchange="s.init()" id="from" class="form-control" value="<?php print date('Y-m-d');?>"><br>
<input type="date" onchange="s.init()" id="to" class="form-control" value="<?php print date('Y-m-d');?>"><br>
<div class="d-grid gap-2">

<a class="btn btn-success btn-block"  download="qms-<?php print date('d-m-Y');?>.xls" onclick="return ExcellentExport.excel(this, 'datatable', 'QMS-<?php print date('d-m-Y');?>');" > تخزين</a>
<a class="btn btn-danger btn-block" href="?logout=1">تسجيل خروج</a>
</div>
</div>


</div>


<div class="mainPan">






<div class="row">

<div class="col-6">
    <div class="card" dir="rtl">
<div class="card-header bg-warning">معدل وقت اللإنتظار</div>
<div class="card-body">
<h1 align="center" id="waitTime"></h1>

</div>
    </div>
</div>

<div class="col-6">
<div class="card" dir="rtl">
<div class="card-header bg-warning"> المجموع </div>
<div class="card-body">
<h1 align="center" id="total"></h1>

</div>
    </div>
</div>

<div class="col-12">
<table class="table table-bordered" dir="rtl" id="datatable">
<thead>

<tr class="d-none">
<th>التاريخ</th>
<th colspan="2" id="date"></th>
<th>الخدمة</th>
<th colspan="2" id="srv"></th>

</tr>
<tr>
<th>الرقم</th>
<th>شباك</th>
<th width="140px">تاريخ</th>
<th>الوقت</th>
<th>المناداة</th>
<th>الوقت</th>
</tr>

</thead>
<tbody id="details">


</tbody>
</table>


</div>


</div>

</div>



<script src="assets/js/frequency.min.js" charset="utf-8"></script>
<script src="assets/js/moment.min.js" charset="utf-8"></script>
<script src="assets/js/excellentexport.js" charset="utf-8"></script>
<script>

var s = {
    list: [],
begin : _('#from'),
to : _('#to'),
init:()=>{
    frequency.getJSON('server/jsons.php?b='+s.begin.value+'&e='+s.to.value , (res)=>{
console.log(res);
s.list = res;
_('#date').innerText = s.begin.value + ' - '+ s.to.value;
s.buildres();
    })
},
buildres : ()=>{
let byGui = parseInt(_('#byGui').value) , 
byService = _('#byService').value  ,
list = s.list;
srv.innerText = selectedText(_('#byGui')) + ' '+ selectedText(_('#byService'));
if (byGui != -1) {
    list = s.list.filter((x)=>{return parseInt(x.GUI) == byGui});
}

if (byService !== '-1') {
    list = s.list.filter((x)=>{return x.SERVICE == byService});
}




let detailsHtml  = '' , d1 , d2 , t1,t2 , diff , totalTime =0;

list.forEach(el => {
    t1 = moment(el.DATE);
    t2 = moment(el.DONE);
    totalTime += t2.diff(t1, 'seconds');
    diff = t2.diff(t1, 'minutes'); 
    detailsHtml += '<tr><td>'+el.ECHO+'</td><td>'+el.GUI+'</td><td>'+t1.format('YYYY/MM/DD')+'</td><td>'+t1.format('hh:mm')+'</td><td>'+t2.format('hh:mm')+'</td><td>'+diff+' "</td></tr>';
});

_('#details').innerHTML = detailsHtml;

totalTime = totalTime / (list.length * 60);
if (isNaN(totalTime)){ 
    totalTime = ' - ';
} else {
    totalTime = totalTime.toFixed(1);
    totalTime +=' دقيقة'
}
_("#waitTime").innerText =  totalTime;
_("#total").innerText =  list.length;


}


}


function selectedText(sel) {
  return sel.options[sel.selectedIndex].text;
}

s.init();

</script>
  </body>
</html>
