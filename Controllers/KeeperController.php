<?php

namespace Controllers;

use DAO\KeeperDAO;
use DAO\UserDAO;
use Models\FreeTimePeriod as FreeTimePeriod;
use Models\Keeper as Keeper;

class KeeperController{

    private $keeperDAO;
    private $userDAO;

    public function __construct()
    {
        $this->keeperDAO = new KeeperDAO();
        $this->userDAO = new UserDAO();
    }

    public function ShowKeeperView(){
        $user = $this->userDAO->GetUser($_SESSION["loggedUser"]);
        $keeper = $this->keeperDAO->GetKeeper($user->getUserID());
        require_once(VIEWS_PATH."keeper-view.php");
    }

    public function ShowCalendarView(){
        $user = $this->userDAO->GetUser($_SESSION["loggedUser"]);
        $keeper = $this->keeperDAO->GetKeeper($user->getUserID());
        require_once(VIEWS_PATH."calendar.php");
    }
    
    public function CheckAndPushData(){
        $user = $this->userDAO->GetUser($_SESSION["loggedUser"]);
        $keeper = $this->keeperDAO->GetKeeper($user->getUserID());

        if($keeper!=NULL){ //ACA SE FIJA SI TENIAMOS INFO, SI TENIAMOS ESTA TODO OK VA A MIRAR LOS PET
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."check-pets.php");
        }else{
            //ACA LO LLEVA A COMPLETAR PERFIL
            $keeper = new Keeper($user->getFirstName(), $user->getLastName(), $user->getEmail(),
                                 $user->getPassword(), "Calle falsa 123", "Grande", "1", 
                                 $user->getUserID());

            $this->keeperDAO->Add($keeper);
            require_once(VIEWS_PATH."validate-session.php");
            include_once(VIEWS_PATH."keeper-view.php");
        }
    }

    public function Update($adress, $stayCost, $petSize, $dateStart, $dateEnd) {
        $user = $this->userDAO->GetUser($_SESSION["loggedUser"]);
        $keeper = $this->keeperDAO->GetKeeper($user->getUserID());

        if($keeper!=NULL){
            $keeper->setAddress($adress);
            $keeper->setStayCost($stayCost);
            $keeper->setPetSize($petSize);
            
            $freeTimePeriod = $keeper->getFreeTimePeriod();

            $newDate = new FreeTimePeriod($dateStart, $dateEnd);
            array_push($freeTimePeriod, $newDate);

            $keeper->setFreeTimePeriod($freeTimePeriod);

            $check = $this->keeperDAO->Update($keeper);
            if($check){
                echo "<script> if(confirm('Perfil actualizado!')); </script>";
                $this->ShowKeeperView();
            }else{
                echo "<script> if(confirm('Error al actualizar!')); </script>";
                $this->ShowKeeperView();
            }
        }
    }
}
