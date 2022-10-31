<?php
    namespace Models;

    use Models\FreeTimePeriod as FreeTimePeriod;
    
    class Keeper extends User{
        private $keeperId;
        private $address;
        private $petSize;
        private $stayCost;
        private $freeTimePeriod = array();
        private $reviews;
        function __construct($firstName,$lastName,$email,$password,$address,$petSize,$stayCost, $userID){
            $this->firstName=$firstName;
            $this->lastName=$lastName;
            $this->email=$email;
            $this->password=$password;
            $this->address=$address;
            $this->petSize=$petSize;
            $this->stayCost=$stayCost;
            $this->keeperId = $userID;
            //$this->freeTimePeriod=array();
        }
        
        
        public function getKeeperId()
        {
                return $this->keeperId;
        }

        public function setKeeperId($keeperId)
        {
                $this->keeperId = $keeperId;

                return $this;
        }

        
        public function getAddress()
        {
                return $this->address;
        }

      
        public function setAddress($address)
        {
                $this->address = $address;

                return $this;
        }

        
        public function getPetSize()
        {
                return $this->petSize;
        }

      
        public function setPetSize($petSize)
        {
                $this->petSize = $petSize;

                return $this;
        }

        
        public function getStayCost()
        {
                return $this->stayCost;
        }

      
        public function setStayCost($stayCost)
        {
                $this->stayCost = $stayCost;

                return $this;
        }

      
        public function getFreeTimePeriod()
        {
                return $this->freeTimePeriod;
        }

        public function setFreeTimePeriod($freeTimePeriod)
        {
                $this->freeTimePeriod = $freeTimePeriod;

                return $this;
        }

      
        public function getReviews()
        {
                return $this->reviews;
        }

       
        public function setReviews($reviews)
        {
                $this->reviews = $reviews;

                return $this;
        }
    }


?>