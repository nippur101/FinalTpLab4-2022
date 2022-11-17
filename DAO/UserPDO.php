<?php

namespace DAO;
use \Exception as Exception;
use Models\User;

class UserPDO implements IUserDAO
{
  
    private $connection;
    private $tableName = "_User";
    private $userList = array();


    public function getAll()
    {

        try
            {

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
                    $user->setSecurityQuestion($valuesArray["securityQuestion"]);
                    $user->setSecurityAnswer($valuesArray["securityAnswer"]);
                    $user->setSecurityNumber($valuesArray["securityNumber"]);
    
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
            $query = "INSERT INTO ".$this->tableName." (firstName, lastName, email, _password, userType, securityQuestion, securityAnswer, securityNumber) VALUES (:firstName, :lastName, :email, :password, :userType, :securityQuestion, :securityAnswer, :securityNumber);";

            $parameters["firstName"] = $user->getFirstName();
            $parameters["lastName"] = $user->getLastName();
            $parameters["email"] = $user->getEmail();
            $parameters["password"] = $user->getPassword();
            $parameters["userType"] = $user->getUserType();
            $parameters["securityQuestion"] = $user->getSecurityQuestion();
            $parameters["securityAnswer"] = $user->getSecurityAnswer();
            $parameters["securityNumber"] = $user->getSecurityNumber();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
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
        $user->setSecurityQuestion("¿Cuál es tu color favorito?");
        $user->setSecurityAnswer("Azul");
        $user->setSecurityNumber("123456");

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

    public function GetUserByEmail($email)
    {
        try
        {
            $user = null;

            $query = "SELECT * FROM ".$this->tableName." WHERE email = :email";

            $parameters["email"] = $email;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            foreach($resultSet as $valuesArray)
            {
                $user = new User();
                $user->setUserId($valuesArray["userId"]);
                $user->setFirstName($valuesArray["firstName"]);
                $user->setLastName($valuesArray["lastName"]);
                $user->setEmail($valuesArray["email"]);
                $user->setPassword($valuesArray["_password"]);
                $user->setUserType($valuesArray["userType"]);
                $user->setSecurityAnswer($valuesArray["securityAnswer"]);
                $user->setSecurityQuestion($valuesArray["securityQuestion"]);
                $user->setSecurityNumber($valuesArray["securityNumber"]);
            }

            return $user;
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function Update(User $user)
    {
        try
        {
            $query = "UPDATE ".$this->tableName." SET firstName = :firstName, lastName = :lastName, email = :email, _password = :password, userType = :userType, securityQuestion = :securityQuestion, securityAnswer = :securityAnswer, securityNumber = :securityNumber WHERE userId = :userId";

            $parameters["firstName"] = $user->getFirstName();
            $parameters["lastName"] = $user->getLastName();
            $parameters["email"] = $user->getEmail();
            $parameters["password"] = $user->getPassword();
            $parameters["userType"] = $user->getUserType();
            $parameters["securityQuestion"] = $user->getSecurityQuestion();
            $parameters["securityAnswer"] = $user->getSecurityAnswer();
            $parameters["securityNumber"] = $user->getSecurityNumber();
            $parameters["userId"] = $user->getUserId();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
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
