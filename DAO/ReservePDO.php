<?php

namespace DAO;
use \Exception as Exception;
use Models\Reserve;

class ReservePDO {
    private $connection;
    private $tableName = "Reserve";
    private $reserveList = array();

    public function GetAll(){
        try{
            $query = "SELECT * FROM ".$this->tableName;
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);
            foreach ($resultSet as $valuesArray) {
                $reserve = new Reserve();
                $reserve->setReserveId($valuesArray["reserveId"]);
                $reserve->setPets($valuesArray["petId"]);
                $reserve->setKeeper($valuesArray["keeperId"]);
                $reserve->setStartDate($valuesArray["startDate"]);
                $reserve->setFinalDate($valuesArray["finalDate"]);
                $reserve->setTotalCost($valuesArray["price"]);
                $reserve->setAmountPaid($valuesArray["amountPaid"]);
                $reserve->setKeeperReviewStatus($valuesArray["reviewStatus"]);
                $reserve->setPaymentReviewStatus($valuesArray["paymentStatus"]);
                array_push($this->reserveList, $reserve);
            }
            return $this->reserveList;
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function Add(Reserve $reserve){
        try{
            $query = "CALL addReserve(".$reserve->getKeeper().",".$reserve->getPets().",'".$reserve->getStartDate()."','".$reserve->getFinalDate()."',".$reserve->getTotalCost().",".$reserve->getAmountPaid().",".$reserve->getKeeperReviewStatus().",".$reserve->getPaymentReviewStatus().");";
            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query);
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
            $query = "UPDATE ".$this->tableName." SET keeperId = ".$reserve->getKeeper().", petId = ".$reserve->getPets().", startDate = '".$reserve->getStartDate()."', finalDate = '".$reserve->getFinalDate()."', price = ".$reserve->getTotalCost().", amountPaid = ".$reserve->getAmountPaid().", reviewStatus = ".$reserve->getKeeperReviewStatus().", paymentStatus = ".$reserve->getPaymentReviewStatus()." WHERE reserveId = ".$reserve->getReserveId();
            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query);
        }
        catch(Exception $ex){
            throw $ex;
        }
    }
}
?>