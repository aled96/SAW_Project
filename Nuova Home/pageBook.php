<!DOCTYPE html>
<html lang="en">
<?php
	require "connectionDB.php";
	
	if(isset($_GET['Id']))
		$id = $_GET['Id'];
	else
        header("location: index.php");

	$_SESSION['PrevPage']="pageBook.php?Id=".$id;


    $sql = "SELECT book.Author FROM book WHERE ID = '".$id."';";
    $result = $conn->query($sql);
    $check = $result->fetch_assoc();
    if($result->num_rows == 0)
    {
        header("location: index.php");
    }
?>
<head>   
    <?php
		require "head.php";
	?>
</head>
<body>
	<?php
		require "navbar.php";

	 ?>

    <section class="container page-details-product">
        <div class="row">
			<div class="panel">
				<?php
				
					$sql = "SELECT *, book.description as BookDesc FROM book, insertion WHERE insertion.Material_offered = book.ID and book.ID='".$id."'";
					
					$result = mySQLi_query($conn, $sql) or die("Error query".$sql);

					while ($row = mySQLi_fetch_array($result)) {
					
					echo'<div class="product-page">
							<div class="list-product">
								<div class="col-md-3 col-sm-3 col-xs-3 my-shop-animation info-book-div heightAuto">
									<div class="box-prod">
										<div class="image-product">
											<img src="data:image/jpeg;base64,'.base64_encode($row['Cover']).'" alt="cover" />

										</div>
									</div>

								</div>
								
								<div class="col-md-9  col-sm-9 col-xs-9 box-desc-detail info-book-div">
									<h2 class="title-product">'.$row['Title'].'</h2>

									<p class="author-txt"><span>Author: </span>'.$row['Author'].'</p>
									<br>
									<p class="author-txt"><span>Sold by: </span><a href="show_profile.php?user='.$row['User_offerer'].'">'.$row['User_offerer'].'</a></p>
										
									<br>
									<p class="book-price">'.$row['Price'].' €</p>
									<br>
									<div class="box-btn-shop">';
									
									if(isset($_SESSION['username']) and strcmp($_SESSION['username'],$row['User_offerer']) == 0){
										echo'<a href="modify_book.php?Id='.$id.'" class="btn btn-book btn-success colorRed"><i class="fa fa-edit"></i>  Edit</a>';
									}
									else{
										echo'<div class="bt-img"><a href="view_chat.php?user_to='.$row['User_offerer'].'" class="btn btn-book btn-success"><i class="fa fa-envelope"></i>  Contact '.$row['User_offerer'].'</a> ';
										
										if(!isset($_SESSION['username'])){
											echo'<a href="login.php" class="btn btn-book btn-success colorRed"><i class="fa fa-heart-o"></i>  Add Favourite</a>';
										}
										else{
											$sqlFav = "SELECT * FROM wishlist WHERE Username = '".$_SESSION['username']."' and Book = '".$id."';";
											$result2 = mySQLi_query($conn, $sqlFav) or die("Error query");
											if($result2->num_rows > 0)
												echo'<button type="button" onClick="preferite2('.$id.')" class="btn btn-book btn-success colorRed"><i class="fa fa-heart"></i>  Remove Favourite</button>';
											else
												echo'<button type="button" onClick="preferite2('.$id.')" class="btn btn-book btn-success colorRed"><i class="fa fa-heart-o"></i>  Add Favourite</button>';
										}
									}
								echo'</div>
									</div>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-12 detail-box-desc">
									<div class="col-md-3 col-sm-3 col-xs-3 info-big"><h1 class="txt-info">Info</h1></div>
									<div class="col-md-9 col-sm-9 col-xs-9 info-box">

										<p class="cat-txt"><span>Description: </span>'.$row['Description'].'</p>
										<br><br>
										<p class="cat-txt"><span>Isbn: </span>'.$row['ISBN'].'</p>
										<p class="cat-txt"><span>Pages: </span>'.$row['PageNum'].'</p>
										<p class="cat-txt"><span>Date of pubblication: </span>'.$row['Date_of_pubblication'].'</p>
										<p class="cat-txt"><span>Edition: </span>'.$row['Edition'].'</p>
										<p class="cat-txt"><span>Categories: </span></p>';

                                $sql = "SELECT category.ID as Cat_ID, category.Name as Cat, faculty.ID as Fac_ID, faculty.Name as Fac FROM concern, category, faculty WHERE concern.Book='".$id."' and concern.Category = category.ID and category.Faculty = faculty.ID";

                                $result = mySQLi_query($conn, $sql) or die("Error query".$sql);

                                while ($row = mySQLi_fetch_array($result)) {

                                    echo '<a class="cat-txt cat-p" href="category.php?fac='.$row['Fac_ID'].'&page=1"><span >'.$row['Fac'].'</span ></a> ><a href="category.php?catSearched='.$row['Cat_ID'].'&page=1"> '.$row['Cat'].'</a ><br>';
                                }

                        echo'
									</div>
								</div>
							</div>
						</div>';
					}
				?>
				
			</div>
        </div>
    </section>
	
	
	<?php
		require "footer.php";

	 ?>
	
</body>