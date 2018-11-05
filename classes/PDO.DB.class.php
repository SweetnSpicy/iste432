<?php

  function getAllPeople(){
    try{
        include "User.class.php";
        $data = array();
        $stmt = $this->dbh->prepare("SELECT * FROM user");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, "User");
        while ($user = $stmt->fetch()){
            $data[] = $user;
        }
        return $data;
    } catch(PDOException $e){
        echo $e->getMessage();
        die("Big problem 5");
    }
  }


?>