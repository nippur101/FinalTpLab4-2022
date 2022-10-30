<?php

namespace Controllers;

use DAO\KeeperDAO;
use Models\Keeper as Keeper;

class KeeperController{

    private $keeperDAO;

    public function __construct()
    {
        $this->keeperDAO = new KeeperDAO();
    }

    public function ShowKeeperView(){
        require_once(VIEWS_PATH."keeper-view.php");
    }
    
    public function Update($adress, $petSize, $stayCost, $freeTimePeriod, $keeperId)
    {
        $keeper = new Keeper($adress, $petSize, $stayCost, $freeTimePeriod, $keeperId);
        $this->keeperDAO->Update($keeper);
        require_once(VIEWS_PATH."validate-session.php");
        require_once(VIEWS_PATH."logged-keeper.php");
    }
}
