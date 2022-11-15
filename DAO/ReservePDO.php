<?php

namespace DAO;
use \Exception as Exception;
use Models\Reserve;

class ReservePDO
{

    private $reserveList = array();
    private $connection;
    private $tableName = "Reserve";

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

        try
            {
              
                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
              

                
                    
                foreach ($resultSet as $valuesArray) {


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
                    
    

                return $this->reserveList;
               
            }
            catch(Exception $ex)
            {
                throw $ex; 
            
             }
    }
    private function SaveReserve(Reserve $reserve)
    {
        try
        {
            //agregar de BD
            $query = "CALL addReserve ('".$reserve->getName()."','".$reserve->getVaccinationPlan()."','".$pets->getRaze()."','".$pets->getPetType()."','".$pets->getVideo()."','".$pets->getImage()."',".$pets->getOwner().");";
           

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query);

        }
        catch(Exception $ex)
        {
            var_dump($query);
            throw $ex;
        }

    }
}
?>