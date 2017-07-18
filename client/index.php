<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>QMS</title>


    <style media="screen">
body {
  background: black;
  overflow: hidden;
}
.loading {position: fixed;top:58vh;line-height: 4vh;text-align: center;left:0;right:0;color:#fff;}
    </style>


    <script type="text/javascript">
var remote = "http://127.0.0.1/qms/" ,
ping = 'ping.php',
client = {
  maxRec : 10,
  Rec : 0,
  call : function(){
    var link = remote + ping ;
    var httpRequest = new XMLHttpRequest();

   httpRequest.onreadystatechange = function() {
       if (httpRequest.readyState === 4  ) {
           if (httpRequest.status === 200 && httpRequest.responseText !== undefined ) {
              var z = JSON.parse(httpRequest.response);
              if (z.status == 'ok') window.location.href = remote + z.link;
           } else {
             console.warn(httpRequest.status);
             client.Rec ++;
             if (client.Rec < client.maxRec ) {

             window.setTimeout(function(){
client.call();
             },3000);
           } else {
             window.close();
           }
           }
       }
   };
   httpRequest.open('GET', link);
   httpRequest.setRequestHeader( "Pragma", "no-cache" );
   httpRequest.setRequestHeader( "Cache-Control", "no-cache" );
   httpRequest.setRequestHeader( "Expires", 0 );
   httpRequest.send();
 } ,
 init : function () {
   window.setTimeout(client.call,5000);
 }
}

client.init();


    </script>
  </head>
  <body>

<img src="intro.png" width="100%" height="auto" alt="">

<div class="loading">
chargement...
</div>

  </body>
</html>
