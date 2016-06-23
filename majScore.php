<?php
session_start ();

include_once 'Connexion.php';
include_once 'UserManager.php';
include_once 'User.class.php';


$pdo = Connexion::getConnexion();
$userManager = new UserManager($pdo);
echo "id ".$_SESSION['userid']." et score ".$_POST['data'];
$userManager->updateUser($_POST['data'], $_SESSION['userid']);