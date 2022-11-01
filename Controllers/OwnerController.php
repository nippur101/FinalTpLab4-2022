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

        public function ShowProfileView(){ 
            $owner = $_SESSION["loggedUser"];
            
            if($owner!=NULL){ 
                require_once(VIEWS_PATH."validate-session.php");
                require_once(VIEWS_PATH."owner-profile.php");
            }
        }
    
}