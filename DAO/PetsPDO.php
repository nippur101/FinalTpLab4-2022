<?php

namespace DAO;

use \Exception as Exception;
use DAO\OwnerPDO;
use DAO\OwnerDAO;
use Models\Pets;
use Models\Owner;

class PetsPDO
{

    private $petsList = array();

    private $connection;
    
    private $tableName = "Pets";
    public function __construct()
    {
       

      //  $this->ownerDAO = new OwnerDAO();
    }

    public function getAll()
    {

        $this->retrieveData();

        return $this->petsList;
    }

    public function Add(Pets $pets)
    {/*
        $ownerDAO = new OwnerPDO();
        $owner = $_SESSION["loggedUser"];
        $ownerDAO->addPetOwner($pets, $owner);
*/
        $this->SavePets($pets);
       


    }

    public function ReturnOwnerPets($ownerId){
        $ownerPets = array();
        try
            {
                $query = "CALL ownerPets(".$ownerId.")";

                $this->connection = Connection::GetInstance();

                $ownerPets = $this->connection->Execute($query);
                
                foreach ($ownerPets as $pet)
                {                
                    $pets = new Pets();
    
                    $pets->setPetId($pet["petsId"]);
                    $pets->setName($pet["_name"]);
                    $pets->setVaccinationPlan($pet["vaccinationPlan"]);
                    $pets->setRaze($pet["raze"]);
                    $pets->setPetType($pet["petType"]);
                    $pets->setVideo($pet["video"]);
                    $pets->setImage($pet["image"]);
                    $pets->setOwner($pet["ownerId"]);
    
    
                    array_push($ownerPets, $pets);
                }   


                return $ownerPets;
               
            }
            catch(Exception $ex)
            {
                throw $ex;
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
                            $pets = new Pets();
    
                            $pets->setPetId($valuesArray["petsId"]);
                            $pets->setName($valuesArray["_name"]);
                            $pets->setVaccinationPlan($valuesArray["vaccinationPlan"]);
                            $pets->setRaze($valuesArray["raze"]);
                            $pets->setPetType($valuesArray["petType"]);
                            $pets->setVideo($valuesArray["video"]);
                            $pets->setImage($valuesArray["image"]);
                            $pets->setOwner($valuesArray["ownerId"]);
            
            
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
            $query = "CALL addPet ('".$pets->getName()."','".$pets->getVaccinationPlan()."','".$pets->getRaze()."','".$pets->getPetType()."','".$pets->getVideo()."','".$pets->getImage()."',".$pets->getOwner().");";
           

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query);

        }
        catch(Exception $ex)
        {
            var_dump($query);
            throw $ex;
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
        try
        {
            $query = "CALL eliminatePet (".$id.");";
           

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query);

        }
        catch(Exception $ex)
        {
            var_dump($query);
            throw $ex;
        }
    }

    

}
?>