<!DOCTYPE html>
<html lang="en">
<?php
	require "connectionDB.php";
	
	$_SESSION['PrevPage'] = "index.php";
?>
<head>
    <?php
		require "head.php";
	?>
</head>
<body>

	<!--Navbar-->
	<?php
	require "navbar.php";
	?>
	
	<!--ImageHome-->
    <section>
        <div class="homePic">
			<img src="https://www.pixelstalk.net/wp-content/uploads/2016/08/Library-HD-Background.jpg"> 
        </div>
    </section>

	

    <!--TOP SERVICES-->
    <section>
        <div class="block-service block-service-opt">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 height200">
                        <div class="item">
                            <div class="simbol-ft"><i class="fa fa-life-ring" aria-hidden="true"></i></div>
                            <div class="simbol-desc">
                                <p class="title">Safe Shopping</p>
                                <p>Safe Shopping Guarantee</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 height200">
                        <div class="item">
                            <div class="simbol-ft"><i class="fa fa-clock-o" aria-hidden="true"></i></div>
                            <div class="simbol-desc">
                                <p class="title">30- day return </p>
                                <p>Moneyback guarantee</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 height200">
                        <div class="item">
                            <div class="simbol-ft"><i class="fa fa-user" aria-hidden="true"></i></div>
                            <div class="simbol-desc">
                                <p class="title">Meet the seller </p>
                                <p>Check the product directly</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 height200">
                        <div class="item">
                            <div class="simbol-ft"><i class="fa fa-headphones" aria-hidden="true"></i></div>
                            <div class="simbol-desc">
                                <p class="title">24/7 support</p>
                                <p>online Consultations</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!--FEATURED PRODUCTS-->
    <section class="container">
        <div class="row">
            <div class="width100 text-center">
                <h1>LAST ADDED</h1>
                <p class="sub-title">Here you can see the last book added ! Don't let them go</p>
            </div>
            <div class="width100">
			
				<?php
				
				$sql = "SELECT book.*, insertion.*, book.ID as BookID FROM book,insertion WHERE book.ID = insertion.Material_offered ORDER BY book.ID desc LIMIT 6 ";
				$result = mySQLi_query($conn, $sql) or die("Error query");

				while($row = mySQLi_fetch_array($result)){


                    #Check if logged
                    $fav_status="fa fa-heart-o";
                    $link = "login.php";
                    if(isset($_SESSION['username'])){
                        $user = $_SESSION['username'];

                        #Check if user == userProfile

                        if(strcmp($row['User_offerer'], $user) == 0){
                            $fav_status = "fa fa-pencil-square-o";
                            $link = "modify_book.php?Id=".$row['BookID'];
                        }
                        else {
                            #Check if in wishlist
                            $sql2 = "SELECT COUNT(*) as IsThere FROM wishlist WHERE Book='" . $row['BookID'] . "' and Username='" . $user . "';";

                            $result2 = mySQLi_query($conn, $sql2) or die("Error query");
                            #If is in list -> change calss for star icon
                            while ($row2 = mySQLi_fetch_array($result2)) {
                                if ($row2['IsThere'] == 1)
                                    $fav_status = "fa fa-heart";
                            }
                            $link = "preferite";
                        }
                    }
				
				echo"
						<div class='col-md-2 my-shop-animation'>
							<div class='box-prod group-book'>
								<div class='box-img-book'>
									<img src='data:image/jpeg;base64,".base64_encode($row['Cover'])."' alt='cover'/>
									<div class='box-btn-shop'>
										<div class='bt-img'><a class='btn btn-det-cart' href='pageBook.php?Id=".$row['BookID']."'><i class='fa fa-list'></i></a></div>";
                if(strcmp($link, "preferite") == 0){
                    echo "
                                                <div class='bt-img'><a class='btn btn-det-cart'><span id='heart-preferite".$row['BookID']."'><i onClick='preferite(".$row['BookID'].")' class='" . $fav_status . "'></i></span></a></div>";
                }
                else{
                    echo "
                                                <div class='bt-img'><a class='btn btn-det-cart' href='" . $link . "'><i class='" . $fav_status . "'></i></a></div>";
                }

                echo"
									</div>
								</div>
								<h2 class='title-book'>".$row['Title']."</h2>
								<p class='author-txt'>".$row['Author']."</p>
								<p class='book-price'>".$row['Price']." €</p>
							</div>
						</div>
							";
				}
				?>
            </div>
        </div>
    </section>

<!--Footer-->
	<?php
	require "footer.php";
	?>

	
</body>
</html>