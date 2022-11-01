<?php
    namespace Controllers;

   

    class HomeController
    {
       

        public function __construct()
        {
            
        }

        public function Index($message = "")
        {
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."index.php");
        } 

        public function Create()
        {   
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."create-account.php");
        } 
        public function CreatePets()
        {   
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."create-pets.php");
        } 
        
        public function Logout()
        {
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."logout.php");
        } 
        public function OwnerList()
        {
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."owner-list.php");
        } 
        public function KeeperList()
        {
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."keeper-list.php");
        } 
        
       
    }
?>