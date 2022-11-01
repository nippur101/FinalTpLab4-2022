<?php 

namespace Controllers;

use DAO\KeeperDAO;
use Models\Keeper as Keeper;
use Models\FreeTimePeriod as FreeTimePeriod;

class KeeperController{
    
        private $keeperDAO;
    
        public function __construct()
        {
            $this->keeperDAO = new KeeperDAO();
            $this->freeTimePeriod=new FreeTimePeriod();
        }

        public function ShowCalendarView(){
            $keeper= $_SESSION["loggedUser"] ; 
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."calendar.php");
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

        public function AddTimePeriod($startDate,$finalDate){
            $keeper = ($_SESSION["loggedUser"]);
            var_dump($keeper);
            $newTime = new FreeTimePeriod();
            $newTime->setStartDate($startDate);
            $newTime->setFinalDate($finalDate);

            $this->keeperDAO->addFreePeriodOfTime($newTime,$keeper);
            var_dump($keeper);
            $this->ShowCalendarView();
        }

        
        public function TimePeriod($startDate,$finalDate){
            $keeper= $_SESSION["loggedUser"] ; 

                if($this->keeperDAO->IsAvaiableTime($startDate,$finalDate, $keeper) || $keeper->getFreeTimePeriod()==null){

                    if($keeper->getFreeTimePeriod()==NULL || $keeper->getFreeTimePeriod()==[]){
                        $oldTime = $this->keeperDAO->GetKeeper($user->getUserID());
                        $newTime = array();
                        $oldTime->setFreeTimePeriod($newTime);
                    }

                    $time=new FreeTimePeriod();
                    $time->setStartDate($startDate);
                    $time->setFinalDate($finalDate);
                    
                    $this->keeperDAO->addFreePeriodOfTime($time,$keeper);
                    echo "<script> if(confirm('Periodo Creado!')); </script>";
                    $this->ShowCalendarView();
                }else{
                    echo "<script> if(confirm('Periodo de Tiempo ocupado!')); </script>";
                    $this->CheckAndPushData();
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

            echo "<script> if(confirm('Datos actualizados!')); </script>";
            $this->CheckAndPushData();


        }

        
        
       
    
}