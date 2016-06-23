<?php


class User
{

    public $id;
    protected $pseudoUser;
    protected $sexeUser;
    protected $mailUser;
    protected $pwdUser;

    protected $lastScore;


    public function __construct()
    {

        $num = func_num_args();

        switch ($num) {
            case 4:
                $this->pseudoUser = func_get_arg(0);
                $this->sexeUser = func_get_arg(1);
                $this->mailUser = func_get_arg(2);
                $this->pwdUser = func_get_arg(3);
                break;

            case 5:
                $this->id = func_get_arg(0);;
                $this->pseudoUser = func_get_arg(1);
                $this->sexeUser = func_get_arg(2);
                $this->mailUser = func_get_arg(3);
                $this->lastScore = func_get_arg(4);
                break;

            case 6:
                $this->id = func_get_arg(0);;
                $this->pseudoUser = func_get_arg(1);
                $this->sexeUser = func_get_arg(2);
                $this->mailUser = func_get_arg(3);
                $this->lastScore = func_get_arg(4);
                $this->pwdUser = func_get_arg(5);
                break;

            default:
        }
    }


    public function getId()
    {
        return $this->id;
    }


    public function getPseudoUser()
    {
        return $this->pseudoUser;
    }


    public function setPseudoUser($pseudoUser)
    {
        $this->pseudoUser = $pseudoUser;
    }


    public function getSexeUser()
    {
        return $this->sexeUser;
    }


    public function setSexeUser($sexeUser)
    {
        $this->sexeUser = $sexeUser;
    }


    public function getMailUser()
    {
        return $this->mailUser;
    }


    public function setMailUser($mailUser)
    {
        $this->mailUser = $mailUser;
    }


    public function getPwdUser()
    {
        return $this->pwdUser;
    }


    public function setPwdUser($pwdUser)
    {
        $this->pwdUser = $pwdUser;
    }

    public function getLastScore()
    {
        return $this->lastScore;
    }


    public function setLastScore($lastScore)
    {
        $this->lastScore = $lastScore;
    }


}