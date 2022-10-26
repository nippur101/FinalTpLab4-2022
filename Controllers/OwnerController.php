<?php 

namespace Controllers;

use DAO\OwnerDAO;
use Models\Owner as Owner;

class OwnerController{
    
        private $ownerDAO;
    
        public function __construct()
        {
            $this->ownerDAO = new OwnerDAO();
        }

        public function CheckAndPushData(){ //la idea de esta funcion es poder convertir el user a un owner para empezar a laburarlo, 
                                            // tanto owner como user laburan con la misma id
            $user = $_SESSION["loggedUser"] = $user; //esto no se si funciona xd
            $owner = new Owner();
            $owner = $this->ownerDAO->GetOwner($user->getUserID());

            if(owner!=NULL){ //ACA SE FIJA SI TENIAMOS INFO, SI TENIAMOS ESTA TODO OK VA A MIRAR LOS KEEPER
                require_once(VIEWS_PATH."validate-session.php");
                require_once(VIEWS_PATH."owner-profile.php");
            }else{
                //ACA LO LLEVA A COMPLETAR PERFIL
            }
        }
    
}