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

    public function Create($mail, $password1, $password2, $type)
    {
        if(!($this->userDAO->alreadyExistUser($mail)))
        {
            if($password1 == $password2)
            {
                $user = new User();
                $user->setMail($mail);
                $user->setPassword($password1);
                $user->setType($type);

                $this->userDAO->Add($user);

                echo "<script> if(confirm('Usuario creado con exito!')); </script>";
                require_once(VIEWS_PATH."validate-session.php");
                require_once(VIEWS_PATH."index.php");
            }
            else
            {
                echo "<script> if(confirm('Las contraseñas no coinciden!')); </script>";
                require_once(VIEWS_PATH."validate-session.php");
                require_once(VIEWS_PATH."create-account.php");
            }
        }
        else
        {
            echo "<script> if(confirm('El usuario ya existe!')); </script>";
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."create-account.php");
        }
    }


}


?>