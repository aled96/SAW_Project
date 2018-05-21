<div class="navbar navbar-inverse">
    <div class="navbar-inner">
        <div class="container-fluid">
            <button class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse" data-disabled="true">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="brand" href="index.php" id="top">Site Name</a>
            <div id= "auto-height" class="nav-collapse collapse" style="height:0px;" data-disabled="true" aria-expanded="false">
                <ul class="nav">
                    <li><a href="index.php"><i class="icon-home icon-white"></i> Home</a></li>
                    <li class="divider-vertical"></li>
                    <li><a href="category.php"><i class="icon-th-list icon-white"></i> Categories</a></li>
                    <li class="divider-vertical"></li>
                    <?php
                    if(isset($_SESSION['username'])) {
                        $servername = "localhost";
                        $username = "root";
                        $password = "password";
                        $dbname = "university_sharing";

                        // Create connection
                        $conn = new mysqli($servername, $username, $password, $dbname);

                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        $user = $_SESSION['username'];
                        $sql2 = "SELECT COUNT(*) as count FROM chat WHERE Is_read = false and User_to = '".$user."'";
                        $result2 = mySQLi_query($conn, $sql2) or die("Error query");
                        $row2 = mySQLi_fetch_array($result2);
                        $unread_count = $row2['count'];
                        if($unread_count == 0)
                            echo '<li><a href="chat.php"><i class="icon-envelope icon-white"></i> Messagges</a></li>
                                <li class="divider-vertical"></li>';
                        else
                            echo '<li><a href="chat.php"><i class="icon-envelope icon-white"></i> Messagges <i class="fa fa-exclamation" style="color: red;"></i></a></li>
                                <li class="divider-vertical"></li>';
                    }
                    ?>
                    <li><form action="search.php" method="get">
                            <input type="text" class="searchNav" placeholder="Search..." name="find" required><span class="searchButton"><button type="submit"><i class="icon-search icon-black"></i> </button></span>
                        </form>
                    </li>
                    <li class="divider-vertical"></li>
                </ul>

                <?php
                if(isset($_SESSION['username']))
                {

                    echo '<ul class="nav navbar-nav navbar-right pull-right">
                                    <li class="dropdown">
                                        <a href="#" data-toggle="dropdown" class="dropdown-toggle" onClick="autoHeight()"><i class="icon-user"></i>'.$user.'<b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="show_profile.php?user='.$user.'&page=1"><i class="icon-user"></i>Dashboard</a></li>
                                            <li class="divider"></li>
                                            <li><a href="insert_new.php"><i class="icon-plus"></i>Add Book</a></li>
                                            <li class="divider"></li>
                                            <li><a href="favourite.php"><i class="icon-heart"></i> Wish List</a></li>
                                            <li class="divider"></li>
                                            <li><a href="setting.php"><i class="icon-wrench"></i> Settings</a></li>
                                            <li class="divider"></li>
                                            <li><a href="logout.php"><i class="icon-share"></i>Logout</a></li>
                                        </ul>
                                    </li>
                                </ul>';
                }
                else
                {
                    echo "<ul class='nav navbar-nav navbar-right pull-right'>
							<li><a href='login.php'><i class='icon-user'></i>Log In</a></li>
							<li class='divider'></li>
							</ul>";

                }

                ?>



            </div>
            <!--/.nav-collapse -->
        </div>
        <!--/.container-fluid -->
    </div>
    <!--/.navbar-inner -->
</div>
