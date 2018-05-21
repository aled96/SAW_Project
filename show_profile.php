 <!DOCTYPE html>
<html lang="en">
<?php
	session_start();
	$userProfile = $_GET['user'];
	$_SESSION['PrevPage'] = "show_profile.php?user=".$userProfile;
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
	<link rel="stylesheet" media="all" href="css/profileStyle.css" />
	<script src="js/common.js"></script>
    <script src="js/login.js"></script>

</head>

<body>

	<?php
	require "navbar.php";
	?>

	
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

		$sql = "SELECT user.*, province.Name as ProvName, Region FROM user, province WHERE ID = City AND Username = '$userProfile'";
		$result = mySQLi_query($conn, $sql) or die("Error query");

		while($row = mySQLi_fetch_array($result)){
			echo"
			<div id='UserInfo'>
				<div id='ProfilePic'>
				<img src='data:image/jpeg;base64,".base64_encode($row['ProfilePic'])."' alt='cover'/>
				</div>
				
				<div id='UserDetail'>
					<div id='Username'><p>".$row['Username']."</p></div>
					<div class='OtherInfo'><p>".$row['Name']."</p><p>".$row['Surname']."</p></div>
					<div class='OtherInfo'><p>".$row['ProvName']." in ".$row['Region']."</p></div>
					<div class='OtherInfo'><a href='#'>Contact here</a></div>
					
				</div>
			</div>
			";
		}
		
		
		
		$sql2 = "SELECT *,book.ID as BookID FROM book, insertion WHERE User_offerer = '$userProfile' AND Material_offered = Book.ID";
		$result2 = mySQLi_query($conn, $sql2) or die("Error query");

		echo"<div id='BooksPublished'>";
		
		while($row2 = mySQLi_fetch_array($result2)){
			echo"
				
				<div class='book-content'>
					<div class='cover' onclick='goToPageBook(".$row2['BookID'].");'>
						<img src='data:image/jpeg;base64,".base64_encode($row2['Cover'])."' alt='cover'/>
					</div>
					<div class='description'>
					<h3>".$row2['Title']."</h3>
					</div>
					<div class='description'>
					<p>".$row2['Description']."</p>
					</div>
				</div>
				<div class='separation-line'></div>
			";
		}
		echo"</div>";
	
	?>
		
	</div>  
  
	<?php
	require "footer.php";

	?>

</body>
</html>