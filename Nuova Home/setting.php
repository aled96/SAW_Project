<!DOCTYPE html>
<html lang="en">

<?php
	require "connectionDB.php";
	
    if(!isset($_SESSION['username']))
    {
        header("location: index.php");
    }
?>

  <head>
    
	
    <title>BookTrader</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

    <link href="http://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900|Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic|Open+Sans:300italic,400italic,600italic,700italic,400,700,600,300|Poppins:400,500,700,300,600" rel="stylesheet" type="text/css">

    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">


    <link rel="stylesheet" href="css/NewHomeTest.css">
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
  
  <section class="container">
	<?php
		if(isset($_SESSION['username'])){
            echo'
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

            $user = $_SESSION['username'];

            $sql = "SELECT user.*, city.Name as Cityname, province.Name as Provincename FROM user, city, province WHERE Username='" . $user . "' and user.City = city.ID and city.Province = province.ID ";
            $result = mySQLi_query($conn, $sql) or die("Error query".$sql);

            while ($user_info = mySQLi_fetch_array($result)) {
                $provinceName = $user_info['Provincename'];
                $cityName = $user_info['Cityname'];
                echo '
						<div class="input-group loginMargin">
								<a href="change_password.php"><button type="button" class="btn btn-success login-btn">Change Password </button></a>
						</div>
						<div class="input-group loginMargin">
							<span class="input-group-addon"><i class="fa fa-user"></i></span>
							<input type="text" placeholder="Username" id="userChange" name="userChange" readonly value="'.$user_info['Username'].'"class="form-control">
						</div>						
						
						<div class="input-group loginMargin">
							<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
							<input type="text" placeholder="Email address" id="emailChange" name="emailChange" onclick="removeErrorChange()" onkeyup="removeErrorChange()" class="form-control" value="'.$user_info['Email'].'">
						</div>

						<div class="input-group loginMargin">
							<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							<input onclick="removeErrorChange()" type="date" id="dateChange" name="dateChange"  value="' . $user_info['Date_of_birth'] . '" class="form-control">
						</div>
						
						<div class="input-group loginMargin">
							<span class="input-group-addon"><i class="fa fa-user"></i></span>
							<input type="text" placeholder="First name" id="nameChange" name="nameChange" onclick="removeErrorChange()" onkeyup="removeErrorChange()"  value="' . $user_info['Name'] . '" class="form-control">
						</div>
						
						<div class="input-group loginMargin">
							<span class="input-group-addon"><i class="fa fa-user"></i></span>
							<input type="text" placeholder="Last name" id="surnameChange" name="surnameChange" onclick="removeErrorChange()" onkeyup="removeErrorChange()"  value="' . $user_info['Surname'] . '" class="form-control">
						</div>
						
						<div class="input-group loginMargin">';
						 if ($user_info['Gender'] == "male") {
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
							<select onclick="removeErrorChange()" name="province" id="province" onchange="selectCity()" class="form-control">
								<option value="not-selected" selected disabled>Province</option>';
								
															
									$sql = "SELECT distinct ID, Name FROM province";
									$result = $conn->query($sql);

									while($row = $result->fetch_assoc()) {
										$prov = $row['Name'];
                                        $id = $row['ID'];
										if(strlen($prov) != 0) {
											if(strcmp($provinceName, $prov) == 0)			
												echo "<option selected value='" . $id . "'>" . $prov . "</option>";
											else{
												echo "<option value='" . $id . "'>" . $prov . "</option>";
											}
										}
									}
						echo'
							</select>
						</div>
													
						<div class="input-group loginMargin">
							<select onclick="removeErrorChange()" name="cityChange" id="cityChange" class="form-control">
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
							
							
						<div class="input-group loginMargin"><img src="data:image/jpeg;base64,'.base64_encode($user_info['ProfilePic']).'" alt="cover"/>
							<input type="file" accept="image/*" id="image" name="image" onclick="removeErrorChange()" required>
						</div>
						<br>
						<button type="button" onclick="checkSettings()" class="btn btn-success login-btn">Submit</button>
					</form>	
				</div>
			</div>
		</div>';
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