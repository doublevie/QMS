<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>PARAM</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <script type="text/javascript" src="assets/js/frequency.min.js"></script>


  </head>
  <body amber>

<?php include 'inc/menu.php' ?>
<div class="container">
<div class="row">
<div class="col-sm-4 bord" style='padding:0'>
  <ul class="settingsUl">
  <li onclick="loadTab(0,this)"><i class="fa fa-cog"></i> GENERAL</li>
  <li onclick="loadTab(1,this)"><i class="fa fa-desktop"></i> AFFICHAGE</li>
  <li onclick="loadTab(2,this)"><i class="fa fa-puzzle-piece"></i> EXTRA</li>
  <li onclick="loadTab(3,this)"><i class="fa fa-user"></i> COMPTES</li>
  <li onclick="loadTab(4,this)"><i class="fa fa-cog"></i> FREUENCY</li>
  </ul>
</div>
<div class="col-sm-8 bord" style="border:none">
<div class="settingsWell" data-tab="0">
  <div class="inner">
<h1>GENERAL</h1>
<table class="settingsTable">
<tr>
  <td>SOCIETE</td>
  <td><input type="text" class="form-control" name="NOM_SOCIETE" value="" onkeyup="save(this)"></td>
</tr>

<tr>
  <td>ADRESSE</td>
  <td><input type="text" class="form-control" name="ADRESSE_SOCIETE" value="" onkeyup="save(this)"></td>
</tr>

<tr>
  <td>TEL</td>
  <td><input type="text" class="form-control" name="TEL_SOCIETE" value="" onkeyup="save(this)"></td>
</tr>

<tr>
  <td>NOMBRE DES GUICHETS</td>
  <td><input type="number" class="form-control" name="NOMBRE_GUICHETS" value="" onkeyup="save(this)"></td>
</tr>

</table>
  </div>
</div>
<div class="settingsWell" data-tab="1">
  <div class="inner">
    <h1>AFFICHAGE </h1>


    <table class="settingsTable">
      <tr>
        <td>TYPE D'AFFICHEGE</td>
        <td>
<select class="form-control" name="DISPLAYTYPE"  onchange="save(this)">
<option value="V">Affichege vertical</option>
<option value="H">Affichege horizontal</option>
</select>
        </td>
      </tr>

      <tr>
        <td>THEME</td>
        <td>
<select class="form-control" name="THEME"  onchange="save(this)">
<option value="amber">ORANGE</option>
<option value="green">VERT</option>
<option value="rouge">ROUGE</option>
</select>
        </td>
      </tr>




</table>

  </div>
</div>
<div class="settingsWell" data-tab="2">
  <div class="inner">
    <h1>EXTRA </h1>
  </div>
</div>

<div class="settingsWell" data-tab="3">
  <div class="inner">
    <h1>COMPTES </h1>
  </div>
</div>

<div class="settingsWell" data-tab="4">
  <div class="inner">
    <h1>FREQUENCY </h1>
  </div>
</div>











</div>

</div>
</div>
<script type="text/javascript" src="app/settings.js">

</script>






  </body>
</html>
