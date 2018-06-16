<!DOCTYPE html>
<html lang="en">

<?php
    session_start();
    if(!isset($_SESSION['username']))
    {
        header("location: index.php");
    }
?>

  <head>
    
	
    <title>BookTrader</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/NewHomeTest.css">

    <link href="http://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900|Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic|Open+Sans:300italic,400italic,600italic,700italic,400,700,600,300|Poppins:400,500,700,300,600" rel="stylesheet" type="text/css">

    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	
	
    <script src="js/common.js"></script>
    <script src="js/insert.js"></script>

</head>

  <body>

  <?php
    require "navbar.php";

  ?>
  
	<section class="container">
		<div class="loginForm">
			<div class="panel panel-info">
				<div class="panel-heading">
					<div class="panel-title">Insert Book</div>
				</div>
                <section>
                    <label class="errorLogin" >
                        <p id="errorSignupBox"><br></p>
                    </label>
                </section>
				<div class="panel-body">
					<form form action="script/insert_newBook.php" method="POST" id="reused_form" enctype="multipart/form-data">
						<div class="input-group loginMargin">
							<span class="input-group-addon"><i class="fa fa-user"></i></span>
							<input name="author" type="text" required placeholder="Author" id="author" class="form-control">
						</div>						
						
						<div class="input-group loginMargin">
							<span class="input-group-addon"><i class="fa fa-address-book"></i></span>
							<input name="title" type="text" required id="title" placeholder="Title" class="form-control">
						</div>
					
						<div class="input-group loginMargin">
							<span class="input-group-addon"><i class="fa fa-edit"></i></span>
							<textarea name="description" class="form-control" id="description" placeholder="Description" rows="6"></textarea>
						</div>

						<div class="input-group loginMargin">
							<span class="input-group-addon"><i class="fa fa-files-o"></i></span>
							<input name="pages" type="number" required id="pages" placeholder="Number of Pages" class="form-control">
							<input type="hidden" id="pswEncryptSign" name="pswEncryptSign">
						</div>

						<div class="input-group loginMargin">
							<span class="input-group-addon"><i class="fa fa-book"></i></span>
							<input name="edition" type="text" required id="edition" placeholder="Edition" class="form-control">
						</div>
						
						<div class="input-group loginMargin">
							<span class="input-group-addon"><i class="fa fa-barcode"></i></span>
							<input name="isbn" type="text" required id="isbn" placeholder="ISBN" class="form-control">
						</div>
							
						<div class="input-group loginMargin">
							<h4>Cover</h4>
							<input type="file" accept="image/*" id="image" name="image" required>
						</div>
						
						<h4 class="loginMargin">Categories</h4>
						<div class="input-group loginMargin" id="categories">
							<input name="number_of_categories" type="hidden" value="1" id="number_of_categories">
							<select name="fac1" id="fac1" class="form-control" required onchange="selectCategory(1)">
								<option value="not-selected" selected disabled>Faculty</option>
								<?php

								require "db/mysql_credentials.php";

								// Create connection
								$conn = new mysqli($servername, $username, $password, $dbname);

								// Check connection
								if ($conn->connect_error) {
									die("Connection failed: " . $conn->connect_error);
								}

								$sql = "SELECT distinct Name FROM faculty";
								$result = $conn->query($sql);

								while($row = $result->fetch_assoc()) {
									$fac = $row['Name'];
									if(strlen($fac) != 0) {
										echo "<option value='" . $fac . "'>" . $fac . "</option>";
									}
								}

								$conn->close();

								?>
							</select>
							<br><br>
							<select name="cat1" class="form-control" required  id="cat1" >
								<option value="not-selected" selected disabled>Category</option>
							</select>
						</div>
							
						<div class="form-group loginMargin">
							<button type="button" class="btn btn-success login-btn" onclick="addNewCategory()">Add New Category</button>
							<br><br>
						</div>
						
						<h4 class="loginMargin">Selling Information</h4>
						<div class="input-group loginMargin">
							<span class="input-group-addon"><i class="fa fa-tag"></i></span>
							<input name="price" type="number" required id="price" placeholder="Price" class="form-control"/>
						</div>
						
						<div class="input-group loginMargin">
							<span class="input-group-addon"><i class="fa fa-map"></i></span>
							<input name="place" type="text" required id="place" placeholder="Place" class="form-control"/>
						</div>
						
						<div class="form-group loginMargin">
							<input type="submit"class="btn btn-success login-btn" value="Submit">
						</div>
					</form>
				</div>
			</div>
		</div>
    </section>

<?php
require "footer.php";

?>

</body>
</html>