<?php

namespace DAO;

use Models\Owner;

class OwnerDAO
{

    private $ownerList = array();

    public function getAll()
    {

        $this->retrieveData();

        return $this->ownerList;
    }

    public function Add(Owner $owner)
    {
        $this->RetrieveData();

        array_push($this->ownerList, $owner);

        $this->SaveOwner();
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


    public function retrieveData()
    {


        $this->ownerList = array();

        if (file_exists('Data/owner.json')) {
            $jsonContent = file_get_contents('Data/owner.json');

            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach ($arrayToDecode as $valuesArray) {
                $owner = new Owner();

                $owner->setUserID($valuesArray["userId"]);
                $owner->setEmail($valuesArray["email"]);
                $owner->setFirstName($valuesArray["firstName"]);
                $owner->setLastName($valuesArray["lastName"]);
                $owner->setPassword($valuesArray["password"]);
                $owner->setPhone($valuesArray["phone"]);
                $owner->setUserType($valuesArray["userType"]);
                $owner->setPets($valuesArray["pets"]);

                array_push($this->ownerList, $owner);
            }
        }
    }
    private function SaveOwner()
    {
        $arrayToEncode = array();

        foreach ($this->ownerList as $owner) {

            $valuesArray["userId"] = $owner->getUserId();
            $valuesArray["firstName"] = $owner->getFirstName();
            $valuesArray["lastName"] = $owner->getLastName();
            $valuesArray["email"] = $owner->getEmail();
           
            $valuesArray["password"] = $owner->getPassword();
            $valuesArray["userType"] = $owner->getUserType();
            $valuesArray["phone"] = $owner->getPhone();
            $valuesArray["pets"] = $owner->getPets();


            array_push($arrayToEncode, $valuesArray);
        }

        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

        file_put_contents('Data/owner.json', $jsonContent);
    }
}
