<?php

namespace DAO;

use Models\Keeper as Keeper;

class KeeperDAO{
    private $keeperList = array();

    public function getAll(){
        $this->retrieveData();
        return $this->keeperList;
    }

    public function Add(Keeper $keeper)
    {
            $this->RetrieveData();
            
            array_push($this->keeperList, $keeper);

            $this->SaveKeeper();
    }

    public function GetKeeper($userID){
        $this->retrieveData();

        $keeperR = null;

        foreach($this->keeperList as $keeper){
            if($keeper->getUserID() == $userID){
                $keeperR = $keeper;
            }
        }

        return $keeperR;
    }

    public function Update(Keeper $keeper){
        $this->retrieveData();

        foreach($this->keeperList as $keeperAux){
            if($keeperAux->getUserID() == $keeper->getUserID()){
                $keeperAux = $keeper;
            }
        }

        $this->SaveKeeper();
    }

    public function retrieveData(){

        $this->keeperList = array();

            if(file_exists('Data/keeper.json'))
            {
                $jsonContent = file_get_contents('Data/keeper.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray){
                    $keeper = new Keeper();
                    $keeper->setUserID($valuesArray["userID"]);
                    $keeper->setAddress($valuesArray["address"]);
                    $keeper->setPetSize($valuesArray["petSize"]);
                    $keeper->setStayCost($valuesArray["stayCost"]);
                    $keeper->setFreeTimePeriod($valuesArray["freeTimePeriod"]);
                    $keeper->setReviews($valuesArray["reviews"]);
                    array_push($this->keeperList, $keeper);
                }
            }
    }

    public function SaveData(){
        $arrayToEncode = array();

        foreach($this->keeperList as $keeper){
            $valuesArray["address"] = $keeper->getAddress();
            $valuesArray["petSize"] = $keeper->getPetSize();
            $valuesArray["stayCost"] = $keeper->getStayCost();
            $valuesArray["freeTimePeriod"] = $keeper->getFreeTimePeriod();
            $valuesArray["reviews"] = $keeper->getReviews();
            array_push($arrayToEncode, $valuesArray);
        }

        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        file_put_contents('Data/keeper.json', $jsonContent);
    }

}