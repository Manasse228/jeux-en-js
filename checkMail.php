<?php
include_once 'Connexion.php';
include_once 'UserManager.php';

$pdo = Connexion::getConnexion();

$userManager = new UserManager($pdo);

    $find = $userManager->exists($_POST["email"],"mail");
    echo $find;


?>