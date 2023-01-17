<!-- On your own, create a logout link to logout page. This can then redirect back to login -->
<?php
   session_start();
   session_destroy();
   header("Location: login.php");
?>