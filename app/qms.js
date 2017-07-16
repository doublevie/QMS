var Settings = {
  guichets : 1,
}

frequency.getJSON('conf/json.php',function(conf){
Settings.guichets = conf.NOMBRE_GUICHETS;
Settings.nomFr = conf.NOM_SOCIETE;
Settings.tel = conf.TEL_SOCIETE;
_('.soc').innerHTML = Settings.nomFr;
if (Settings.tel.length) _('.tel').innerHTML = 'TEL '+Settings.tel;


qms.jsonCall();
});



var call = new Audio();
var qms = {
  data : [],
    ln : [3000,5000,10000,15000,20000,25000,30000,35000],
timer : 20000,
jsonCall : function(){
frequency.getJSON('server/json.php',function(z){
  var x = z.call
qms.data = x;
qms.timer = qms.ln[x.length];
console.log('timer'+qms.timer);
var interv  ;
if (x && x.length) {
for (var i = 0; i < x.length; i++) {
  interv = 4200 * i ;

qms.call(x[i].nmb,x[i].g,interv);
console.log(i);
}
}
window.setTimeout(function(){qms.jsonCall()},qms.ln[x.length]);
});

} ,
call : function(n,g,interv) {
  window.setTimeout(function(){

 qms.showNumber(n, g);
  },interv);
} ,

clock : function(el) {
var d = new Date(), dm = d.getMinutes() , dh = d.getHours();
dh = qms.checkTime(dh) ;
dm = qms.checkTime(dm) ;
var clock = dh + '<span>:</span>' + dm;
    _(el).innerHTML = clock;
window.setTimeout(function(){qms.clock(el)},60000);
} ,
 checkTime : function(i) {if (i < 10) {i = "0" + i}; return i;},
 fullDate : function (){

     var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' } ,
     date = new Date();
      _('.fulldate').innerHTML =   date.toLocaleDateString("fr-FR",options);
 },
current : -1,
ads: [
  {type:'image',src:'freq.jpg',duration:'7000'} ,
  {type:'image',src:'ad1.png',duration:'5000'} ,
  // {type:'video',src:'small.mp4',duration:'18000'} ,
],

 hideVideo : function(){
   _('video').classList.remove('show');
   _('video').pause();
 } ,
 hideImge : function() {
   _('img.main').classList.remove('show');
 } ,
 playVideo : function () {
   qms.hideImge();
 _('video').classList.add('show');
 console.log(qms.ads[qms.current].src);
 _('video').src = 'ad/'+qms.ads[qms.current].src ;
  _('video').load();
  _('video').play() ;
 } ,
  muteVideo : function () {
   _('video').volume = 0.2;
  } ,
  repriseMutedVideo : function(){
    _('video').volume = 1;
  },
 playImage : function() {
   qms.hideVideo();
 _('img.main').classList.add('show');
 _('img.main').src = 'ad/'+qms.ads[qms.current].src ;
 } ,
 initAd : function() {
qms.current++;
if (qms.current == qms.ads.length) qms.current = 0;
var cu = qms.ads[qms.current];
if (cu.type == 'video') {qms.playVideo(qms.current);}
if (cu.type == 'image') {qms.playImage(qms.current);}

window.setTimeout(function(){
qms.initAd()
},cu.duration);

 } ,


 showNumber : function(n,g) {
var p1 = performance.now() , p2 , time;
   if (qms.ads[qms.current].type == 'video') qms.muteVideo();
   var a = _('.smallNumber') , b =  _('.showNumber');
   var inner = (Settings.guichets == 1? '<div class="numberOnly"><small>NUMERO </small>'+n+'</div>':'<small>NUMERO </small>'+n +'<small>GUICHET </small>'+g)
   var inner2 = (Settings.guichets == 1? '<div class="numberOnly"><small>NUMERO </small>00'+n+'</div>':'<small>NUMERO </small>00'+n +'<small>GUICHET </small>'+g)
    a.innerHTML = inner2;
    b.innerHTML = inner;



call.src = 'call/'+n+'.ogg';
call.load();
call.play();
p2 = performance.now() ; time = Math.round(p2 - p1);
// console.log(time);
   b.classList.remove('show');
   ramjet.transform( a, b, {
  done: function () {
     b.classList.add('show');
    // this function is called as soon as the transition completes
  }
});

window.setTimeout(function(){
   if (qms.ads[qms.current].type == 'video') qms.repriseMutedVideo();
   b.classList.remove('show');
   ramjet.transform( b, a, {
  done: function () {
     // this function is called as soon as the transition completes
     b.classList.remove('show');
  }
});


},4000);

 }

}

qms.initAd();










var test = {
  begin : 0 ,
  end : 10,
init : function(){
test.begin += 1;
 if (test.begin <= test.end) {
qms.showNumber(test.begin);
 } else {
test.begin = 0;
 }
window.setTimeout(function(){test.init()},5000);

}
}

// test.init();
