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
					<li><a href="#"><i class="icon-th-list icon-white"></i> Categories</a></li>
					<li class="divider-vertical"></li>
					<li><a href="#"><i class="icon-envelope icon-white"></i> Messagges</a></li>
					<li class="divider-vertical"></li>
					<li><a href="#"><i class="icon-lock icon-white"></i> Permits</a></li>
					<li class="divider-vertical"></li>
					<li><form action="search.php" method="GET">
						<input type="text" class="searchNav" placeholder="Search..." name="find" required><span class="searchButton"><button type="submit"><i class="icon-search icon-black"></i> </button></span>
						</form>
					</li>
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

<div class="content">
		
	<?php	
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "university_sharing";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	if(isset($_GET['find'])){	
		$find = $_GET['find'];
		echo"
			<div class='typeHome'>
				<h1>Results for: ".$find."</h1>
			</div>";
		
		
		$sql = "SELECT * FROM book WHERE author LIKE '%".$find."%' OR title LIKE '%".$find."%' OR description LIKE '%".$find."%'";
		$result = mySQLi_query($conn, $sql) or die("Error query");

		$anyResults = false;
		while($row = mySQLi_fetch_array($result)){
		
			$anyResults = true;
			echo
			"<div class='book-content'>
				<div class='cover' onclick='goToPageBook(".$row[0].");'>
				<img src='data:image/jpeg;base64,".base64_encode($row[7])."' alt='cover'/>
				</div>
				<div class='description'>
				<h3>".$row[2]."</h3>
				</div>
				<div class='description'>
				<p>".$row[3]."</p>
				</div>
			</div>
			<div class='separation-line'></div>";
		}
		
		if($anyResults == false)
			echo"<h3>No results found</h3>";
	}
	else if(isset($_GET['cat'])){	
		$cat = $_GET['cat'];
		echo"
			<div class='typeHome'>
				<h1>".$cat."</h1>
			</div>";
		
		
		$sql = "SELECT * FROM book,material,category,faculty WHERE book.id = material.book and material.category = category.id and category.faculty = faculty.id and faculty.name = '".$cat."'";
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