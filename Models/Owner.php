<?php
    namespace Models;
    class Owner extends User{
        private $userID;
        private $firstName;
        private $lastName;
        private $phone;
        private $pets;

        

        public function getFirstName()
        {
                return $this->firstName;
        }

       
        public function setFirstName($firstName)
        {
                $this->firstName = $firstName;

                return $this;
        }

       
        public function getLastName()
        {
                return $this->lastName;
        }

        
        public function setLastName($lastName)
        {
                $this->lastName = $lastName;

                return $this;
        }

        public function getPhone()
        {
                return $this->phone;
        }

        public function setPhone($phone)
        {
                $this->phone = $phone;

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

        public function getUserID()
        {
                return $this->userID;
        }

        public function setUserID($userID)
        {
                $this->userID = $userID;
        }
    }




 ?>