<?php

namespace DAO;
namespace DAO;
use \Exception as Exception;
use DAO\OwnerPDO;
use DAO\OwnerDAO;
use Models\Pets;
use Models\Owner;

class PetsDAO
{

    private $petsList = array();
    private $connection;
    
    private $tableName = "Pets";
    public function __construct()
    {
        $this->ownerPDO = new OwnerPDO();
        $this->ownerDAO = new OwnerDAO();
    }

    public function getAll()
    {

        $this->retrieveData();

        return $this->petsList;
    }

    public function Add(Pets $pets)
    {
        $owner = $_SESSION["loggedUser"];
        $this->ownerDAO->addPetOwner($pets, $owner);

        $this->RetrieveData();

        array_push($this->petsList, $pets);

        $this->SavePets();
    }

    public function ReturnOwnerPets($ownerId){
        $this->retrieveData();
        $ownerPets = array();
        foreach($this->petsList as $pet){
            if($pet->getOwner() == $ownerId){
                array_push($ownerPets, $pet);
            }
        }
        return $ownerPets;
    }

    public function validPet($name, $owner)
    {
        $check = true;
        $list = $this->getAll();
        foreach ($list as $pets) {
            if (
                $owner->getUserID == $pets->getOwner->getUserID
                && $pets->getName == $name
            ) {
                $check = false;
            }
        }
        return $check;
    }

    public function GetPet($id)
    {
        $this->retrieveData();
        $petR = null;
        foreach ($this->petsList as $pets) {
            if ($pets->getPetId() == $id) {
                $petR = $pets;
            }
        }

        return $petR;
    }

    public function alreadyExistPets($owner, $name)
    {

        $petsList = $this->getAll();

        $check = false;

        foreach ($petsList as $pets) {

            if ($pets->getOwner() == $owner->getUserID()) {
                if ($pets->getName() == $name) {
                    $check = true;
                }
            }
        }

        return $check;
    }

    public function retrieveData()
    {

       
        $this->petsList = array();

        try
            {
              
                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                foreach ($resultSet as $valuesArray) {

                  
                    
                    foreach ($resultSet as $valuesArray) {
                            $pets = new Pets();
    
                            $pets->setPetId($valuesArray["petId"]);
                            $pets->setName($valuesArray["name"]);
                            $pets->setVaccinationPlan($valuesArray["vaccinationPlan"]);
                            $pets->setRaze($valuesArray["raze"]);
                            $pets->setPetType($valuesArray["petType"]);
                            $pets->setVideo($valuesArray["video"]);
                            $pets->setImage($valuesArray["image"]);
                            $pets->setOwner($valuesArray["owner"]);
            
            
                            array_push($this->petsList, $pets);
                        }
                    
    
                    array_push($this->petsList, $pets);
                }

                return $this->petsList;
               
            }
            catch(Exception $ex)
            {
                throw $ex;
          
            
             }
    }
    private function SavePets(Pets $pets)
    {
        try
        {
            $query = "INSERT INTO ".$this->tableName." (petId, petId, vaccinationPlan, petType, raze,video,image,owner)
             VALUES ( :petId, :petId, :vaccinationPlan, :petType, :raze,:video,:image,:owner);";
            
            $valuesArray["petId"] = $pets->getPetId();
            $valuesArray["name"] = $pets->getName();
            $valuesArray["vaccinationPlan"] = $pets->getVaccinationPlan();
            $valuesArray["petType"] = $pets->getPetType();
            $valuesArray["raze"] = $pets->getRaze();
            $valuesArray["video"] = $pets->getVideo();
            $valuesArray["image"] = $pets->getImage();
            $valuesArray["owner"] = $pets->getOwner();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $valuesArray);

        }
        catch(Exception $ex)
        {
            var_dump($query);
            throw $ex;
        }

        foreach ($this->petsList as $pets) {
            


            array_push($arrayToEncode, $valuesArray);
        }

       
    }
    public function NewId()
    {
        $petList = $this->GetAll();
        $id = 0;
        if ($petList != null) {
            foreach ($petList as $pets) {
                if ($pets->getPetId() > $id) {
                    $id = $pets->getPetId();
                }
            }
        }
        return $id + 1;
    }
    public function Remove($id)
    {
        $this->RetrieveData();

        $newList = array();

        foreach ($this->petsList as $pets) {
            if ($pets->getPetId() != $id) {
                array_push($newList, $pets);
            }
        }

        $this->petsList = $newList;

        $this->SavePets();
    }

    public function recuperarMascotas($ownerId){
        $query = "SELECT * FROM ".$this->tableName."INER JOING _owner AS o ON o.petsId=Pets.petsId where ownerId=$ownerId";

        $this->connection = Connection::GetInstance();

        $resultSet = $this->connection->Execute($query);
    }
}
