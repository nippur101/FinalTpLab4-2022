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
        
       

        public function Logout()
        {
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."logout.php");
        } 
        
       
    }
?>