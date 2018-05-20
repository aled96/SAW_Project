<!DOCTYPE html>
<html lang="en">

<?php
	session_start();
	$_SESSION['PrevPage'] = "category.php";
?>
  <head>
    <title>Site Name</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link href="https://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">

	<link rel="stylesheet" media="all" href="css/footer.css" />
	<link rel="stylesheet" media="all" href="css/common.css" />
	<link rel="stylesheet" media="all" href="css/home.css" />
      <link rel="stylesheet" media="all" href="css/bootstrap-category.css" />
	<script src="js/common.js"></script>

</head>

  <body>

  <?php
  require "navbar.php";
  ?>

  <div class="backimg-content">
      <div class="row">

            <?php
            $servername = "localhost";
            $username = "root";
            $password = "password";
            $dbname = "university_sharing";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "SELECT * FROM faculty";
            $result = mySQLi_query($conn, $sql) or die("Error query");

            while($row = mySQLi_fetch_array($result)){

                echo
                "<div class='category col-lg-2 col-md-3 col-sm-4 col-ssm-8 col-xs-10'>
                        <a href='search.php?cat=".$row['Name']."'><img src='data:image/jpeg;base64,".base64_encode($row['Image'])."' alt='cover'/></a>
                        
                    </div>
                ";
            }

            ?>
</div>


      </div>
  </div>

  <?php
  require "footer.php";
  ?>
 
</body>
</html>