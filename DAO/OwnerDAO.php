<?php 

namespace DAO;

use Models\Owner;

class OwnerDAO {

    private $ownerList = array();

    public function getAll(){

        $this->retrieveData();

        return $this->ownerList;

    }

    public function Add(Owner $owner)
    {
            $this->RetrieveData();
            
            array_push($this->ownerList, $owner);

            $this->SaveOwner();
    }

    public function validOwner($email, $password){
        $check = false;
       $ownerList=$this->getAll();
       foreach($ownerList as $owner){
            if($owner->getEmail()==$email && $owner->getPassword()==$password ){
                $check=true;
            }
       }
       return $check;

    }

    public function retrieveData(){

        $this->ownerList = array();

            if(file_exists('Data/owner.json'))
            {
                $jsonContent = file_get_contents('Data/owner.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                   
                    //$email,$password,$firstName,$lastName,$phone,$pets
                    $owner = new Owner();
                   
                    $owner->setEmail($valuesArray["email"]);
                    $owner->setPassword($valuesArray["password"]);
                    $owner->setFirstName($valuesArray["firstName"]);
                    $owner->setLastName($valuesArray["lastName"]);
                    $owner->setPhone($valuesArray["phone"]);
                    $owner->setPets($valuesArray["pets"]);
                    

                    array_push($this->ownerList, $owner);
                }
            }

    }
    private function SaveOwner()
    {
        $arrayToEncode = array();

        foreach($this->ownerList as $owner)
        {
            $valuesArray["email"] = $owner->getEmail();
            $valuesArray["password"] = $owner->getPassword();
            $valuesArray["firstName"] = $owner->getFirstName();
            $valuesArray["lastName"] = $owner->getLastName();
            $valuesArray["phone"] = $owner->getPhone();
            $valuesArray["pets"] = $owner->getPets();
           

            array_push($arrayToEncode, $valuesArray);
        }

        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        
        file_put_contents('Data/owner.json', $jsonContent);
    }

}

?>