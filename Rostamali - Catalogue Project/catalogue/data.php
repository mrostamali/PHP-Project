<?php

// REMEMBER: This will be stored in a non-web folder. In our case, /data/ outside of the puplic_html
$username_good = "maryam";
$yourpassword = "web123";

$pw_enc = password_hash($yourpassword, PASSWORD_DEFAULT);

?>