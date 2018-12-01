<?php
require_once('DB.class.php');
session_start();
include "assets/inc/header.php";
include "assets/inc/nav.php";
include "assets/inc/container.php";

if(!isset($_SESSION['role'])){
    header("Location: login.php");
}

?>


<?php
 include "assets/inc/end-container.php";
?>
