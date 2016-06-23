<?php
session_start ();
if($_SESSION) {
    header("Location: ".htmlspecialchars_decode('jeu.php'), true, 303);
}
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

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
    <link href="css/login.css" rel="stylesheet">
</head>
<body>

<?php


if (($_SERVER['REQUEST_METHOD'] == "POST") && ($_POST["submitlogin"] == "submitlogin")
    && (isset($_POST['login'])) && (isset($_POST['password']))
) {

    include_once 'Connexion.php';
    include_once 'UserManager.php';
    include_once 'User.class.php';

    $pdo = Connexion::getConnexion();
    $userManager = new UserManager($pdo);

    $userConected = $userManager->checkLogin($_POST["login"], $_POST["password"]);

    if ( (is_object($userConected)) && ($userConected instanceof User) ) {

        session_start();
        $_SESSION["userid"] = $userConected->getId();
        $_SESSION["pseudo"] = $userConected->getPseudoUser();
        $_SESSION["score"] = $userConected->getLastScore();
        $_SESSION["sexe"] = $userConected->getSexeUser();
        $_SESSION["email"] = $userConected->getMailUser();

        $_POST = null;
        Utilities::POST_redirect("jeu.php");

    } else {
        $errorLogin = "Pseudo et/ou mot de passe incorrect(s)!";
    }


}


?>

<div class="container">


    <div class="omb_login">

        <div class="row omb_row-sm-offset-3 omb_loginOr">
            <div class="col-xs-12 col-sm-6">
                <hr class="omb_hrOr">
                <span class="omb_spanOr">Login</span>
            </div>
        </div>

        <div class="row omb_row-sm-offset-3">
            <div class="col-xs-12 col-sm-6">


                <span class="alert-danger"> <?php echo $errorLogin; ?> </span>
                <form class="omb_loginForm" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES); ?>"
                      autocomplete="off" method="POST">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control" autocomplete="off" required name="login" placeholder="Email / Pseudo">
                    </div>
                    <span class="help-block"></span>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        <input  type="password" class="form-control" required name="password" placeholder="Password">
                    </div>

                    <br />
                    <button class="btn btn-lg btn-primary btn-block" name="submitlogin" value="submitlogin" type="submit">Login</button>
                </form>
            </div>
        </div>

        <div class="row omb_row-sm-offset-3">

            <div class="col-xs-12 col-sm-3 ">
                <a href="inscription.php">Inscription</a>
            </div>

            <div class="col-xs-12 col-sm-3 ">
                <p class="omb_forgotPwd">
                    <a href="lostPassword.php">Mot de passe oublié?</a>
                </p>
            </div>

        </div>

    </div>






</div>

</body>
</html>
