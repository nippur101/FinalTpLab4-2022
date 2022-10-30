<?php
    namespace Models;
    class Owner extends User{
        
        private $phone;
        private $pets;

        /*
        function __construct($email,$password,$firstName,$lastName,$phone,$pets)
        {
            $this->firstName=$firstName;
            $this->lastName=$lastName;
            $this->phone=$phone;
            $this->pets=$pets;
            $this->email=$email;
            $this->password=$password;
        }
        
*/
       

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