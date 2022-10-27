<?php 

namespace Controllers;

use DAO\PetsDAO;
use Models\Pets as Pets;

class PetsController{

    private $petsDAO;

    public function __construct()
    {
       $this->petsDAO=new PetsDAO();
    }

    
    
    public function CreatePets( $name, $vaccinationPlan, $raze,$petType, $video, $owner)
    {
        $this->petsDAO=new PetsDAO();
        
        
        if(!($this->petsDAO->alreadyExistPets($owner,$name))){
           
                $pets = new Pets();
                $pets->setPetId($this->NewID);
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
    public function NewId() {
        $petList = $this->petsDAO->GetAll();
        $id = 0;
        if($petList!=null){
            foreach($petList as $pets) {
                if($pets->getPetId() > $id) {
                    $id = $pets->getPetId();
                }
            }
        }
        return $id + 1;
    }


}


?>