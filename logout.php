<?php
unset($_COOKIE['username']);
unset($_COOKIE['userpower']);
setcookie('username', null, time()-3600);
setcookie('userpower', null, time()-3600);


 ?>
<script type="text/javascript">
window.location.href = "login.php"
</script>
