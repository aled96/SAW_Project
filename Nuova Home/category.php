<!DOCTYPE html>
<html lang="en">
<?php

	require "connectionDB.php";
	
	if(isset($_GET['page']))
		$actualPage = $_GET['page'];
	else
		$actualPage = 1;
?>
<head>
    
    <?php
		require "head.php";
	?>
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
					
				<div class="filter-small">
					<h3>Categories<button type="button" onclick="filter_button()" class="filter-button" id="filter-button-minus"><i class="fa fa-angle-up"></i></button></h3>
				</div>
                <div id="filter-container" style="visibility: visible;" class="col-md-3 column-box">
                    
					<form action="category.php" name="searchform" id="formCat" method="GET">
						<!--FILTER CATEGORIES-->
						<div class="filter-table">
							<div class="filter-big" id="filter-container-none">
								<h3>Categories</h3>
							</div>
							<div class="list-category-column">
								<ul>
								<?php		
								
									$fac = "";
									$catSelected = "";
									$search = "";
									$priceMin = "";
									$priceMax = "";
																										
									//fac used only for search by nav(pressing on a faculty)
									if(isset($_GET['fac']) and $_GET['fac'] != "")
										$fac = $_GET['fac'];
									if(isset($_GET['catSearched']) and $_GET['catSearched'] != "")
										$catSelected = $_GET['catSearched'];
									if(isset($_GET['search']) and $_GET['search'] != "")
										$search = $_GET['search'];
									if(isset($_GET['priceMin']) and $_GET['priceMin'] != "")
										$priceMin = $_GET['priceMin'];
									if(isset($_GET['priceMax']) and $_GET['priceMax'] != "")
										$priceMax = $_GET['priceMax'];
										
									$_SESSION['PrevPage'] = $linkPage = "category.php?fac=".$fac."&catSearched=".$catSelected."&search=".$search."&priceMin=".$priceMin."&priceMax=".$priceMax."&page=".$actualPage;
									
									if($catSelected != "" or $search != null or $priceMin != null or $priceMax != null)
										echo'
										<div class="col-md-12" id="resetFilterButton"><button type="button" onclick="resetFilters();" class="btn default"><i class="fa fa-times"></i> <span>Remove all filters</span></button><br><br></div>
										';
									
									$sql = "SELECT COUNT(DISTINCT ID) as AllBooks FROM book;";
									$result = $conn->query($sql);

									while($row = $result->fetch_assoc()) {
										echo'
										<li class="filter active facultyList">All ('.$row['AllBooks'].')
											<div class="line-separator"></div>
										</li>';
									}
										
									mysqli_free_result($result);
									//TODO !!! POCO ROBUSTO PERCHE' ASSUMO CHE SIANO PRESENTI TUTTI I VALORI NEL DB, DA 1 A MAX !!
									//SE ALCUNI VENGONO ELIMINATI, IMPAZZISCE
									
									$sql1 = "SELECT faculty.Name as FacultyName, COUNT(book.ID) as NumCat, T.Name, T.ID 
											FROM (SELECT category.Faculty, concern.book, category.ID, category.Name 
														FROM `category` LEFT OUTER JOIN concern ON concern.Category = category.ID) as T LEFT OUTER JOIN book ON T.book = book.ID, faculty 
											WHERE faculty.ID = T.Faculty GROUP BY (T.ID) ORDER BY T.Faculty";
									$result1 = $conn->query($sql1);

									$prevFac = "";
									$cont = $result1->num_rows;
									
									echo'<input type="hidden" value="'.$cont.'" id="maxCat"/>';
									
									echo'<input type="hidden" value="'.$catSelected.'" id="catSearched" name="catSearched"/>';
									
									
									$categories = explode(" ",$catSelected);
									
									$catAsChild = "";
									while($row1 = $result1->fetch_assoc()) {	
										if(strcmp($prevFac,$row1['FacultyName']) != 0)
										{
											if($prevFac != ""){
												echo'<input type="hidden" id="'.$prevFac.'" value="'.$catAsChild.'"/>';
											}
											$prevFac =$row1['FacultyName'];
											echo'
											<li class="filter"><button type="button" class="noneButton facultyList" onclick="pressFaculty('.$prevFac.')">'.$prevFac.'</button>
												<div class="line-separator"></div>
											</li>';
											$catAsChild = "";
										}
										$catAsChild = $catAsChild.$row1['ID']." ";
										$checked = "";
										if(in_array($row1['ID'],$categories))
											$checked=" checked";
										
										echo'
											<li class="filter"><input type="checkbox" id="cat'.$row1['ID'].'" class="checkboxCategory" '.$checked.'/>'.$row1['Name'].' ('.$row1['NumCat'].')
												<div class="line-separator"></div>
											</li>';
									}
									mysqli_free_result($result1);
									//To print the last one
									if($prevFac != ""){
										echo'<input type="hidden" id="'.$prevFac.'" value="'.$catAsChild.'"/>';
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
						
						<input type="hidden" name="page" value="1">
					</form>
                </div>

                <div class="col-md-9 panel">
                    <div class="books-table">
							<h3>Books</h3>
                    </div>

                    <div id="dataMix">
                        <?php
						
						$sql = "SELECT distinct book.ID as BookID, Author, Title, Cover, Price, User_offerer FROM book
							INNER JOIN concern ON concern.Book = book.ID INNER JOIN insertion ON book.ID = insertion.Material_offered";
						
						//select the chosen category
						if($catSelected != ""){
							#$categories -> explode from catSelected (in previous section)
							$sql = $sql." AND (";
							for($i = 0; $i < sizeof($categories); $i = $i+1){
							    if($categories[$i] != "") {
                                    if ($i > 0)
                                        $sql = $sql . " OR ";
                                    $sql = $sql . "concern.Category = " . $categories[$i];
                                }
							}
							$sql = $sql.")";
						}
						
						if($priceMin != "")
							$sql = $sql." AND Price >=".$priceMin;
						if($priceMax != "")
							$sql = $sql." AND Price <=".$priceMax;
						
						if($search != "")
							$sql = $sql." AND (Title LIKE '%".$search."%' OR
												Description LIKE '%".$search."%' OR
												Author LIKE '%".$search."%')";
						
						if($fac != "")
							$sql = "SELECT distinct book.ID as BookID, Author, Title, Cover, Price, User_offerer from insertion,category,concern,book WHERE category.ID = concern.Category AND concern.Book = book.ID AND book.ID = insertion.Material_offered AND category.faculty = '".$fac."';";
						
						$result1 = $conn->query($sql) or die("Error query".$sql);
						$bookNumber = $result1->num_rows;
						$bookPerPage = 12;
						
						if($bookNumber >= 0){
						
							$linkPage = "category.php?fac=".$fac."&catSearched=".$catSelected."&search=".$search."&priceMin=".$priceMin."&priceMax=".$priceMax."&";
							$typeClassWidth = "col-md-3";
						
							require "paging.php";
						}
						else
							echo'<h4 class="noResults">There are not any results !</h4>';
						
						mysqli_free_result($result1);
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
