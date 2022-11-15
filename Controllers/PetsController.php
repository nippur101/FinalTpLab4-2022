<?php

namespace Controllers;

use DAO\PetsDAO;
use Models\Pets as Pets;
use Models\Owner as Owner;
use DAO\OwnerDAO;
use DAO\PetsPDO;

class PetsController
{

    private $petsDAO;
    private $ownerDAO;

    public function __construct()
    {
       // $this->petsDAO = new PetsDAO();
        //$this->ownerDAO = new OwnerDAO();

        $this->petsDAO = new PetsPDO();
        $this->ownerDAO = new PetsPDO();
    }

    public function CreatePets($name, $vaccinationPlan, $raze, $petType, $video, $image)
    {
        $owner = $_SESSION["loggedUser"];

        if (!($this->petsDAO->alreadyExistPets($owner, $name))) {

            $pets = new Pets();
            $pets->setPetId($this->petsDAO->NewID());
            $pets->setName($name);
            $pets->setVaccinationPlan($vaccinationPlan);
            $pets->setRaze($raze);
            $pets->setPetType($petType);
            $pets->setVideo($video);
            $pets->setImage($image);
            $pets->setOwner($owner->getUserID());
            $this->petsDAO->Add($pets);
           
            echo "<script> if(confirm('La Mascota se ha creado con exito!')); </script>";
        } else {
            echo "<script> if(confirm('La mascota ya existe!')); </script>";
        }
        require_once(VIEWS_PATH . "validate-session.php");
        require_once(VIEWS_PATH . "owner-profile.php");
    }
    public function deletePets($petsId)
    {
        $this->petsDAO->Remove($petsId);
        require_once(VIEWS_PATH . "validate-session.php");
        require_once(VIEWS_PATH . "owner-profile.php");
    }
}
