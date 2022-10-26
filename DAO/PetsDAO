<?php 

namespace DAO;

use Models\Pets;
use Models\Owner;
class PetsDAO {

    private $petsList = array();

    public function getAll(){

        $this->retrieveData();

        return $this->petsList;

    }

    public function Add(Pets $pets)
    {
            $this->RetrieveData();
            
            array_push($this->petsList, $pets);

            $this->SavePets();
    }

    public function validPet($name, $owner){
        $check = true;
       $list=$this->getAll();
       foreach($list as $pets){
            if($owner->getUserID == $pets->getOwner->getUserID   
                && $pets->getName == $name ){
                $check=false;
            }
       }
       return $check;

    }

    public function alreadyExistPets($owner,$name){
            
        $petsList = $this->getAll();

        $check = false;

        foreach($petsList as $pets){

            if( $pets->getOwner()==$owner ){
                If( $pets->getName() == $name){
                    $check = true;
                }
            }
        }

        return $check;
}

    public function retrieveData(){

        $this->petsList = array();

            if(file_exists('Data/pets.json'))
            {
                $jsonContent = file_get_contents('Data/pets.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                   
                    $pets = new Pets();
                   
                    $pets->setPetId($valuesArray["petId"]);
                    $pets->setName($valuesArray["name"]);
                    $pets->setVaccinationPlan($valuesArray["vaccinationPlan"]);
                    $pets->setRaze($valuesArray["raze"]);
                    $pets->setPetType($valuesArray["petType"]);
                    $pets->setVideo($valuesArray["video"]);
                    $pets->setOwner($valuesArray["owner"]);
                    

                    array_push($this->petsList, $pets);
                }
            }

    }
    private function SavePets()
    {
        $arrayToEncode = array();

        foreach($this->petsList as $pets)
        {
            $valuesArray["petId"] = $pets->getPetId();
            $valuesArray["name"] = $pets->getName();
            $valuesArray["vaccinationPlan"] = $pets->getVaccinationPlan();
            $valuesArray["petType"] = $pets->getPetType();
            $valuesArray["raze"] = $pets->getRaze();
            $valuesArray["video"] = $pets->getVideo();
            $valuesArray["owner"] = $pets->getOwner();
           

            array_push($arrayToEncode, $valuesArray);
        }

        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        
        file_put_contents('Data/pets.json', $jsonContent);
    }
    public function NewID(){

        $id = 0;

        foreach($this->petsList as $pets){

            $id = ($pets->getPetId() > $id) ? $pets->getPetId() : $id;

        }

        return $id + 1;

    }

}

?>