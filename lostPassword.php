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
    <title>Recupération d'identifiants</title>

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
    <script src="js/inscription.js" type="text/javascript"></script>
</head>
<body>



<div class="container">


    <div class="omb_login">

        <div class="row omb_row-sm-offset-3 omb_loginOr">
            <div class="col-xs-12 col-sm-6">
                <hr class="omb_hrOr">

            </div>
        </div>

        <div class="row omb_row-sm-offset-3">
            <div class="col-xs-12 col-sm-6">

                <?php
                $msg="";
                if (($_SERVER['REQUEST_METHOD'] == "POST")  && (isset($_POST['email']))
                ) {

                    include_once 'Connexion.php';
                    include_once 'UserManager.php';
                    include_once 'User.class.php';

                    $pdo = Connexion::getConnexion();
                    $userManager = new UserManager($pdo);

                    $count = $userManager->exists($_POST['email'],"mail");

                    if($count == 1){
                        $msg = "Un email vient d'être envoyé à votre adresse mail avec vos identifiants.";
                        $to  = $_POST['email'];

                        $subject = 'Rappeld\'identifiant';

                        $headers  = 'MIME-Version: 1.0' . "\r\n";
                        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

                         $user = $userManager->getUserLost('mail', $to);

                        $message = "Votre Pseudo est: <strong>".$user->getPseudoUser()."</strong> et votre mot de passe est <strong>".$user->getPwdUser()."</strong>";

                        mail($to, $subject, $message, $headers);
                        header("Location: ".htmlspecialchars_decode('login.php'), true, 303);
                    }else{
                        $msg = "Cette adresse email n'est pas dans notre base. Merci de votre compréhension.";
                    }


                }

                ?>

                <span class="flash"> <?php echo $msg ?> </span>
                <form class="omb_loginForm" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES); ?>"
                      autocomplete="off" method="POST">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control"  id="idEmail" name="email"
                               autocomplete="off" required name="login" placeholder="Adresse mail">
                    </div>
                    <p id="messageCheckEmail" ></p>

                    <br />
                    <button class="btn btn-lg btn-primary btn-block" name="submitlogin" value="submitlogin" type="submit">Recupérer</button>
                </form>
            </div>
        </div>



    </div>


    <div class="row omb_row-sm-offset-3">

        <div class="col-xs-12 col-sm-3 ">
            <a href="inscription.php">Inscription</a>
        </div>

        <div class="col-xs-12 col-sm-3 ">
            <p class="omb_forgotPwd">
                <a href="login.php">Login</a>
            </p>
        </div>

    </div>






</div>

</body>
</html>
