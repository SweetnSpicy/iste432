<?php
include "assets/inc/header.php";
include "assets/inc/nav.php";
include "assets/inc/container.php";
require_once('DB.class.php');
?>

<div id="login-row" class="row justify-content-center align-items-center" >
    <div id="login-column" class="col-md-6">
        <div id="login-box" class="col-md-12">
            <form id="login-form" class="form" action="" method="post">
               <h1 class="text-center">Login</h1>
                <div class="form-group">
                    <label for="email" >Username:</label><br>
                    <input type="text" name="email" id="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Password:</label><br>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                <div class="form-group">
                    <label for="remember-me"><span>Remember me</span> <span><input id="remember-me" name="remember-me" type="checkbox"></span></label><br>
                    <input type="submit" name="submit" class="btn btn-info btn-md text-uppercase" value="submit">
                </div>
                <div class="form-group">
                    <input type="submit" name="logout" value="logout" class='btn btn-info btn-md text-uppercase'>
                </div>

            </form>
        </div>
    </div>

		<?php
		    $db = new PDO_DB();

		if (isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['password'])){


		    $results = $db->login($_POST['email']);



		    if ($_POST['email'] == $results->email &&
		    $_POST['password'] == $results->password) { #password_verify($_POST['password'], $usr->VCHPASSWORD) swap this in for hashing
		        $_SESSION['valid'] = true;
		        $_SESSION['role'] = $results->role;
		        echo 'You have logged in.';
		        if($results->role == 'admin'){
		            header("Location: admin.php");
		        }
		        else if($results->role == 'user') {
		            header("Location: index.php");
		        }
		        else {
		            echo "<h1>Login session error</h1>";
		        }
		    }
		}


		    if (!empty($_POST['logout'])){
		        $_SESSION['valid'] = false;
		        $_SESSION['role'] = '';
		        session_destroy();
		        echo 'You have logged out.';
		    }
		?>
<?php
include "assets/inc/end-container.php";

?>


<script>
	$(document).ready(function (){
		// forgot password modal
		$('#forgotPassword').click(function(){
			$('#forgotPasswordModal').modal();
		});
	});
</script>
