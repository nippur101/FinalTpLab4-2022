<?php 

namespace Controllers;

use DAO\PetsDAO;
use Models\Pets as Pets;
use Models\Owner as Owner;
use DAO\OwnerDAO;

class PetsController{

    private $petsDAO;
    private $ownerDAO;

    public function __construct()
    {
       $this->petsDAO=new PetsDAO();
       $this->ownerDAO=new OwnerDAO();
    }

    
    
    public function CreatePets( $name, $vaccinationPlan, $raze,$petType, $video)
    {
        $owner = $_SESSION["loggedUser"] ; 
       // $owner = new Owner();
       // $owner = $this->ownerDAO->GetOwner($user->getUserID());
        
        
        if(!($this->petsDAO->alreadyExistPets($owner,$name))){
           
                $pets = new Pets();
                $pets->setPetId($this->petsDAO->NewID());
                $pets->setName($name);
                $pets->setVaccinationPlan($vaccinationPlan);
                $pets->setRaze($raze);
                $pets->setPetType($petType);
                $pets->setVideo($video);
                $pets->setOwner($owner);
                $this->petsDAO->Add($pets);
                echo "<script> if(confirm('La Mascota se ha creado con exito!')); </script>";
                
            }
            else
            {
            echo "<script> if(confirm('La mascota ya existe!')); </script>";
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."create-account.php");
        }
    }
   


}


?>