<?php

namespace Controllers;

use DAO\KeeperDAO;
use DAO\KeeperPDO;
use DAO\PetsDAO;
use DAO\PetsPDO;
use DAO\ReservePDO;
use DateTime;
use Models\FreeTimePeriod as FreeTimePeriod;

class KeeperController
{

    private $keeperDAO;
    private $petDAO;
    private $reserveDAO;

    public function __construct()
    {
        $this->keeperDAO = new KeeperPDO();
        $this->petDAO = new PetsPDO();
        //===========================================
       // $this->keeperDAO = new KeeperDAO();
        //$this->petDAO = new PetsDAO();
        //===========================================


        $this->reserveDAO = new ReservePDO();
        $this->freeTimePeriod = new FreeTimePeriod();   
    }

    public function ShowCalendarView()
    {
        $keeper = $_SESSION["loggedUser"];
        $HiredTimePeriod = $this->reserveDAO->GetReservesConfirmedByKeeper($keeper->getUserId());
        require_once(VIEWS_PATH . "validate-session.php");
        require_once(VIEWS_PATH . "calendar.php");
    }

    public function CheckAndPushData()
    {
        $keeper = $_SESSION["loggedUser"];
        require_once(VIEWS_PATH . "validate-session.php");
        require_once(VIEWS_PATH . "keeper-profile.php");
    }

    public function AddTimePeriod($startDate, $finalDate)
    {
        $keeper = ($_SESSION["loggedUser"]);
        var_dump($keeper);
        $newTime = new FreeTimePeriod();
        $newTime->setStartDate($startDate);
        $newTime->setFinalDate($finalDate);

        $this->keeperDAO->addFreePeriodOfTime($newTime, $keeper);
        
        $this->ShowCalendarView();
    }


    public function TimePeriod($startDate, $finalDate)
    {
        $keeper = $_SESSION["loggedUser"];

        if($this->keeperDAO->IsValidDate($startDate, $finalDate)){
            if ($this->keeperDAO->IsAvaiableTime($startDate, $finalDate, $keeper) || $keeper->getFreeTimePeriod() == null) {

                if ($keeper->getFreeTimePeriod() == NULL || $keeper->getFreeTimePeriod() == []) {
                    $oldTime = $this->keeperDAO->GetKeeper($keeper->getUserID());
                    $newTime = array();
                    $oldTime->setFreeTimePeriod($newTime);
                }
    
                $time = new FreeTimePeriod();
                $time->setStartDate($startDate);
                $time->setFinalDate($finalDate);
                $time->setKeeperID($keeper->getUserID());
    
                $this->keeperDAO->addFreePeriodOfTime($time, $keeper);
                echo "<script> if(confirm('Periodo agregado!')); </script>";
                //$this->ShowCalendarView();
                header("location: " . FRONT_ROOT . "Keeper/ShowCalendarView");
            } else {
                echo "<script> if(confirm('Periodo de ya ocupado!')); </script>";
                $this->CheckAndPushData();
            }    
        }
        
        require_once(VIEWS_PATH . "validate-session.php");
        require_once(VIEWS_PATH . "keeper-profile.php");
    }

    public function AddSecondInfo($address, $petSize, $stayCost)
    {
        $keeper = $_SESSION["loggedUser"];
        $keeper->setAddress($address);
        $keeper->setStayCost($stayCost);
        $keeper->setPetSize($petSize);
        $this->keeperDAO->updateKeeper($keeper);
        
        echo "<script> if(confirm('Datos actualizados!')); </script>";
        $this->CheckAndPushData();
    }

    public function KeeperList($petId)
    {
        $petToKeep = $this->petDAO->GetPet($petId);

        require_once(VIEWS_PATH . "validate-session.php");
        require_once(VIEWS_PATH . "keeper-list-prev.php");
    }

    public function ReturnKeepersInTime($petId, $startDate, $finalDate){
        $keeperList = $this->keeperDAO->GetAll();
        $keepersInTime = array();
        $eventsOfKeepers = array();
        $from = $startDate;
        $to = $finalDate;
        $petToKeep = $this->petDAO->GetPet($petId);
        foreach ($keeperList as $keeper) {
            $timeFree = $this->keeperDAO->IsKeeperInTime($startDate, $finalDate, $keeper);
            if ($timeFree != null) {
                if($keeper->getPetSize() == $petToKeep->getPetType()){
                    array_push($keepersInTime, $keeper);
                    $eventOfKeepers[$keeper->getUserID()] = $timeFree;
                }
            }
        }
        
        require_once(VIEWS_PATH . "validate-session.php");
        require_once(VIEWS_PATH . "keeper-list.php");
    }

    public function HireKeeper($petId, $keeperID, $startDate, $finalDate){
        $keeper = $this->keeperDAO->GetKeeper($keeperID);
        $event = $this->keeperDAO->IsKeeperInTime($startDate, $finalDate, $keeper);
        $needed = new FreeTimePeriod();
        $needed->setStartDate($startDate);
        $needed->setFinalDate($finalDate);

        $petToKeep = $this->petDAO->GetPet($petId);

        $keeperDateStart = new DateTime($event->getStartDate());
        $keeperDateFinal = new DateTime($event->getFinalDate());
        $keeperInterval = $keeperDateStart->diff($keeperDateFinal);
        
        $requestedDateStart = new DateTime($needed->getStartDate());
        $requestedDateFinal = new DateTime($needed->getFinalDate());
        $requestedInterval = $requestedDateStart->diff($requestedDateFinal);
        
        require_once(VIEWS_PATH . "validate-session.php");
        require_once(VIEWS_PATH . "confirm-reserve.php");

    }
}
