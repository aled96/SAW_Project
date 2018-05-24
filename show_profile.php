 <!DOCTYPE html>
<html lang="en">
<?php
	session_start();
	$userProfile = $_GET['user'];
	
	if(!isset($_GET['user'])) {
        if(!isset($_SESSION['username'])) {
            header("location: index.php");
        }
        $userProfile = $_SESSION['username'];
    }
	
	if(isset($_GET['page']))
		$actualPage = $_GET['page'];
	else
		$actualPage = 1;
	$_SESSION['PrevPage'] = "show_profile.php?user=".$userProfile."&page=".$actualPage;
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
					<div class='OtherInfo'><a href='view_chat.php?user_to=".$userProfile."'>Contact here</a></div>
					
				</div>
			</div>
			";
		}
		
		$sql1 = "SELECT COUNT(*) as len FROM book, insertion WHERE User_offerer = '$userProfile' AND Material_offered = book.Id";
		
		$result1 = mySQLi_query($conn, $sql1) or die("Error query2");
		while($row1 = mySQLi_fetch_array($result1)){
			$maxPage = ceil(($row1['len'])/1);
		}
		
		//check, if page number >> max --> show last page
		if($actualPage > $maxPage)
			$actualPage = $maxPage;
		
		
		$firstToView = ($actualPage-1)*1;
		
		
		$sql2 = "SELECT *,book.ID as BookID FROM book, insertion WHERE User_offerer = '$userProfile' AND Material_offered = book.Id LIMIT ".$firstToView.", 1";
		
		$result2 = mySQLi_query($conn, $sql2) or die("Error query");

		echo"<div id='BooksPublished'>";
		
		$cont = mysqli_num_rows($result2)-1;
		
		while($row2 = mySQLi_fetch_array($result2)){
			echo"
				
				<div class='book-content'>
					<div class='cover' onclick='goToPageBook(".$row2['BookID'].");'>
						<img src='data:image/jpeg;base64,".base64_encode($row2['Cover'])."' alt='cover'/>
					</div>
					<div class='description'>
					<h3>".$row2['Title']."</h3>
					<br>
					<p>".$row2['Description']."</p>
					</div>
				</div>";
				
				if($cont > 0){
					echo"<div class='separation-line'></div>";
					$cont--;
				}
		}
		
		if($actualPage-1 < 1)
			$prev="#";
		else
			$prev="show_profile.php?user=".$userProfile."&page=".($actualPage-1);
		
		if($actualPage+1 > $maxPage)
			$next="#";
		else
			$next="show_profile.php?user=".$userProfile."&page=".($actualPage+1);
		
		echo"
		<div class='pagination-position'>
			  <ul class='pagination'>
				<li class='page-item'><a class='page-link' href='".$prev."'>Previous</a></li>
				<li class='page-item'><a class='page-link' href='show_profile.php?user=".$userProfile."&page=1'>1</a></li>";
		//if there are less than 6 pages -> show them
		if($maxPage < 6)
			for ($i = 1; $i <= $maxPage; $i++)
			echo"<li class='page-item'><a class='page-link' href='show_profile.php?user=".$userProfile."&page=".$i."'>".$i."</a></li>";
		//otherwise if there are more than 5 pages --> ...
		else if($maxPage > 5)
		{
			if($actualPage == 1)
				echo"<li class='page-item'><a class='page-link' href='show_profile.php?user=".$userProfile."&page=2'>2</a></li>
					<li class='page-item'><p class='page-link'>...</p></li>";
			else if($actualPage == $maxPage)
				echo"<li class='page-item'><p class='page-link'>...</p></li>
					<li class='page-item'><a class='page-link'href='show_profile.php?user=".$userProfile."&page=".($maxPage-1)."'>".($maxPage-1)."</a></li>";
			else if($actualPage == 2)
				echo"<li class='page-item'><a class='page-link' href='show_profile.php?user=".$userProfile."&page=2'>2</a></li>
				<li class='page-item'><a class='page-link' href='show_profile.php?user=".$userProfile."&page=3'>3</a></li>
				<li class='page-item'><p class='page-link'>...</p></li>";
			else if($actualPage == 3)
				echo"<li class='page-item'><a class='page-link' href='show_profile.php?user=".$userProfile."&page=2'>2</a></li>
				<li class='page-item'><a class='page-link' href='show_profile.php?user=".$userProfile."&page=3'>3</a></li><li class='page-item'><a class='page-link' href='show_profile.php?user=".$userProfile."&page=4'>4</a></li>
				<li class='page-item'><p class='page-link'>...</p></li>";
			else if($actualPage == $maxPage-2)
				echo"<li class='page-item'><p class='page-link'>...</p></li>
				<li class='page-item'><a class='page-link' href='show_profile.php?user=".$userProfile."&page=".($maxPage-3)."''>".($maxPage-3)."</a></li>
				<li class='page-item'><a class='page-link' href='show_profile.php?user=".$userProfile."&page=".($maxPage-2)."''>".($maxPage-2)."</a></li>
				<li class='page-item'><a class='page-link' href='show_profile.php?user=".$userProfile."&page=".($maxPage-1)."''>".($maxPage-1)."</a></li>";
			else if($actualPage == $maxPage-1)
				echo"<li class='page-item'><p class='page-link'>...</p></li>
				<li class='page-item'><a class='page-link' href='show_profile.php?user=".$userProfile."&page=".($maxPage-2)."''>".($maxPage-2)."</a></li>
				<li class='page-item'><a class='page-link' href='show_profile.php?user=".$userProfile."&page=".($maxPage-1)."''>".($maxPage-1)."</a></li>";
			else 
				echo"<li class='page-item'><p class='page-link'>...</p></li>
					  <li class='page-item'><a class='page-link' href='show_profile.php?user=".$userProfile."&page=".$actualPage."'>".$actualPage."</a></li>
					<li class='page-item'><p class='page-link'>...</p></li>";
			//page max
			echo"<li class='page-item'><a class='page-link' href='show_profile.php?user=".$userProfile."&page=".$maxPage."''>".$maxPage."</a></li>";
		}
		echo"<li class='page-item'><a class='page-link' href='".$next."'>Next</a></li>
			  </ul>
		</div>
		
		</div>";
	
	?>
		
	</div>  
  
	<?php
	require "footer.php";

	?>

</body>
</html>