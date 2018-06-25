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
    
    <?php
		require "head.php";
	?>
	
    <script src="js/login.js"></script>

</head>

  <body>

  <?php
    require "navbar.php";
  ?>
  
	<section class="container min-height-login">
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


                        <h4 class="loginMargin">Personal Information</h4>
						<div class="input-group loginMargin">
							<span class="input-group-addon"><i class="fa fa-user"></i></span>
							<input type="text" placeholder="First name" id="nameSign" name="nameSign" onclick="removeErrorSignup()" onkeyup="removeErrorSignup()" class="form-control">
						</div>
						
						<div class="input-group loginMargin">
							<span class="input-group-addon"><i class="fa fa-user"></i></span>
							<input type="text" placeholder="Last name" id="surnameSign" name="surnameSign" onclick="removeErrorSignup()" onkeyup="removeErrorSignup()" class="form-control">
						</div>

                        <div class="input-group loginMargin">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input onclick="removeErrorSignup()" type="date" id="dateSign" name="dateSign" class="form-control">
                        </div>

                        <div class="input-group loginMargin">
							<select  onchange="removeErrorSignup()" name="gender" id="gender" class="form-control">
								<option value="not-selected" selected disabled>Gender</option>
								<option value="male">Male</option>
								<option value="female">Female</option>
							</select>
						</div>

                        <h4 class="loginMargin">City of Birth</h4>
						<div class="input-group loginMargin">
							<select onclick="removeErrorSignup()" name="province" id="province" onchange="selectCity()" class="form-control">
								<option value="not-selected" selected disabled>Province</option>
								<?php

									$sql = "SELECT ID, Name FROM province";
									$result = $conn->query($sql);

									while($row = $result->fetch_assoc()) {
										$prov = $row['Name'];
                                        $id = $row['ID'];
										if(strlen($prov) != 0) {
											echo "<option value='" . $id . "'>" . $prov . "</option>";
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

                        <h4 class="loginMargin">Profile Pic</h4>
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