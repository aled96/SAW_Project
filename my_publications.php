 <!DOCTYPE html>
<html lang="en">
<?php
	session_start();
	$userProfile = "";
	
	if(!isset($_SESSION['username'])) {
        header("location: index.php");
    }
	else
		$userProfile = $_SESSION['username'];
	
	if(isset($_GET['page']))
		$actualPage = $_GET['page'];
	else
		$actualPage = 1;
	$_SESSION['PrevPage'] = "my_publications.php?user=".$userProfile."&page=".$actualPage;
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
	<link rel="stylesheet" media="all" href="css/paging.css" />
	<script src="js/common.js"></script>
    <script src="js/login.js"></script>
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

	
	<?php

        require "db/mysql_credentials.php";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);

		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		
		echo"<div class='TitlePage'><p> My Publications</p></div>";
		
		$sql1 = "SELECT *,book.ID as BookID FROM book, insertion WHERE User_offerer = '$userProfile' AND Material_offered = book.Id";
		
		$result1 = mySQLi_query($conn, $sql1) or die("Error query1");
		$bookPublished = $result1->num_rows;
		
		if($bookPublished > 0){
			$bookPerPage = 2;
			
			$maxPage = ceil(($bookPublished)/$bookPerPage);
			//check, if page number >> max --> show last page
			if($actualPage > $maxPage)
				$actualPage = $maxPage;
			else if($actualPage < 1)
				$actualPage = 1;
			
			
			$firstToView = ($actualPage-1)*$bookPerPage;

			$cont = -1;
			
			echo"<div id='BooksPublished'>";
			
			while($row1 = mySQLi_fetch_array($result1)){
				$cont ++;
				//echo "Cont ".$cont;
				if($cont < $firstToView){
					continue;
				}
				else if($cont >= $firstToView + $bookPerPage)
					break;
				else{
					echo"						
						<div class='book-content'>
							<div class='cover' onclick='goToPageBook(".$row1['BookID'].");'>
								<img src='data:image/jpeg;base64,".base64_encode($row1['Cover'])."' alt='cover'/>
							</div>
							<div class='description'>
							<h3>".$row1['Title']."</h3>
							<a href='modify_book.php?id=".$row1['BookID']."'><i class='icon-pencil'></i></a>
							<br>
							<p>".$row1['Description']."</p>
							</div>
						</div>";
						
						if($cont < $firstToView+$bookPerPage-1){
							echo"<div class='separation-line'></div>";
						}
				}
			}	
			
			if($actualPage-1 < 1)
				$prev="#";
			else
				$prev="my_publications.php?user=".$userProfile."&page=".($actualPage-1);
			
			if($actualPage+1 > $maxPage)
				$next="#";
			else
				$next="my_publications.php?user=".$userProfile."&page=".($actualPage+1);
			
			echo"
			<div class='pagination-position'>
				  <ul class='pagination'>
					<li class='page-item'><a class='page-link' href='".$prev."'>Previous</a></li>
					<li class='page-item'><a class='page-link' href='my_publications.php?user=".$userProfile."&page=1'>1</a></li>";
			//if there are less than 6 pages -> show them
			if($maxPage < 6)
				for ($i = 2; $i <= $maxPage; $i++)
				echo"<li class='page-item'><a class='page-link' href='my_publications.php?user=".$userProfile."&page=".$i."'>".$i."</a></li>";
			//otherwise if there are more than 5 pages --> ...
			else if($maxPage > 5)
			{
				if($actualPage == 1)
					echo"<li class='page-item'><a class='page-link' href='my_publications.php?user=".$userProfile."&page=2'>2</a></li>
						<li class='page-item'><p class='page-link'>...</p></li>";
				else if($actualPage == $maxPage)
					echo"<li class='page-item'><p class='page-link'>...</p></li>
						<li class='page-item'><a class='page-link'href='my_publications.php?user=".$userProfile."&page=".($maxPage-1)."'>".($maxPage-1)."</a></li>";
				else if($actualPage == 2)
					echo"<li class='page-item'><a class='page-link' href='my_publications.php?user=".$userProfile."&page=2'>2</a></li>
					<li class='page-item'><a class='page-link' href='my_publications.php?user=".$userProfile."&page=3'>3</a></li>
					<li class='page-item'><p class='page-link'>...</p></li>";
				else if($actualPage == 3)
					echo"<li class='page-item'><a class='page-link' href='my_publications.php?user=".$userProfile."&page=2'>2</a></li>
					<li class='page-item'><a class='page-link' href='my_publications.php?user=".$userProfile."&page=3'>3</a></li><li class='page-item'><a class='page-link' href='my_publications.php?user=".$userProfile."&page=4'>4</a></li>
					<li class='page-item'><p class='page-link'>...</p></li>";
				else if($actualPage == $maxPage-2)
					echo"<li class='page-item'><p class='page-link'>...</p></li>
					<li class='page-item'><a class='page-link' href='my_publications.php?user=".$userProfile."&page=".($maxPage-3)."''>".($maxPage-3)."</a></li>
					<li class='page-item'><a class='page-link' href='my_publications.php?user=".$userProfile."&page=".($maxPage-2)."''>".($maxPage-2)."</a></li>
					<li class='page-item'><a class='page-link' href='my_publications.php?user=".$userProfile."&page=".($maxPage-1)."''>".($maxPage-1)."</a></li>";
				else if($actualPage == $maxPage-1)
					echo"<li class='page-item'><p class='page-link'>...</p></li>
					<li class='page-item'><a class='page-link' href='my_publications.php?user=".$userProfile."&page=".($maxPage-2)."''>".($maxPage-2)."</a></li>
					<li class='page-item'><a class='page-link' href='my_publications.php?user=".$userProfile."&page=".($maxPage-1)."''>".($maxPage-1)."</a></li>";
				else 
					echo"<li class='page-item'><p class='page-link'>...</p></li>
						  <li class='page-item'><a class='page-link' href='my_publications.php?user=".$userProfile."&page=".($actualPage-1)."'>".($actualPage-1)."</a></li>
						  <li class='page-item'><a class='page-link' href='my_publications.php?user=".$userProfile."&page=".$actualPage."'>".$actualPage."</a></li>
						  <li class='page-item'><a class='page-link' href='my_publications.php?user=".$userProfile."&page=".($actualPage+1)."'>".($actualPage+1)."</a></li>
						<li class='page-item'><p class='page-link'>...</p></li>";
				//page max
				echo"<li class='page-item'><a class='page-link' href='my_publications.php?user=".$userProfile."&page=".$maxPage."''>".$maxPage."</a></li>";
			}
			echo"<li class='page-item'><a class='page-link' href='".$next."'>Next</a></li>
				  </ul>
			</div>
			
			</div>";
		}
		else
			echo"<h2> No books published</h2>";
	
	?>
		
	</div>  
  
	<?php
	require "footer.php";

	?>

</body>
</html>