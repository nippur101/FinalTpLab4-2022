<?php

namespace DAO;
use \Exception as Exception;
use Models\Owner;
use Models\Pets;

class OwnerPDO
{
    private $connection;
    private $ownerList = array();
    private $tableName = "_Owner";
    public function getAll()
    {
        $this->retrieveData();

        return $this->ownerList;
    }

    public function Add(Owner $owner)
    {
       
        try
        {
            $query = "INSERT INTO ".$this->tableName." (userId, firstName, lastName, email, _password, userType) VALUES (:userId, :firstName, :lastName :email, :_password, :userType);";
            
                $arrayPets=array();

     

                $valuesArray["userId"] =NULL;
                $valuesArray["firstName"] = $owner->getFirstName();
                $valuesArray["lastName"] = $owner->getLastName();
                $valuesArray["email"] = $owner->getEmail();
                $valuesArray["phone"] = $owner->getPhone();
                $valuesArray["password"] = $owner->getPassword();
                $valuesArray["userType"] = $owner->getUserType();
                //$valuesArray["pets"] = $owner->getPets();
                if ($owner->getPets() != null) {
                    foreach ($owner->getPets() as $pets) {
                        $arrayPets["petId"] = $pets->getPetId();
                        $arrayPets["name"] = $pets->getName();
                        $arrayPets["vaccinationPlan"] = $pets->getVaccinationPlan();
                        $arrayPets["petType"] = $pets->getPetType();
                        $arrayPets["raze"] = $pets->getRaze();
                        $arrayPets["video"] = $pets->getVideo();
                        $arrayPets["image"] = $pets->getImage();
                        $arrayPets["owner"] = $pets->getOwner();
                        $valuesArray["pets"][] = $arrayPets;
                    }
                }
    
            




            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $valuesArray);
        }
        catch(Exception $ex)
        {
           
            throw $ex;
        }
    }

    public function GetOwner($userID)
    {
        $this->retrieveData();
        $ownerR = null;
        foreach ($this->ownerList as $owner) {
            if ($owner->getUserID() == $userID) {
                $ownerR = $owner;
            }
        }

        return $ownerR;
    }

    public function ReturnDefaultOwner($userObject)
    {
        $owner = new Owner();
        $owner->setFirstName($userObject->getFirstName());
        $owner->setLastName($userObject->getLastName());
        $owner->setEmail($userObject->getEmail());
        $owner->setPassword($userObject->getPassword());
        $owner->setUserType($userObject->getUserType());
        $owner->setUserID($userObject->getUserID());
        $owner->setPhone("Incompleta");
        $owner->setPets(array());

        return $owner;
    }
/*
    public function Remove($id)
    {
        $this->RetrieveData();

        $newList = array();

        foreach ($this->ownerList as $owner) {
            if ($owner->getUserID() != $id) {
                array_push($newList, $owner);
            }
        }

        $this->ownerList = $newList;

        $this->SaveOwner();
    }

    public function addPetOwner($pet, $owner)
    {
        $this->retrieveData();
        $owner->setPets($pet->getPetId());


        $this->Remove($owner->getUserID());

        $this->add($owner);

        $this->SaveOwner();
    }
*/
    public function retrieveData()
    {

        $this->ownerList = array();

        try
            {
              
                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                foreach ($resultSet as $valuesArray) {

                    $owner = new Owner();
                    $owner->setUserId($valuesArray["userId"]);
                    $owner->setFirstName($valuesArray["firstName"]);
                    $owner->setLastName($valuesArray["lastName"]);
                    $owner->setEmail($valuesArray["email"]);
                    $owner->setPassword($valuesArray["_password"]);
                    $owner->setUserType($valuesArray["userType"]);
                    $owner->setPhone($valuesArray["phone"]);
                   // $owner->setPets($valuesArray["pets"]);
                    if (isset($valuesArray["pets"])) {
                        foreach ($valuesArray["pets"] as $value) {
                            $pets = new Pets();
    
                            $pets->setPetId($value["petId"]);
                            $pets->setName($value["name"]);
                            $pets->setVaccinationPlan($value["vaccinationPlan"]);
                            $pets->setRaze($value["raze"]);
                            $pets->setPetType($value["petType"]);
                            $pets->setVideo($value["video"]);
                            $pets->setImage($value["image"]);
                            $pets->setOwner($value["owner"]);
            
            
                            $owner->addPets( $pets);
                        }
                    }
    
                    array_push($this->ownerList, $owner);
                }

                return $this->ownerList;
               
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
    }
   
}