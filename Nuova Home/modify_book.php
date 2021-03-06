<!DOCTYPE html>
<html lang="en">

<?php
require "connectionDB.php";
	
if(!isset($_SESSION['username']))
{
    header("location: index.php");
}

$id = 0;
if(isset($_GET['Id']))
    $id = $conn->real_escape_string($_GET['Id']);
else
    header("location: index.php");

$sql = "SELECT User_offerer FROM insertion WHERE Material_offered = '".$id."';";
$result = $conn->query($sql);
$check = $result->fetch_assoc();
if($result->num_rows == 0)
{
    header("location: index.php");
}
else if(strcmp($check['User_offerer'], $_SESSION['username']) != 0){
    header("location: index.php");
}

mysqli_free_result($result);
?>

<head>

	<link rel="stylesheet" href="css/form.css">
	
    <?php
		require "head.php";
	?>
	
    <script src="js/insert.js"></script>

    <script>
        document.addEventListener("keyup", function(event) {
            event.preventDefault();
            if (event.keyCode === 13) {
                submitModifyBook();
            }
        });	
		
    </script>
</head>

<body>

<?php
	echo'
	<div id="deleteConfirm" class="deleteConfirm" style="visibility:hidden;">
		<div class="loginForm marginTop-200">
			<div class="panel panel-info">
				<form action="script/delete_publication.php" method="POST" class="loginMargin" style="z-index:11;">
					<div class="confirmDiv">
					<input type="hidden" name="id" value="'.$id.'"/>
					<h4>Are you sure you want to delete the book?</h4>
					<button type="submit" class="btn btn-success">Yes</button>	
					<button type="button" onclick="deleteBook(false);" class="btn btn-success">No</button>
					</div>
			   </form>
			</div>
		</div>
	</div>';
?>

<?php
require "navbar.php";
?>


<?php

$sql = "SELECT insertion.User_offerer, book.*,Price, Place FROM book,insertion WHERE book.ID = Material_offered AND book.ID = '".$id."';";
$result = $conn->query($sql);


while($book = $result->fetch_assoc()) {
    echo'
                  <section class="container">
                      <div class="loginForm">
                          <div class="panel panel-info">
                              <div class="panel-heading">
                                  <div class="panel-title">Modify Book</div>
                              </div>
                              <section>
                                  <label class="errorLogin" >
                                      <span id="errorBox"><br></span>
                                  </label>
                              </section>
                              <div class="panel-body">
                                <form action="script/commit_modify_book.php" method="POST" id="reused_form" name="modify_book" enctype="multipart/form-data">
								
                                      <div class="form-group loginMargin">
										<button type="button" onclick="deleteBook(true);" class="btn btn-success cat-btn">Delete Book</button>
										</div>
                                      <div class="input-group loginMargin">
                                          <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                          <input name="id" type="hidden" value="'.$id.'" id="id" />
                                          <input name="author" type="text" required placeholder="Author" id="author" class="form-control" value="'.$book['Author'].'" onclick="removeErrorNewBook()" onkeyup="removeErrorNewBook()">
                                      </div>
                
                                      <div class="input-group loginMargin">
                                          <span class="input-group-addon"><i class="fa fa-address-book"></i></span>
                                          <input name="title" type="text" required id="title" placeholder="Title" value="'.$book['Title'].'" class="form-control" onclick="removeErrorNewBook()" onkeyup="removeErrorNewBook()">
                                      </div>
                
                                      <div class="input-group loginMargin">
                                          <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                                          <textarea name="description" class="form-control" id="description" placeholder="Description" rows="6" onclick="removeErrorNewBook()" onkeyup="removeErrorNewBook()">'.$book['Description'].'</textarea>
                                      </div>
                
                                      <div class="input-group loginMargin">
                                          <span class="input-group-addon"><i class="fa fa-files-o"></i></span>
                                          <input name="pages" type="number" required id="pages" placeholder="Number of Pages" value="'.$book['PageNum'].'" class="form-control" onclick="removeErrorNewBook()" onkeyup="removeErrorNewBook()">
                                      </div>
                
                                      <div class="input-group loginMargin">
                                          <span class="input-group-addon"><i class="fa fa-book"></i></span>
                                          <input name="edition" type="text" required id="edition" value="'.$book['Edition'].'" placeholder="Edition" class="form-control" onclick="removeErrorNewBook()" onkeyup="removeErrorNewBook()">
                                      </div>
                
                                      <div class="input-group loginMargin">
                                          <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                          <input name="isbn" type="text" required id="isbn" placeholder="ISBN" value="'.$book['ISBN'].'" class="form-control" onclick="removeErrorNewBook()" onkeyup="removeErrorNewBook()">
                                      </div>
                
                                      <div class="input-group loginMargin">
                                          <h4>Cover</h4>
                                          <div class="col-md-10 col-sm-12 col-xs-10 col-lg-10 show-img-modify">
											<img id="imageShow" src="data:image/jpeg;base64,'.base64_encode($book['Cover']).'" alt="cover"/>
										  </div>
                                          <input type="file" accept="image/*" id="image" onchange="loadFile(event)" name="image" required>
                                      </div>
                
                                      <h4 class="loginMargin">Categories</h4>';


            $sql1 = "SELECT category.Name as Category, faculty.Name as Faculty FROM concern, category, faculty WHERE concern.Category = category.ID AND category.Faculty = faculty.ID AND concern.Book = '".$id."';";
            $result1 = $conn->query($sql1);

            while($row1 = $result1->fetch_assoc()) {
                echo'
                <div class="input-group loginMargin">
                    <input type="text" name="fac1" id="fac1" class="form-control" readonly value="'.$row1['Faculty'].'"/>
                    </div>
                    <div class="input-group loginMargin">
                    <input type="text" name="cat1" id="cat1" class="form-control" readonly value="'.$row1['Category'].'"/>
                    </div>';
            }
			mysqli_free_result($result1);
										
            echo '
                                      <div class="input-group loginMargin" id="categories">
                                        <input name="number_of_categories" type="hidden" value="0" id="number_of_categories">
                                        
                                      </div>
                
                                      <div class="form-group loginMargin">
                                          <button type="button" class="btn btn-success login-btn" onclick="addNewCategory()">Add New Category</button>
                                          <br><br>
                                      </div>
                
                                      <h4 class="loginMargin">Selling Information</h4>
                                      <div class="input-group loginMargin">
                                          <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                          <input name="price" type="number" required id="price" value="'.$book['Price'].'" placeholder="Price" class="form-control" onclick="removeErrorNewBook()" onkeyup="removeErrorNewBook()"/>
                                      </div>
                
                                      <div class="input-group loginMargin">
                                          <span class="input-group-addon"><i class="fa fa-map"></i></span>
                                          <input name="place" type="text" required id="place" placeholder="Place" value="'.$book['Place'].'" class="form-control" onclick="removeErrorNewBook()" onkeyup="removeErrorNewBook()"/>
                                      </div>
                
                                      <div class="form-group loginMargin">
                                          <input type="button" class="btn btn-success login-btn" onclick="submitModifyBook()" value="Submit">
                                      </div>
                                 </form>
                              </div>
                          </div>
                      </div>
                  </section>';
}

mysqli_free_result($result);
										
?>



<?php
require "footer.php";

?>

</body>
</html>
