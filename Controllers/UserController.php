<?php 

namespace Controllers;

use DAO\UserDAO;
use DAO\KeeperDAO;
use DAO\OwnerDAO;
use Models\User as User;
use Models\Keeper as Keeper;
use Models\Owner;

class UserController{

    private $userDAO;

    public function __construct()
    {
        $this->userDAO = new UserDAO();
        $this->keeperDAO = new KeeperDAO();
        $this->ownerDAO = new OwnerDAO();
        
    }

    public function Login($mail, $password)
    {
        $user = $this->userDAO->validUser($mail, $password);

        if($user != NULL)
        {

          // $_SESSION["loggedUser"] = $user;

            $firstName = $user->getFirstName();
            $lastName = $user->getLastName();

            if($user->getUserType() == 1)
            {
                $_SESSION["loggedUser"] =$this->keeperDAO->GetKeeper($user->getUserID());
               
                require_once(VIEWS_PATH."validate-session.php");
                require_once(VIEWS_PATH."logged-keeper.php");
              

            }
            else
            {
                $_SESSION["loggedUser"] =$this->ownerDAO->GetOwner($user->getUserID());
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

    public function CreateAccount(){

        require_once(VIEWS_PATH."create-account.php");

    }

    public function CreatePets(){

        require_once(VIEWS_PATH."validate-session.php");
        require_once(VIEWS_PATH."create-pets.php");

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
                $_SESSION["loggedUser"] = $user->getUserID();
                $this->userDAO->Add($user);
                echo "<script> if(confirm('Usuario creado con exito!')); </script>";
                if($user->getUserType() == 1)
                {
                    $keeper=new Keeper();
                    $keeper->setFirstName($firstName);
                    $keeper->setLastName($lastName);
                    $keeper->setEmail($mail);
                    $keeper->setPassword($password1);
                    $keeper->setUserType($type);
                    $keeper->setUserID($user->getUserID());
                    $keeper->setAddress(null);
                    $keeper->setPetSize(null);
                    $keeper->setStayCost(null);
                    $keeper->setFreeTimePeriod(null);
                    $keeper->setReviews(null);
                    $this->keeperDAO->Add($keeper);
                    $_SESSION["loggedUser"] =$keeper;
                    require_once(VIEWS_PATH."validate-session.php");
                    require_once(VIEWS_PATH."keeper-profile.php");
                }
                else
                {
                    $owner=new Owner();
                    $owner->setFirstName($firstName);
                    $owner->setLastName($lastName);
                    $owner->setEmail($mail);
                    $owner->setPassword($password1);
                    $owner->setUserType($type);
                    $owner->setUserID($user->getUserID());
                    $owner->setPhone(null);
                    $owner->setPets(null);
                    $this->ownerDAO->Add($owner);
                    $_SESSION["loggedUser"] =$owner;
                    
                    require_once(VIEWS_PATH."validate-session.php");
                    require_once(VIEWS_PATH."owner-profile.php");
                }
            }
            else{
                echo "<script> if(confirm('Las contraseñas no coinciden!')); </script>";
                //require_once(VIEWS_PATH."validate-session.php");
                require_once(VIEWS_PATH."create-account.php");
            }
        }
        else{
            echo "<script> if(confirm('El usuario ya existe!')); </script>";
            //require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."create-account.php");
        }
    }


}


?>