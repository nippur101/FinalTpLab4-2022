<?php

namespace Controllers;

use DAO\ReservePDO;
use DAO\KeeperPDO;
use DAO\PetsPDO;
use Models\Reserve;

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
        $this->reserveDAO = new ReservePDO();
        $this->keeperDAO = new KeeperPDO();
        $this->petDAO = new PetsPDO();
    }

    public function GenerateReserve($keeperId, $keeperStartDate, $keeperFinalDate, $keeperStayCost, $totalStayCost, $petId)
    {
        $reserve = new Reserve();
        $reserve->setKeeper($keeperId);
        $reserve->setStartDate($keeperStartDate);
        $reserve->setFinalDate($keeperFinalDate);
        $reserve->setTotalCost($totalStayCost);
        $reserve->setAmountPaid($keeperStayCost);
        $reserve->setPets($petId);

        $petObject = $this->petDAO->GetPet($petId);
        $ownerID = $petObject->getOwner();
        $reserve->setOwner($ownerID);

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
