<?php

namespace DAO;
use \Exception as Exception;
use Models\User;

class UserPDO
{
  
    private $connection;
    private $tableName = "_User";
    private $userList = array();


    public function getAll()
    {

        try
            {
                $studentList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                foreach ($resultSet as $valuesArray) {

                    $user = new User();
                    $user->setUserId($valuesArray["userId"]);
                    $user->setFirstName($valuesArray["firstName"]);
                    $user->setLastName($valuesArray["lastName"]);
                    $user->setEmail($valuesArray["email"]);
                    $user->setPassword($valuesArray["_password"]);
                    $user->setUserType($valuesArray["userType"]);
    
    
                    array_push($this->userList, $user);
                }

                return $this->userList;
               
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
    }

   
    public function Add(User $user)
    {

        try
        {
            $query = "INSERT INTO ".$this->tableName." (_User.firstName, _User.lastName, _User.email, _User._password, _User.userType) VALUES ( :firstName, :lastName :email, :_password, :userType);";
            
           // $valuesArray["userId"] = NULL;
            $valuesArray["firstName"] = $user->getFirstName();
            $valuesArray["lastName"] = $user->getLastName();
            $valuesArray["email"] = $user->getEmail();
            $valuesArray["_password"] = $user->getPassword();
            $valuesArray["userType"] = $user->getUserType();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $valuesArray);
        }
        catch(Exception $ex)
        {
            var_dump($query);
            throw $ex;
        }
        
    }

    public function validUser($mail, $password)
    {

        $userList = $this->getAll();

        $userR = null;

        foreach ($userList as $user) {

            if ($user->getEmail() == $mail && $user->getPassword() == $password) {
                $userR = $user;
            }
        }

        return $userR;
    }

    public function ReturnDefaultUser($firstName, $lastName, $mail, $password1, $type)
    {

        $user = new User();

        $user->setFirstName($firstName);
        $user->setLastName($lastName);
        $user->setEmail($mail);
        $user->setPassword($password1);
        $user->setUserType($type);
        

        return $user;
    }

    public function alreadyExistUser($mail)
    {

        $userList = $this->getAll();

        $check = false;

        foreach ($userList as $user) {

            if ($user->getEmail() == $mail) {
                $check = true;
            }
        }

        return $check;
    }

/*    public function retrieveData()
    {

        $this->userList = array();

        if (file_exists('Data/users.json')) {
            $jsonContent = file_get_contents('Data/users.json');

            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach ($arrayToDecode as $valuesArray) {

                $user = new User();
                $user->setUserId($valuesArray["userId"]);
                $user->setFirstName($valuesArray["firstName"]);
                $user->setLastName($valuesArray["lastName"]);
                $user->setEmail($valuesArray["email"]);
                $user->setPassword($valuesArray["password"]);
                $user->setUserType($valuesArray["userType"]);


                array_push($this->userList, $user);
            }
        }
    }
    private function SaveUser()
    {
        $arrayToEncode = array();

        foreach ($this->userList as $user) {
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
    */
}
