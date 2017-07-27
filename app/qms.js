var Settings = {
  guichets : 1,
  adsvolume : 0,
}



frequency.getJSON('conf/json.php',function(conf){
Settings.guichets = conf.NOMBRE_GUICHETS;
Settings.nomFr = conf.NOM_SOCIETE;
Settings.tel = conf.TEL_SOCIETE;
Settings.cdn = conf.BASE_CDN;
Settings.echofiles = conf.BASE_AUDIO;
_('.soc').innerHTML = Settings.nomFr;
if (Settings.tel.length) _('.tel').innerHTML = 'TEL '+Settings.tel;
document.body.setAttribute(conf.THEME , '');
console.log(conf.THEME);
qms.initAd();
qms.jsonCall();

});


function pad( string) {
  return (3 <= string.length) ? string : pad('0' + string);
}

var timer;
var call = new Audio();
var qms = {
  data : [],
    ln : [3000,8000,12000,17000,22000,27000,32000,37000,42000,47000,52000],

jsonCall : function(){
frequency.getJSON('server/json.php',function(z){
    _('.countAll').innerText = z.count;
  var x = z.call;
timer = (z.count == '0' ?20000:qms.ln[x.length]);
qms.data = x;

var interv  ;
if (x && x.length) {
for (var i = 0; i < x.length; i++) {
  interv = (4200 * i )+ 500 ;
  console.log('interv'+interv);
qms.call(x[i].nmb,x[i].g,interv);

}
}
console.log('timerNow : '+timer);
window.setTimeout(function(){qms.jsonCall();},timer);
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
  {type:'video',src:'OPPO F1 Plus - Selfie Expert (FCB version).mp4',duration:'30000'} ,
  {type:'video',src:'Samsung Galaxy S8 Watching.mp4',duration:'16000'} ,
  {type:'video',src:'SampleVideo_1280x720_2mb.mp4',duration:'16000'} ,
  {type:'image',src:'samsung.jpg',duration:'5000'} ,
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
 _('video').src = Settings.cdn+qms.ads[qms.current].src ;
 _('video').volume = Settings.adsvolume;
  _('video').load();
  _('video').play() ;
 } ,
  muteVideo : function () {
   _('video').volume = 0.2;
  } ,
  repriseMutedVideo : function(){
    _('video').volume = Settings.adsvolume;
  },
 playImage : function() {
   qms.hideVideo();
 _('img.main').classList.add('show');
 _('img.main').src = Settings.cdn+qms.ads[qms.current].src ;
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
   var inner = (Settings.guichets == 1? '<div class="numberOnly "><small class="fr">NUMERO </small>'+pad(n)+'</div>':'<small>NUMERO </small>'+pad(n) +'<small>GUICHET </small>'+g)
   var inner2 = (Settings.guichets == 1? '<div class="numberOnly "><small class="fr"> </small>'+pad(n)+'</div>':'<small>NUMERO </small>'+pad(n) +'<small>GUICHET </small>'+g)
    a.innerHTML = inner2;
    b.innerHTML = inner;

call.src = Settings.echofiles+'call/'+n+'.ogg';
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


},3800);

 }

}















// test.init();
