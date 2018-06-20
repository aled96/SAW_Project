<?php

require "../connectionDB.php";

$user = $conn->real_escape_string($_POST['userSign']);
$email = $conn->real_escape_string($_POST['emailSign']);
$pwd = $conn->real_escape_string($_POST['pswEncryptSign']);
$name = $conn->real_escape_string($_POST['nameSign']);
$surname = $conn->real_escape_string($_POST['surnameSign']);
$gender = $conn->real_escape_string($_POST['gender']);
$date_birth = $conn->real_escape_string($_POST['dateSign']);
$city = $conn->real_escape_string($_POST['citySign']);

if ($_FILES['image']['size'] == 0){
    $imgData = null;
}
else{
	$imgData = addslashes(file_get_contents($_FILES['image']['tmp_name']));
}

$sql2 = "SELECT ID from city where NAME = '".$city."'";

$result2 = mySQLi_query($conn, $sql2) or die("Error query2");

while($row2 = mySQLi_fetch_array($result2)){
    $city = $row2['ID'];
}

$sql = "INSERT INTO user (Username, Email, Password, Name, Surname, Gender, Date_of_birth, City, ProfilePic)
VALUES ('".$user."', '".$email."', '".$pwd."', '".$name."', '".$surname."', '".$gender."', '".$date_birth."', '".$city."','".$imgData."')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";

    $conn->close();

    $_SESSION['username'] = $user;

    if(isset($_SESSION['PrevPage']))
        header("location: ../".$_SESSION['PrevPage']);
    else
        header("location: ../index.php");
} else {
    $conn->close();
    header("location: ../index.php");
}


?>
