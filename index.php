<!DOCTYPE html>
<html lang="en">

<?php
	session_start();
	$_SESSION['PrevPage'] = "index.php";
?>
  <head>
    <title>Site Name</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="css/bootstrap.css">
	<link href="https://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="https://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
	<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">


	<link rel="stylesheet" media="all" href="css/footer.css" />
	<link rel="stylesheet" media="all" href="css/common.css" />
	<link rel="stylesheet" media="all" href="css/home.css" />
	<script src="js/common.js"></script>

</head>

  <body>

  <?php
    require "navbar.php";
  ?>

<div class="slideshow">
</div>

  <br><br>
  <br><br>

  <div class="information">
      <div class="row">
          <div class="col col-12">
              <div class="jumbotron alert-success" style="background: radial-gradient(white,#EAFAF1)">
                  <h1 class=lead">Spend less. Read more books</h1>
                  <br>
                  <p class="minor">How is that possible? By sharing books with other people you save money and read more books.</p>
              </div>
          </div>
      </div>
      <div class="row">
          <div class="col col-4">
              <a href="login.php" title="Click here to register" style="text-decoration:none">
              <div class="jumbotron alert-info">
                  <h2 class="lead">1. Register</h2>
                  <br>
                  <p class="minor">Register Now!</p>
              </div>
              </a>
          </div>
          <div class="col col-4">
              <div class="jumbotron alert-warning">
                  <h2 class="lead">2. Add Books</h2>
                  <br>
                  <p class="minor">Update your Profile</p>
              </div>
          </div>
          <div class="col col-4">
              <div class="jumbotron alert-success">
                  <h2 class="lead">3. Bargain</h2>
                  <br>
                  <p class="minor">Save Money</p>
              </div>
          </div>

      </div>
  </div>

  <br><br>

<div class="content">
	
	<div class='typeHome'>
		<h1>Last Books Added</h1>
	</div>
		
	<?php	
	$servername = "localhost";
	$username = "root";
	$password = "password";
	$dbname = "university_sharing";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	$sql = "SELECT * FROM book ORDER BY Id desc LIMIT 5 ";
	$result = mySQLi_query($conn, $sql) or die("Error query");

	while($row = mySQLi_fetch_array($result)){
		echo
		"
		<div class='book-content'>
			<div class='cover' onclick='goToPageBook(".$row['ID'].");'>
			<img src='data:image/jpeg;base64,".base64_encode($row['Cover'])."' alt='cover'/>
			</div>
			<div class='description'>
			<h3>".$row['Title']."</h3>
			</div>
			<div class='description'>
			<p>".$row['Description']."</p>
			</div>
		</div>
		<div class='separation-line'></div>";
	
	}
	
	
	
	
	?>
	
</div>

  <?php
    require "footer.php";

  ?>
 
</body>
</html>