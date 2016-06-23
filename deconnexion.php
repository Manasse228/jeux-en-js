<?php

session_start();
session_unset();
session_destroy();
header("Location: ".htmlspecialchars_decode('login.php'), true, 303);
exit();
?>