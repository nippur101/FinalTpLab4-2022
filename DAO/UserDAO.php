<?php 

namespace DAO;

use Models\User;

class UserDAO {

    private $userList = array();

    public function getAll(){

        $this->retrieveData();

        return $this->userList;

    }

    public function Add(User $user)
    {
            $this->RetrieveData();
            
            array_push($this->userList, $user);

            $this->SaveUser();
    }

    public function validUser($mail, $password){

        $userList = $this->getAll();

        $check = false;

        foreach($userList as $user){

            if($user->getMail() == $mail && $user->getPassword() == $password){
                $check = true;
            }
        }

        return $check;
    }

    public function retrieveData(){

        $this->userList = array();

            if(file_exists('Data/users.json'))
            {
                $jsonContent = file_get_contents('Data/users.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    
                    $user = new User();
                    $user->setUserId($valuesArray["userId"]);
                    $user->setFirstName($valuesArray["firsName"]);
                    $user->setLastName($valuesArray["lastName"]);
                    $user->setMail($valuesArray["email"]);
                    $user->setPassword($valuesArray["password"]);
                    $user->setUserType($valuesArray["userType"]);


                    array_push($this->userList, $user);
                }
            }

    }
    private function SaveUser()
    {
        $arrayToEncode = array();

        foreach($this->userList as $user)
        {
            $valuesArray["userId"] = $user->getUserId();
            $valuesArray["firstName"] = $user->getFirstName();
            $valuesArray["lastName"] = $user->getLastName();
            $valuesArray["email"] = $user->getEmail();
            $valuesArray["password"] = $user->getPassword();
            $valuesArray["userType"] = $user->getUserType();


            array_push($arrayToEncode, $valuesArray);
        }

        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        
        file_put_contents('Data/users.json', $jsonContent);
    }

}

?>