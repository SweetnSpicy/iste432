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

<form action="" method="POST">
	<!-- form fields for doing some simple functions -->
	<!-- new user -->
	<div>
		<h3 class="text-center">New User</h3>
            <div class="form-group">
                <label for="email" >Username:</label><br>
                <input type="text" name="email" id="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Password:</label><br>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <div class="form-group">
            	<label for="role">Role:</label><br>
            	<input type="text" name="role" id="role" class="form-control">
            <div class="form-group">
                <input type="submit" name="" value="" class='btn btn-info btn-md text-uppercase'>
            </div>
	</div>

	<!-- -->


</form>

<?php
 include "assets/inc/end-container.php";
?>
