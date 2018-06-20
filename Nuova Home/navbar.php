<!--Navbar-->

<!-- for minimenu-->
<script>
function minimenu(){
	if(document.getElementById("minimenu").style.visibility == "hidden"){
		document.getElementById("minimenu").style.visibility = "visible";
		document.getElementById("minimenu").style.height = "auto";
	}
	else{
		document.getElementById("minimenu").style.visibility = "hidden";
		document.getElementById("minimenu").style.height = "0px";
	}
}

</script>

    <header>
        <div id="top" class="container box-logo-menu">
            <div class="row">
                <nav class="navigation-menu">

                    <div class="col-md-3 content-logo">
                        <h2>Book<span>Trader</span></h2>
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" onclick="minimenu();">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                    </div>
                    <div class="mainmenu">
                        <div class="collapse navbar-collapse" id="navbar-collapse-1">
                            <ul class="menu-first-level">
                                <li>
                                    <a href="index.php">Home</a>
                                </li>
                                <?php
								
									if(isset($_SESSION['username'])){
									
										$user = $_SESSION['username'];
										$sql = "SELECT COUNT(*) as count FROM chat WHERE Is_read = false and User_to = '".$user."'";
										$result = mySQLi_query($conn, $sql) or die("Error query");
										$row = mySQLi_fetch_array($result);
										$unread_count = $row['count'];
										
										echo '<span id="all_messages"><li>
												<a href="chat.php">Messages';
													
										if($unread_count > 0)
											echo'<i class="fa fa-exclamation-circle red-message" id="message-alert" name="message-alert"></i>';
													
										echo'	</a>
											</li></span>';
									}

                                ?>
                                <li class="exp-mega">
                                    <a href="category.php">Categories</a>
                                    <!-- Mega Menu Four Column -->
                                    <div class="mega-menu">
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

										$i = 0;
										$toClose=false;
										while($row = $result->fetch_assoc()) {
											if($i == 0){
												echo'<span>';
												$toClose=true;
											}
											$i++;
											echo'<a href="#">'.$row['Name'].'</a>';
											if($i == 3){
												$i = 0;
												$toClose=false;
												echo'</span>';
											}
										}
										if($toClose)
											echo'</span>';
										?>
                                    </div>
                                </li>
								
								<?php
								
								if(!isset($_SESSION['username']))
									echo"<li><a href='login.php'>Login</a></li>";
								else{
									echo"
									<li class='exp-mega'>
										<div class='item'>
												<i class='fa fa-user'></i>
											</div>
										<!-- Menu One Column -->
										<div class='mega-menu little-menu'>
											<span>
												<a href='show_profile.php?user=".$_SESSION['username']."'>Dashboard</a>
												<a href='insert_new.php'>AddBook</a>
												<a href='#'>Wishlist</a>
												<a href='setting.php'>Settings</a>
												<a href='script/logout.php'>Logout</a>
											</span>
										</div>
									</li>";
									}
								?>
                            </ul>
							
                        </div>
                    </div>
					<!-- Mini Menu (after pressed hamburger)-->
					<div class="col-md-8 mainmenu minimenu" id="minimenu">
                        <div class="navbar-collapse">
                            <ul>
                                <li>
                                    <a href="index.php">Home</a>
                                </li>
								<br>
								<?php
                                if(isset($_SESSION['username']))
                                    echo '<li><a href="chat.php">Messages</a></li><br>';

                                echo'
								<li>
                                    <a href="category.php">Categories</a>
                                </li>';
								
								if(!isset($_SESSION['username']))
									echo"<li><a href='login.php'>Login</a></li>";
								else{
									echo"
									<li class='exp-mega'>
										<a href='#'>User Info</a>
									</li>";
									}
								?>
								
                            </ul>
                        </div>
                    </div>
					
                </nav>

            </div>
        </div>
    </header>