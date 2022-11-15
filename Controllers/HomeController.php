<?php

namespace Controllers;

class HomeController
{

    public function Index($message = "")
    {
        if(isset($_SESSION["loggedUser"]))
        {
            if($_SESSION["typeUser"] == 1)
            {
                $keeper = $_SESSION["loggedUser"];
                require_once(VIEWS_PATH . "validate-session.php");
                require_once(VIEWS_PATH . "logged-keeper.php");
            }
            else if($_SESSION["loggedUser"] == 2)
            {
                $owner = $_SESSION["loggedUser"];
                require_once(VIEWS_PATH . "validate-session.php");
                require_once(VIEWS_PATH . "logged-owner.php");
            }
        }
        else
        {
            require_once(VIEWS_PATH . "validate-session.php");
            require_once(VIEWS_PATH . "index.php");
        }
        
    }

    public function Create()
    {
        require_once(VIEWS_PATH . "create-account.php");
    }
    public function CreatePets()
    {
        require_once(VIEWS_PATH . "validate-session.php");
        require_once(VIEWS_PATH . "create-pets.php");
    }

    public function Logout()
    {
        unset($_SESSION["loggedUser"]);
        unset($_SESSION["typeUser"]);
        $this->Index();
    }
    public function OwnerList()
    {
        require_once(VIEWS_PATH . "validate-session.php");
        require_once(VIEWS_PATH . "owner-list.php");
    }
    
}
