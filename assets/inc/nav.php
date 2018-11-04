<div class="row" id="mainNav">
  <div class="col-lg-4">
  </div>
  <div class="col-lg-6">

  </div>
  <div class="col-lg-2">

  </div>
</div><!-- end nav row -->
<div class="row justify-content-center alignt-items-center" id="logoRow">
  <div class="col-lg-4 col-md-4 col-sm-4" id="logoCol">
    <h1 class='text-center' style="color:white;">Board Games</h1>
  </div>
</div>

<?php


  if (!empty($_POST['logout'])){
    $_SESSION['valid'] = false;
    $_SESSION['role'] = '';
    session_destroy();
    header("location: Login.php");

}
?>
