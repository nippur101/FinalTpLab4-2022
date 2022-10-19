<?php
    namespace Models;

    class User
    {
        private $email;
        private $password;
        private $userID;

        public function getMail()
        {
            return $this->email;
        }

        public function setMail($email)
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
    }
?>