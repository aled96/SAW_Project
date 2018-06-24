<!DOCTYPE html>
<html lang="en">

<?php
	require "connectionDB.php";
	
    if(!isset($_SESSION['username']))
    {
        header("location: index.php");
    }
?>

  <head>
    
    <?php
		require "head.php";
	?>
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
                        <p id="errorBox"><br></p>
                    </label>
                </section>
				<div class="panel-body">
					<form action="script/insert_newBook.php" method="POST" id="reused_form" name="add_new" enctype="multipart/form-data">
						<div class="input-group loginMargin">
							<span class="input-group-addon"><i class="fa fa-user"></i></span>
							<input name="author" type="text" required placeholder="Author" id="author" class="form-control" onclick="removeErrorNewBook()" onkeyup="removeErrorNewBook()">
						</div>						
						
						<div class="input-group loginMargin">
							<span class="input-group-addon"><i class="fa fa-address-book"></i></span>
							<input name="title" type="text" required id="title" placeholder="Title" class="form-control" onclick="removeErrorNewBook()" onkeyup="removeErrorNewBook()">
						</div>
					
						<div class="input-group loginMargin">
							<span class="input-group-addon"><i class="fa fa-edit"></i></span>
							<textarea name="description" class="form-control" id="description" placeholder="Description" rows="6" onclick="removeErrorNewBook()" onkeyup="removeErrorNewBook()"></textarea>
						</div>

						<div class="input-group loginMargin">
							<span class="input-group-addon"><i class="fa fa-files-o"></i></span>
							<input name="pages" type="number" required id="pages" placeholder="Number of Pages" class="form-control" onclick="removeErrorNewBook()" onkeyup="removeErrorNewBook()">
						</div>

						<div class="input-group loginMargin">
							<span class="input-group-addon"><i class="fa fa-book"></i></span>
							<input name="edition" type="text" required id="edition" placeholder="Edition" class="form-control" onclick="removeErrorNewBook()" onkeyup="removeErrorNewBook()">
						</div>
						
						<div class="input-group loginMargin">
							<span class="input-group-addon"><i class="fa fa-barcode"></i></span>
							<input name="isbn" type="text" required id="isbn" placeholder="ISBN" class="form-control" onclick="removeErrorNewBook()" onkeyup="removeErrorNewBook()">
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
							<input name="price" type="number" required id="price" placeholder="Price" class="form-control" onclick="removeErrorNewBook()" onkeyup="removeErrorNewBook()"/>
						</div>
						
						<div class="input-group loginMargin">
							<span class="input-group-addon"><i class="fa fa-map"></i></span>
							<input name="place" type="text" required id="place" placeholder="Place" class="form-control" onclick="removeErrorNewBook()" onkeyup="removeErrorNewBook()"/>
						</div>
						
						<div class="form-group loginMargin">
							<input type="button" class="btn btn-success login-btn" onclick="submitNewBook()" value="Submit">
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