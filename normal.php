<?php
require_once('DB.class.php');
session_start();
include "assets/inc/header.php";
include "assets/inc/nav.php";
include "assets/inc/container.php";

if(!isset($_SESSION['role'])){
		header("Location: admin.php");
}
elseif(isset($_SESSION['role'])){
	if($_SESSION['role'] != 'Admin'){
		header("Location: normal.php");
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
	<!-- Get Games - call php func -->
	<div>
		<h3 class="text-center">Get Library</h3>
      
	</div>

  <!-- Get My Ratings - call php func -->
  <div>
    <h3 class="text-center">Get My Ratings</h3>
      <!-- button -->
  </div>

</form>

<?php
 include "assets/inc/end-container.php";
?>
