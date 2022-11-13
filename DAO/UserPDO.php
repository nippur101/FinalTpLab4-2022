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
            $query = "CALL addUser('".$user->getFirstName()."','".$user->getLastName()."','".$user->getEmail()."','".$user->getPassword()."',".$user->getUserType().");";
            
            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query);
          
        }
        catch(Exception $ex)
        {
           
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

    public function retrieveUserId($email,$password,$user){
        try
        {
            $query = "CALL retrieveUserId('".$email."','".$password."');";
            
            $this->connection = Connection::GetInstance();
            
            $resultSet = $this->connection->Execute($query);
            
                foreach($resultSet as $value){
                
                $user->setUserId($value["userId"]);
            }

           
          
        }
        catch(Exception $ex)
        {
           
            throw $ex;
        }
    }

}
