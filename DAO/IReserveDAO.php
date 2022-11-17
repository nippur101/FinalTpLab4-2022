<?php
    namespace DAO;

    use Models\reserve as Reserve;
    use DAO\Connection as Connection;

    interface IReserveDAO
    {
        
        function GetAll();
        public function GetByKeeper($keeper);
        public function GetByOwner($owner);
        public function Delete($reserveId);
        public function GetReserve($reserveId);
        public function Update(Reserve $reserve);

        public function GetPetsWithoutReserve($petList);
   

      

        
    }
?>