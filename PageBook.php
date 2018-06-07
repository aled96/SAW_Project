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
	<link rel="stylesheet" media="all" href="css/bookPage.css" />
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

<div id="contentBookPage">
	<?php

        require "db/mysql_credentials.php";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
	
		if(isset($_GET['Id']))
			$id = $_GET['Id'];
		else
			$id = 0;
	
		$_SESSION['PrevPage']="PageBook.php?Id=".$id;
		
		$sql = "SELECT *, book.description as BookDesc FROM book, insertion WHERE insertion.Material_offered = book.ID and book.ID='$id'";

		$result = mySQLi_query($conn, $sql) or die("Error query");
		
		while($row = mySQLi_fetch_array($result)){
			echo"
			<div id='BookCover'>
				<img src='data:image/jpeg;base64,".base64_encode($row['Cover'])."' alt='cover'/>
			</div>
			
			<div id='BookDescription'>
				<div id='Title'><p>".$row['Title']."</p></div>
				<div id='Author'><p>by ".$row['Author']."</p></div>
				<div id='Text'>
				<p>".$row['BookDesc']."</p>
				</div>
			</div>	
			
			<div id='SellerInfo'>
				<div id='Seller'><h5>Sold By: </h5><a href='show_profile.php?user=".$row['User_offerer']."&page=1'>".$row['User_offerer']."</a></div>
				<br>
				<div id='Seller'><h5>Price: </h5><p>".$row['Price']." €</p></div>
				<br>
				<div id='Seller'><h5>Place: </h5><p>".$row['Place']."</p></div>
				<br><br>";
				
				
				#Check if logged
				$star_status="icon-star-empty";
				$link = "login.php";
				if(isset($_SESSION['username'])){
					$user = $_SESSION['username'];
					#Check if in wishlist
					$sql2 = "SELECT COUNT(*) as IsThere FROM wishlist WHERE Book='$id' and Username='$user';";

					$result2 = mySQLi_query($conn, $sql2) or die("Error query");
					#If is in list -> change calss for star icon
					while($row2 = mySQLi_fetch_array($result2)){
						if($row2['IsThere'] == 1)
							$star_status="icon-star";
					}
					$link="add_favourite.php?Book=".$id;
				}
				
				echo"<div class='AddFavourite'>
					<a href='".$link."'><i class='$star_status'></i></a><p> Add Favourite</p>
				</div>				
			</div>		
			
			<div id='Details'>
				<h2>Details</h2>
				<div class='Info'><h5>Paperback: </h5><p>".$row['PageNum']." pages</p></div>
				<div class='Info'><h5>Publisher: </h5><p>".$row['Edition']."</p></div>
				<div class='Info'><h5>ISBN: </h5><p>".$row['ISBN']."</p></div>
			</div>";
			
			
		$sql2 = "SELECT faculty.name as Fac, category.Name as Cat FROM book,concern,category,faculty WHERE book.ID = concern.Book and concern.Category = category.ID and book.ID='".$id."' and faculty.ID = category.Faculty";
		$result2 = mySQLi_query($conn, $sql2) or die("Error query2");
			
			
			echo"<div id='categoryBook'><h3>Category</h3>";
			while($row2 = mySQLi_fetch_array($result2)){
				echo"
					<a href='#'>".$row2['Fac']."</a><a> > </a><a href='#'> ".$row2['Cat']."</a>";
			}
			echo"</div>";
		}
	?>
</div>

 <?php
 require "footer.php";

 ?>
 
</body>
</html>