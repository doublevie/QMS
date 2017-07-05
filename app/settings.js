

function loadTab(x,el) {
  if (_('.activeTab')) _('.activeTab').classList.remove('activeTab');
  if (_('.currentLi')) _('.currentLi').classList.remove('currentLi');
  _('[data-tab="'+x+'"]').classList.add('activeTab');
  if (el) el.classList.add('currentLi');
}

window.onload = function(){
  loadTab(0);
// document.body.style.opacity = 1;
}



function save(el) {
var key = el.name , val = el.value;
console.log('key '+key+'; value='+val);


}
