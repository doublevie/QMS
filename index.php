<?php
include 'inc/main.php';
$ini = parse_ini_file("conf/qms.ini");
$Adresse = $ini["ADRESSE_SOCIETE"];
$printer = $ini["PRINTER"];
$sname = $ini["NOM_SOCIETE"];
$db = new SQLite3('server/data/queue.sqlite');
$today = date('Y-m-d');
$db->exec("DELETE FROM MAIN WHERE (DONE='0') AND (DATE NOT LIKE '$today%') ");


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bs5/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/b.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">

    <title>Borne</title>
</head>
<body>
    

<div class="pwhite">
  <div class="squares">
    <div class="square"></div>
    <div class="square"></div>
    <div class="square"></div>
    <div class="square"></div>
    <div class="square"></div>
    <div class="square"></div>
    <div class="square"></div>
    <div class="square"></div>
    <div class="square"></div>
    <div class="square"></div>
  </div>
</div>
<div class="grey"></div>
<div class="main">

<img src="assets/dz.png" style="position:fixed;left:10px;top:30px;width:200px;height:auto;opacity:0.1"  alt="">

<div class="rep text-warning">الجمهورية الجزائرية الديمقراطية الشعبية</div>
<br>
<div class="container">
  <div class="row">
    <div class="col-2"></div>
    
    <div class="col-8" align="center"><img class="logo" src="assets/logo.png" style="height:auto;width:300px;"></div>
    <div class="col-2"></div>
  </div>
</div>


<div class="minist text-white">الوكالة الوطنية للتشغيل</div>


<div class="backright animate__animated" onclick="reset()">
<img src="assets/right.png"/>
</div>

<br>

<div style="width:500px;margin:0 auto;">
<div class="extraBtns d-none gap-2 d-grid">

<button serviceBtn class="btn btn-dark text-warning btn-primary btn-lg animate__animated " onclick="subBtnc()"><h1>مصلحة طالبي العمل</h1></button>

<div class="extraSubBtns d-none gap-2 d-grid">
<?php
for ($i=0; $i < 2; $i++) { 
  print '<button subServiceBtn data-txt="'.$services[$i]['ar'].'" data-i="'.$i.'" onclick="newTicket(this,true)" class="btn btn-dark text-warning btn-primary btn-lg animate__animated "><h1>'.$services[$i]['ar'].'</h1></button>';
}
?>
</div>


<?php
for ($i=2; $i < count($services); $i++) { 
  print '<button serviceBtn data-txt="'.$services[$i]['ar'].'" data-i="'.$i.'" onclick="newTicket(this)" class="btn btn-dark text-warning btn-primary btn-lg animate__animated "><h1>'.$services[$i]['ar'].'</h1></button>';
}

?>




</div>


<div class="d-grid gap-2 mainBtn">
<button  class="btn btn-block btn-warning btn-lg animate__animated"  onclick="btnc()"  id="ticket"><h1>إضغط هنا<br> لسحب التذكرة</h1></button>

</div>


</div>
</div>

</body>

<script src="assets/js/frequency.min.js" charset="utf-8"></script>
<script>

const mainBtn = document.getElementById('ticket');
const serviceBtns =  document.querySelectorAll('[serviceBtn]');
const subServiceBtns =  document.querySelectorAll('[subServiceBtn]');
const backBtn = document.querySelector('.backright');


const mainAnimations = {
  in:'animate__zoomIn',
  out: 'animate__zoomOut'
}

const btnsAnimations = {
  in:'animate__fadeInUp',
  out: 'animate__fadeOutRight'
}



function btnc(){
  backBtn.classList.remove('d-none');
addClass(backBtn,'animate__fadeInRight');

_('.extraBtns').classList.remove('d-none');
mainBtn.classList.add(mainAnimations.out);
for (let i = 0; i < serviceBtns.length; i++) {
  const element = serviceBtns[i];
  element.classList.remove(btnsAnimations.out);
  element.classList.add(btnsAnimations.in);
}
}

function subBtnc(){
  _('.extraSubBtns').classList.remove('d-none');
  for (let i = 0; i < serviceBtns.length; i++) {
  const element = serviceBtns[i];
  element.classList.add(btnsAnimations.out);
  element.classList.remove(btnsAnimations.in);
}

for (let i = 0; i < subServiceBtns.length; i++) {
  const element = subServiceBtns[i];
  element.classList.remove('animate__rotateOutDownLeft');
  element.classList.add('animate__rotateInUpLeft');
}
}


function reset(subtoo){
  

  addClass(backBtn,'animate__fadeOutRight');
window.setTimeout(()=>{backBtn.classList.add('d-none');},1000)
  mainBtn.classList.remove(mainAnimations.out);
  mainBtn.classList.add(mainAnimations.in);
  for (let i = 0; i < serviceBtns.length; i++) {
    const element = serviceBtns[i];
    element.classList.remove(btnsAnimations.in);
    element.classList.add(btnsAnimations.out);
  }
  
if (subtoo) {
  for (let i = 0; i < subServiceBtns.length; i++) {
    const element = subServiceBtns[i];
    element.classList.remove('animate__rotateInUpLeft');
    element.classList.add('animate__rotateOutDownLeft');
  }
  _('.extraSubBtns').classList.add('d-none');
}

  window.setTimeout(function(){
    mainBtn.classList.remove(mainAnimations.in);
    _('.extraBtns').classList.add('d-none');
  },1000)
window.setTimeout(()=>{
  addClass(mainBtn,'animate__tada');
},1200)

}

function newTicket(btn,sub){
  const serviceI  = btn.dataset.i;
    btn.setAttribute("disabled","disabled");
    btn.innerHTML = '<span class="spinner-border spinner-border-sm" style="width:calc(1.375rem + 1.5vw);height:calc(calc(1.375rem + 1.5vw)" role="status" aria-hidden="true"></span>';
frequency.get('server/new.php?print=1'+'&s='+serviceI,(n)=>{
btn.innerHTML = '<h1>'+n.split(';;')[1]+'</h1>';
window.setTimeout(()=>{
    btn.innerHTML = '<h1>'+btn.dataset.txt+'</h1>';
    btn.removeAttribute('disabled');
},1000)


window.setTimeout(()=>{reset(sub)},1300);
})
}







function addClass(el,cls){
  el.classList.add(cls);
  window.setTimeout(()=>{
    el.classList.remove(cls);
  },800)
}








</script>
</html>