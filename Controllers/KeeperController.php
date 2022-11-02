<?php

namespace Controllers;

use DAO\KeeperDAO;
use DateTime;
use Models\FreeTimePeriod as FreeTimePeriod;

class KeeperController
{

    private $keeperDAO;

    public function __construct()
    {
        $this->keeperDAO = new KeeperDAO();
        $this->freeTimePeriod = new FreeTimePeriod();
    }

    public function ShowCalendarView()
    {
        $keeper = $_SESSION["loggedUser"];
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
        var_dump($keeper);
        $this->ShowCalendarView();
    }


    public function TimePeriod($startDate, $finalDate)
    {
        $keeper = $_SESSION["loggedUser"];

        if ($this->keeperDAO->IsAvaiableTime($startDate, $finalDate, $keeper) || $keeper->getFreeTimePeriod() == null) {

            if ($keeper->getFreeTimePeriod() == NULL || $keeper->getFreeTimePeriod() == []) {
                $oldTime = $this->keeperDAO->GetKeeper($keeper->getUserID());
                $newTime = array();
                $oldTime->setFreeTimePeriod($newTime);
            }

            $time = new FreeTimePeriod();
            $time->setStartDate($startDate);
            $time->setFinalDate($finalDate);

            $this->keeperDAO->addFreePeriodOfTime($time, $keeper);
            echo "<script> if(confirm('Periodo agregado!')); </script>";
            $this->ShowCalendarView();
        } else {
            echo "<script> if(confirm('Periodo de ya ocupado!')); </script>";
            $this->CheckAndPushData();
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
        $this->keeperDAO->Remove($keeper->getUserID());
        $this->keeperDAO->Add($keeper);

        echo "<script> if(confirm('Datos actualizados!')); </script>";
        $this->CheckAndPushData();
    }

    public function KeeperList()
    {
        require_once(VIEWS_PATH . "validate-session.php");
        require_once(VIEWS_PATH . "keeper-list-prev.php");
    }

    public function ReturnKeepersInTime($startDate, $finalDate){
        $keeperList = $this->keeperDAO->GetAll();
        $keepersInTime = array();
        $eventsOfKeepers = array();
        $from = $startDate;
        $to = $finalDate;
        foreach ($keeperList as $keeper) {
            $timeFree = $this->keeperDAO->IsKeeperInTime($startDate, $finalDate, $keeper);
            if ($timeFree != null) {
                array_push($keepersInTime, $keeper);
                $eventOfKeepers[$keeper->getUserID()] = $timeFree;
            }
        }
        
        require_once(VIEWS_PATH . "validate-session.php");
        require_once(VIEWS_PATH . "keeper-list.php");
    }

    public function HireKeeper($keeperID, $startDate, $finalDate){
        $keeper = $this->keeperDAO->GetKeeper($keeperID);
        $event = $this->keeperDAO->IsKeeperInTime($startDate, $finalDate, $keeper);
        $needed = new FreeTimePeriod();
        $needed->setStartDate($startDate);
        $needed->setFinalDate($finalDate);

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
