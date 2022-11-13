<?php

namespace Controllers;

use DAO\OwnerDAO;
use DAO\PetsDAO;
use Models\Owner as Owner;
use DAO\OwnerPDO;
use DAO\PetsPDO;

class OwnerController
{

    private $ownerDAO;
    private $petDAO;

    public function __construct()
    {
      //  $this->ownerDAO = new OwnerDAO();
        //$this->petDAO = new PetsDAO();

        $this->ownerDAO = new OwnerPDO();
        $this->petDAO = new PetsPDO();
    }

    public function ShowProfileView()
    {
        $owner = $_SESSION["loggedUser"];

        if ($owner != NULL) {
            require_once(VIEWS_PATH . "validate-session.php");
            require_once(VIEWS_PATH . "owner-profile.php");
        }
    }

    public function SelectPetForKeeper(){
        $owner = $_SESSION["loggedUser"];
        $petList = $this->petDAO->ReturnOwnerPets($owner->getUserID());

        if($petList != NULL){
            require_once(VIEWS_PATH . "validate-session.php");
            require_once(VIEWS_PATH . "keeper-list-owner-pet.php");
        }else{
            echo "<script> alert('Para contratar un Keeper necesita tener mascotas'); </script>";
            $this->ShowProfileView();
        }
        
    }
}
