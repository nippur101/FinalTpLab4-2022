<?php

namespace DAO;

use \Exception as Exception;
use Models\Pets;
use Models\Keeper as Keeper;
use DAO\UserDAO as UserDAO;
use Models\FreeTimePeriod;

class KeeperPDO implements IKeeperDAO
{
    private $keeperList = array();
    private $connection;
    private $tableName = "keeper";
    private $tableName2 = "FreeTimePeriod";


    public function getAll()
    {
        $this->retrieveData();
        return $this->keeperList;
    }

    public function Add(Keeper $keeper)
    {
        try {
            $query = "INSERT INTO " . $this->tableName . " (address, petSize, stayCost, userID) VALUES (:address, :petSize, :stayCost, :userID);";
            $parameters["address"] = $keeper->getAddress();
            $parameters["petSize"] = $keeper->getPetSize();
            $parameters["stayCost"] = $keeper->getStayCost();
            $parameters["userID"] = $keeper->getUserID();
            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function updateKeeper(Keeper $keeper)
    {
        try {
            $query = "UPDATE " . $this->tableName . " SET address = '" . $keeper->getAddress() . "', petSize = '" . $keeper->getPetSize() . "', stayCost = " . $keeper->getStayCost() . " WHERE userID = " . $keeper->getUserID() . ";";
            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function Remove($id)
    {
        try {
            $query = "DELETE FROM " . $this->tableName . " WHERE userID = " . $id;
            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query);
        } catch (Exception $ex) {
            throw $ex;
        }
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

        $userList = array();
        $userPDO = new UserPDO();

        try {
            $userList = $userPDO->getAll();

            $query = "SELECT * FROM " . $this->tableName;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);
            foreach ($resultSet as $valuesArray) {

                $keeper = new Keeper();
                $keeper->setUserId($valuesArray["userId"]);
                $keeper->setAddress($valuesArray["address"]);
                $keeper->setPetSize($valuesArray["petsize"]);
                $keeper->setStayCost($valuesArray["stayCost"]);
                $keeper->setReviews($valuesArray["reviews"]);

                $keeper->setFreeTimePeriod($this->GetFromTableKeeperFreeTimePeriod($keeper->getUserID()));

                foreach ($userList as $user) {
                    if ($keeper->getUserID() == $user->getUserID()) {
                        $keeper->setFirstName($user->getFirstName());
                        $keeper->setLastName($user->getLastName());
                        $keeper->setEmail($user->getEmail());
                        $keeper->setPassword($user->getPassword());
                        $keeper->setUserType($user->getUserType());
                    }
                }
                array_push($this->keeperList, $keeper);
            }

            return $this->keeperList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function IsValidDate($startDate, $finalDate)
    {
        $isValid = true;
        $keeperList = $this->getAll();
        if ($startDate > $finalDate) {
            $isValid = false;
        }
        return $isValid;
    }

    public function addFreePeriodOfTime(FreeTimePeriod $freeTimePeriod, $keeper)
    {
        $keeper->AddTimePeriod($freeTimePeriod);
        try {
            $query = "INSERT INTO " . $this->tableName2 . " (keeperId, startDate, finalDate) VALUES (:keeperId, :startDate, :finalDate);";
            $parameters["keeperId"] = $freeTimePeriod->getKeeperID();
            $parameters["startDate"] = $freeTimePeriod->getStartDate();
            $parameters["finalDate"] = $freeTimePeriod->getFinalDate();
            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);
            $this->retrieveData();
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetFromTableKeeperFreeTimePeriod($keeperID)
    {
        $freeTimePeriodList = array();
        try {
            $query = "SELECT * FROM " . $this->tableName2 . " WHERE keeperId = " . $keeperID;
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);
            foreach ($resultSet as $valuesArray) {
                $freeTimePeriod = new FreeTimePeriod();
                $freeTimePeriod->setKeeperID($valuesArray["keeperId"]);
                $freeTimePeriod->setStartDate($valuesArray["startDate"]);
                $freeTimePeriod->setFinalDate($valuesArray["finalDate"]);
                array_push($freeTimePeriodList, $freeTimePeriod);
            }
            return $freeTimePeriodList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

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

    public function RemoveFreeTimePeriod($keeper, $startDate, $finalDate)
    {
        $keeper->RemoveTimePeriod($startDate, $finalDate);
        try {
            $query = "DELETE FROM " . $this->tableName2 . " WHERE keeperId = :keeperId AND startDate = :startDate AND finalDate = :finalDate";
            $parameters["keeperId"] = $keeper->getUserID();
            $parameters["startDate"] = $startDate;
            $parameters["finalDate"] = $finalDate;
            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);
            $this->retrieveData();
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
