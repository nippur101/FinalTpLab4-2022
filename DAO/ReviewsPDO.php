<?php

namespace DAO;

use \Exception as Exception;
use Models\Reviews as Reviews;

class ReviewsPDO{
    private $reviewsList = array();
    private $connection;
    private $tableName = "Reviews";

    public function getAll()
    {
        $this->retrieveData();
        return $this->reviewsList;
    }

    public function retrieveData(){
        $this->reviewsList = array();
        try{
            $query = "SELECT * FROM " . $this->tableName;
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);
            foreach($resultSet as $row){
                $reviews = new Reviews();
                $reviews->setReviewsId($row["reviewsId"]);
                $reviews->setDescription($row["_description"]);
                $reviews->setDate($row["_date"]);
                $reviews->setKeeper($row["keeperId"]);
                $reviews->setOwner($row["ownerId"]);
                $reviews->setPets($row["petsId"]);
                $reviews->setUserScore($row["userScore"]);
                array_push($this->reviewsList, $reviews);
            }
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function Add(Reviews $reviews)
    {
        try {
            $query = "INSERT INTO " . $this->tableName . " (_description, _date, keeperId, ownerId, petsId, userScore) VALUES (:_description, :_date, :keeperId, :ownerId, :petsId, :userScore);";
            $parameters["_description"] = $reviews->getDescription();
            $parameters["_date"] = $reviews->getDate();
            $parameters["keeperId"] = $reviews->getKeeper();
            $parameters["ownerId"] = $reviews->getOwner();
            $parameters["petsId"] = $reviews->getPets();
            $parameters["userScore"] = $reviews->getUserScore();
            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetReviewsByOwner($owner){
        $reviewsList = array();
        try{
            $query = "SELECT * FROM " . $this->tableName . " WHERE ownerId = " . $owner->getUserId();
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);
            foreach($resultSet as $row){
                $reviews = new Reviews();
                $reviews->setReviewsId($row["reviewsId"]);
                $reviews->setDescription($row["_description"]);
                $reviews->setDate($row["_date"]);
                $reviews->setKeeper($row["keeperId"]);
                $reviews->setOwner($row["ownerId"]);
                $reviews->setPets($row["petsId"]);
                $reviews->setUserScore($row["userScore"]);
                array_push($reviewsList, $reviews);
            }
        }
        catch(Exception $ex){
            throw $ex;
        }
        return $reviewsList;
    }

    public function GetReviewsByKeeper($keeper){
        $reviewsList = array();
        try{
            $query = "SELECT * FROM " . $this->tableName . " WHERE keeperId = " . $keeper->getUserId();
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);
            foreach($resultSet as $row){
                $reviews = new Reviews();
                $reviews->setReviewsId($row["reviewsId"]);
                $reviews->setDescription($row["_description"]);
                $reviews->setDate($row["_date"]);
                $reviews->setKeeper($row["keeperId"]);
                $reviews->setOwner($row["ownerId"]);
                $reviews->setPets($row["petsId"]);
                $reviews->setUserScore($row["userScore"]);
                array_push($reviewsList, $reviews);
            }
        }
        catch(Exception $ex){
            throw $ex;
        }
        return $reviewsList;
    }
}

?>