<?php 

namespace Controllers;

use DAO\UserDAO;
use Models\User as User;

class UserController{

    private $userDAO;

    public function __construct()
    {
        $this->userDAO = new UserDAO();
    }

    public function Login($mail, $password)
    {
        $user = $this->userDAO->validUser($mail, $password);

        if($user == true)
        {
            $_SESSION["loggedUser"] = $user;
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."logged.php");
        }
        else
        {
            echo "<script> if(confirm('Error de credenciales!')); </script>";
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."index.php");
        }
    }


}


?>