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
		
		if($bookNumber > 0){
			require "paging.php";
		}
		else
			echo'<h4 class="noResults">Your wishlist is empty !</h4>';
    ?>
	</div>
	</div>
</section>
	<?php
	require "footer.php";

	?>

</body>
</html>