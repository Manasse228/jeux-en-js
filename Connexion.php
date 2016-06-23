<?php


class Connexion{

    private static $conn = null;

    private $serveur ;
    private $dbname ;
    private $user ;
    private $password ;

    private function __construct() {

           $this->serveur = "mysql.info.unicaen.fr";
           $this->dbname = "21416699_4";
           $this->user = "21416699";
           $this->password = "xohtheghooghohku";

         /*  $this->serveur = "localhost";
           $this->dbname = "memoire";
           $this->user = "root";
           $this->password = "Serge1992"; */

        try{
            if(is_null(self::$conn)) {
                $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                self::$conn = new PDO('mysql:host='.$this->serveur.';dbname='.$this->dbname.'',$this->user,$this->password, $pdo_options);
            }
        }catch(PDOException $ex){
            die('Connection échouée :' . $ex->getMessage());
        }

    }

    public static function getConnexion() {
        new Connexion();
        return self::$conn;
    }



}

?>