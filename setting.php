<!DOCTYPE html>
<html lang="en">
<?php
	session_start();
?>
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
    <script src="js/login.js"></script>

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
				

				<?php
					if(isset($_SESSION['username']))
					{
					    $user = $_SESSION['username'];
						echo '<ul class="nav navbar-nav navbar-right pull-right">
                                    <li class="dropdown">
                                        <a href="#" data-toggle="dropdown" class="dropdown-toggle" onClick="autoHeight()"><i class="icon-user"></i>'.$user.'<b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="#"><i class="icon-wrench"></i> Settings</a></li>
                                            <li class="divider"></li>
                                            <li><a href="logout.php"><i class="icon-share"></i>Logout</a></li>
                                        </ul>
                                    </li>
                                </ul>';
					}
					else
					{
						echo "<ul class='nav navbar-nav navbar-right pull-right'>
							<li><a href='login.php'><i class='icon-user'></i>Log In</a></li>
							<li class='divider'></li>
							</ul>";

					}

					?>

			</div>
			<!--/.nav-collapse -->
		</div>
		<!--/.container-fluid -->
	</div>
	<!--/.navbar-inner -->
</div>

    <div class="body body-s" id="settings">
        <form action="changeSettings.php" method="POST" name="settings" class="sky-form">
            <header>Update Informtion</header>
            <?php

			if(isset($_SESSION['username'])){
                $servername = "localhost";
                $username = "root";
                $password = "password";
                $dbname = "university_sharing";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                $user = $_SESSION['username'];

                $sql = "SELECT * FROM user WHERE Username='" . $user . "'";
                $result = mySQLi_query($conn, $sql) or die("Error query");

                while ($row = mySQLi_fetch_array($result)) {
                    echo '
            <fieldset>
                <section>
                    <label class="input" >
                        <p class="errorLogin" id="errorSettingsBox"><br></p>
                    </label>
                </section>
                <section>
                    <label class="input">
                        <i class="icon-append icon-user"></i>
                        <input type="text" placeholder="Username" id="userSign" name="userSign" onclick="removeErrorSignup()" onkeyup="removeErrorSignup()" value="' . $row['Username'] . '">
                        <b class="tooltip tooltip-bottom-right">Only characters and numbers</b>
                    </label>
                </section>

                <section>
                    <label class="input">
                        <i class="icon-append icon-envelope-alt"></i>
                        <input type="text" placeholder="Email address" id="emailSign" name="emailSign" onclick="removeErrorSignup()" onkeyup="removeErrorSignup()"  value="' . $row['Email'] . '">
                        <b class="tooltip tooltip-bottom-right">Needed to verify your account</b>
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
                        <input type="date" id="dateSign" name="dateSign"  value="' . $row['Date_of_birth'] . '">
                    </label>
                </section>
            </fieldset>

            <fieldset>
                <div class="row">
                    <section class="col col-6">
                        <label class="input">
                            <input type="text" placeholder="First name" id="nameSign" name="nameSign" onclick="removeErrorSignup()" onkeyup="removeErrorSignup()"  value="' . $row['Name'] . '">
                        </label>
                    </section>
                    <section class="col col-6">
                        <label class="input">
                            <input type="text" placeholder="Last name" id="surnameSign" name="surnameSign" onclick="removeErrorSignup()" onkeyup="removeErrorSignup()"  value="' . $row['Surname'] . '">
                        </label>
                    </section>
                </div>

                <section>
                    <label class="select">';
                    if ($row['Gender'] == "male") {
                        echo "
							<select name='gender'>
							<option value='male' selected>Male</option>
							<option value='female'>Female</option>
							</select>
							";
                    } else {
                        echo "
							<select name='gender'>
							<option value='male'>Male</option>
							<option value='female' selected>Female</option>
							</select>
							";
                    }
                    echo '
                        <i></i>
                    </label>
                </section>
            </fieldset>

            <fieldset>
                <section>
                    <label class="select">
                        <select name="province" id="province">
                            <option value="not-selected" selected disabled>Province</option>';
                    $sql = "SELECT distinct Name FROM province";
                    $result = $conn->query($sql);

                    while ($row = $result->fetch_assoc()) {
                        $city = $row['Name'];
                        if (strlen($city) != 0) {
                            echo "<option value='" . $city . "'>" . $city . "</option>";
                        }
                    }
                    echo '
                        </select>
                        <i></i>
                    </label>
                </section>

                <section>
                    <label class="select">
                        <select name="citySign" id="citySign">
                            <option value="not-selected" selected disabled>City</option>';

                    $sql = "SELECT distinct Name FROM city";
                    $result = $conn->query($sql);

                    while ($row = $result->fetch_assoc()) {
                        $city = $row['name'];
                        if (strlen($city) != 0) {
                            echo "<option value='" . $city . "'>" . $city . "</option>";
                        }
                    }

                    $conn->close();
                    echo '
                        </select>
                        <i></i>
                    </label>
                </section>
            </fieldset>

            <footer>
                <button type="button" onclick="checkSettings()" class="button">Submit</button>
            </footer>
        </form>
    </div>';
                }
            }
            else
                echo "Log in First";
			?>

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