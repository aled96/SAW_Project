<?php

require "../connectionDB.php";

if(!isset($_SESSION['username'])) {
    header("location: index.php");
}

$user = $_SESSION['username'];
$email = $conn->real_escape_string($_POST['emailChange']);
$name = $conn->real_escape_string($_POST['nameChange']);
$surname = $conn->real_escape_string($_POST['surnameChange']);
$gender = $conn->real_escape_string($_POST['gender']);
$date_of_birth = $conn->real_escape_string($_POST['dateChange']);
$city = $conn->real_escape_string($_POST['cityChange']);

if ($_FILES['image']['size'] == 0){
    $img = null;
}
else{
	$img = addslashes(file_get_contents($_FILES['image']['tmp_name']));
}

if($img == null)
	$sql = "UPDATE user SET Email = '".$email."', Name = '".$name."', Surname = '".$surname."',Gender = '".$gender."',Date_of_birth = '".$date_of_birth."', City = '".$city."' WHERE Username = '".$user."'";
else
	$sql = "UPDATE user SET Email = '".$email."', Name = '".$name."', Surname = '".$surname."',Gender = '".$gender."',Date_of_birth = '".$date_of_birth."', City = '".$city."', ProfilePic = '".$img."' WHERE Username = '".$user."'";

$result = mySQLi_query($conn, $sql) or die("Error query");

header("location: ../show_profile.php?user=".$user."&page=1");

?>
