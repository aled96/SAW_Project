<!DOCTYPE html>
<html lang="en">
<?php
session_start();
$_SESSION['PrevPage'] ="setting.php";
?>
<head>
    <title>Site Name</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">

    <link rel="stylesheet" media="all" href="css/footer.css" />
    <link rel="stylesheet" media="all" href="css/common.css" />
    <link rel="stylesheet" media="all" href="css/login.css" />
    <script src="js/common.js"></script>
    <script src="js/changeSetting.js"></script>

    <?php
    if(isset($_SESSION['username'])) {
        echo '<script src="js/message_updates.js"></script>';
    }
    ?>
</head>

<body>


  <?php
  require "navbar.php";
  ?>
     <?php

        if(isset($_SESSION['username'])){
            echo'
              <div class="backimg">
                <div class="body" id="settings">
                    <form action="script/changeSettings.php" method="POST" name="settingsForm" class="sky-form" enctype="multipart/form-data">
                        <header>Update Information</header>';

            require "db/mysql_credentials.php";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            $user = $_SESSION['username'];

            $sql = "SELECT user.*, city.Name as Cityname, province.Name as Provincename FROM user, city, province WHERE Username='" . $user . "' and user.City = city.ID and city.Province = province.ID ";
            $result = mySQLi_query($conn, $sql) or die("Error query".$sql);

            while ($row = mySQLi_fetch_array($result)) {
                $provinceName = $row['Provincename'];
                $cityName = $row['Cityname'];
                echo '
            <fieldset>
                <section>
                    <label class="input" >
                        <a href="change_password.php"><button type="button" class="change-password-button" >Change Password </button></a>
                    </label>
                </section>
                <section>
                    <label class="input" >
                        <p class="errorLogin" id="errorSettingsBox"><br></p>
                    </label>
                </section>
                <section>
                    <label class="input">
                        Username
                    </label>
                    <label class="input">
                        <i class="icon-append icon-user"></i>
                        <input type="text" placeholder="Username" id="userChange" name="userChange" readonly value="'.$row['Username'].'">
                    </label>
                </section>

                <section>
                    <label class="input">
                        Email
                    </label>
                    <label class="input">
                        <i class="icon-append icon-envelope-alt"></i>
                        <input type="text" placeholder="Email address" id="emailChange" name="emailChange" onclick="removeErrorChange()" onkeyup="removeErrorChange()"  value="'.$row['Email'].'">
                        <b class="tooltip tooltip-bottom-right">Needed to verify your account</b>
                    </label>
                </section>

            </fieldset>

            <fieldset>
                <section>
                    <label class="input">
                        Date of Birth
                    </label>
                    <label class="input">
                        <i class="icon-append icon-calendar"></i>
                        <input type="date" id="dateChange" name="dateChange" onclick="removeErrorChange()"  value="' . $row['Date_of_birth'] . '">
                    </label>
                </section>
            </fieldset>

            <fieldset>
                <div class="row">
                    <section class="col col-6">
                        <label class="input">
                            Name
                        </label>
                    <label class="input">
                            <input type="text" placeholder="First name" id="nameChange" name="nameChange" onclick="removeErrorChange()" onkeyup="removeErrorChange()"  value="' . $row['Name'] . '">
                        </label>
                    </section>
                    <section class="col col-6">
                        <label class="input">
                        Surname
                    </label>
                    <label class="input">
                            <input type="text" placeholder="Last name" id="surnameChange" name="surnameChange" onclick="removeErrorChange()" onkeyup="removeErrorChange()"  value="' . $row['Surname'] . '">
                        </label>
                    </section>
                </div>

                <section>
                    <label class="input">
                        Gender
                    </label>
                    <label class="select">';
                    if ($row['Gender'] == "male") {
                        echo "
							<select  onclick='removeErrorChange' name='gender' id='gender'>
							<option value='male' selected>Male</option>
							<option value='female'>Female</option>
							</select>
							";
                    } else {
                        echo "
							<select onclick='removeErrorChange' name='gender' id='gender'>
							<option value='male'>Male</option>
							<option value='female' selected>Female</option>
							</select>
							";
                    }
                    echo '
                        <i></i>
                    </label>
                </section>
            </fieldset>

            <fieldset>
                <section>
                    <label class="input">
                        Province of Birth
                    </label>
                    <label class="select">
                        <select onclick="removeErrorChange()" name="province" id="province" onchange="selectCity()">
                            <option value="not-selected" selected disabled>Province</option>';
                    $sql = "SELECT distinct Name FROM province";
                    $result = $conn->query($sql);

                    while ($row = $result->fetch_assoc()) {
                        $prov = $row['Name'];
                        if (strlen($prov) != 0) {
                            if(strcmp($provinceName, $prov) == 0)
                                echo "<option selected value='" . $prov . "'>" . $prov . "</option>";
                            else
                                echo "<option value='" . $prov . "'>" . $prov . "</option>";
                        }
                    }
                    echo '
                        </select>
                        <i></i>
                    </label>
                </section>

                <section>
                    <label class="input">
                        City of Birth
                    </label>
                    <label class="select">
                        <select  onclick="removeErrorChange()"name="cityChange" id="cityChange">
                            <option value="not-selected" selected disabled>City</option>';

                    $sql = "SELECT distinct city.* FROM city, province where city.Province = province.ID and province.Name = '".$provinceName."'";
                    $result = $conn->query($sql);

                    while ($row = $result->fetch_assoc()) {
                        $city = $row['Name'];
						$cityId = $row['ID'];
                        if (strlen($city) != 0) {
                            if(strcmp($cityName, $city) == 0)
                                echo "<option selected value='".$cityId."'>" . $city . "</option>";
                            else
                                echo "<option value='".$cityId."'>" . $city . "</option>";
                        }
                    }

                    $conn->close();
                    echo '
                        </select>
                        <i></i>
                    </label>
                </section>
				
				<section>
						<label class="input">
							Profile Picture
						</label>
						<label class="input">
							<input type="file" accept="image/*" id="image" name="image" onclick="removeErrorChange()">
						</label>
				</section>
				
            </fieldset>

            <footer>
                <button type="button" onclick="checkSettings()" class="button">Submit</button>
            </footer>
        </form>
        <br><br>
    </div>
    </div>';
                }
            }
            else
                header("location: index.php");
			?>


    <?php
    require "footer.php";

    ?>

</body>
</html>
