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

	<script src="js/memory.js"></script>
	<link rel="stylesheet" href="css/style.css" />

	<script   src="https://code.jquery.com/jquery-1.12.2.min.js"
			  integrity="sha256-lZFHibXzMHo3GGeehn1hudTAP3Sc0uKXBXAzHX1sjtk="
			  crossorigin="anonymous"></script>


</head>
<body>



<a href="acount.php" >Mon Compte</a>
<a href="jeu.php" >Nouveau Jeu</a>
<a href="members.php" >Membre</a>
<a href="deconnexion.php" >Deconnection</a>

<h1>Bienvenue <?php echo $_SESSION['pseudo'] ?></h1>
<h2>Activer les neuronnes sava ... hahahha non je blague</h2>

<p>Score : <span id="score"></span> — Meilleur score : <span id="meilleur"></span></p>

<ul id="jeu"></ul>


<script src="js/memory.js"></script>
</body>
</html>
