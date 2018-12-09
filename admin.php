<?php
require_once('DB.class.php');
session_start();
include "assets/inc/header.php";
include "assets/inc/nav.php";
include "assets/inc/container.php";

if(!isset($_SESSION['role'])){
		header("Location: login.php");
}
elseif(isset($_SESSION['role'])){
	if($_SESSION['role'] != 'Admin'){
		header("Location: login.php");
	}
}

?>

<div class="row justify-content-center align-items-center">
  <div class="col-lg-4">
    <h1 style="text-align:center;margin-top:10px;">Admin Home</h1>
  </div>
</div>
<div class='row justify-content-center align-items-center'>
  <div class='col-lg-12'>
  </div>
</div>


<?php
 include "assets/inc/end-container.php";
?>
