<?php

  class PDO_DB {

    // constructor method to connect to database
    function __construct(){
      try {
        // not sure how to do this with POSTGRES
      }
      catch (PDOException $e){
        echo "<h1>Unable to connect to database</h1>";
        echo $e;
      }
    } // end constructor

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
