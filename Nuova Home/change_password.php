<!DOCTYPE html>
<html lang="en">
<?php

require "connectionDB.php";

if(!isset($_SESSION['username'])) {
    header("location: login.php");
}

$_SESSION['PrevPage'] ="setting.php";
?>
  <head>
  
	<link rel="stylesheet" href="css/form.css">
    
    <?php
		require "head.php";
	?>
    <script src="js/changePassword.js"></script>

</head>

  <body>

  <?php
    require "navbar.php";

  ?>
  
	<section class="container min-height-login">
     <?php

        if(isset($_SESSION['username'])){
            echo'<div class="loginForm" id="signUpForm">
					<div class="panel panel-info">
						<div class="panel-heading">
							<div class="panel-title">Change Password</div>
						</div>
						<section>
						<label class="errorLogin" >
							<span id="errorSettingsBox"><br></span>
						</label>
						</section>
						<div class="panel-body">
							<form action="script/changePassword.php" method="POST" name="changePasswordForm" id="changePasswordForm" enctype="multipart/form-data">
					
								<div class="input-group loginMargin">
									<span class="input-group-addon"><i class="fa fa-unlock-alt"></i></span>
									<input type="password" placeholder="Old Password" id="oldPassChange" name="oldPassChange" onclick="removeErrorChange()" onkeyup="removeErrorChange()" value="" class="form-control">
								</div>	
					
								<div class="input-group loginMargin">
									<span class="input-group-addon"><i class="fa fa-lock"></i></span>
									<input type="password" placeholder="New Password" id="newPassChange" name="newPassChange" onclick="removeErrorChange()" onkeyup="removeErrorChange()" value="" class="form-control">
									<input type="hidden" id="pswEncryptChange" name="pswEncryptChange" value="">
									<input type="hidden" id="pswEncryptOldChange" name="pswEncryptOldChange" value="">
								</div>
					
								<div class="input-group loginMargin">
									<span class="input-group-addon"><i class="fa fa-lock"></i></span>
									<input type="password" placeholder="New Password" id="repeatNewPassChange" name="repeatNewPassChange" onclick="removeErrorChange()" onkeyup="removeErrorChange()" value="" class="form-control">
								</div>
								<br>
								<button type="button" onclick="checkPassword()" class="btn btn-success login-btn">Submit</button>
							</form>
						</div>
					</div>
				</div>';
                }
            else
                header("location: index.php");
			?>
	</section>

    <?php
    require "footer.php";

    ?>

</body>
</html>
