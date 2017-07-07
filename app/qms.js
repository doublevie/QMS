var call = new Audio();
var qms = {
clock : function(el) {
var d = new Date(), dm = d.getMinutes() , dh = d.getHours();
dh = qms.checkTime(dh) ;
dm = qms.checkTime(dm) ;
var clock = dh + '<span>:</span>' + dm;
    _(el).innerHTML = clock;
window.setTimeout(function(){qms.clock(el)},60000);
} ,
 checkTime : function(i) {if (i < 10) {i = "0" + i}; return i;},
current : -1,
ads: [
  {type:'image',src:'freq.jpg',duration:'7000'} ,
  {type:'image',src:'ad1.png',duration:'5000'} ,
  {type:'video',src:'small.mp4',duration:'18000'} ,
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
   if (qms.ads[qms.current].type == 'video') qms.muteVideo();
   _('[number]').innerHTML = n;
   _('[guch]').innerHTML = g;
   var a = _('.smallNumber') , b =  _('.showNumber');
   b.innerHTML = '<small>NUMERO </small>'+n +'<small>GUICHET </small>'+g ;
call.src = 'call/00'+n+'.ogg';
call.load();
call.play();

   b.classList.remove('show');
   ramjet.transform( a, b, {
  done: function () {
     b.classList.add('show');
    // this function is called as soon as the transition completes
  }
});

window.setTimeout(function(){
   if (qms.ads[qms.current].type == 'video') qms.repriseMutedVideo();
   ramjet.transform( b, a, {
  done: function () {
    b.classList.remove('show');
     // this function is called as soon as the transition completes
  }
});


},4000)

 }





}

qms.initAd();
