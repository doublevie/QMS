<?php
include 'inc/strings.php';
$ini = parse_ini_file("conf/qms.ini");
$Adresse = $ini["ADRESSE_SOCIETE"];
$printer = $ini["PRINTER"];
$sname = $ini["NOM_SOCIETE"];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bs5/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/b.css">
    <title>Borne</title>
</head>
<body>
    
<div class="title"><?php print $sname;?></div>
<div class="subtitle">sub</div>

<br><br>

<div style="width:500px;margin:0 auto;">

<button data-txt="<?php print $str['demander_ticket'];?>" class="btn btn-block btn-warning btn-lg" id="ticket"><h1><?php print $str['demander_ticket'];?></h1></button>
</div>


</body>

<script src="assets/js/frequency.min.js" charset="utf-8"></script>
<script>

const btn = document.getElementById('ticket');

btn.addEventListener('click',newTicket);


function newTicket(){
    btn.setAttribute("disabled","disabled");
    btn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';
frequency.get('server/new.php?print=1',(n)=>{
btn.innerHTML = n;
window.setTimeout(()=>{
    btn.innerHTML = btn.dataset.txt;
    btn.removeAttribute('disabled');
},1000)

})
}
















</script>
</html>