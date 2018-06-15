<!DOCTYPE html>
<html lang="en">
<?php
	session_start();
	if(isset($_GET['Id']))
		$id = $_GET['Id'];
	else
		$id = 0;

	$_SESSION['PrevPage']="pageBook.php?Id=".$id;
?>
<head>
    <title>BookTrader</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/NewHomeTest.css">

    <link href="http://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900|Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic|Open+Sans:300italic,400italic,600italic,700italic,400,700,600,300|Poppins:400,500,700,300,600" rel="stylesheet" type="text/css">

    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

</head>
<body>
	<?php
		require "navbar.php";

	 ?>

    <section class="container page-details-product">
        <div class="row">
			<div class="panel">
				<?php
				
					require "db/mysql_credentials.php";

					// Create connection
					$conn = new mysqli($servername, $username, $password, $dbname);

					
					$sql = "SELECT *, book.description as BookDesc FROM book, insertion WHERE insertion.Material_offered = book.ID and book.ID='".$id."'";
					
					$result = mySQLi_query($conn, $sql) or die("Error query".$sql);

					while ($row = mySQLi_fetch_array($result)) {
					
					echo'<div class="product-page">
							<div class="list-product">
								<div class="col-md-3 my-shop-animation">
									<div class="box-prod">
										<div class="image-product">
											<img src="data:image/jpeg;base64,'.base64_encode($row['Cover']).'" alt="cover" />

										</div>
									</div>

								</div>
								
								<div class="col-md-9 box-desc-detail">
									<h2 class="title-product">'.$row['Title'].'</h2>

									<p class="author-txt"><span>Author: </span>'.$row['Author'].'</p>
									<br>
									<p class="author-txt"><span>Sold by: </span>'.$row['User_offerer'].'</p>
										
									<br>
									<p class="book-price">'.$row['Price'].' €</p>
									<br>
									<div class="box-btn-shop">
										<div class="bt-img"><button type="button" class="btn btn-success"><i class="fa fa-envelope"></i>  Contact '.$row['User_offerer'].'</button></div>
									</div>
								</div>
								<div class="col-md-12 detail-box-desc">
									<div class="col-md-3"><h1 class="txt-info">Info</h1></div>
									<div class="col-md-9 info-box">

										<p class="cat-txt"><span>Description: </span>'.$row['Description'].'</p>
										<br><br>
										<p class="cat-txt"><span>Isbn: </span>'.$row['ISBN'].'</p>
										<p class="cat-txt"><span>Pages: </span>'.$row['PageNum'].'</p>
										<p class="cat-txt"><span>Date of pubblication: </span>'.$row['Date_of_pubblication'].'</p>
										<p class="cat-txt"><span>Edition: </span>'.$row['Edition'].'</p>
										<p class="cat-txt"><span>Category: </span>Art</p>
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