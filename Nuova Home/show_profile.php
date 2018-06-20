 <!DOCTYPE html>
<html lang="en">
<?php

    require "connectionDB.php";
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
      <script src="js/common.js"></script>
      <?php
      #if(isset($_SESSION['username'])) {
          #echo '<script src="js/message_updates.js"></script>';
      #}

      ?>
	
</head>

<body>

    <!--Navbar-->
    <?php
    require "navbar.php";
    
		$sql = "SELECT user.*, city.Name as CityName, province.Name as ProvName, Region FROM user, city,province WHERE city.ID = City AND province.ID = Province AND Username = '$userProfile'";
		$result = mySQLi_query($conn, $sql) or die("Error query");

        $sql1 = "SELECT *,book.ID as BookID FROM book, insertion WHERE User_offerer = '$userProfile' AND Material_offered = book.Id ORDER BY book.ID DESC";

        $result1 = mySQLi_query($conn, $sql1) or die("Error query1");
        $bookPublished = $result1->num_rows;

        while($row = mySQLi_fetch_array($result)) {

            $date = new DateTime($row['Date_of_birth']);
            $date_of_birth = $date->format('d-m-Y');
            echo '<section class="container min-height-login">
                <div class="row profile-container">
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
                                    <h2 style="margin-bottom: 0px;"><strong>'.$bookPublished.'</strong></h2>
                                    <p><small>Books Published</small></p>';
								if(!isset($_SESSION['username']) || strcmp($_SESSION['username'],$_GET['user']) != 0)
                                    echo'<p><a href="view_chat.php?user_to='.$userProfile.'"><button class="btn mybtn btn-success"><span class="fa fa-user"></span> Contact Now! 
                                        </button></a></p>';
										
							echo'
                            </div>
                        </div>
                    </div>
                </div>';
        }

    if($bookPublished > 0){

        echo '<div class="row">
                    <div class="width100 text-center">
                        <h1>UPLOADED BY <span>'.strtoupper($userProfile).'</span></h1>
                    </div>';

        $bookPerPage = 6;

        $maxPage = ceil(($bookPublished)/$bookPerPage);
        //check, if page number >> max --> show last page
        if($actualPage > $maxPage)
            $actualPage = $maxPage;
        else if($actualPage < 1)
            $actualPage = 1;


        $firstToView = ($actualPage-1)*$bookPerPage;


        if($actualPage-1 < 1)
            $prev="#";
        else
            $prev="show_profile.php?user=".$userProfile."&page=".($actualPage-1);

        if($actualPage+1 > $maxPage)
            $next="#";
        else
            $next="show_profile.php?user=".$userProfile."&page=".($actualPage+1);

        echo"
			<div class='pagination-position col-md-offset-5 col-md-2 col-lg-offset-5 col-lg-1 col-sm-offset-4 col-sm-6 col-xs-6 col-xs-offset-4'>
				  <ul class='pagination'>
					<li class='page-item'><a class='page-link' href='".$prev."'>Previous</a></li>
					<li class='page-item'><a class='page-link' href='show_profile.php?user=".$userProfile."&page=1'>1</a></li>";
        //if there are less than 6 pages -> show them
        if($maxPage < 6)
            for ($i = 2; $i <= $maxPage; $i++)
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
						  <li class='page-item'><a class='page-link' href='show_profile.php?user=".$userProfile."&page=".($actualPage-1)."'>".($actualPage-1)."</a></li>
						  <li class='page-item'><a class='page-link' href='show_profile.php?user=".$userProfile."&page=".$actualPage."'>".$actualPage."</a></li>
						  <li class='page-item'><a class='page-link' href='show_profile.php?user=".$userProfile."&page=".($actualPage+1)."'>".($actualPage+1)."</a></li>
						<li class='page-item'><p class='page-link'>...</p></li>";
            //page max
            echo"<li class='page-item'><a class='page-link' href='show_profile.php?user=".$userProfile."&page=".$maxPage."''>".$maxPage."</a></li>";
        }
        echo"<li class='page-item'><a class='page-link' href='".$next."'>Next</a></li>
				  </ul>
			</div><br><br>
			";

        echo '<div class="width100">';


        $cont = -1;
        while($row1 = mySQLi_fetch_array($result1)){

            $cont ++;
            //echo "Cont ".$cont;
            if($cont < $firstToView){
                continue;
            }
            else if($cont >= $firstToView + $bookPerPage)
                break;
            else {
                #Check if logged
                $fav_status = "fa fa-heart-o";
                $link = "login.php";
                if (isset($_SESSION['username'])) {
                    $user = $_SESSION['username'];

                    #Check if user == userProfile

                    if(strcmp($userProfile, $user) == 0){
                        $fav_status = "fa fa-pencil-square-o";
                        $link = "modify_book.php?Id=".$row1['BookID'];
                    }
                    else {
                        #Check if in wishlist
                        $sql2 = "SELECT COUNT(*) as IsThere FROM wishlist WHERE Book='" . $row1['BookID'] . "' and Username='" . $user . "';";

                        $result2 = mySQLi_query($conn, $sql2) or die("Error query");
                        #If is in list -> change calss for star icon
                        while ($row2 = mySQLi_fetch_array($result2)) {
                            if ($row2['IsThere'] == 1)
                                $fav_status = "fa fa-heart";
                        }
                        $link = "preferite";
                    }
                }

                echo "
                                <div class='col-md-2 my-shop-animation'>
                                    <div class='box-prod group-book'>
                                        <div class='box-img-book'>
                                            <img src='data:image/jpeg;base64," . base64_encode($row1['Cover']) . "' alt='cover'/>
                                            <div class='box-btn-shop'>
                                                <div class='bt-img'><a class='btn btn-det-cart' href='pageBook.php?Id=" . $row1['BookID'] . "'><i class='fa fa-list'></i></a></div>";
                if(strcmp($link, "preferite") == 0){
                    echo "
                                                <div class='bt-img'><a class='btn btn-det-cart'><span id='heart-preferite".$row1['BookID']."'><i onClick='preferite(".$row1['BookID'].")' class='" . $fav_status . "'></i></span></a></div>";
                }
                else{
                    echo "
                                                <div class='bt-img'><a class='btn btn-det-cart' href='" . $link . "'><i class='" . $fav_status . "'></i></a></div>";
                }

                echo"
                                            </div>
                                        </div>
                                        <h2 class='title-book'>" . $row1['Title'] . "</h2>
                                        <p class='author-txt'>" . $row1['Author'] . "</p>
                                        <p class='book-price'>" . $row1['Price'] . " €</p>
                                    </div>
                                </div>
                                    ";
            }
        }

        echo '
            </div>
            </div>
            </section>';




    }

    ?>

  
	<?php
	require "footer.php";

	?>

</body>
</html>