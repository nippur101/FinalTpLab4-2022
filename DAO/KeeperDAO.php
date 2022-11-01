<?php

namespace DAO;

use Models\Keeper as Keeper;

use DAO\UserDAO as UserDAO;
use Models\FreeTimePeriod;

class KeeperDAO{
    private $keeperList = array();
    private $userList=array();

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
       
        $keeperR = new Keeper();


        foreach($this->keeperList as $keeper){
            if($keeper->getUserID() == $userID){
                $keeperR = $keeper;
            }
        }

        return $keeperR;
    }

    public function addFreePeriodOfTime($time,$keeper){
        $this->retrieveData();
        $keeper->setFreeTimePeriod($time);

       
        $this->Remove($keeper->getUserID());
     
        $this->add($keeper);
       
        $this->SaveData();

    }
    public function Remove($id) {
        $this->RetrieveData();

        $newList = array();

        foreach($this->keeperList as $keeper) {
            if($keeper->getUserID() != $id) {
                array_push($newList, $keeper);
            }
        }

        $this->keeperList = $newList;

        $this->SaveData();
    }



    public function Update(Keeper $keeper){
        $this->retrieveData();

        foreach($this->keeperList as $keeperAux){
            if($keeperAux->getUserID() == $keeper->getUserID()){
                $keeperAux = $keeper;
            }
        }


        $this->SaveData();

    }

    public function retrieveData(){

        $this->keeperList = array();

            if(file_exists('Data/keeper.json'))
            {
                $jsonContent = file_get_contents('Data/keeper.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray){
                    $keeper = new Keeper();

                    $keeper->setUserId($valuesArray["userId"]);
                    $keeper->setFirstName($valuesArray["firstName"]);
                    $keeper->setLastName($valuesArray["lastName"]);
                    $keeper->setEmail($valuesArray["email"]);
                    $keeper->setPassword($valuesArray["password"]);
                    $keeper->setUserType($valuesArray["userType"]);
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
        $this->RetrieveData();
        $arrayToEncode = array();
        $arrayTime=array();
        

        foreach($this->keeperList as $keeper){

            
            $valuesArray["userId"] = $keeper->getUserId();
            $valuesArray["firstName"] = $keeper->getFirstName();
            $valuesArray["lastName"] = $keeper->getLastName();
            $valuesArray["email"] = $keeper->getEmail();
            $valuesArray["password"] = $keeper->getPassword();
            $valuesArray["userType"] = $keeper->getUserType();

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


    public function OcupedTimePeriod($startDate,$finalDate){
        $val=true;
        $keeper=$_SESSION["loggedUser"] ;/*
        if($keeper->getFreeTimePeriod()!=null){
            foreach($keeper->getFreeTimePeriod() as $ocuped){
                if(($ocuped->getStartDate()<$startDate && $ocuped->getFinalDate()<$finalDate)||
                ($ocuped->getStartDate()>$startDate && $ocuped->getFinalDate()<$finalDate) ){
                    $val=true;
                }

            }
        }*/
        return $val;
    }


}