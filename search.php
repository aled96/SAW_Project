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
	<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">


	<link rel="stylesheet" media="all" href="css/footer.css" />
	<link rel="stylesheet" media="all" href="css/common.css" />
	<link rel="stylesheet" media="all" href="css/home.css" />
	<script src="js/common.js"></script>
      <?php
      if(isset($_SESSION['username'])) {
          echo '<script src="js/message_updates.js"></script>';
      }

      ?>
</head>

  <body>


  <?php
  require "navbar.php";
  ?>

<div class="content">
		
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
	
	if(isset($_GET['find'])){	
		$find = $_GET['find'];
		$_SESSION['PrevPage']="search.php?find=".$find;
	
		echo"
			<div class='typeHome'>
				<h1>Results for: ".$find."</h1>
			</div>";
		
		
		$sql = "SELECT * FROM book WHERE Author LIKE '%".$find."%' OR Title LIKE '%".$find."%' OR Description LIKE '%".$find."%'";
		$result = mySQLi_query($conn, $sql) or die("Error query");

		$anyResults = false;
		while($row = mySQLi_fetch_array($result)){
		
			$anyResults = true;
			echo
			"<div class='book-content'>
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
		
		if($anyResults == false)
			echo"<h3>No results found</h3>";
	}
	else if(isset($_GET['cat'])){	
		$cat = $_GET['cat'];
		$_SESSION['PrevPage']="search.php?cat=".$cat;
		echo"
			<div class='typeHome'>
				<h1>".$cat."</h1>
			</div>";
		
		
		$sql = "SELECT book.* FROM book,concern,category,faculty WHERE book.ID = concern.Book and concern.Category = category.ID and category.Faculty = faculty.ID and faculty.Name = '".$cat."'";
		$result = mySQLi_query($conn, $sql) or die("Error query");

		$anyResults = false;
		while($row = mySQLi_fetch_array($result)){
		
			$anyResults = true;
			echo
			"<div class='book-content'>
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
		
		if($anyResults == false)
			echo"<h3>No books in this category</h3>";
	
	}
	?>
	
</div>

  <?php
  require "footer.php";

  ?>
 
</body>
</html>
