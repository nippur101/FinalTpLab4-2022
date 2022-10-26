<?php
    namespace Models;
    class Pets{
        private $petId;
        private $name;
        private $vaccinationPlan;
        private $raze;
        private $video;
        private $owner;
       
       
        

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