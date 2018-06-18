<!DOCTYPE html>
<html lang="en">
<?php
	session_start();
	$_SESSION['PrevPage'] = "index.php";
?>
<head>
    <title>BookTrader</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/NewHomeTest.css">

    <link href="http://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900|Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic|Open+Sans:300italic,400italic,600italic,700italic,400,700,600,300|Poppins:400,500,700,300,600" rel="stylesheet" type="text/css">

    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  
  <script src="js/search.js"></script>

</head>
<body>

	<!--Navbar-->
	<?php
	require "navbar.php";
	?>
	
    <section class="container">
        <div class="row">
            <div class="col-md-12 table-padding">
                <div class="col-md-3 column-box">
                    
					<form action="category.php" id="formCat" method="GET">
						<!--FILTER CATEGORIES-->
						<div class="filter-table">
					
							<h3>Categories</h3>
							<div class="list-category-column">
								<ul>
								<?php		

									$catSelected = "";
									$search = "";
									$priceMin = "";
									$priceMax = "";
									
									if(isset($_GET['catSearched']) and $_GET['catSearched'] != "")
										$catSelected = $_GET['catSearched'];
									if(isset($_GET['search']) and $_GET['search'] != "")
										$search = $_GET['search'];
									if(isset($_GET['priceMin']) and $_GET['priceMin'] != "")
										$priceMin = $_GET['priceMin'];
									if(isset($_GET['priceMax']) and $_GET['priceMax'] != "")
										$priceMax = $_GET['priceMax'];
										
										
									if($catSelected != "" or $search != null or $priceMin != null or $priceMax != null)
										echo'
										<div class="col-md-12" id="resetFilterButton"><button type="button" onclick="resetFilters();" class="btn default"><i class="fa fa-times"></i> <span>Remove all filters</span></button><br><br></div>
										';
										
									require "db/mysql_credentials.php";

									// Create connection
									$conn = new mysqli($servername, $username, $password, $dbname);

									// Check connection
									if ($conn->connect_error) {
										die("Connection failed: " . $conn->connect_error);
									}
										
									$sql = "SELECT COUNT(DISTINCT ID) as AllBooks FROM book;";
									$result = $conn->query($sql);

									while($row = $result->fetch_assoc()) {
										echo'
										<li class="filter active"><h4 class="facultyList">All ('.$row['AllBooks'].')</h4>
											<div class="line-separator"></div>
										</li>';
									}
										
									//TODO !!! POCO ROBUSTO PERCHE' ASSUMO CHE SIANO PRESENTI TUTTI I VALORI NEL DB, DA 1 A MAX !!
									//SE ALCUNI VENGONO ELIMINATI, IMPAZZISCE
									
									$sql = "SELECT faculty.Name as FacultyName, COUNT(book.ID) as NumCat, T.Name, T.ID 
											FROM (SELECT category.Faculty, concern.book, category.ID, category.Name 
														FROM `category` LEFT OUTER JOIN concern ON concern.Category = category.ID) as T LEFT OUTER JOIN book ON T.book = book.ID, faculty 
											WHERE faculty.ID = T.Faculty GROUP BY (T.ID) ORDER BY T.Faculty";
									$result = $conn->query($sql);

									$prevFac = "";
									$cont = $result->num_rows;
									
									echo'<input type="hidden" value="'.$cont.'" id="maxCat"/>';
									
									echo'<input type="hidden" value="'.$catSelected.'" id="catSearched" name="catSearched"/>';
									
									
									$categories = explode(" ",$catSelected);
									
									while($row = $result->fetch_assoc()) {	
										if(strcmp($prevFac,$row['FacultyName']) != 0)
										{
											$prevFac =$row['FacultyName'];
											echo'
											<li class="filter"><h4 class="facultyList">'.$prevFac.'</h4>
												<div class="line-separator"></div>
											</li>';
										}
										
										$checked = "";
										if(in_array($row['ID'],$categories))
											$checked=" checked";
										
										echo'
											<li class="filter"><input type="checkbox" id="cat'.$row['ID'].'" class="checkboxCategory" '.$checked.'/>'.$row['Name'].' ('.$row['NumCat'].')
												<div class="line-separator"></div>
											</li>';
									}
									?>
								</ul>
							</div>
						</div>
						
						<?php
						echo'
						<div class="sw-search">
							<div class="nav-search">
								<span class="input-icon">
									<input placeholder="Filter list ..." class="nav-search-input" value="'.$search.'" id="search" name="search">
									<i class="search-icon fa fa-search nav-search-icon"></i>
								</span>
							</div>
						</div>
						<!--RANGE PRICES-->
						<div class="lateral-filter">
							<article class="price-range filter-table">
								<h3>Price Range</h3>
								<div class="content-filter-price">
									<div class="col-md-4 inp-price data-price">
										<input type="text" id="priceMin" name="priceMin" placeholder="Min" value="'.$priceMin.'" onclick="removePriceError();">
									</div>
									<div class="col-md-4 inp-price data-price">
										<input type="text" id="priceMax" name="priceMax" placeholder="Max" value="'.$priceMax.'" onclick="removePriceError();">
									</div>
									<div class="col-md-4 search-btn"><button onclick="searchFilter();" type="button" class="btn default"><span>Search</span></button></div>
								</div>
							</article>
						</div>';
						?>
					</form>
                </div>

                <div class="col-md-9 panel">
                    <div class="books-table">
							<h3>Books</h3>
                    </div>

                    <div id="dataMix">
                        <?php
						
						$sql = "SELECT *, book.ID as BookID FROM book,insertion WHERE book.ID = Material_offered LIMIT 8";
						
						if(isset($_GET['cat']) and $_GET['cat'] != ""){
							
						}
												
						$result = $conn->query($sql);

						while($row = $result->fetch_assoc()) {
						
							#Check if logged
							$fav_status="fa fa-heart-o";
							$link = "login.php";
							if(isset($_SESSION['username'])){
								$user = $_SESSION['username'];
								#Check if in wishlist
								$sql2 = "SELECT COUNT(*) as IsThere FROM wishlist WHERE Book='".$row['BookID']."' and Username='".$user."';";

								$result2 = mySQLi_query($conn, $sql2) or die("Error query");
								#If is in list -> change calss for star icon
								while($row2 = mySQLi_fetch_array($result2)){
									if($row2['IsThere'] == 1)
										$fav_status="fa fa-heart";
								}
								$link="script/add_favourite.php?Book=".$row['BookID'];
							}
							echo'
							<div class="col-md-3 my-shop-animation mix">
								<div class="box-prod group-book">
									<div class="box-img-book">
										<img src="data:image/jpeg;base64,'.base64_encode($row['Cover']).'" alt="cover"/>

										<div class="box-btn-shop">
											<div class="bt-img"><a class="btn btn-det-cart" href="pageBook.php?Id='.$row['BookID'].'"><i class="fa fa-list"></i></a></div>
											<div class="bt-img"><a class="btn btn-det-cart" href="'.$link.'"><i class="'.$fav_status.'"></i></a></div>
										</div>
									</div>
									<h2 class="title-book">'.$row['Title'].'</h2>
									<p class="author-txt">'.$row['Author'].'</p>

									<p class="category-txt">Art</p>

									<p class="book-price"> '.$row['Price'].' €</p>
								</div>
							</div>';
							
							//TODO -> Paging 
						}
							
						?>                    
                </div>
				</div>
			</div>
		</div>
    </section>
	
	
	<!--Navbar-->
	<?php
	require "footer.php";
	?>
	
</body>
</html>