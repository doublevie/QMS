

function loadTab(x) {
  if (_('.activeTab')) _('.activeTab').classList.remove('activeTab');
  _('[data-tab="'+x+'"]').classList.add('activeTab');
}

window.onload = function(){loadTab(0)}
