var qms = {
clock : function(el) {
var d = new Date(), dm = d.getMinutes() , dh = d.getHours();
dh = qms.checkTime(dh) ;
dm = qms.checkTime(dm) ;
var clock = dh + '<span>:</span>' + dm;
    _(el).innerHTML = clock;
window.setTimeout(function(){qms.clock(el)},60000);
} ,
 checkTime : function(i) {if (i < 10) {i = "0" + i}; return i;}

}
