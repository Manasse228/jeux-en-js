<?php
session_start ();
if(empty($_SESSION)) {
    header("Location: ".htmlspecialchars_decode('login.php'), true, 303);
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Test d'alzheimer</title>


    <link rel="stylesheet" href="css/style.css" />



    <link rel="stylesheet" href="css/menu.css">

</head>
<body>


<a href="acount.php" >Mon Compte</a>
<a href="jeu.php" >Nouveau Jeu</a>
<a href="members.php" >Membre</a>
<a href="deconnexion.php" >Deconnection</a>


</body>
</html>
