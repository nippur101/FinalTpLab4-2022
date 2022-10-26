<?php 

namespace Controllers;

use DAO\PetsDAO;
use Models\Pets as Pets;

class PetsController{

    private $petsDAO;

    public function __construct()
    {
        $this->petsDAO = new PetsDAO();
    }

    
    
    public function CreatePets( $name, $vaccinationPlan, $raze,$petType, $video, $owner)
    {
        
        if(!($this->petsDAO->alreadyExistPets($owner,$name))){
           
                $pets = new Pets();
                $pets->setName($name);
                $pets->setVaccinationPlan($vaccinationPlan);
                $pets->setRaze($raze);
                $pets->setPetType($petType);
                $pets->setVideo($video);
                $pets->setOwner($owner);
                $pets->setPetId($this->petsDAO->NewID());
                $this->petsDAO->Add($pets);
                echo "<script> if(confirm('La Mascota se ha creado con exito!')); </script>";
                
            }
           
        
        else{
            echo "<script> if(confirm('La mascota ya existe!')); </script>";
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."create-account.php");
        }
    }


}


?>