<?php

namespace Controllers;

use DAO\OwnerDAO;
use DAO\PetsDAO;
use DAO\ReserveDAO;
use Models\Owner as Owner;
use DAO\OwnerPDO;
use DAO\PetsPDO;
use DAO\ReservePDO;

class OwnerController
{

    private $ownerDAO;
    private $petDAO;
    private $reserveDAO;

    public function __construct()
    {
      //  $this->ownerDAO = new OwnerDAO();
        //$this->petDAO = new PetsDAO();

        $this->ownerDAO = new OwnerPDO();
        $this->petDAO = new PetsPDO();
        $this->reserveDAO = new ReservePDO();
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
            $petList = $this->reserveDAO->GetPetsWithoutReserve($petList);
            require_once(VIEWS_PATH . "validate-session.php");
            require_once(VIEWS_PATH . "keeper-list-owner-pet.php");
        }else{
            echo "<script> alert('Para contratar un Keeper necesita tener mascotas'); </script>";
            $this->ShowProfileView();
        }
        
    }
}
