<?php
    namespace DAO;

    use Models\Pets as Pets;
    use DAO\Connection as Connection;

    interface IPetsDAO
    {
        function Add(Pets $pets);
        function GetAll();
        function NewID();

        public function ReturnOwnerPets($ownerId);
        public function validPet($name, $owner);
        public function GetPet($id);
        public function alreadyExistPets($owner, $name);
        public function Remove($id);

        
        public function retrieveData();

        
    }
?>