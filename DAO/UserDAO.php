<?php 

namespace DAO;

use Models\User;

class UserDAO {

    private $userList = array();

    public function getAll(){

        $this->retrieveData();

        return $this->userList;

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
                    $user->setMail($valuesArray["email"]);
                    $user->setPassword($valuesArray["password"]);

                    array_push($this->userList, $user);
                }
            }

    }

}

?>