<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Site Name</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link href="https://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">


	<link rel="stylesheet" media="all" href="css/footer.css" />
    <link rel="stylesheet" media="all" href="css/common.css" />
    <link rel="stylesheet" media="all" href="css/login.css" />
	<script src="js/common.js"></script>
    <script src="js/login.js"></script>

</head>

  <body>

  <?php
    require "navbar.php";

  ?>
<div class="backimg">

    <div class="body" id="logIn">
        <form action="login_user.php" method="POST" name="login" class="sky-form">
            <header>Log In form</header>

            <fieldset>
                <section>
                    <label class="input" >
                        <p class='errorLogin' id = "errorLoginBox"><br></p>
                    </label>
                </section>
                <section>
                    <label class="input">
                        Username
                    </label>
                    <label class="input">
                        <i class="icon-append icon-user"></i>
                        <input type="text" onclick="removeError()" onkeyup="removeError()" placeholder="Username" id="usernameLog" name="usernameLog">
                    </label>
                </section>

                <section>
                    <label class="input">
                        Password
                    </label>
                    <label class="input">
                        <i class="icon-append icon-lock"></i>
                        <input type="password" onclick="removeError()" onkeyup="removeError()" placeholder="Password" id="pswLog" name="pswLog">
                        <input type="hidden" id="pswEncryptLog" name="pswEncryptLog">
                    </label>
                </section>

            </fieldset>

                <footer>
                    <button type="button" onClick="ajaxcheckPassword()" class="button">Submit</button>
                </footer>

            <fieldset>
                <section>
                    <p>Not registered? Sign up <a href="#" onClick="show('signUpForm');hide('logIn');">here</a></p>
                </section>
            </fieldset>

        </form>

    </div>

    <div class="body" id="signUpForm">
    <form action="signup.php" method="POST" name="signupform" class="sky-form">
        <header>Registration form</header>

        <fieldset>
            <section>
                <label class="input" >
                    <p class='errorLogin' id="errorSignupBox"><br></p>
                </label>
            </section>
            <section>
                <label class="input">
                    Username
                </label>
                <label class="input">
                    <i class="icon-append icon-user"></i>
                    <input type="text" placeholder="Username" id="userSign" name="userSign" onclick="removeErrorSignup()" onkeyup="removeErrorSignup()">
                    <b class="tooltip tooltip-bottom-right">Only characters and numbers</b>
                </label>
            </section>

            <section>
                <label class="input">
                    Email
                </label>
                <label class="input">
                    <i class="icon-append icon-envelope-alt"></i>
                    <input type="text" placeholder="Email address" id="emailSign" name="emailSign" onclick="removeErrorSignup()" onkeyup="removeErrorSignup()">
                    <b class="tooltip tooltip-bottom-right">Needed to verify your account</b>
                </label>
            </section>

            <section>
                <label class="input">
                    Password
                </label>
                <label class="input">
                    <i class="icon-append icon-lock"></i>
                    <input type="password" placeholder="Password" id="pswSign" name="pswSign" onclick="removeErrorSignup()" onkeyup="removeErrorSignup()">
                    <b class="tooltip tooltip-bottom-right">Only latin characters and numbers</b>
                </label>
            </section>
            <input type="hidden" id="pswEncryptSign" name="pswEncryptSign">

            <section>
                <label class="input">
                    Password Confirm
                </label>
                <label class="input">
                    <i class="icon-append icon-lock"></i>
                    <input type="password" placeholder="Confirm password" id="pswConfirmSign" name="pswConfirmSign" onclick="removeErrorSignup()" onkeyup="removeErrorSignup()">
                    <b class="tooltip tooltip-bottom-right">Only latin characters and numbers</b>
                </label>
            </section>
        </fieldset>

        <fieldset>
            <section>
                <label class="input">
                    Date of Birth
                </label>
                <label class="input input-date">
                    <i class="icon-append icon-calendar"></i>
                    <input onclick="removeErrorSignup()" type="date" id="dateSign" name="dateSign">
                </label>
            </section>
        </fieldset>

        <fieldset>
            <div class="row">
                <section class="col col-6">
                    <label class="input">
                        Name
                    </label>
                    <label class="input">
                        <input type="text" placeholder="First name" id="nameSign" name="nameSign" onclick="removeErrorSignup()" onkeyup="removeErrorSignup()">
                    </label>
                </section>
                <section class="col col-6">
                    <label class="input">
                        Surname
                    </label>
                    <label class="input">
                        <input type="text" placeholder="Last name" id="surnameSign" name="surnameSign" onclick="removeErrorSignup()" onkeyup="removeErrorSignup()">
                    </label>
                </section>
            </div>

            <section>
                <label class="input">
                    Gender
                </label>
                <label class="select">
                    <select  onchange="removeErrorSignup()" name="gender" id="gender">
                        <option value="not-selected" selected disabled>Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                    <i></i>
                </label>
            </section>
        </fieldset>

        <fieldset>
            <section>
                <label class="input">
                    Province of Birth
                </label>
                <label class="select">
                    <select onclick="removeErrorSignup()" name="province" id="province" onchange="selectCity()">
                        <option value="not-selected" selected disabled>Province</option>
                        <?php

                        require "db/mysql_credentials.php";

                        // Create connection
                        $conn = new mysqli($servername, $username, $password, $dbname);

                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

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
                    <i></i>
                </label>
            </section>

            <section>
                <label class="input">
                    City of Birth
                </label>
                <label class="select">
                    <select onclick="removeErrorSignup()" name="citySign" id="citySign">
                        <option value="not-selected" selected disabled>City</option>

                    </select>
                    <i></i>
                </label>
            </section>

			<section>
                    <label class="input">
                        Profile Picture
                    </label>
                    <label class="input">
						<input type="file" accept="image/*" id="image" name="image" onclick="removeErrorSignup()" onkeyup="removeErrorSignup()" required>
                    </label>
            </section>
			
            <section>
                <label class="checkbox"><input onclick="removeErrorSignup()"  type="checkbox" name="checkbox" id="checkboxSign"><i></i>I agree to the Terms of Service</label>
            </section>
        </fieldset>

        <footer>
            <button type="button" onclick="checkSignUp()" class="button">Submit</button>
        </footer>

        <fieldset>
            <section>
                <p>Already registered? Log in <a href="#" onClick="show('logIn');hide('signUpForm');">here</a></p>
            </section>
        </fieldset>
    </form>
    <br><br>
</div>

</div>

  <?php
  require "footer.php";

  ?>
 
</body>
</html>