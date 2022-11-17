<?php
    namespace DAO;

    use Models\User as User;
    use DAO\Connection as Connection;

    interface IUserDAO
    {
        function Add(User $user);
        function GetAll();

        public function validUser($mail, $password);

        public function ReturnDefaultUser($firstName, $lastName, $mail, $password1, $type);

        public function alreadyExistUser($mail);

        

        
    }
?>