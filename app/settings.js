

function loadTab(x,el) {
  if (_('.activeTab')) _('.activeTab').classList.remove('activeTab');
  if (_('.currentLi')) _('.currentLi').classList.remove('currentLi');
  _('[data-tab="'+x+'"]').classList.add('activeTab');
  if (el) el.classList.add('currentLi');
}

window.onload = function(){
  loadSettings();
  loadTab(0);
}



function save(el) {
var key = el.name , val = el.value;
frequency.post('conf/save.php','key='+key+'&val='+val,function(z){
  if (z !== '1') alert('z');
  console.log(z+' '+key) ;
});
}



function loadSettings(){
  frequency.getJSON('conf/json.php',function(e){
console.log(e);
_('[name="NOM_SOCIETE"]').value = e.NOM_SOCIETE;
_('[name="ADRESSE_SOCIETE"]').value = e.ADRESSE_SOCIETE;
_('[name="TEL_SOCIETE"]').value = e.TEL_SOCIETE;
_('[name="DISPLAYTYPE"]').value = e.DISPLAYTYPE;
_('[name="NOMBRE_GUICHETS"]').value = e.NOMBRE_GUICHETS;
_('[name="THEME"]').value = e.THEME;
_('[name="MAXNUMBER"]').value = e.MAXNUMBER;
  });
}
