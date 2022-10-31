<?php
    namespace Models;
    class Owner extends User{
        
        private $phone;
        private $pets;

        
        function __construct()
        {
           
            $this->pets=array();
           
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
    }




 ?>