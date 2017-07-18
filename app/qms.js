var Settings = {
  guichets : 1,
  echofiles : 'http://127.0.0.1/nmb/' ,
}

frequency.getJSON('conf/json.php',function(conf){
Settings.guichets = conf.NOMBRE_GUICHETS;
Settings.nomFr = conf.NOM_SOCIETE;
Settings.tel = conf.TEL_SOCIETE;
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


var call = new Audio();
var qms = {
  data : [],
    ln : [3000,8000,12000,17000,22000,27000,32000,37000,42000,47000,52000],
timer : 20000,
jsonCall : function(){
frequency.getJSON('server/json.php',function(z){
    _('.countAll').innerText = z.count;
  var x = z.call;
qms.data = x;
qms.timer = qms.ln[x.length];
var interv  ;
if (x && x.length) {
for (var i = 0; i < x.length; i++) {
  interv = (4200 * i )+ 500 ;
  console.log('interv'+interv);
qms.call(x[i].nmb,x[i].g,interv);

}
}
console.log('timerNow : '+qms.ln[x.length]);
window.setTimeout(function(){qms.jsonCall();},qms.ln[x.length]);
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
  {type:'image',src:'ad1.png',duration:'5000'} ,
  {type:'image',src:'ad2.png',duration:'5000'} ,
  {type:'image',src:'ad3.png',duration:'5000'},
  {type:'video',src:'SampleVideo_1280x720_2mb.mp4',duration:'13000'} ,
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
   var inner = (Settings.guichets == 1? '<div class="numberOnly"><small>NUMERO </small>'+pad(n)+'</div>':'<small>NUMERO </small>'+pad(n) +'<small>GUICHET </small>'+g)
   var inner2 = (Settings.guichets == 1? '<div class="numberOnly"><small>NUMERO </small>'+pad(n)+'</div>':'<small>NUMERO </small>'+pad(n) +'<small>GUICHET </small>'+g)
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
