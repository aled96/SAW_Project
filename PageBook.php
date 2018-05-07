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
	<link rel="stylesheet" media="all" href="css/BookPage.css" />
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
             <a class="brand" href="#" id="top">Site Name</a>
             <div id= "auto-height" class="nav-collapse collapse" style="height:auto;" data-disabled="true">
                 <ul class="nav">
                     <li><a href="index.php"><i class="icon-home icon-white"></i> Home</a></li>
                     <li class="divider-vertical"></li>
                     <li><a href="category.php"><i class="icon-th-list icon-white"></i> Categories</a></li>
                     <li class="divider-vertical"></li>
                     <li><a href="#"><i class="icon-envelope icon-white"></i> Messagges</a></li>
                     <li class="divider-vertical"></li>
                     <li><a href="#"><i class="icon-lock icon-white"></i> Permits</a></li>
                     <li class="divider-vertical"></li>
                     <li><form action="search.php" method="get">
                             <input type="text" class="searchNav" placeholder="Search..." name="find" required><span class="searchButton"><button type="submit"><i class="icon-search icon-black"></i> </button></span>
                         </form>
                     </li>
                     <li class="divider-vertical"></li>
                 </ul>



                 <?php
                 session_start();
                 if(isset($_SESSION['username']))
                 {
                     $user = $_SESSION['username'];
                     echo '<ul class="nav navbar-nav navbar-right pull-right">
                                    <li class="dropdown">
                                        <a href="#" data-toggle="dropdown" class="dropdown-toggle" onClick="autoHeight()"><i class="icon-user"></i>'.$user.'<b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="setting.php"><i class="icon-wrench"></i> Settings</a></li>
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

<div id="contentBookPage">
	<?php
		$servername = "localhost";
		$username = "root";
		$password = "password";
		$dbname = "university_sharing";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
	
		$id = $_GET['Id'];
	
		$sql = "SELECT * FROM book, insertion WHERE insertion.material_offered = book.ID and book.ID='".$id."'";

		$result = mySQLi_query($conn, $sql) or die("Error query");
		
		while($row = mySQLi_fetch_array($result)){
			echo"
			<div id='BookCover'>
				<img src='data:image/jpeg;base64,".base64_encode($row['Cover'])."' alt='cover'/>
			</div>
			
			<div id='BookDescription'>
				<div id='Title'><h1>".$row['Title']."</h1></div>
				<div id='Author'><p>by ".$row['Author']."</p></div>
				<div id='Text'>
				<p>".$row['Description']."</p>
				</div>
			</div>	
			
			<div id='SellerInfo'>
				<div id='Seller'><h5>Sold By: </h5><p>".$row['user_offerer']."</p></div>
				<br>
				<div id='Seller'><h5>Price: </h5><p>".$row['price']." €</p></div>
				<br>
				<div id='Seller'><h5>Place: </h5><p>".$row['place']."</p></div>
				<br><br>
				<div class='AddFavourite'>
					<a href=''><i class='icon-heart icon-black'></i></a><p> Add Favourite</p>
				</div>				
			</div>		
			
			<div id='Details'>
				<h2>Details</h2>
				<div class='Info'><h5>Paperback: </h5><p>".$row['PageNum']." pages</p></div>
				<div class='Info'><h5>Publisher: </h5><p>".$row['Edition']."</p></div>
				<div class='Info'><h5>ISBN: </h5><p>".$row['ISBN']."</p></div>
			</div>";
			
			
		$sql2 = "SELECT faculty.name as Fac, category.Name as Cat FROM category,material,faculty WHERE material.category = category.id and material.book='".$id."' and faculty.id = category.faculty";
		$result2 = mySQLi_query($conn, $sql2) or die("Error query2");
		
			while($row2 = mySQLi_fetch_array($result2)){
			
				echo"
							
				<div id='categoryBook'>
					<h3>Category</h3>
					<a href='#'>".$row2['Fac']."</a><a> > </a><a href='#'> ".$row2['Cat']."</a>
				</div>";
			}
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