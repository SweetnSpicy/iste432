<?php

  class PDO_DB {
    
    private $db;
    // constructor method to connect to database
    function __construct(){
      try {
        $this->db = new PDO("pgsql:dbname=boardgame;user=t;password=pass;host=localhost;port=5432");
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }
      catch (PDOException $e){
        echo "<h1>Unable to connect to database</h1>";
        echo $e;
      }
    } // end constructor

    //might be moved to a different class called pagestart
      //TODO: check for the fucking password
    public function login($email) {
      try {
        $stmt = $this->db->prepare("SELECT username, password, role FROM bg_user
                                      WHERE username = :email");
        $stmt->bindparam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result;
      }
      catch (PDOException $e) {
        echo "<h1>unable to log in</h1>";
        echo $e;
      }
    }

////////////SELECTS/////////////////
    function getLibrary($usr){
        try{
            $data = array();
            $stmt = $this->db->prepare("SELECT gameid FROM Library WHERE username = :usr");
            $stmt->execute(array("usr"=>$usr));
            while ($lib = $stmt->fetch()){
                $data[] = $lib['gameid'];
            }
            return $data;
        } catch(PDOException $e){
            echo $e->getMessage();
            die("No games returned");
        }
    }

    function getInUsersLibrary($usr, $gid){
        try{
            $data = array();
            $stmt = $this->db->prepare("SELECT gameid FROM Library WHERE username = :usr AND gameid = :gid");
            $stmt->bindparam(':usr', $usr);
            $stmt->bindparam(':gid', $gid);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            return $result;
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
            $stmt = $this->db->prepare("INSERT INTO bg_user (username, password, role) VALUES (:username, :password, :role)");
            return $stmt->execute(array(
                "username" => $usr,
                "password" => $pwd,
                "role" => $role,
            ));
        } catch(PDOException $e){
            echo $e->getMessage();
            die("No user inserted");
        }
    }

    function insertGameIntoLibrary($usr, $gid){
        try{
            $stmt = $this->db->prepare("INSERT INTO Library (username, gameid) VALUES (:usr, :gid)");
            $stmt->execute([
                'usr' => $usr,
                'gid' => $gid,
            ]);
            return true;
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

    function deleteFromLibrary($usr, $gid){
        try{
            $stmt = $this->db->prepare("DELETE FROM Library WHERE username = :usr AND gameid = :gid");
            $stmt->bindparam(':usr', $usr);
            $stmt->bindparam(':gid', $gid);
            return $stmt->execute();
        } catch(PDOException $e){
            echo $e->getMessage();
            die("No user inserted");
        }
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

  } // end class
?>





