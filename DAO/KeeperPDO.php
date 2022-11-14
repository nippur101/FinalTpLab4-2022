<?php

namespace DAO;
use \Exception as Exception;
use Models\Pets;
use Models\Keeper as Keeper;
use DAO\UserDAO as UserDAO;
use Models\FreeTimePeriod;

class KeeperPDO
{
    private $keeperList = array();
    private $connection;
    private $tableName = "Keeper";


    public function getAll()
    {
        $this->retrieveData();
        return $this->keeperList;
    }

    public function Add(Keeper $keeper)
    {
        
        try
        {
            $query = "CALL addKeeper('".$keeper->getAddress()."','".$keeper->getPetSize()."',".$keeper->getStayCost().",".$keeper->getUserID().");";
          
            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query);
        }
        catch(Exception $ex)
        {
           
            throw $ex;
        }
    }

    public function Remove($id)
    {
        $this->RetrieveData();

        $newList = array();

        foreach ($this->keeperList as $keeper) {
            if ($keeper->getUserID() != $id) {
                array_push($newList, $keeper);
            }
        }

        $this->keeperList = $newList;

        $this->SaveData();
    }

    public function GetKeeper($userID)
    {
        $this->RetrieveData();
        $keeperR = new Keeper();

        foreach ($this->keeperList as $keeper) {
            if ($keeper->getUserID() == $userID) {
                $keeperR = $keeper;
            }
        }

        return $keeperR;
    }
/*
    public function addFreePeriodOfTime($time, $keeper)
    {
        $keeper->AddTimePeriod($time);
        $this->Update($keeper);
    }



    public function Update(Keeper $keeper)
    {
        $this->RetrieveData();

        $newList = array();

        foreach ($this->keeperList as $keeperR) {
            if ($keeperR->getUserID() != $keeper->getUserID()) {
                array_push($newList, $keeperR);
            }
        }

        array_push($newList, $keeper);

        $this->keeperList = $newList;

        $this->SaveData();
    }
    */

    public function ReturnDefaultKeeper($userObject)
    {
        $keeper = new Keeper();
        $keeper->setFirstName($userObject->getFirstName());
        $keeper->setLastName($userObject->getLastName());
        $keeper->setEmail($userObject->getEmail());
        $keeper->setPassword($userObject->getPassword());
        $keeper->setUserType($userObject->getUserType());
        $keeper->setUserID($userObject->getUserID());
        $keeper->setAddress("Incompleta");
        $keeper->setPetSize("Incompleta");
        $keeper->setStayCost(0.0);
        $keeper->setFreeTimePeriod(array());
        $keeper->setReviews(array());

        return $keeper;
    }

    public function retrieveData()
    {

        $userList=array();
        $userPDO=new UserPDO();
    
            try
                {
                    $userList=$userPDO->getAll();
    
                    $query = "SELECT * FROM ".$this->tableName;
    
                    $this->connection = Connection::GetInstance();
    
                    $resultSet = $this->connection->Execute($query);
                    foreach ($resultSet as $valuesArray) {
    
                        $keeper = new Keeper();
                        $keeper->setUserId($valuesArray["userId"]);
                        $keeper->setAddress($valuesArray["address"]);
                        $keeper->setPetSize($valuesArray["petSize"]);
                        $keeper->setStayCost($valuesArray["stayCost"]);
                        $keeper->setReviews($valuesArray["reviews"]);
                        $this->KeeperFreeTimePeriod($keeper);
                        array_push($this->keeperList, $keeper);
                    }

                    foreach($userList as $user){
                        if($keeper->getUserID()==$user->getUserID()){
                            $keeper->setFirstName($user->getFirstName());
                            $keeper->setLastName($user->getLastName());
                            $keeper->setEmail($user->getEmail());
                            $keeper->setPassword($user->getPassword());
                            $keeper->setUserType($user->getUserType());
                        }
        
                    }
    
                    return $this->keeperList;
                   
                }
                catch(Exception $ex)
                {
                    throw $ex;
                }
        
    }


    public function KeeperFreeTimePeriod($keeper){
        try
                {
                   
    
                    $query = "CALL keeperFreeTimeperiod(".$keeper->getUserID().");";
    
                    $this->connection = Connection::GetInstance();
    
                    $resultSet = $this->connection->Execute($query);

                    if (isset($resultSet["freeTimePeriod"])) {
                        foreach ($resultSet["freeTimePeriod"] as $value) {
                            $time = new FreeTimePeriod();
                            $time->setStartDate($value["dateStart"]);
                            $time->setFinalDate($value["dateFinal"]);
                            $keeper->AddTimePeriod($time);
                        }
                    }
                }catch(Exception $ex)
                {
                    throw $ex;
                }
    }


    
