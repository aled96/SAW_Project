<!DOCTYPE html>
<html lang="en">
<?php

require "connectionDB.php";
	
$_SESSION['PrevPage'] ="setting.php";
?>
  <head>
    
	
    <title>BookTrader</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/NewHomeTest.css">

    <link href="http://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900|Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic|Open+Sans:300italic,400italic,600italic,700italic,400,700,600,300|Poppins:400,500,700,300,600" rel="stylesheet" type="text/css">

    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	
	
    <script src="js/changePassword.js"></script>

</head>

  <body>

  <?php
    require "navbar.php";

  ?>
  
	<section class="container">
     <?php

        if(isset($_SESSION['username'])){
		
		
            echo'<div class="loginForm" id="signUpForm">
					<div class="panel panel-info">
						<div class="panel-heading">
							<div class="panel-title">Change Password</div>
						</div>
						<section>
						<label class="errorLogin" >
							<p id="errorSettingsBox"><br></p>
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
