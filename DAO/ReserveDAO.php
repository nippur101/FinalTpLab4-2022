<?php

namespace DAO;

use Models\Reserve;

class ReserveDAO implements IReserveDAO
{

    private $reserveList = array();

    public function getAll()
    {

        $this->retrieveData();

        return $this->reserveList;
    }

    public function Add(Reserve $reserve)
    {
        $this->RetrieveData();

        array_push($this->reserveList, $reserve);

        $this->SaveReserve();
    }

    public function GetByOwner($owner)
    {
        $this->RetrieveData();

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
        $this->RetrieveData();

        $reserve = $this->GetReserve($reserveId);

        if ($reserve != null) {
            $key = array_search($reserve, $this->reserveList);
            unset($this->reserveList[$key]);
            $this->SaveReserve();
        }
    }

    public function GetByKeeper($keeper)
    {
        $this->RetrieveData();

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
        $this->RetrieveData();

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
        $this->RetrieveData();

        foreach ($this->reserveList as $reserve) {
            if ($reserve->getReserveID() == $reserveId) {
                return $reserve;
            }
        }
    }

    public function Update(Reserve $reserve)
    {
        $this->RetrieveData();

        foreach ($this->reserveList as $reserveValue) {
            if ($reserveValue->getReserveID() == $reserve->getReserveID()) {
                $reserveValue = $reserve;
            }
        }

        $this->SaveReserve();
    }

    public function retrieveData()
    {

        $this->reserveList = array();

        if (file_exists('Data/reserve.json')) {
            $jsonContent = file_get_contents('Data/reserve.json');

            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach ($arrayToDecode as $valuesArray) {


                $reserve = new Reserve();
                $reserve->setReserveId($valuesArray["reserveId"]);
                $reserve->setStartDate($valuesArray["startDate"]);
                $reserve->setFinalDate($valuesArray["finalDate"]);
                $reserve->setAmountPaid($valuesArray["amountPaid"]);
                $reserve->setKeeper($valuesArray["keeper"]);
                $reserve->setPets($valuesArray["pets"]);
                $reserve->setTotalCost($valuesArray["totalCost"]);


                array_push($this->reserveList, $reserve);
            }
        }
    }
    private function SaveReserve()
    {
        $arrayToEncode = array();

        foreach ($this->reserveList as $reserve) {
            $valuesArray["reserveId"] = $reserve->getReserveId();
            $valuesArray["startDate"] = $reserve->getStartDate();
            $valuesArray["finalDate"] = $reserve->getFinalDate();
            $valuesArray["amountPaid"] = $reserve->getAmountPaid();
            $valuesArray["keeper"] = $reserve->getKeeper();
            $valuesArray["pets"] = $reserve->getPets();
            $valuesArray["totalCost"] = $reserve->getTotalCost();


            array_push($arrayToEncode, $valuesArray);
        }

        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

        file_put_contents('Data/reserve.json', $jsonContent);
    }
}
?>