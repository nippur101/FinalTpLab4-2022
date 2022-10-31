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

            $this->SaveData();
    }

    public function GetKeeper($userID){
        $this->retrieveData();

        $keeperR = null;

        foreach($this->keeperList as $keeper){
            if($keeper->getKeeperId() == $userID){
                $keeperR = $keeper;
            }
        }

        return $keeperR;
    }

    public function Update(Keeper $keeper){
        $flag = false;
        //$this->retrieveData();

        foreach($this->keeperList as $keeperAux){
            if($keeperAux->getKeeperId() == $keeper->getKeeperId()){
                $keeperAux = $keeper;
                $flag = true;
            }
        }

        $this->SaveData();
        return $flag;
    }

    public function RetrieveData(){

        $this->keeperList = array();

            if(file_exists('Data/keeper.json'))
            {
                $jsonContent = file_get_contents('Data/keeper.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray){
                    $keeper = new Keeper("Unknown", "Unknown", "Unknown", "Unknown",$valuesArray["address"], 
                                        $valuesArray["petSize"], $valuesArray["stayCost"], $valuesArray["userID"]);
                    $keeper->setFreeTimePeriod($valuesArray["freeTimePeriod"]);
                    $keeper->setReviews($valuesArray["reviews"]);
                    array_push($this->keeperList, $keeper);
                }
            }
    }

    public function SaveData(){
        $arrayToEncode = array();

        foreach($this->keeperList as $keeper){
            $valuesArray["userID"] = $keeper->getKeeperId();
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