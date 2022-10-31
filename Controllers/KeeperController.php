<?php 

namespace Controllers;

use DAO\KeeperDAO;
use Models\Keeper as Keeper;
use Models\FreeTimePeriod ;

class KeeperController{
    
        private $keeperDAO;
    
        public function __construct()
        {
            $this->keeperDAO = new KeeperDAO();
            $this->freeTimePeriod=new FreeTimePeriod();
        }

        public function CheckAndPushData(){ //la idea de esta funcion es poder convertir el user a un owner para empezar a laburarlo, 
                                            // tanto owner como user laburan con la misma id
            
            $keeper = $_SESSION["loggedUser"] ; 
            if($keeper!=NULL){ //ACA SE FIJA SI TENIAMOS INFO, SI TENIAMOS ESTA TODO OK VA A MIRAR LOS KEEPER
                require_once(VIEWS_PATH."validate-session.php");
                require_once(VIEWS_PATH."keeper-profile.php");
            }else{
                //ACA LO LLEVA A COMPLETAR PERFIL
            }
        }
        public function TimePeriod($startDate,$finalDate){
            $keeper= $_SESSION["loggedUser"] ; 
            
          
            
            if($this->keeperDAO->OcupedTimePeriod($startDate,$finalDate)){
                $time=new FreeTimePeriod;
                $time->setStartDate($startDate);
                $time->setFinalDate($finalDate);
               $keeper->setFreeTimePeriod( $this->freeTimePeriod->Add($time));

            }

                require_once(VIEWS_PATH."validate-session.php");
                require_once(VIEWS_PATH."keeper-profile.php");
          
        }
 
        public function AddSecondInfo($address, $petSize,$stayCost ){
        

            $keeper= $_SESSION["loggedUser"] ; 
            $keeper->setAddress($address);
            $keeper->setStayCost($stayCost);
            $keeper->setPetSize($petSize);
            $this->keeperDAO->Update($keeper);


        }

        
        
       
    
}