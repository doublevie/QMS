<?php
// if (isset($_COOKIE["username"]) && $_COOKIE["username"] != null) die($_COOKIE["username"]);
if (isset($_COOKIE["username"]) && $_COOKIE["username"] != null) die('<script type="text/javascript">window.location.href="main.php";</script>');

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
    <link rel="stylesheet" href="assets/css/animate.css">
     <style media="screen">
body {
  background: #FAFAFA;
}

.logdiv , .welcome {position: fixed;left:0;right:0;top:30vh;}
.welcome {text-align: center;height:40vh;line-height: 40vh;font-size: 12vh;opacity:0;pointer-events: none;font-weight: 100}
.panel {width:500px;margin: 0 auto;}
.alert {border-radius: 0;position: fixed;bottom: 0;left:0;right:0;margin:0;text-align: center;opacity: 0;pointer-events: none;}
.alert.show , .welcome.show {opacity: 1;pointer-events: auto;}

    </style>
    <script type="text/javascript" src="assets/js/frequency.min.js"></script>
  </head>
  <body>

<div class="alert error alert-danger" role="alert"> <i class="fa fa-exclamation-triangle"></i> Mot de passe incorrect</div>


<div class="welcome">
Bonjour
</div>

<div class="logdiv">

  <div class="panel panel-default  ">
    <div class="panel-heading">Connexion</div>
    <div class="panel-body">
<form class="loginform" action="login" method="post">

<select class="form-control userSelect" name="user">
<option value="0" pass="4a7d1ed414474e4033ac29ccb8653d9b" power="3"> ADMIN</option>
<option value="1" pass="4a7d1ed414474e4033ac29ccb8653d9b" power="3"> ADMIN 2</option>
</select>

<br>

<input type="password"  class="form-control" name="pass" value="" required>

<br>

<button type="submit"  class="btn btn-info connect" name="button">Connexion</button>





</form>
    </div>
  </div>
</div>





<script src="assets/js/frequency.min.js" charset="utf-8"></script>
<script src="assets/js/md5.min.js" charset="utf-8"></script>

<script type="text/javascript">

var passField = _('[name="pass"]'), userselect = _('.userSelect') , welcome = _('.welcome') , tries = 0 , maxtries = 5;


function checkPassword(){
var pass = passField.value ,
pass2 = userselect.options[userselect.selectedIndex].getAttribute('pass'),
userPower = userselect.options[userselect.selectedIndex].getAttribute('power'),
userName = userselect.options[userselect.selectedIndex].innerText;

if (md5(pass) == pass2) {
  console.info('password correct !');
  _('.panel').classList.add('flipOutY');
  _('.panel').classList.add('animated');
  window.setTimeout(function(){
_('.panel').remove();
welcome.classList.add('show');
welcome.classList.add('animated');
welcome.classList.add('flipInX');
frequency.get('set.php?user='+userName+'&power='+userPower ,function(z){window.location.href = "main.php"});
  },600);
} else {
  wrongPassword();
}



}


function wrongPassword(){
tries ++;
if (tries == maxtries) window.close();
passField.value = "";
_('.error').classList.add('show');
_('.connect').classList.remove('btn-info');
_('.connect').classList.add('btn-danger');
window.setTimeout(function(){
  _('.error').classList.remove('show');
_('.connect').classList.add('btn-info');
_('.connect').classList.remove('btn-danger');
},3000);
}

_('.loginform').onsubmit = function(e){
  e.preventDefault();
  checkPassword();
  return false;
};


window.onkeypress = function(e){
  _('[name="pass"]').focus();
}
</script>

  </body>
</html>
