<?php

namespace DAO;
use \Exception as Exception;
use Models\Owner;
use Models\Pets;

class OwnerPDO implements IOwnerDAO
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
            $query = "CALL addOwner(".$owner->getUserID().",'".$owner->getPhone()."');";
            
            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query);
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
*/
    public function addPetOwner($pet, $owner)
    {
        
        $pet->setOwner($owner->getUserID);

    }

    public function retrieveData()
    {

        $this->ownerList = array();
        $petList=array();
        $petsPDO=new PetsPDO();
        $userList=array();
        $userPDO=new UserPDO();

        try
            {
                $userList=$userPDO->getAll();
              
                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $valuesArray) {

                    $owner = new Owner();
                    $owner->setUserId($valuesArray["userId"]);
                    $owner->setPhone($valuesArray["phone"]);
                
                foreach($userList as $user){
                    if($owner->getUserID()==$user->getUserID()){
                        $owner->setFirstName($user->getFirstName());
                        $owner->setLastName($user->getLastName());
                        $owner->setEmail($user->getEmail());
                        $owner->setPassword($user->getPassword());
                        $owner->setUserType($user->getUserType());
                    }
    
                }
                    $petList= $petsPDO->ReturnOwnerPets($owner->getUserID());
                    $owner->setPets($petList);
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
?>