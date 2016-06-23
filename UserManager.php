<?php

include('User.php');
include_once 'Utilities.php';


class UserManager
{

    private $pdo;


    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }



    public function createUser(User $user){

        try {
            global $pdo;

            $pdo->beginTransaction();
            $req = $pdo->prepare("INSERT INTO user(pseudo,mail,sexe,score,password)
            VALUES (:pseudo, :mail, :sexe, :score, :password)");

            $req->bindValue(':pseudo', $user->getPseudoUser(), PDO::PARAM_STR);
            $req->bindValue(':mail', $user->getMailUser(), PDO::PARAM_STR);
            $req->bindValue(':sexe', $user->getSexeUser(), PDO::PARAM_STR);
            $req->bindValue(':score', '0', PDO::PARAM_INT);
            $req->bindValue(':password', $user->getPwdUser(), PDO::PARAM_STR);

            $req->execute();
            $pdo->commit();

        } catch (Exception $ex) {
            $pdo->rollback();
            echo 'Erreur : ' . $ex->getMessage() . '<br />';
            echo 'N° : ' . $ex->getCode();
            echo "Error: " . $req . "<br>" . $pdo->error;

            exit();
        }
    }

    public function updateUser($score, $id){

        try {
            global $pdo;

            $pdo->beginTransaction();
            $req = $pdo->prepare("UPDATE user SET score='".$score."' where id='".$id."' ");

            $req->execute();
            $pdo->commit();

        } catch (Exception $ex) {
            $pdo->rollback();
            echo 'Erreur : ' . $ex->getMessage() . '<br />';
            echo 'N° : ' . $ex->getCode();
            echo "Error: " . $req . "<br>" . $pdo->error;

            exit();
        }
    }

    public function checkLogin($valueSaisie, $password){
        global $pdo;
        if(Utilities::VerifierAdresseMail(trim($valueSaisie))==1){
            $column="mail";
        }else{$column="pseudo"; }
        $req = $pdo->prepare("SELECT COUNT(*) FROM  user WHERE ".$column." = :val AND password = :password ");
        $req->bindValue(':val', trim($valueSaisie), PDO::PARAM_STR);
        $req->bindValue(':password', trim($password), PDO::PARAM_STR);
        $result = $req->execute();

        if ($result) {
            $count = $req->fetchColumn();
        }else {
            trigger_error('Error executing statement.', E_USER_ERROR);
        }

        if($count==1){
            return $this->getUser($column, $valueSaisie);
        }else{
            return $count;
        }

    }

    public function getUser($column, $value){
        global $pdo;
        $req = $pdo->prepare("SELECT *  FROM  user WHERE ".$column." = :val ");
        $req->bindValue(':val', trim($value), PDO::PARAM_STR);
        $result = $req->execute();
        $data = $req->fetch(PDO::FETCH_ASSOC);

        return new User($data["id"], $data["pseudo"], $data["sexe"], $data["mail"], $data["score"]);
    }

    public function getUserLost($column, $value){
        global $pdo;
        $req = $pdo->prepare("SELECT *  FROM  user WHERE ".$column." = :val ");
        $req->bindValue(':val', trim($value), PDO::PARAM_STR);
        $result = $req->execute();
        $data = $req->fetch(PDO::FETCH_ASSOC);

        return new User($data["id"], $data["pseudo"], $data["sexe"], $data["mail"], $data["score"], $data["password"]);
    }


    public function exists($donne, $type)
    {
        global $pdo;
        $req = $pdo->prepare("SELECT COUNT(" . $type . ") FROM  user WHERE " . $type . " = :value ");
        $req->bindValue(':value', trim($donne), PDO::PARAM_STR);
        $result = $req->execute();

        if ($result) {
            $count = $req->fetchColumn();
        } else {
            trigger_error('Error executing statement.', E_USER_ERROR);
        }
        return $count;
    }

    public static function verifexists(array $data){
        $errors = array();

        if ($data[0] > 0)
            $errors["emailexist"] = "Cette adresse email est déja utilisée <br/>";
        if ($data[1] > 0)
            $errors["pseudoexist"] = "Ce pseudo est déja utilié";

        return $errors;
    }




    public function getPdo()
    {
        return $this->pdo;
    }


    public function setPdo($pdo)
    {
        $this->pdo = $pdo;
    }




}