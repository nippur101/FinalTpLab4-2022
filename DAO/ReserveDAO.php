<?php

namespace DAO;

use Models\Reserve;

class ReserveDAO
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

    public function validReserve($starDate, $finalDate)
    {



        $check = false;


        return $check;
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
