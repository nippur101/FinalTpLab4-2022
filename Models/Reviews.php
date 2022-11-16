<?php
    namespace Models;
    
    class Reviews{
        private $reviewsId;
        private $description;
        private $date;
        private $keeper;
        private $owner;
        private $pets;
        private $userScore;
        function __construct(){
           
        }

        public function getOwner(){
            return $this->owner;
        }

        public function setOwner($owner){
            $this->owner = $owner;
        }
         
        public function getReviewsId()
        {
                return $this->reviewsId;
        }

        
        public function setReviewsId($reviewsId)
        {
                $this->reviewsId = $reviewsId;

                return $this;
        }

        
        public function getDescription()
        {
                return $this->description;
        }

        
        public function setDescription($description)
        {
                $this->description = $description;

                return $this;
        }

       
        public function getDate()
        {
                return $this->date;
        }

       
        public function setDate($date)
        {
                $this->date = $date;

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

        
        public function getUserScore()
        {
                return $this->userScore;
        }

       
        public function setUserScore($userScore)
        {
                $this->userScore = $userScore;

                return $this;
        }
    }


?>