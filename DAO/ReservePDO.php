<?php

namespace DAO;
use \Exception as Exception;
use Models\Reserve;

class ReservePDO implements IReserveDAO
{
    private $connection;
    private $tableName = "reserve";
    private $reserveList = array();

    public function GetAll(){
        try{
            $query = "SELECT * FROM ".$this->tableName;
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);
            foreach ($resultSet as $valuesArray) {
                $reserve = new Reserve();
                $reserve->setReserveId($valuesArray["reserveId"]);
                $reserve->setPets($valuesArray["petsId"]);
                $reserve->setKeeper($valuesArray["keeperId"]);
                $reserve->setStartDate($valuesArray["startDate"]);
                $reserve->setFinalDate($valuesArray["finalDate"]);
                $reserve->setTotalCost($valuesArray["totalCost"]);
                $reserve->setAmountPaid($valuesArray["amountPaid"]);
                $reserve->setOwner($valuesArray["ownerId"]);
                $reserve->setKeeperReviewStatus($valuesArray["reviewStatus"]);
                $reserve->setPaymentReviewStatus($valuesArray["paymentStatus"]);
                array_push($this->reserveList, $reserve);
            }
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function AddReserve($reserve){
        try{
            $query = "INSERT INTO ".$this->tableName." (petsId, keeperId, startDate, finalDate, totalCost, amountPaid, ownerId, reviewStatus, paymentStatus) VALUES (:petsId, :keeperId, :startDate, :finalDate, :totalCost, :amountPaid, :ownerId, :reviewStatus, :paymentStatus)";
            $parameters["petsId"] = $reserve->getPets();
            $parameters["keeperId"] = $reserve->getKeeper();
            $parameters["startDate"] = $reserve->getStartDate();
            $parameters["finalDate"] = $reserve->getFinalDate();
            $parameters["totalCost"] = $reserve->getTotalCost();
            $parameters["amountPaid"] = $reserve->getAmountPaid();
            $parameters["ownerId"] = $reserve->getOwner();
            $parameters["reviewStatus"] = $reserve->getKeeperReviewStatus();
            $parameters["paymentStatus"] = $reserve->getPaymentReviewStatus();
            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function GetByOwner($owner){
        $this->GetAll();

        $reserves = array();

        foreach ($this->reserveList as $reserve) {
            if ($reserve->getOwner() == $owner) {
                array_push($reserves, $reserve);
            }
        }

        return $reserves;
    }

    public function Delete($reserveId)
    {
        try{
            $query = "DELETE FROM ".$this->tableName." WHERE reserveId = ".$reserveId;
            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query);
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function GetByKeeper($keeper)
    {
        $this->GetAll();

        $reserveList = array();

        foreach ($this->reserveList as $reserve) {
            if ($reserve->getKeeper() == $keeper->getUserID()) {
                array_push($reserveList, $reserve);
            }
        }

        return $reserveList;
    }

    public function GetPetsWithoutReserve($petList)
    {
        $this->GetAll();

        $petListWithoutReserve = array();

        foreach ($petList as $pet) {
            $flag = true;
            foreach ($this->reserveList as $reserve) {
                if ($reserve->getPets() == $pet->getPetId()) {
                    $flag = false;
                }
            }
            if ($flag) {
                array_push($petListWithoutReserve, $pet);
            }
        }

        return $petListWithoutReserve;
    }

    public function GetReserve($reserveId)
    {
        $this->GetAll();

        foreach ($this->reserveList as $reserve) {
            if ($reserve->getReserveID() == $reserveId) {
                return $reserve;
            }
        }
    }

    public function Update(Reserve $reserve)
    {
        try{
            $query = "UPDATE ".$this->tableName." SET keeperId = ".$reserve->getKeeper().", petsId = ".$reserve->getPets().", startDate = '".$reserve->getStartDate()."', finalDate = '".$reserve->getFinalDate()."', totalCost = ".$reserve->getTotalCost().", amountPaid = ".$reserve->getAmountPaid().", reviewStatus = ".$reserve->getKeeperReviewStatus().", paymentStatus = ".$reserve->getPaymentReviewStatus()." WHERE reserveId = ".$reserve->getReserveId();
            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query);
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function GetReservesConfirmedByKeeper($keeperId){
        $this->GetAll();

        $reserveList = array();

        foreach ($this->reserveList as $reserve) {
            if ($reserve->getKeeper() == $keeperId && $reserve->getKeeperReviewStatus() == 1 && $reserve->getPaymentReviewStatus() == 1) {
                array_push($reserveList, $reserve);
            }
        }

        return $reserveList;
    }
}
?>