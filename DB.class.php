<?php

  class PDO_DB {
    
    private $dbh;
    // constructor method to connect to database
    function __construct(){
      try {
        $this->dbh = new PDO("pgsql:dbname=boardgame;user=t;password=pass;host=localhost;port=5432");
        $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }
      catch (PDOException $e){
        echo "<h1>Unable to connect to database</h1>";
        echo $e;
      }
    } // end constructor

    //might be moved to a different class called pagestart
    public function login($email, $password) {
      try {
        $stmt = $this->dbh->prepare("SELECT username, password FROM bg_user
                                      WHERE username = :username AND password = :password");
        $stmt->bindparam(':username', $email);
        $stmt->bindparam(':password', $password);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_OBJ);

        return $result;
      }
      catch (PDOException $e) {
        echo "<h1>unable to log in</h1>";
        echo $e;
      }
    }
  } // end class

?>
