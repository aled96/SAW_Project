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



<div id="settings">
	<h1>Change Info</h1>
	<form action="changeSettings.php" method="POST" name="settings">
		<?php
		
			if(isset($_SESSION['username'])){
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "university_sharing";

				// Create connection
				$conn = new mysqli($servername, $username, $password, $dbname);

				$user = $_SESSION['username'];
				
				$sql = "SELECT * FROM user WHERE username='".$user."'";
				$result = mySQLi_query($conn, $sql) or die("Error query");

				while($row = mySQLi_fetch_array($result)){
					echo"<table>
						<tr><td><label>Name</label></td><td><input type='text' id='nameSign name='nameSign' value='".$row['name']."'></td></tr>
						<tr><td><label>Surname</label></td><td><input type='text' id='surnameSign' name='surnameSign' value='".$row['surname']."'></td></tr>
						<tr><td><label>E-mail</label></td><td><input type='email' id='emailSign' name='emailSign' value='".$row['email']."'></td></tr>
						<tr><td><label>Username</label></td><td><input type='text' id='nameSign name='nameSign' value='".$row['name']."'></td></tr>
						<tr><td><label>Date of Birth</label></td><td><input type='date' id='dateSign' name='dateSign' value='".$row['date_of_birth']."'></td></tr>
						<tr><td><label>Gender</label></td><td>
							<select name='gender'>
							<option value='male'>Male</option>
							<option value='female'>Female</option>
							</select>
						</td></tr>
						<tr><td><label>Province</label></td><td>
							<select name='province'>
								<option value='male'>Male</option>
								<option value='female'>Female</option>
							</select>
						</td></tr>
						<tr><td><label>City</label></td><td>
							<select name='city'>
								<option value='male'>Male</option>
								<option value='female'>Female</option>
							</select>
						</td></tr>
						<tr><td></td><td><input type='submit' value='Submit' onClick='checkBeforeSubmit();' name='sub'></td></tr>
					</table>";
				}
			}
			else
				echo"<p>Log in first <a href='login.php'>here</a></p>";
		?>
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