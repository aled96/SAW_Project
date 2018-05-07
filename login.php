<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Site Name</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link href="https://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="https://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
	<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">


	<link rel="stylesheet" media="all" href="css/footer.css" />
    <link rel="stylesheet" media="all" href="css/common.css" />
    <link rel="stylesheet" media="all" href="css/Home.css" />
    <link rel="stylesheet" media="all" href="css/sky-forms.css" />
    <link rel="stylesheet" media="all" href="css/demo.css" />
	<script src="js/common.js"></script>

</head>

  <body  class="bg-cyan">

    <div class="navbar navbar-inverse">
    <div class="navbar-inner">
		<div class="container-fluid">
			<button class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse" data-disabled="true">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="brand" href="index.php" id="top">Site Name</a>
			<div id= "auto-height" class="nav-collapse collapse" style="height:auto;" data-disabled="true">
				<ul class="nav">
					<li class="active"><a href="index.php"><i class="icon-home icon-white"></i> Home</a></li>
					<li class="divider-vertical"></li>
					<li><a href="#"><i class="icon-file icon-white"></i> Data</a></li>
					<li class="divider-vertical"></li>
					<li><a href="#"><i class="icon-envelope icon-white"></i> Messagges</a></li>
					<li class="divider-vertical"></li>
					<li><a href="#"><i class="icon-lock icon-white"></i> Permits</a></li>
					<li class="divider-vertical"></li>
				</ul>
                <ul class="nav navbar-nav navbar-right pull-right">
                    <li><a href="#" onClick="show('logIn'); hide('signUpForm');"><i class="icon-user"></i>Log In</a></li>
                </ul>

			</div>
			<!--/.nav-collapse -->
		</div>
		<!--/.container-fluid -->
	</div>
	<!--/.navbar-inner -->
</div>


<div class="body body-s" id="logIn">
    <form action="login_user.php" method="POST" name="signup" class="sky-form">
        <header>Registration form</header>

        <fieldset>
            <section>
                <label class="input">
                    <i class="icon-append icon-user"></i>
                    <input type="text" placeholder="Username" id=usernameLog" name="usernameLog">
                </label>
            </section>

            <section>
                <label class="input">
                    <i class="icon-append icon-lock"></i>
                    <input type="password" placeholder="Password" id="pswLog" name="pswLog">
                </label>
            </section>

            <footer>
                <button type="submit" class="button">Submit</button>
            </footer>

        </fieldset>

        <fieldset>
            <section>
                <p>Not registered? Sign up <a href="#" onClick="show('signUpForm');hide('logIn');">here</a></p>
            </section>
        </fieldset>

    </form>

</div>

<div class="body body-s" id="signUpForm">
    <form action="signup.php" method="POST" name="signup" class="sky-form">
        <header>Registration form</header>

        <fieldset>
            <section>
                <label class="input">
                    <i class="icon-append icon-user"></i>
                    <input type="text" placeholder="Username" id=userSign" name="userSign">
                    <b class="tooltip tooltip-bottom-right">Only characters and numbers</b>
                </label>
            </section>

            <section>
                <label class="input">
                    <i class="icon-append icon-envelope-alt"></i>
                    <input type="text" placeholder="Email address" id="emailSign" name="emailSign">
                    <b class="tooltip tooltip-bottom-right">Needed to verify your account</b>
                </label>
            </section>

            <section>
                <label class="input">
                    <i class="icon-append icon-lock"></i>
                    <input type="password" placeholder="Password" id="pswSign" name="pswSign">
                    <b class="tooltip tooltip-bottom-right">Only latin characters and numbers</b>
                </label>
            </section>

            <section>
                <label class="input">
                    <i class="icon-append icon-lock"></i>
                    <input type="password" placeholder="Confirm password" id="pswConfirmSign" name="pswConfirmSign">
                    <b class="tooltip tooltip-bottom-right">Only latin characters and numbers</b>
                </label>
            </section>
        </fieldset>

        <fieldset>
            <section>
                <label class="input">
                    Date of Birth
                </label>
                <label class="input">
                    <i class="icon-append icon-calendar"></i>
                    <input type="date" id="dateSign" name="dateSign">
                </label>
            </section>
        </fieldset>

        <fieldset>
            <div class="row">
                <section class="col col-6">
                    <label class="input">
                        <input type="text" placeholder="First name" id="nameSign" name="nameSign">
                    </label>
                </section>
                <section class="col col-6">
                    <label class="input">
                        <input type="text" placeholder="Last name" id="surnameSign" name="surnameSign">
                    </label>
                </section>
            </div>

            <section>
                <label class="select">
                    <select name="gender">
                        <option value="not-selected" selected disabled>Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                    <i></i>
                </label>
            </section>
        </fieldset>

        <fieldset>
            <section>
                <label class="select">
                    <select name="province">
                        <option value="not-selected" selected disabled>Province</option>
                        <option value="male">Genova</option>
                    </select>
                    <i></i>
                </label>
            </section>

            <section>
                <label class="select">
                    <select name="city">
                        <option value="not-selected" selected disabled>City</option>
                        <option value="male">Genova</option>
                    </select>
                    <i></i>
                </label>
            </section>

            <section>
                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>I agree to the Terms of Service</label>
            </section>
        </fieldset>

        <footer>
            <button type="submit" class="button">Submit</button>
        </footer>

        <fieldset>
            <section>
                <p>Already registered? Log in <a href="#" onClick="show('logIn');hide('signUpForm');">here</a></p>
            </section>
        </fieldset>
    </form>
</div>


<div class="myfooter">
  <small>
	Something to write in the footer
  </small>
  <div class="mynav">
    <ul>
      <li><a href="#"><i id="social-inf" class="fa fa-info fa-2x social"></i></a></li>
      <li><a href="#"><i id="social-con" class="fa fa-address-book-o fa-2x social"></i></a></li>
      <li><a href="#"><i id="social-fb" class="fa fa-facebook fa-2x social"></i></a></li>
      <li><a href="#"><i id="social-tw" class="fa fa-instagram fa-2x social"></i></a></li>
      <li><a href="#"><i id="social-li" class="fa fa-linkedin fa-2x social"></i></a></li>
      <li><a href="mailto:boh@boh.it"><i id="social-em" class="fa fa-envelope fa-2x social"></i></a></li>
    </ul>
  </div>
</div>
 
</body>
</html>