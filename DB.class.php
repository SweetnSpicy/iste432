<?php

  class PDO_DB {
    
    private $dbh;
    // constructor method to connect to database
    function __construct(){
      try {
        $this->dbh = new PDO("pgsql:host={$_SERVER['DB_SERVER']};dbname={$_SERVER['DB']};user={$_SERVER['DB_USER']};password={$_SERVER['DB_PASS']}");
        $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }
      catch (PDOException $e){
        echo "<h1>Unable to connect to database</h1>";
        echo $e;
      }
    } // end constructor

    //might be moved to a different class called pagestart
    public function login($email) {
      try {
        $stmt = $this->dbh->prepare("SELECT email, password, role FROM users
                                      WHERE email = :email");
        $stmt->bindparam(':email', $email);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_OBJ);

        return result;
      }
      catch (PDOException $e) {
        echo "<h1>unable to log in</h1>";
        echo $e;
      }
    }
  } // end class

?>
