<?php
    namespace Models;
    
   class FreeTimePeriod{
    private $startDate;
    private $finalDate;
    

    public function getStartDate()
    {
        return $this->startDate;
    }

   
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

   
    public function getFinalDate()
    {
        return $this->finalDate;
    }


    public function setFinalDate($finalDate)
    {
        $this->finalDate = $finalDate;

        return $this;
    }
    
   }


?>