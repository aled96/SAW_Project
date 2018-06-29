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
    
	<link rel="stylesheet" href="css/form.css">
	
    <?php
		require "head.php";
	?>
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
			<div class="loginForm" id="signUpForm">
				<div class="panel panel-info">
					<div class="panel-heading">
						<div class="panel-title">Registration</div>
					</div>
					<section>
                    <label class="errorLogin" >
                        <span id="errorSettingsBox"><br></span>
                    </label>
                </section>
				<div class="panel-body">
					<form action="script/changeSettings.php" method="POST" id="settingsForm" name="settingsForm" enctype="multipart/form-data">';

            $user = $_SESSION['username'];

            $sql = "SELECT user.*, city.Name as Cityname, province.Name as Provincename FROM user, city, province WHERE Username='" . $user . "' and user.City = city.ID and city.Province = province.ID ";
            $result = mySQLi_query($conn, $sql) or die("Error query".$sql);

            while ($user_info = mySQLi_fetch_array($result)) {
                $provinceName = $user_info['Provincename'];
                $cityName = $user_info['Cityname'];
                echo '
						<div class="input-group loginMargin">
								<a href="change_password.php" class="btn btn-success login-btn">Change Password </a>
						</div>
						<div class="input-group loginMargin">
							<span class="input-group-addon"><i class="fa fa-user"></i></span>
							<input type="text" placeholder="Username" id="userChange" name="userChange" readonly value="'.$user_info['Username'].'" class="form-control">
						</div>						
						
						<div class="input-group loginMargin">
							<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
							<input type="text" placeholder="Email address" id="emailChange" name="emailChange" onclick="removeErrorChange()" onkeyup="removeErrorChange()" class="form-control" value="'.$user_info['Email'].'">
						</div>
						
						
                        <h4 class="loginMargin">Personal Information</h4>

						
						<div class="input-group loginMargin">
							<span class="input-group-addon"><i class="fa fa-user"></i></span>
							<input type="text" placeholder="First name" id="nameChange" name="nameChange" onclick="removeErrorChange()" onkeyup="removeErrorChange()"  value="' . $user_info['Name'] . '" class="form-control">
						</div>
						
						<div class="input-group loginMargin">
							<span class="input-group-addon"><i class="fa fa-user"></i></span>
							<input type="text" placeholder="Last name" id="surnameChange" name="surnameChange" onclick="removeErrorChange()" onkeyup="removeErrorChange()"  value="' . $user_info['Surname'] . '" class="form-control">
						</div>
						
						
						<div class="input-group loginMargin">
							<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							<input onclick="removeErrorChange()" type="date" id="dateChange" name="dateChange"  value="' . $user_info['Date_of_birth'] . '" class="form-control">
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
						
                        <h4 class="loginMargin">City of Birth</h4>
							
						<div class="input-group loginMargin">
							<select onclick="removeErrorChange()" name="province" id="province" onchange="selectCity()" class="form-control">
								<option value="not-selected" selected disabled>Province</option>';
								
															
									$sql1 = "SELECT distinct ID, Name FROM province";
									$result1 = $conn->query($sql1);

									while($row1 = $result1->fetch_assoc()) {
										$prov = $row1['Name'];
                                        $id = $row1['ID'];
										if(strlen($prov) != 0) {
											if(strcmp($provinceName, $prov) == 0)			
												echo "<option selected value='" . $id . "'>" . $prov . "</option>";
											else{
												echo "<option value='" . $id . "'>" . $prov . "</option>";
											}
										}
									}
									mysqli_free_result($result1);
						echo'
							</select>
						</div>
													
						<div class="input-group loginMargin">
							<select onclick="removeErrorChange()" name="cityChange" id="cityChange" class="form-control">
								<option value="not-selected" selected disabled>City</option>';
						
						 $sql2 = "SELECT distinct city.* FROM city, province where city.Province = province.ID and province.Name = '".$provinceName."'";
						$result2 = $conn->query($sql2);

						while ($row2 = $result2->fetch_assoc()) {
							$city = $row2['Name'];
							$cityId = $row2['ID'];
							if (strlen($city) != 0) {
								if(strcmp($cityName, $city) == 0)
									echo "<option selected value='".$cityId."'>" . $city . "</option>";
								else
									echo "<option value='".$cityId."'>" . $city . "</option>";
							}
						}
						mysqli_free_result($result2);
						
						echo'
									
							</select>
						</div>
							
							
                        <h4 class="loginMargin">Profile Pic</h4>
						<div class="input-group loginMargin">
							<div class="col-md-10 col-sm-12 col-xs-10 col-lg-10 show-img-modify">
								<img id="imageShow" src="data:image/jpeg;base64,'.base64_encode($user_info['ProfilePic']).'" alt="cover"/>
							</div>
							<input type="file" accept="image/*" id="imageChange" name="image" onclick="removeErrorChange()" onchange="loadFile(event)" required>
						</div>
						<br>
						<button type="button" onclick="checkSettings()" class="btn btn-success login-btn">Submit</button>
					</form>	
				</div>
			</div>
		</div>';
			}
			mysqli_free_result($result);
		}else
                header("location: index.php");
		?>
    </section>

  <?php
  require "footer.php";

  ?>
 
</body>
</html>
