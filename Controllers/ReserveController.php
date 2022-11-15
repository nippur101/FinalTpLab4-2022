<?php

namespace Controllers;

use DAO\ReserveDAO as ReserveDAO;
use DAO\KeeperDAO;
use DAO\PetsDAO;
use Models\Reserve as Reserve;

const PENDING_APPROVAL = 0;
const APPROVED = 1;
const REJECTED = 2;

class ReserveController
{
    private $reserveDAO;
    private $keeperDAO;
    private $petDAO;

    public function __construct()
    {
        $this->reserveDAO = new ReserveDAO();
        $this->keeperDAO = new KeeperDAO();
        $this->petDAO = new PetsDAO();
    }

    public function GenerateReserve($keeperId, $keeperStartDate, $keeperFinalDate, $keeperStayCost, $totalStayCost, $petId)
    {
        $reserve = new Reserve();
        $reserve->setKeeper($this->keeperDAO->GetKeeper($keeperId));
        $reserve->setStartDate($keeperStartDate);
        $reserve->setFinalDate($keeperFinalDate);
        $reserve->setTotalCost($totalStayCost);
        $reserve->setAmountPaid($keeperStayCost);
        $reserve->setPets($this->petDAO->GetPet($petId));
        $reserve->setKeeperReviewStatus(PENDING_APPROVAL);
        $reserve->setPaymentReviewStatus(PENDING_APPROVAL);
        $this->reserveDAO->Add($reserve);
    }

    public function RetrievePendingReserves()
    {
        $keeper = $_SESSION["loggedUser"];
        $reserves = $this->reserveDAO->GetByKeeper($keeper);
        require_once(VIEWS_PATH . "keeper-reserves.php");
    }

    public function ConfirmReserve($reserveId)
    {
        $reserve = $this->reserveDAO->GetReserve($reserveId);
        $reserve->setKeeperReviewStatus(APPROVED);
        $this->reserveDAO->Update($reserve);
        $this->RetrievePendingReserves();
    }

    public function RefuseReserve($reserveId)
    {
        $reserve = $this->reserveDAO->GetReserve($reserveId);
        $reserve->setKeeperReviewStatus(REJECTED);
        $this->reserveDAO->Update($reserve);
        $this->RetrievePendingReserves();
    }

    public function RetrieveMadedReserves()
    {
        $owner = $_SESSION["loggedUser"];
        $reserves = $this->reserveDAO->GetByOwner($owner);
        require_once(VIEWS_PATH . "owner-reserves.php");
    }

    public function DeleteReserve($reserveId)
    {
        $reserve = $this->reserveDAO->GetReserve($reserveId);
        $this->reserveDAO->Delete($reserve);
        $this->RetrieveMadedReserves();
    }
}
