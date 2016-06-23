<?php
session_start ();
if($_SESSION) {
    header("Location: ".htmlspecialchars_decode('jeu.php'), true, 303);
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Inscription</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
          crossorigin="anonymous">

    <script   src="https://code.jquery.com/jquery-1.12.2.min.js"
              integrity="sha256-lZFHibXzMHo3GGeehn1hudTAP3Sc0uKXBXAzHX1sjtk="
              crossorigin="anonymous"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
            integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
            crossorigin="anonymous"></script>

    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

    <link rel="stylesheet" href="css/inscription.css" />
    <script src="js/inscription.js" type="text/javascript"></script>



</head>
<body>


<?php

include_once 'Connexion.php';
include_once 'UserManager.php';
include_once 'Utilities.php';
include_once 'User.class.php';

if (($_SERVER['REQUEST_METHOD'] == "POST") && ($_POST["inscription"] == "submit")
    && (isset($_POST['pseudo'])) && (isset($_POST['email'])) && (isset($_POST['password']))
) {


    try {

        $pdo = Connexion::getConnexion();
        $userManager = new UserManager($pdo);

        $errormails = $userManager->exists($_POST["email"], "mail");
        $errorpseudos = $userManager->exists($_POST["pseudo"], "pseudo");

        $verifexist = array($errormails, $errorpseudos);
        $exists = UserManager::verifexists($verifexist);

        if (count($exists) <= 0) {

            $user = new User($_POST["pseudo"], $_POST["sexe"], $_POST["email"], $_POST["password"]);
            $userManager->createUser($user);


            Utilities::POST_redirect("login.php");

        } else {

            if($exists['emailexist']){
                echo "<script type='text/javascript'>alertBorder('idEmail')</script>";
            }

            if($exists['pseudoexist']){
                echo "<script type='text/javascript'>alertBorder('idpseudo')</script>";
            }

        }

    } catch (Exception $ex) {

        echo 'Erreur : ' . $ex->getMessage() . '<br />';
    }

}


?>


<div class="box " >
    <fieldset >
        <legend id="text">Inscription</legend>

        <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES); ?>"
              autocomplete="off" method="post" >


            <div class="row">
                <div class="col-xs-10 col-md-10 ">
                    <input id="idpseudo" onblur="check('pseudo', 'idpseudo', 'messageCheckPseudo', 'checkPseudo',
                    'Pseudo disponible', 'Pseudo déja utilisé' )" required
                           value="<?php echo $_POST['pseudo'];?>"
                           class="form-control" name="pseudo" placeholder="Pseudo" type="text"   />
                    <p  id="messageCheckPseudo" ><?php if($exists){ echo $exists['pseudoexist']; } ?></p>
                </div>
                <div class="col-xs-2 col-md-2 form-inline">
                    <label class="radio inline" >
                        <input type="radio" name="sexe"  value="M" checked="checked">
                       M
                    </label>
                    <label class="radio inline" for="radios-1">
                        <input type="radio" name="sexe"  value="F">
                        F
                    </label>
                </div>
            </div>

            <div class="input-group">
                <span class="input-group-addon">@</span>
                <input onblur="checkmail('email', 'idEmail', 'messageCheckEmail', 'checkMail',
             'Adresse email disponible', 'Adresse email déja utilisé' )"  type="email" id="idEmail"
                       value="<?php echo $_POST['email'] ?>" required
                       class="form-control" name="email" placeholder="Adresse Email"   />
            </div>
            <p id="messageCheckEmail" ><?php if($exists){ echo $exists['emailexist']; } ?></p>


            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input class="form-control" onblur="verifSaisie('pwd', 'pwd2', 'messageCheckPassword')"
                       autocomplete="off" required name="password" id="pwd" placeholder="Mot de passe" type="password" />
            </div>
            <p></p>

            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input class="form-control" onblur="verifSaisie('pwd', 'pwd2', 'messageCheckPassword')"
                       autocomplete="off" required name="password2" id="pwd2" placeholder="Verification du mot de passe" type="password" />
            </div>
            <p id="messageCheckPassword" ></p>

            <div class="row">
                <div class="col-xs-8 col-md-8 col-lg-8">
                    <button name="inscription" value="submit" class="btn btn-lg btn-primary btn-block" type="submit">
                        <span class="glyphicon glyphicon-floppy-save"></span> Inscription </button>
                </div>
                <div class="col-xs-4 col-md-4 col-lg-4">
                    <button type="reset" class="btn btn-lg btn-primary btn-block btn-danger">Annuler</button>
                </div>
            </div>

        </form>


    </fieldset>
    <div class="col-xs-12 col-sm-3 ">
        <p class="omb_forgotPwd">
            <a href="login.php">Login</a>
        </p>
    </div>

</div>



</body>
</html>

