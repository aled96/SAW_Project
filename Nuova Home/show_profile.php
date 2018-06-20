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
      <title>BookTrader</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
      <link rel="stylesheet" href="css/NewHomeTest.css">

      <link href="http://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900|Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic|Open+Sans:300italic,400italic,600italic,700italic,400,700,600,300|Poppins:400,500,700,300,600" rel="stylesheet" type="text/css">

      <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

	  <link rel="stylesheet" media="all" href="css/profileStyle.css" />
	  <link rel="stylesheet" media="all" href="css/paging.css" />
      <script src="js/login.js"></script>
      <?php
      if(isset($_SESSION['username'])) {
          echo '<script src="js/message_updates.js"></script>';
      }

      ?>
	
</head>

<body>

    <!--Navbar-->
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

		$sql = "SELECT user.*, city.Name as CityName, province.Name as ProvName, Region FROM user, city,province WHERE city.ID = City AND province.ID = Province AND Username = '$userProfile'";
		$result = mySQLi_query($conn, $sql) or die("Error query");

        $sql1 = "SELECT *,book.ID as BookID FROM book, insertion WHERE User_offerer = '$userProfile' AND Material_offered = book.Id ORDER BY book.ID DESC";

        $result1 = mySQLi_query($conn, $sql1) or die("Error query1");
        $bookPublished = $result1->num_rows;

        while($row = mySQLi_fetch_array($result)) {

            $date = new DateTime($row['Date_of_birth']);
            $date_of_birth = $date->format('d-m-Y');
            echo '
                <div class="row">
                    <div class="col-md-offset-1 col-md-10 col-lg-offset-2 col-lg-8">
                        <div class="well profile">
                            <div class="col-sm-12">
                            
                            <div class="col-xs-12 col-sm-4 text-center image">
                                    <figure>';
                if ($row['ProfilePic'] != null)
                    echo "<img class='profile-image' src='data:image/jpeg;base64,".base64_encode($row['ProfilePic'])."' alt='cover'>";
                else
                    echo "<img class='profile-image' src='https://bootdey.com/img/Content/user_1.jpg'>";

                echo '
                                    </figure>
                                </div>
                                <div class="col-xs-12 col-sm-8">
                                    <h2>' . $row["Username"] . '</h2>
                                    <p><strong>Name: </strong>' . $row['Name'] . ' ' . $row['Surname'] . '</p>
                                    <p><strong>Born on </strong>' . $date_of_birth . '</p>
                                    <p><strong>City: </strong>' . $row['ProvName'] . ' in ' . $row['Region'] . '</p>
            
                                </div>
                                
                            </div>
                            <div class="col-xs-12 divider text-center">
                                    <h2><strong>'.$bookPublished.'</strong></h2>
                                    <p><small>Books Published</small></p>
                                    <p><a href="view_chat.php?user_to='.$userProfile.'"><button class="btn mybtn btn-info"><span class="fa fa-user"></span> Contact Now! 
                                        </button></a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
        }

        ?>

    <!--FEATURED PRODUCTS-->
    <section class="container">
        <div class="row">
            <div class="width100 text-center">
                <h1>LAST <span>ADDED</span></h1>
                <p class="sub-title">Here you can see the last book added ! Don't let them go</p>
            </div>
            <div class="width100">

                <?php
                require "db/mysql_credentials.php";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT book.*, insertion.*, book.ID as BookID FROM book,insertion WHERE book.ID = insertion.Material_offered ORDER BY book.ID desc LIMIT 6 ";
                $result = mySQLi_query($conn, $sql) or die("Error query");

                while($row = mySQLi_fetch_array($result)){


                    #Check if logged
                    $fav_status="fa fa-heart-o";
                    $link = "login.php";
                    if(isset($_SESSION['username'])){
                        $user = $_SESSION['username'];
                        #Check if in wishlist
                        $sql2 = "SELECT COUNT(*) as IsThere FROM wishlist WHERE Book='".$row['BookID']."' and Username='".$user."';";

                        $result2 = mySQLi_query($conn, $sql2) or die("Error query");
                        #If is in list -> change calss for star icon
                        while($row2 = mySQLi_fetch_array($result2)){
                            if($row2['IsThere'] == 1)
                                $fav_status="fa fa-heart";
                        }
                        $link="script/add_favourite.php?Book=".$row['BookID'];
                    }

                    echo"
						<div class='col-md-2 my-shop-animation'>
							<div class='box-prod group-book'>
								<div class='box-img-book'>
									<img src='data:image/jpeg;base64,".base64_encode($row['Cover'])."' alt='cover'/>
									<div class='box-btn-shop'>
										<div class='bt-img'><a class='btn btn-det-cart' href='pageBook.php?Id=".$row['BookID']."'><i class='fa fa-list'></i></a></div>
										<div class='bt-img'><a class='btn btn-det-cart' href='".$link."'><i class='".$fav_status."'></i></a></div>
									</div>
								</div>
								<h2 class='title-book'>".$row['Title']."</h2>
								<p class='author-txt'>".$row['Author']."</p>
								<p class='book-price'>".$row['Price']." €</p>
							</div>
						</div>
							";
                }
                ?>
            </div>
        </div>
    </section>
  
	<?php
	require "footer.php";

	?>

</body>
</html>