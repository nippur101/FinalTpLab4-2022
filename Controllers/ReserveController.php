<?php 

namespace Controllers;

use DAO\ReserveDAO as ReserveDAO;
use Models\Reserve as Reserve;

class ReserveController
{
    private $reserveDAO;

    public function __construct()
    {
        $this->reserveDAO = new ReserveDAO();
    }

    public function GenerateReserve($keeperId, $keeperStartDate, $keeperFinalDate, $keeperStayCost, $totalStayCost, $petId){
        
    }
}