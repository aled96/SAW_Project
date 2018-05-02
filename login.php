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
	<script src="js/common.js"></script>

</head>

  <body>

    <div class="navbar navbar-inverse">
    <div class="navbar-inner">
		<div class="container-fluid">
			<button class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse" data-disabled="true">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="brand" href="index.html" id="top">Site Name</a>
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



<div id="signUpForm">
	<h1>Sign Up</h1>
	<form action="signup.php" method="POST" name="signup">
		<table>
			<tr><td><label>Name</label></td><td><input type="text" id="nameSign" name="nameSign"></td></tr>
			<tr><td><label>Surname</label></td><td><input type="text" id="surnameSign" name="surnameSign"></td></tr>
			<tr><td><label>E-mail</label></td><td><input type="email" id="emailSign" name="emailSign"></td></tr>
			<tr><td><label>Nickname</label></td><td><input type="text" id=nickSign" name="nickSign"></td></tr>
			<tr><td><label>Password</label></td><td><input type="password" id="pswSign" name="pswSign"></td></tr>
			<tr><td><label>Password Confirm</label></td><td><input type="password" id="pswConfirmSign" name="pswConfirmSign"></td></tr>
			<tr><td><label>Date of Birth</label></td><td><input type="date" id="dateSign" name="dateSign" value="2000-01-01"></td></tr>
			<tr><td><label>Gender</label></td><td>
				<select name="gender">
				<option value="male">Male</option>
				<option value="female">Female</option>
				</select>
			</td></tr>
			<tr><td><label>Province</label></td><td>
				<select name="province">
					<option value="male">Male</option>
					<option value="female">Female</option>
				</select>
			</td></tr>
			<tr><td><label>City</label></td><td>
				<select name="city">
					<option value="male">Male</option>
					<option value="female">Female</option>
				</select>
			</td></tr>
			<tr><td></td><td><input type="button" value="Submit" onClick="checkBeforeSubmit();" name="sub"></td></tr>
			<tr><td colspan="2"><p>Already registered? Log In <a href="#" onClick="hide('signUpForm');show('logIn');">here</a></p></td></tr>
		</table>		
	</form>
</div>

<div id="logIn">
	<h1>Log In </h1>
	<form action="login_user.php" method="POST" name="login">
		<table>
			<tr><td><label>Username</label></td><td><input type="text" id="usernameLog" name="usernameLog"></td></tr>
			<tr><td><label>Password</label></td><td><input type="password" id="pswLog" name="pswLog"></td></tr>
			<tr><td></td><td><input type="submit" value="Submit" name="submit"></td></tr>
			<tr><td colspan="2"><p>Not registered? Sign up <a href="#" onClick="show('signUpForm');hide('logIn');">here</a></p></td></tr>
		</table>		
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