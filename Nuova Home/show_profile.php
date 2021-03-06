<!DOCTYPE html>
<html lang="en">
<?php

    require "connectionDB.php";
	
	if(!isset($_GET['user'])) {
        if(!isset($_SESSION['username'])) {
            header("location: index.php");
        }
        $userProfile = $_SESSION['username'];
    }
	else
		$userProfile = $conn->real_escape_string(trim($_GET['user']));
	
	if(isset($_GET['page']))
		$actualPage = $conn->real_escape_string(trim($_GET['page']));
	else
		$actualPage = 1;

    $sql = "SELECT Email FROM user WHERE Username = '".$userProfile."';";
    $result = $conn->query($sql);
    $check = $result->fetch_assoc();
    if($result->num_rows == 0)
    {	
		mysqli_free_result($result);
        header("location: index.php");
    }
	mysqli_free_result($result);
	$_SESSION['PrevPage'] = "show_profile.php?user=".$userProfile."&page=".$actualPage;
?>
  <head>

	<link rel="stylesheet" href="css/product.css">
	<link rel="stylesheet" media="all" href="css/profileStyle.css" />
	<link rel="stylesheet" media="all" href="css/paging.css" />
    <?php
		require "head.php";
	?>
      <script src="js/login.js"></script>
	
</head>

<body>

    <!--Navbar-->
    <?php
    require "navbar.php";
    
		echo'<section class="container min-height-login">';
		
		$sql = "SELECT user.*, city.Name as CityName, province.Name as ProvName, Region FROM user, city,province WHERE city.ID = City AND province.ID = Province AND Username = '$userProfile'";
		$result = mySQLi_query($conn, $sql) or die("Error query");

        $sql1 = "SELECT *,book.ID as BookID FROM book, insertion WHERE User_offerer = '$userProfile' AND Material_offered = book.Id ORDER BY book.ID DESC";

		//Query now because we need bookNumber
        $result1 = mySQLi_query($conn, $sql1) or die("Error query1");
        $bookNumber = $result1->num_rows;
		
        while($row = mySQLi_fetch_array($result)) {

            $date = new DateTime($row['Date_of_birth']);
            $date_of_birth = $date->format('d-m-Y');
            echo '
                <div class="row profile-container">
                    <div class="col-md-offset-1 col-md-10 col-lg-offset-2 col-lg-8">
                        <div class="well profile">
                            <div class="col-sm-12">
                            
                            <div class="col-xs-12 col-sm-4 text-center image">
                                    <figure>';
                if ($row['ProfilePic'] != null)
                    echo "<img class='profile-image' src='data:image/jpeg;base64,".base64_encode($row['ProfilePic'])."' alt='profile image'>";
                else
                    echo "<img class='profile-image' src='https://bootdey.com/img/Content/user_1.jpg' alt='profile image'>";

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
                                    <h2 style="margin-bottom: 0px;"><strong>'.$bookNumber.'</strong></h2>
                                    <p><small>Books Published</small></p>';
								if(!isset($_SESSION['username']) || strcmp($_SESSION['username'],$userProfile) != 0)
                                    echo'<p><a href="view_chat.php?user_to='.$userProfile.'" class="btn mybtn btn-success"><span class="fa fa-user"></span> Contact Now! 
                                        </a></p>';
										
							echo'
                            </div>
                        </div>
                    </div>
                </div>';
        }
		mysqli_free_result($result);

	echo '<div class="row">
			<div class="width100 text-center">
				<h1>UPLOADED BY <span>'.strtoupper($userProfile).'</span></h1>
			</div>';
				
				
	$linkPage = "show_profile.php?user=".$userProfile."&";
	$typeClassWidth = "col-md-2";
	$bookPerPage = 6;
	
	if($bookNumber > 0){
		require "paging.php";
	}
	else
		echo'<h4 class="noResults">No books published !</h4>';

	echo '
		</div>
		</section>';
	
	mysqli_free_result($result1);
    ?>

  
	<?php
	require "footer.php";

	?>

</body>
</html>
