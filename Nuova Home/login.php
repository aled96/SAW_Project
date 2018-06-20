<!DOCTYPE html>
<html lang="en">

<?php
	require "connectionDB.php";
	
    if(isset($_SESSION['username']))
    {
        header("location: index.php");
    }
?>

  <head>
    
	
    <title>BookTrader</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/NewHomeTest.css">

    <link href="http://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900|Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic|Open+Sans:300italic,400italic,600italic,700italic,400,700,600,300|Poppins:400,500,700,300,600" rel="stylesheet" type="text/css">

    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	
	
    <script src="js/login.js"></script>

</head>

  <body>

  <?php
    require "navbar.php";
  ?>
  
	<section class="container">
		<div class="loginForm" id="logIn">
			<div class="panel panel-info">
				<div class="panel-heading">
					<div class="panel-title">Login</div>
				</div>
				
                <section>
                    <label class="errorLogin" >
                        <p id="errorLoginBox"><br></p>
                    </label>
                </section>
				<div class="panel-body">
					<form action="script/login_user.php" method="POST" name="login">
						<div class="input-group loginMargin">
							<span class="input-group-addon"><i class="fa fa-user"></i></span>
							<input type="text" onclick="removeError()" onkeyup="removeError()" placeholder="Username" id="usernameLog" name="usernameLog" class="form-control">
						</div>

						<div class="input-group loginMargin">
							<span class="input-group-addon">
								<i class="fa fa-lock"></i>
							</span>
							<input type="password" onclick="removeError()" onkeyup="removeError()" placeholder="Password" id="pswLog" name="pswLog" class="form-control">
                        <input type="hidden" id="pswEncryptLog" name="pswEncryptLog">
						</div>

						<div class="form-group loginMargin">
							<div class="loginSentence">
								<p>Not registered? Sign up <a href="#" onClick="show('signUpForm');hide('logIn');">here</a></p>
							</div>
							<input type="button" onClick="ajaxcheckPassword()"  class="btn btn-success login-btn" value="Submit">
						</div>
					</form>
				</div>
			</div>
		</div>


		<div class="signUpForm" id="signUpForm">
			<div class="panel panel-info">
				<div class="panel-heading">
					<div class="panel-title">Registration</div>
				</div>
                <section>
                    <label class="errorLogin" >
                        <p id="errorSignupBox"><br></p>
                    </label>
                </section>
				<div class="panel-body">
					<form form action="script/signup.php" method="POST" name="signupform" enctype="multipart/form-data">
						<div class="input-group loginMargin">
							<span class="input-group-addon"><i class="fa fa-user"></i></span>
							<input type="text" placeholder="Username" id="userSign" name="userSign" onclick="removeErrorSignup()" onkeyup="removeErrorSignup()" class="form-control">
						</div>						
						
						<div class="input-group loginMargin">
							<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
							<input type="text" placeholder="Email address" id="emailSign" name="emailSign" onclick="removeErrorSignup()" onkeyup="removeErrorSignup()" class="form-control">
						</div>
					
						<div class="input-group loginMargin">
							<span class="input-group-addon"><i class="fa fa-lock"></i></span>
							<input type="password" placeholder="Password" id="pswSign" name="pswSign" onclick="removeErrorSignup()" onkeyup="removeErrorSignup()" class="form-control">
						</div>


						<div class="input-group loginMargin">
							<span class="input-group-addon"><i class="fa fa-lock"></i></span>
							<input type="password" placeholder="Confirm password" id="pswConfirmSign" name="pswConfirmSign" onclick="removeErrorSignup()" onkeyup="removeErrorSignup()" class="form-control">
							<input type="hidden" id="pswEncryptSign" name="pswEncryptSign">
						</div>

						<div class="input-group loginMargin">
							<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							<input onclick="removeErrorSignup()" type="date" id="dateSign" name="dateSign" class="form-control">
						</div>
						
						
						
						<div class="input-group loginMargin">
							<span class="input-group-addon"><i class="fa fa-user"></i></span>
							<input type="text" placeholder="First name" id="nameSign" name="nameSign" onclick="removeErrorSignup()" onkeyup="removeErrorSignup()" class="form-control">
						</div>
						
						<div class="input-group loginMargin">
							<span class="input-group-addon"><i class="fa fa-user"></i></span>
							<input type="text" placeholder="Last name" id="surnameSign" name="surnameSign" onclick="removeErrorSignup()" onkeyup="removeErrorSignup()" class="form-control">
						</div>
						
						<div class="input-group loginMargin">
							<select  onchange="removeErrorSignup()" name="gender" id="gender" class="form-control">
								<option value="not-selected" selected disabled>Gender</option>
								<option value="male">Male</option>
								<option value="female">Female</option>
							</select>
						</div>
							
						<div class="input-group loginMargin">
							<select onclick="removeErrorSignup()" name="province" id="province" onchange="selectCity()" class="form-control">
								<option value="not-selected" selected disabled>Province</option>
								<?php

									$sql = "SELECT distinct Name FROM province";
									$result = $conn->query($sql);

									while($row = $result->fetch_assoc()) {
										$prov = $row['Name'];
										if(strlen($prov) != 0) {
											echo "<option value='" . $prov . "'>" . $prov . "</option>";
										}
									}

									$conn->close();
								?>
							</select>
						</div>
													
						<div class="input-group loginMargin">
							<select onclick="removeErrorSignup()" name="citySign" id="citySign" class="form-control">
								<option value="not-selected" selected disabled>City</option>
							</select>
						</div>
							
							
						<div class="input-group loginMargin">
							<input type="file" accept="image/*" id="image" name="image" onclick="removeErrorSignup()" required>
						</div>
							
							
						<div class="input-group loginMargin">
							<section>
								<label><input onclick="removeErrorSignup()"  type="checkbox" name="checkbox" id="checkboxSign"><i></i>I agree to the Terms of Service</label>
							</section>
						</div>
						
						
						<div class="form-group loginMargin">
							<div class="loginSentence">
								<p>Already registered? Log in <a href="#" onClick="show('logIn');hide('signUpForm');">here</a></p>
							</div>
							<input type="button" onclick="checkSignUp()" class="btn btn-success login-btn" value="Submit">
						</div>
					</form>
				</div>
			</div>
		</div>
    </section>

  <?php
  require "footer.php";

  ?>
 
</body>
</html>