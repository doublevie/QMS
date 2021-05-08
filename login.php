<?php
include 'inc/main.php';
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Statistiques</title>
    <link rel="stylesheet" href="bs5/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
<style>
.card.login {
  width:400px;
  margin-top:30vh;
}
</style>
    <style media="screen">



    </style>
    <script type="text/javascript" src="assets/js/frequency.min.js"></script>
  </head>
  <body style="background:var(--bs-light)">

<?php include 'inc/nav.php' ?>



<div align="center">
<div class="card login">
<div class="card-header bg-primary text-white">تسجيل الدخول</div>
<div class="card-body">
<div class="alert alert-danger d-none">كلمة السر غير مطابقة</div>
<br>
<form action="" method="get" id="login">
<input type="password" class="form-control pass" autofocus="true" placeholder="كلمة السر">

<br>

<button type="submit" class="btn btn-block btn-danger" dir="rtl"><i class="fa fa-sign-in"></i> تسجيل الدخول</button>
</form>


</div>
</div>
</div>





<script src="assets/js/frequency.min.js" charset="utf-8"></script>
<script>

var form = _('#login') , 
realPass = '<?php print $adminpass;?>' ,alert=_('.alert-danger');

form.addEventListener('submit',function(z){
  z.preventDefault();
  let pass = _('.pass').value;
  if (pass == realPass) {
    frequency.post(window.location.href , 'pass='+pass,function(r){
      window.location.reload();
    })

  } else {
alert.classList.remove('d-none');
_('.pass').value = '';

  }
  
})

</script>
  </body>
</html>
