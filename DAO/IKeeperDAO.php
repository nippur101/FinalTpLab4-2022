<?php
    namespace DAO;

    use Models\Keeper as Keeper;
    use DAO\Connection as Connection;

    interface IKeeperDAO
    {
        function Add(Keeper $keeper);
        function GetAll();
        function Remove($id);

        
        public function GetKeeper($userID);
        
        public function ReturnDefaultKeeper($userObject);
        public function updateKeeper(Keeper $keeper);
        public function IsAvaiableTime($dateStart, $dateFinal, $keeper);
        public function IsKeeperInTime($dateStart, $dateFinal, $keeper);
        public function OcupedTimePeriod($startDate, $finalDate);
       

      

        
    }
?>