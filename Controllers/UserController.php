<?php

namespace Controllers;

use DAO\UserPDO;
use DAO\KeeperDAO;
use DAO\OwnerDAO;
use DAO\OwnerPDO;
use DAO\UserDAO;
use Models\User as User;
use Models\Keeper as Keeper;
use Models\Owner;

class UserController
{

    private $userDAO;

    public function __construct()
    {
        $this->userDAO = new UserPDO();
       // $this->keeperDAO = new KeeperPDO();
        $this->ownerDAO = new OwnerPDO();
       // $this->userDAO = new UserDAO();
        $this->keeperDAO = new KeeperDAO();
       // $this->ownerDAO = new OwnerDAO();
    }

    public function Destroy()
    {
        session_destroy();
        header("location: " . FRONT_ROOT . "Home/Index");
    }

    public function Login($mail, $password)
    {
        $user = $this->userDAO->validUser($mail, $password);

        if ($user != NULL) {
            $firstName = $user->getFirstName();
            $lastName = $user->getLastName();

            if ($user->getUserType() == 1) {

                $_SESSION["loggedUser"] = $this->keeperDAO->GetKeeper($user->getUserID());

                $_SESSION["typeUser"] = 1;
                require_once(VIEWS_PATH . "validate-session.php");
                require_once(VIEWS_PATH . "logged-keeper.php");
            } else {
                $_SESSION["loggedUser"] = $this->ownerDAO->GetOwner($user->getUserID());
                $_SESSION["typeUser"] = 2;
                require_once(VIEWS_PATH . "validate-session.php");
                require_once(VIEWS_PATH . "logged-owner.php");
            }
        } else {
            echo "<script> if(confirm('Error de credenciales!')); </script>";
            require_once(VIEWS_PATH . "validate-session.php");
            require_once(VIEWS_PATH . "index.php");
        }
    }

    public function CreateAccount()
    {

        require_once(VIEWS_PATH . "create-account.php");
    }

    public function CreatePets()
    {

        require_once(VIEWS_PATH . "validate-session.php");
        require_once(VIEWS_PATH . "create-pets.php");
    }

    public function Create($firstName, $lastName, $mail, $password1, $password2, $type)
    {
        if (!($this->userDAO->alreadyExistUser($mail))) {
            if ($password1 == $password2) {

                $user = $this->userDAO->ReturnDefaultUser($firstName, $lastName, $mail, $password1, $type);
                $this->userDAO->Add($user);
                echo "<script> if(confirm('Usuario creado con exito!')); </script>";

                $this->userDAO->retrieveUserId($mail,$password1,$user);
                var_dump($user);


                if ($user->getUserType() == 1) {
                    $keeper = $this->keeperDAO->ReturnDefaultKeeper($user);
                    $this->keeperDAO->Add($keeper);

                    $_SESSION["loggedUser"] = ($keeper);
                    $_SESSION["typeUser"] = $keeper->getUserType();
                    require_once(VIEWS_PATH . "validate-session.php");
                    require_once(VIEWS_PATH . "keeper-profile.php");
                } else {
                    $owner = $this->ownerDAO->ReturnDefaultOwner($user);
                    $this->ownerDAO->Add($owner);

                    $_SESSION["loggedUser"] = ($owner);
                    $_SESSION["typeUser"] = $owner->getUserType();
                    require_once(VIEWS_PATH . "validate-session.php");
                    require_once(VIEWS_PATH . "owner-profile.php");
                }
            } else {
                echo "<script> if(confirm('Las contraseñas no coinciden!')); </script>";
                require_once(VIEWS_PATH . "validate-session.php");
                require_once(VIEWS_PATH . "create-account.php");
            }
        } else {
            echo "<script> if(confirm('El usuario ya existe!')); </script>";
            require_once(VIEWS_PATH . "validate-session.php");
            require_once(VIEWS_PATH . "create-account.php");
        }
    }
}
