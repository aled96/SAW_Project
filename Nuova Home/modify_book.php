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
					<div class="panel-title">Modify Book</div>
				</div>
                <section>
                    <label class="errorLogin" >
                        <p id="errorSignupBox"><br></p>
                    </label>
                </section>
				<div class="panel-body">
				
				<?php
					require "db/mysql_credentials.php";

					// Create connection
					$conn = new mysqli($servername, $username, $password, $dbname);

					// Check connection
					if ($conn->connect_error) {
						die("Connection failed: " . $conn->connect_error);
					}

					$id = 0;
					if(isset($_GET['Id']))
						$id = $_GET['Id'];
					else
						echo"THERE IS AN ERROR";
						
					$sql = "SELECT book.*,Price, Place FROM book,insertion WHERE book.ID = Material_offered AND book.ID = '".$id."';";
					$result = $conn->query($sql);

					while($row = $result->fetch_assoc()) {
						echo'
						<form action="script/commit_modify_book.php" method="POST" id="reused_form" enctype="multipart/form-data">
						
						<h4 class="loginMargin">Book Information</h4>
							<div class="input-group loginMargin">
								<span class="input-group-addon"><input name="id" type="hidden" value="'.$id.'" id="id" /><i class="fa fa-user"></i></span>
								<input name="author" type="text" required placeholder="Author" id="author" value="'.$row['Author'].'" class="form-control">	</div>						
								
								<div class="input-group loginMargin">
									<span class="input-group-addon"><i class="fa fa-address-book"></i></span>
									<input name="title" type="text" required id="title" value="'.$row['Title'].'" placeholder="Title" class="form-control">
								</div>
							
								<div class="input-group loginMargin">
									<span class="input-group-addon"><i class="fa fa-edit"></i></span>
									<textarea name="description" class="form-control" id="description" placeholder="Description" rows="6">'.$row['Description'].'</textarea>
								</div>

								<div class="input-group loginMargin">
									<span class="input-group-addon"><i class="fa fa-files-o"></i></span>
									<input name="pages" type="number" required id="pages" value="'.$row['PageNum'].'" placeholder="Number of Pages" class="form-control">
								</div>

								<div class="input-group loginMargin">
									<span class="input-group-addon"><i class="fa fa-book"></i></span>
									<input name="edition" type="text" required id="edition" value="'.$row['Edition'].'" placeholder="Edition" class="form-control">
								</div>
								
								<div class="input-group loginMargin">
									<span class="input-group-addon"><i class="fa fa-barcode"></i></span>
									<input name="isbn" type="text" required id="isbn" value="'.$row['ISBN'].'" placeholder="ISBN" class="form-control">
								</div>
									
								<div class="input-group loginMargin">
									<h4>Cover</h4><img src="data:image/jpeg;base64,'.base64_encode($row['Cover']).'" alt="cover"/>
									<input type="file" accept="image/*" id="image" name="image">
								</div>
								<h4 class="loginMargin">Categories</h4>
								';
								
								
								$sql1 = "SELECT Category.Name as Category, Faculty.Name as Faculty FROM concern, category, faculty WHERE concern.Category = category.ID AND category.Faculty = Faculty.ID AND concern.Book = '".$id."';";
								$result1 = $conn->query($sql1);

								while($row1 = $result1->fetch_assoc()) {
									echo'
									<div class="input-group loginMargin">
										<input type="text" name="fac0" id="fac0" class="form-control" readonly value="'.$row1['Faculty'].'"/>
									</div>
									<div class="input-group loginMargin">
										<input type="text" name="cat0" id="cat0" class="form-control" readonly value="'.$row1['Category'].'"/>
									</div>';
								}
								
							echo'<br>
							<div class="input-group loginMargin" id="categories">
								<input name="number_of_categories" type="hidden" value="1" id="number_of_categories">
								<select name="fac1" id="fac1" class="form-control" onchange="selectCategory(1)">
								<option value="not-selected" selected disabled>Faculty</option>
								';
								
								$sql2 = "SELECT distinct Name FROM faculty";
								$result2 = $conn->query($sql2);

								while($row2 = $result2->fetch_assoc()) {
									$fac2 = $row2['Name'];
									if(strlen($fac2) != 0) {
										echo "<option value='" .$fac2 ."'>".$fac2."</option>";
									}
								}
							echo'
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
									<input name="price" type="number" required id="price" value="'.$row['Price'].'" placeholder="Price" class="form-control"/>
								</div>
								
								<div class="input-group loginMargin">
									<span class="input-group-addon"><i class="fa fa-map"></i></span>
									<input name="place" type="text" required id="place" value="'.$row['Place'].'" placeholder="Place" class="form-control"/>
								</div>
								
								<div class="form-group loginMargin">
									<input type="submit"class="btn btn-success login-btn" value="Submit">
								</div>
							</form>
							
							
							<form action"script/delete_publication.php" method="GET" class="loginMargin	">
								<input type="hidden" id="Id" name="Id" value="'.$id.'"/>
								<button type="submit" class="btn btn-success cat-btn">Delete Book</button>	
							</form>';
						}
					?>
				</div>
			</div>
		</div>
    </section>

<?php
require "footer.php";

?>

</body>
</html>