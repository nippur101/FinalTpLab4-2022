<?php
    namespace DAO;

    use Models\Reviews as Reviews;
    use DAO\Connection as Connection;

    interface IReviewsDAO
    {
        function Add(Reviews $reviews);
        function GetAll();
        public function retrieveData();
        public function GetReviewsByOwner($owner);
        public function GetReviewsByKeeper($keeper);

        

        
    }
?>