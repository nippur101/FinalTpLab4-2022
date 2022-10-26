<?php 

namespace Controllers;

use DAO\OwnerDAO;
use DAO\UserDAO;
use Models\Owner as Owner;
use Models\User as User;

class OwnerController{
    
        private $ownerDAO;
        private $userDAO;
    
        public function __construct()
        {
            $this->ownerDAO = new OwnerDAO();
            $this->userDAO = new UserDAO();
        }

        public function CheckAndPushData(){
            $user = $this->userDAO->GetUser($_SESSION["loggedUser"]);
            $owner = $this->ownerDAO->GetOwner($user->getUserID());

            if($owner!=NULL){ //ACA SE FIJA SI TENIAMOS INFO, SI TENIAMOS ESTA TODO OK VA A MIRAR LOS KEEPER
                require_once(VIEWS_PATH."validate-session.php");
                require_once(VIEWS_PATH."check-keepers.php");
            }else{
                //ACA LO LLEVA A COMPLETAR PERFIL
                $owner = new Owner();
                $owner->setFirstName($user->getFirstName());
                $owner->setLastName($user->getLastName());

                require_once(VIEWS_PATH."validate-session.php");
                require_once(VIEWS_PATH."owner-profile.php");
            }
        }

        public function Update($fistName, $lastName, $phone, $pets){
            $user = $this->userDAO->GetUser($_SESSION["loggedUser"]);
            $owner = $this->ownerDAO->GetOwner($user->getUserID());

            $owner->setFirstName($fistName);
            $owner->setLastName($lastName);
            $owner->setPhone($phone);
            $owner->setPets($pets);

            $this->ownerDAO->Update($owner);

            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."check-keepers.php");
        }
    
}