<?php 

namespace Controllers;

use DAO\ReservePDO;
use DAO\ReviewsPDO;
use Models\Reviews;
use DAO\KeeperPDO;
use DAO\PetsPDO;

use const Controllers\APPROVED as ControllersAPPROVED;

const PENDING_APPROVAL = 0;
const APPROVED = 1;
const REJECTED = 2;

class ReviewsController{
    private $reviewsDAO;
    private $reserveDAO;
    private $keeperDAO;

    public function __construct(){
        $this->reviewsDAO = new ReviewsPDO();
        $this->reserveDAO = new ReservePDO();
        $this->keeperDAO = new KeeperPDO();
    }

    public function GenerateReview($reserveId){
        $reserve = $this->reserveDAO->getReserve($reserveId);
        $keeper = $this->keeperDAO->GetKeeper($reserve->getKeeper());

        if($reserve->getKeeperReviewStatus() == APPROVED && $reserve->getPaymentReviewStatus() == APPROVED){
            require_once(VIEWS_PATH . "validate-session.php");
            require_once(VIEWS_PATH . "write-review.php");
        }else{
            echo "<script> if(confirm('Cannot generate reserve until is approved and payed!')); </script>";
            header("location:" . FRONT_ROOT . "Reserve/RetrieveMadedReserves");
        }
    }

    public function CreateNewReview($score, $comment, $reserveId){
        $reserve = $this->reserveDAO->getReserve($reserveId);
        $review = new Reviews();
        $review->setUserScore($score);
        $review->setDescription($comment);
        $review->setKeeper($reserve->getKeeper());
        $review->setOwner($reserve->getOwner());
        $review->setPets($reserve->getPets());
        $review->setDate(date("Y-m-d"));

        $this->reviewsDAO->Add($review);
        header("location:" . FRONT_ROOT . "Reserve/RetrieveMadedReserves");
    }

    public function ViewReviewsByOwner(){
        $owner = $_SESSION["loggedUser"];

        $reviews = $this->reviewsDAO->GetReviewsByOwner($owner);
        $pet_DAO = new PetsPDO();
        $keeper_DAO = new KeeperPDO();

        require_once(VIEWS_PATH . "validate-session.php");
        require_once(VIEWS_PATH . "reviews-view-owner.php");
    }

    public function ViewReviewsByKeeper(){
        $keeper = $_SESSION["loggedUser"];

        $reviews = $this->reviewsDAO->GetReviewsByKeeper($keeper);
        $pet_DAO = new PetsPDO();
        $owner_DAO = new KeeperPDO();

        require_once(VIEWS_PATH . "validate-session.php");
        require_once(VIEWS_PATH . "reviews-view-keeper.php");
    }
}

?>