/*

    public function SaveData()
    {

        $arrayToEncode = array();
        $arrayTime = array();


        foreach ($this->keeperList as $keeper) {

            $valuesArray["userId"] = $keeper->getUserId();
            $valuesArray["firstName"] = $keeper->getFirstName();
            $valuesArray["lastName"] = $keeper->getLastName();
            $valuesArray["email"] = $keeper->getEmail();
            $valuesArray["password"] = $keeper->getPassword();
            $valuesArray["userType"] = $keeper->getUserType();
            $valuesArray["address"] = $keeper->getAddress();
            $valuesArray["petSize"] = $keeper->getPetSize();
            $valuesArray["stayCost"] = $keeper->getStayCost();
            if ($keeper->getFreeTimePeriod() != null) {
                foreach ($keeper->getFreeTimePeriod() as $time) {
                    $arrayTime["dateStart"] = $time->getStartDate();
                    $arrayTime["dateFinal"] = $time->getFinalDate();
                    $valuesArray["freeTimePeriod"][] = $arrayTime;
                }
            }

            $valuesArray["reviews"] = $keeper->getReviews();
            array_push($arrayToEncode, $valuesArray);
        }

        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        file_put_contents('Data/keeper.json', $jsonContent);
    }
*/
    public function IsAvaiableTime($dateStart, $dateFinal, $keeper)
    {
        $this->RetrieveData();
        $avaiable = true;
        foreach ($keeper->getFreeTimePeriod() as $time) {
            if (($time->getStartDate() == $dateStart && $time->getFinalDate() == $dateFinal) ||
                ($time->getStartDate() == $dateStart && $time->getFinalDate() > $dateFinal) ||
                ($time->getStartDate() < $dateStart && $time->getFinalDate() == $dateFinal) ||
                ($time->getStartDate() < $dateStart && $time->getFinalDate() > $dateFinal) ||
                ($time->getStartDate() > $dateStart && $time->getFinalDate() < $dateFinal)
            ) {
                $avaiable = false;
            }
        }
        return $avaiable;
    }

    public function IsKeeperInTime($dateStart, $dateFinal, $keeper)
    {
        $this->RetrieveData();
        $avaiable = null;
        foreach ($keeper->getFreeTimePeriod() as $time) {
            if (($time->getStartDate() == $dateStart && $time->getFinalDate() == $dateFinal) ||
                ($time->getStartDate() == $dateStart && $time->getFinalDate() > $dateFinal) ||
                ($time->getStartDate() < $dateStart && $time->getFinalDate() == $dateFinal) ||
                ($time->getStartDate() < $dateStart && $time->getFinalDate() > $dateFinal) ||
                ($time->getStartDate() > $dateStart && $time->getFinalDate() < $dateFinal)
            ) {
                $avaiable = $time;
            }
        }
        return $avaiable;
    }

    public function OcupedTimePeriod($startDate, $finalDate)
    {
        $val = true;
        $keeper = $_SESSION["loggedUser"];
        if ($keeper->getFreeTimePeriod() != null) {
            foreach ($keeper->getFreeTimePeriod() as $ocuped) {
                if (($ocuped->getStartDate() < $startDate && $ocuped->getFinalDate() < $finalDate) ||
                    ($ocuped->getStartDate() > $startDate && $ocuped->getFinalDate() < $finalDate)
                ) {
                    $val = true;
                } else {
                    $val = false;
                }
            }
        }
        return $val;
    }
}
