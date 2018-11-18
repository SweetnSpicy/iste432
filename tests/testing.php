<?php

class DB{
  private $db;

  public function __construct(){
      try{
          //open conn
          $this->db = new PDO("pgsql:host=localhost;dbname=cxm1544', 'cxm1544', 'goldenP3");
          //change error reporting for development
          $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      } catch(PDOException $e){
          die("Failed to connect");
      }
  }
  //http://www.postgresqltutorial.com/postgresql-php/create-tables/
  //http://www.postgresqltutorial.com/postgresql-create-table/
  public function createDB(){
    try{
      $sqlList = ['CREATE DATABASE BoardGames',
              'CREATE TABLE IF NOT EXISTS Users (
                  username character varying(15) PRIMARY KEY,
                  password character varying(100) NOT NULL,
                  role character varying(10) NOT NULL
              )',
              'CREATE TABLE IF NOT EXISTS Ratings (
                  gameId INTEGER PRIMARY KEY,
                  title VARCHAR (100) NOT NULL,
                  rating DOUBLE PRECISION,
                  review TEXT
              )',
              'CREATE TABLE IF NOT EXISTS Library (
                  username VARCHAR (15) PRIMARY KEY,
                  gameId INTEGER NOT NULL,
                  FOREIGN KEY (username) REFERENCES User(username),
                  FOREIGN KEY (gameId) REFERENCES Ratings(gameId)
              )',
              'CREATE TABLE IF NOT EXISTS Ratings_User (
                  gameId INTEGER NOT NULL,
                  username VARCHAR (15) PRIMARY KEY,
                  PRIMARY KEY (gameId, username),
                  FOREIGN KEY (username) REFERENCES User(username)
              );'
      ];

      foreach ($sqlList as $sql) {
          $this->db->exec($sql);
      }

      return $this;
    }
    catch(PDOException $e){
      echo $sql . "<br>" . $e->getMessage();
    }
  }
  
  public function getAllUsers(){
    try{
      include "../classes/User.class.php";
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
  
  function delete($usr){
    $queryStr = "DELETE FROM Users WHERE username = ?";
    $numRows = 0;
    if($stmt = $this->db->prepare($queryStr)){
      $stmt->bind_param("s", $usr);
      $stmt->execute();
      $stmt->store_result();
      $numRows = $stmt->affected_rows;
    }
    return $numRows;
  } //delete
  
  function updateLazy($sql){
    $stmt = $this->db->prepare($queryStr);
    $stmt->execute();
    $stmt->store_result();
    $numRows = $stmt->affected_rows;
    return $numRows;
  }
  
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Testing</title>
</head>
<body>
  
</body>
</html>



