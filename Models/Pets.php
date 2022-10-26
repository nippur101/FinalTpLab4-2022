<?php
    namespace Models;
    class Pets{
        private $petId;
        private $name;
        private $vaccinationPlan;
        private $raze;
        private $petType;
        private $video;
        private $owner;
       
        function __construct($name,$vaccinationPlan,$raze,$petType,$video,$owner){
            $this->name=$name;
            $this->vaccinationPlan=$vaccinationPlan;
            $this->raze=$raze;
            $this->petType=$petType;
            $this->video=$video;
            $this->owner=$owner;
        }
        

        public function getPetId()
        {
                return $this->petId;
        }

       
        public function setPetId($petId)
        {
                $this->petId = $petId;

                return $this;
        }

       
        public function getName()
        {
                return $this->name;
        }

        
        public function setName($name)
        {
                $this->name = $name;

                return $this;
        }

       
        public function getVaccinationPlan()
        {
                return $this->vaccinationPlan;
        }

        
        public function setVaccinationPlan($vaccinationPlan)
        {
                $this->vaccinationPlan = $vaccinationPlan;

                return $this;
        }

        
        public function getRaze()
        {
                return $this->raze;
        }

       
        public function setRaze($raze)
        {
                $this->raze = $raze;

                return $this;
        }

      
        public function getVideo()
        {
                return $this->video;
        }

       
        public function setVideo($video)
        {
                $this->video = $video;

                return $this;
        }

      
        public function getPetType()
        {
                return $this->petType;
        }

       
        public function setPetType($petType)
        {
                $this->petType = $petType;

                return $this;
        }

       
        public function getOwner()
        {
                return $this->owner;
        }

        public function setOwner($owner)
        {
                $this->owner = $owner;

                return $this;
        }
    }

?>