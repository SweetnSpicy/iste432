<?php

class DB{
    private $db;

    public function __construct(){
        try{
            //open conn
            $this->db = new PDO("pgsql:host=localhost;port=5432;dbname=testdb;user=usr;password=pwd");
            //change error reporting for development
            //$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e){
            die("Failed to connect");
        }
    }

    ////////////SELECTS/////////////////
    function getLibrary($usr){
        try{
            $data = array();
            $stmt = $this->db->prepare("SELECT * FROM Library WHERE username = :usr");
            $stmt->execute(array("usr"=>$usr));
            while ($lib = $stmt->fetch()){
                $data[] = $lib;
            }
            return $data;
        } catch(PDOException $e){
            echo $e->getMessage();
            die("No games returned");
        }
    }
    
    function getAllGames(){
        try{
            include_once "Library.class.php";
            $data = array();
            $stmt = $this->db->prepare("SELECT * FROM Library");
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, "Library");
            while ($games = $stmt->fetch()){
                $data[] = $games;
            }
            return $data;
        } catch(PDOException $e){
            echo $e->getMessage();
            die("No games returned");
        }
    }

    function getAllUsers(){
        try{
            include "User.class.php";
            $data = array();
            $stmt = $this->db->prepare("SELECT * FROM Users");
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, "User");
            while ($user = $stmt->fetch()){
                $data[] = $user;
            }
            return $data;
        } catch(PDOException $e){
            echo $e->getMessage();
            die("Not all users returned");
        }
    }

    function getRatings($gId){
        try{
            include "Ratings.class.php";
            $data = array();
            $stmt = $this->db->prepare("SELECT * FROM Ratings where gameId = :id");
            $stmt->execute(array("id"=>$gId));
            $stmt->setFetchMode(PDO::FETCH_CLASS, "Ratings");
            while ($user = $stmt->fetch()){
                $data[] = $user;
            }
            return $data;
        } catch(PDOException $e){
            echo $e->getMessage();
            die("No rating returned");
        }
    }

    function getMyRating($gId, $usr){
        try{
            include "Ratings.class.php";
            $data = array();
            //pffft aight this a tomorrow me issue
            //$stmt = $this->db->prepare("SELECT * FROM Ratings_User where gameId = :id and username");
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, "Ratings");
            while ($user = $stmt->fetch()){
                $data[] = $user;
            }
            return $data;
        } catch(PDOException $e){
            echo $e->getMessage();
            die("Your rating has not returned");
        }
    }

    function getLazy($sql){
        try{
            $data = array();
            $stmt->execute($sql);
            while ($thing = $stmt->fetch()){
            $data[] = $thing;
            }
            return $data;
        } catch(PDOException $e){
            echo $e->getMessage();
            die("Nothing gotten'd");
        }
    }

    /////////////INSERTS////////////////

    function insertUser($usr, $pwd, $role){
        try{
            $stmt = $this->db->prepare("INSERT INTO Users (username, password, role) VALUES (:username, :password, :role)");
            $stmt->execute(array(
                "username" => $usr,
                "role" => $role
            ));
            return $this->db->lastInsertId();
        } catch(PDOException $e){
            echo $e->getMessage();
            die("No user inserted");
        }
    }

    function insertRating($gId, $title, $rating, $review){
        try{
            //connect the username to the gameId with ratings_user
            $stmt = $this->db->prepare("INSERT INTO Ratings (gameId, title, rating, review) VALUES (:gameId, :title, :rating, :review)");
            $stmt->execute(array(
                "gameId" => $gId,
                "title" => $title,
                "rating" => $rating,
                "review" => $review
            ));
            return $this->db->lastInsertId();
        } catch(PDOException $e){
            echo $e->getMessage();
            die("No rating inserted");
        }
    }

    function insertLazy($sql){
        try{
            //$stmt = $this->db->prepare($sql);
            $stmt->execute($sql);
            return $this->db->lastInsertId();
        } catch(PDOException $e){
            echo $e->getMessage();
            die("No insert was made");
        }
    }
    /////////////UPDATES////////////////
    /////////////DELETES////////////////
    function deleteUser($usr){
        $queryStr = "DELETE FROM BG_User WHERE username = ?";
        $numRows = 0;
        if($stmt = $this->db->prepare($queryStr)){
        $stmt->bind_param("s", $usr);  
        $stmt->execute();
        $stmt->store_result();
        $numRows = $stmt->affected_rows;
        }
        return $numRows;
    }

    function deleteLazy($sql){
        try{
            //$stmt = $this->db->prepare($sql);
            $numRows = 0;
            $stmt->execute($sql);
            $stmt->store_result();
            $numRows = $stmt->affected_rows;
            return $numRows;
        } catch(PDOException $e){
            echo $e->getMessage();
            die("No delete happened");
        }
    }

}
?>