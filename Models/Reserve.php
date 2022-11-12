<?php
    namespace Models;
    
    class Reserve{
        private $reserveId;
        private $startDate;
        private $finalDate;
        private $amountPaid;
        private $keeper;
        private $pets;
        private $keeperReviewStatus;
        private $paymentReviewStatus;
        private $totalCost;
               
        public function getReserveId()
        {
                return $this->reserveId;
        }

        public function setReserveId($reserveId)
        {
                $this->reserveId = $reserveId;

                return $this;
        }

        
        public function getStartDate()
        {
                return $this->startDate;
        }

        
        public function setStartDate($startDate)
        {
                $this->startDate = $startDate;

                return $this;
        }

        public function getFinalDate()
        {
                return $this->finalDate;
        }

        public function setFinalDate($finalDate)
        {
                $this->finalDate = $finalDate;

                return $this;
        }

        
        public function getAmountPaid()
        {
                return $this->amountPaid;
        }

        
        public function setAmountPaid($amountPaid)
        {
                $this->amountPaid = $amountPaid;

                return $this;
        }

        
        public function getKeeper()
        {
                return $this->keeper;
        }

       
        public function setKeeper($keeper)
        {
                $this->keeper = $keeper;

                return $this;
        }

      
        public function getPets()
        {
                return $this->pets;
        }

        
        public function setPets($pets)
        {
                $this->pets = $pets;

                return $this;
        }

       
        public function getTotalCost()
        {
                return $this->totalCost;
        }

       
        public function setTotalCost($totalCost)
        {
                $this->totalCost = $totalCost;

                return $this;
        }

        public function getKeeperReviewStatus()
        {
                return $this->keeperReviewStatus;
        }

        public function getPaymentReviewStatus()
        {
                return $this->paymentReviewStatus;
        }

        public function setKeeperReviewStatus($keeperReviewStatus)
        {
                $this->keeperReviewStatus = $keeperReviewStatus;

                return $this;
        }

        public function setPaymentReviewStatus($paymentReviewStatus)
        {
                $this->paymentReviewStatus = $paymentReviewStatus;

                return $this;
        }
    }
