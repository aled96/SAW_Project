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
	
	
    <script src="js/changeSetting.js"></script>

</head>

  <body>

  <?php
    require "navbar.php";

  ?>
  
  <section class="container">
	<?php
		if(isset($_SESSION['username'])){
            echo'
			<section class="container">
			<div class="loginForm" id="signUpForm">
				<div class="panel panel-info">
					<div class="panel-heading">
						<div class="panel-title">Registration</div>
					</div>
					<section>
                    <label class="errorLogin" >
                        <p id="errorSettingsBox"><br></p>
                    </label>
                </section>
				<div class="panel-body">
					<form form action="script/changeSettings.php" method="POST" id="settingsForm" name="settingsForm" enctype="multipart/form-data">';

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
						<div class="input-group loginMargin">
								<a href="change_password.php"><button type="button" class="btn btn-success login-btn">Change Password </button></a>
						</div>
						<div class="input-group loginMargin">
							<span class="input-group-addon"><i class="fa fa-user"></i></span>
							<input type="text" placeholder="Username" id="userChange" name="userChange" readonly value="'.$row['Username'].'"class="form-control">
						</div>						
						
						<div class="input-group loginMargin">
							<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
							<input type="text" placeholder="Email address" id="emailChange" name="emailChange" onclick="removeErrorSettings()" onkeyup="removeErrorSettings()" class="form-control" value="'.$row['Email'].'">
						</div>

						<div class="input-group loginMargin">
							<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							<input onclick="removeErrorSettings()" type="date" id="dateChange" name="dateChange"  value="' . $row['Date_of_birth'] . '" class="form-control">
						</div>
						
						<div class="input-group loginMargin">
							<span class="input-group-addon"><i class="fa fa-user"></i></span>
							<input type="text" placeholder="First name" id="nameChange" name="nameChange" onclick="removeErrorChange()" onkeyup="removeErrorChange()"  value="' . $row['Name'] . '" class="form-control">
						</div>
						
						<div class="input-group loginMargin">
							<span class="input-group-addon"><i class="fa fa-user"></i></span>
							<input type="text" placeholder="Last name" id="surnameChange" name="surnameChange" onclick="removeErrorChange()" onkeyup="removeErrorChange()"  value="' . $row['Surname'] . '" class="form-control">
						</div>
						
						<div class="input-group loginMargin">';
						 if ($row['Gender'] == "male") {
						 echo '
							<select name="gender" id="gender" class="form-control">
								<option value="male" selected>Male</option>
							<option value="female">Female</option>
							</select>';
						}
						else{
						echo"<select name='gender' id='gender'>
							<option value='male'>Male</option>
							<option value='female' selected>Female</option>
							</select>";
						}
						echo'
						</div>
							
						<div class="input-group loginMargin">
							<select onclick="removeErrorSettings()" name="province" id="province" onchange="selectCity()" class="form-control">
								<option value="not-selected" selected disabled>Province</option>';
								
															
									$sql = "SELECT distinct Name FROM province";
									$result = $conn->query($sql);

									while($row = $result->fetch_assoc()) {
										$prov = $row['Name'];
										if(strlen($prov) != 0) {
											if(strcmp($provinceName, $prov) == 0)			
												echo "<option selected value='" . $prov . "'>" . $prov . "</option>";
											else{
												echo "<option value='" . $prov . "'>" . $prov . "</option>";
											}
										}
									}
						echo'
							</select>
						</div>
													
						<div class="input-group loginMargin">
							<select onclick="removeErrorSettings()" name="cityChange" id="cityChange" class="form-control">
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
						
						echo'
									
							</select>
						</div>
							
							
						<div class="input-group loginMargin">
							<input type="file" accept="image/*" id="image" name="image" onclick="removeErrorSettings()" onkeyup="removeErrorSettings()" required>
						</div>
						<br>
						<button type="button" onclick="checkSettings()" class="btn btn-success login-btn">Submit</button>
					</form>	
				</div>
			</div>
		</div>
		</section>';
		}
		}else
                header("location: index.php");
		?>
    </section>

  <?php
  require "footer.php";

  ?>
 
</body>
</html>