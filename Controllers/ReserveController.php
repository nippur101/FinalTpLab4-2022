<?php

namespace Controllers;

use DAO\ReservePDO;
use DAO\KeeperPDO;
use DAO\PetsPDO;
use DateTime;
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
        $this->reserveDAO->AddReserve($reserve);

        $this->RetrieveMadedReserves();
    }

    public function RetrievePendingReserves()
    {
        $keeper = $_SESSION["loggedUser"];
        $pet_DAO = new PetsPDO();
        $reserves = array();
        $reserves = $this->reserveDAO->GetByKeeper($keeper);
        require_once(VIEWS_PATH . "keeper-reserves.php");
    }

    public function ConfirmReserve($reserveId)
    {
        $reserve = $this->reserveDAO->GetReserve($reserveId);
        $reserve->setKeeperReviewStatus(APPROVED);
        $this->reserveDAO->Update($reserve);
        header("location:" . FRONT_ROOT . "Reserve/RetrievePendingReserves");
    }

    public function RefuseReserve($reserveId)
    {
        $reserve = $this->reserveDAO->GetReserve($reserveId);

        if ($reserve->getPaymentReviewStatus() == PENDING_APPROVAL) {
            $reserve->setKeeperReviewStatus(REJECTED);
            $this->reserveDAO->Update($reserve);
        } else {
            echo "<script> if(confirm('Cannot change status once payed!')); </script>";
        }
        header("location:" . FRONT_ROOT . "Reserve/RetrievePendingReserves");
    }

    public function RetrieveMadedReserves()
    {
        $owner = $_SESSION["loggedUser"];
        $pet_DAO = new PetsPDO();
        $reserves = $this->reserveDAO->GetByOwner($owner->getUserId());
        require_once(VIEWS_PATH . "owner-reserves.php");
    }

    public function DeleteReserve($reserveId)
    {
        $event = $this->reserveDAO->GetReserve($reserveId);

        if ($event->getPaymentReviewStatus() == APPROVED) {
            echo "<script> if(confirm('Cannot delete once payed!')); </script>";
            header("location:" . FRONT_ROOT . "Reserve/RetrieveMadedReserves");
        } else {
            $this->reserveDAO->Delete($reserveId);
            header("location:" . FRONT_ROOT . "Reserve/RetrieveMadedReserves");
        }
    }

    public function PaidOut($reserveId)
    {
        $event = $this->reserveDAO->GetReserve($reserveId);

        if ($event->getPaymentReviewStatus() == APPROVED) {
            echo "<script> if(confirm('Already payed!')); </script>";
            header("location:" . FRONT_ROOT . "Reserve/RetrieveMadedReserves");
        } else {
            if($event->getKeeperReviewStatus() == PENDING_APPROVAL){
                echo "<script> if(confirm('Cannot pay until keeper confirms!')); </script>";
                header("location:" . FRONT_ROOT . "Reserve/RetrieveMadedReserves");
            }else{
                $keeper = $this->keeperDAO->GetKeeper($event->getKeeper());
                $petToKeep = $this->petDAO->GetPet($event->getPets());
    
                $keeperDateStart = new DateTime($event->getStartDate());
                $keeperDateFinal = new DateTime($event->getFinalDate());
                $keeperInterval = $keeperDateStart->diff($keeperDateFinal);
    
                require_once(VIEWS_PATH . "payment-view.php");
            }
        }
    }

    public function FinishPayment($reserveId)
    {
        $reserve = $this->reserveDAO->GetReserve($reserveId);
        $reserve->setPaymentReviewStatus(APPROVED);
        $keeperObject = $this->keeperDAO->GetKeeper($reserve->getKeeper());
        $this->keeperDAO->RemoveFreeTimePeriod($keeperObject, $reserve->getStartDate(), $reserve->getFinalDate());
        $this->reserveDAO->Update($reserve);
        header("location:" . FRONT_ROOT . "Reserve/RetrieveMadedReserves");
    }
}
