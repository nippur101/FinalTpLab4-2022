<?php
    namespace DAO;

    use Models\Owner as Owner;
    use DAO\Connection as Connection;

    interface IOwnerDAO
    {
        function Add(Owner $owner);
        function GetAll();
       
        public function GetOwner($userID);
        public function ReturnDefaultOwner($userObject);
        public function addPetOwner($pet, $owner);

       

        public function retrieveData();

        
    }
?>