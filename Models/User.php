<?php
    namespace Models;

    class User
    {
        
        private $userID;
        private $firstName;
        private $lastName;
        private $email;
        private $password;
        private $userType;
        

        public function getEmail()
        {
            return $this->email;
        }

        public function setEmail($email)
        {
            $this->email = $email;
        }

        public function getPassword()
        {
            return $this->password;
        }

        public function setPassword($password)
        {
            $this->password = $password;
        }

        public function getUserID()
        {
            return $this->userID;
        }

        public function setUserID($userID)
        {
            $this->userID = $userID;
        }

       
        public function getUserType()
        {
                return $this->userType;
        }

        
        public function setUserType($userType)
        {
                $this->userType = $userType;

                return $this;
        }

    
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
    }
?>