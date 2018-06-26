 <!DOCTYPE html>
<html lang="en">
<?php

    require "connectionDB.php";
	
	
	if(!isset($_SESSION['username'])) {
		header("location: index.php");
	}
	
	$user = $_SESSION['username'];
	
	if(isset($_GET['page']))
		$actualPage = $_GET['page'];
	else
		$actualPage = 1;
		
	$_SESSION['PrevPage'] = "favourite.php?page=".$actualPage;
?>
  <head>
     
    <?php
		require "head.php";
	?>
	  <link rel="stylesheet" media="all" href="css/profileStyle.css" />
	  <link rel="stylesheet" media="all" href="css/paging.css" />
      <script src="js/login.js"></script>
	
</head>

<body>

    <!--Navbar-->
<?php
require "navbar.php";
?>

<section class="container min-height-login">
    <div class="row profile-container">
        <div>
            <h1 class="txt-info centerText">Wishlist</h1>
        </div>

        <div class="row">
        <?php

            $sql1 = "SELECT *,book.ID as BookID, User_offerer FROM book, wishlist,insertion WHERE Username = '".$user."' AND book.ID = wishlist.Book AND book.ID = insertion.Material_offered ORDER BY book.ID DESC";

            $result1 = mySQLi_query($conn, $sql1) or die("Error query1");
            $bookNumber = $result1->num_rows;

            $linkPage = "favourite.php?";
            $typeClassWidth = "col-md-2";
            $bookPerPage = 12;

            if($bookNumber > 0){
                require "paging.php";
            }
            else
                echo'<h4 class="noResults">Your wishlist is empty !</h4>';

			mysqli_free_result($result1);
        ?>
        </div>
	</div>
</section>
	<?php
	require "footer.php";

	?>

</body>
</html>