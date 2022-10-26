<?php
    namespace Models;
    
   class freeTimePeriod{
    private $startDate;
    private $finalDate;
    function __construct($startDate,$finalDate){
        $this->startDate=$startDate;
        $this->finalDate=$finalDate;
    }
    

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