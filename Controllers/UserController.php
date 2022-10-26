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

        if($user != NULL)
        {
            $_SESSION["loggedUser"] = $user;
            $firstName = $user->getFirstName();
            $lastName = $user->getLastName();

            if($user->getUserType() == 1)
            {
                require_once(VIEWS_PATH."validate-session.php");
                require_once(VIEWS_PATH."logged-keeper.php");
            }
            else
            {
                require_once(VIEWS_PATH."validate-session.php");
                require_once(VIEWS_PATH."logged-owner.php");
            }
        }
        else
        {
            echo "<script> if(confirm('Error de credenciales!')); </script>";
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."index.php");
        }
    }

    public function Create($firstName, $lastName, $mail, $password1, $password2, $type)
    {
        if(!($this->userDAO->alreadyExistUser($mail))){
            if($password1 == $password2){
                $user = new User();
                $user->setFirstName($firstName);
                $user->setLastName($lastName);
                $user->setEmail($mail);
                $user->setPassword($password1);
                $user->setUserType($type);
                $user->setUserID($this->userDAO->NewID());
                $this->userDAO->Add($user);
                echo "<script> if(confirm('Usuario creado con exito!')); </script>";
                if($user->getUserType == 1)
                {
                    require_once(VIEWS_PATH."validate-session.php");
                    require_once(VIEWS_PATH."logged-keeper.php");
                }
                else
                {
                    require_once(VIEWS_PATH."validate-session.php");
                    require_once(VIEWS_PATH."logged-owner.php");
                }
            }
            else{
                echo "<script> if(confirm('Las contraseñas no coinciden!')); </script>";
                require_once(VIEWS_PATH."validate-session.php");
                require_once(VIEWS_PATH."create-account.php");
            }
        }
        else{
            echo "<script> if(confirm('El usuario ya existe!')); </script>";
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."create-account.php");
        }
    }


}


?>