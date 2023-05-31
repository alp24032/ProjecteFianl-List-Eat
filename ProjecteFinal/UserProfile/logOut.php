<?php

session_start();

session_unset();

session_destroy();

header("Location: /ProjecteFinal/LogIn_&_SignUp/signIn.php");

?>