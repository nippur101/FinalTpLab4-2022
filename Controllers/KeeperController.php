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
            $user = $_SESSION["loggedUser"] ; //esto no se si funciona xd
            $keeper = new Keeper();
            $keeper = $this->keeperDAO->GetKeeper($user->getUserID());

            if($keeper!=NULL){ //ACA SE FIJA SI TENIAMOS INFO, SI TENIAMOS ESTA TODO OK VA A MIRAR LOS KEEPER
                require_once(VIEWS_PATH."validate-session.php");
                require_once(VIEWS_PATH."keeper-profile.php");
            }else{
                //ACA LO LLEVA A COMPLETAR PERFIL
            }
        }
        public function TimePeriod($startDate,$finalDate){
            $user = $_SESSION["loggedUser"] ; 
            $keeper = new Keeper();
            $keeper = $this->keeperDAO->GetKeeper($user->getUserID());
            
            if($this->keeperDAO->OcupedTimePeriod($startDate,$finalDate)){
                $time=new FreeTimePeriod;
                $time->setStartDate($startDate);
                $time->setFinalDate($finalDate);
               $keeper->setFreeTimePeriod( $this->freeTimePeriod->Add($time));

            }

                require_once(VIEWS_PATH."validate-session.php");
                require_once(VIEWS_PATH."keeper-profile.php");
          
        }

        
        
       
    
}